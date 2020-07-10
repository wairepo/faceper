<?php

namespace App\Http\Controllers\Api;

use Cookie;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException;
use App\Models\Page;

class PageController extends ApiController
{

  public function list(Request $request)
  {

    if( $request->cookie('page_token') ) {
      return response()->json(["success" => false, "message" => "page_found"]);
    }

    $fb = new Facebook();

    $fb->setDefaultAccessToken($request->cookie('fb_token'));

    $res = $fb->get('/me?fields=id,name,birthday,email,first_name,last_name,gender,picture');
    $account = $fb->get('/'. Auth::user()->fb_user_id .'/accounts?access_token=' . $request->cookie('fb_token'));

    $pages = $account->getGraphEdge()->asArray();

    $result = [];

    foreach ($pages as $key => $value) {

      $params = [

        "id"            => $value['id'],
        "access_token"  => $value['access_token'],
        "category"      => $value['category'],
        "name"          => $value['name'],
        "value"         => [
              "id"            => $value['id'],
              "name"          => $value['name'],
              "category"      => $value['category']
        ]
      ];

      array_push($result, $params);
    }

    return response()->json(["success" => true, "data" => $result]);
  }

  public function create(Request $request)
  {
    $page = Page::create([
      'user_id' => Auth::user()->id,
      'page_id' => $request['id'],
      'name' => $request['name'],
      'category' => $request['category']
    ]);

    if( $page ) {
      Cookie::queue( "page_token", $page->page_id, 43800);
    }

    return response()->json(["success" => true]);
  }
}









