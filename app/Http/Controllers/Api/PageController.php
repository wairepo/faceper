<?php

namespace App\Http\Controllers\Api;

use Cookie;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;

class PageController extends ApiController
{

  public function list(Request $request)
  {

    $user = User::find(Auth::user()->id);

    if( $request->cookie("p") ) {
      return response()->json(["success" => false, "message" => "page_exists"]);
    }

    $page = $user->pages;

    if( !empty($page) ) {

      Cookie::queue( "p", $page[0]['id'], 43800);

      return response()->json(["success" => false, "message" => "page_exists"]);
    }

    $fb = new Facebook();

    $fb->setDefaultAccessToken($request->cookie('fb_token'));

    $res = $fb->get('/me?fields=id,name,birthday,email,first_name,last_name,gender,picture');
    $account = $fb->get('/'. Auth::user()->fb_user_id .'/accounts?access_token=' . $request->cookie('fb_token'));

    $pages = $account->getGraphEdge()->asArray();

    $result = [];

    foreach ($pages as $key => $value) {

      if( in_array("MANAGE", $value['tasks']) ) {

        $params = [

          "id"            => $value['id'],
          "access_token"  => $value['access_token'],
          "category"      => $value['category'],
          "name"          => $value['name'],
          "value"         => [
                "id"                => $value['id'],
                "name"              => $value['name'],
                "category"          => $value['category'],
                "access_token"      => $value['access_token']
          ]
        ];

        array_push($result, $params);
      }
    }

    return response()->json(["success" => true, "data" => $result, "pages" => $pages]);
  }

  public function create(Request $request)
  {
    $page = Page::where("page_id", $request['id'])->first();

    if( !empty($page) ) {

      Cookie::queue( "p", $page->page_id, 43800);
      
      return response()->json(["success" => false, "message" => "page_exists"]);
    }

    if( $request->cookie("p") ) {
      return response()->json(["success" => false, "message" => "page_exists"]);
    }

    $page = Page::create([
      'page_id' => $request['id'],
      'token' => $request['access_token'],
      'name' => $request['name'],
      'category' => $request['category']
    ]);

    if( $page ) {

      Role::create([ "user_id" => Auth::user()->id, "page_id" => $page->id, "role" => "owner" ]);

      // return response()->json($request->cookie('fb_token'));

      // $fb = new Facebook();
      // $fb->setDefaultAccessToken($request->cookie('fb_token'));
      // $res = $fb->get('/'. $page->id );

      // return response()->json($res);

      Cookie::queue( "p", $page->page_id, 43800);
    }

    return response()->json(["success" => true]);
  }
}









