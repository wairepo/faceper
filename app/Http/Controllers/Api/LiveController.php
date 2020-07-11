<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Auth;

class LiveController extends Controller
{

    public function list(Request $request)
    {
      $fb = new Facebook();

      $fb->setDefaultAccessToken($request->cookie('fb_token'));

      // $res = $fb->get('/feed/?fields=can_reply_privately,from,message,comments{can_reply_privately,from,message}&access_token=' . $request->cookie('fb_token'));
      // $account = $fb->get('/'. Auth::user()->fb_user_id .'/accounts?access_token=' . $request->cookie('fb_token'));

      // $pages = $account->getGraphEdge()->asArray();

      return response()->json($request->cookie('page_token'));

      // $permissions = ['email', 'pages_show_list', 'pages_read_user_content', 'pages_manage_posts', 'publish_video', 'pages_messaging', 'pages_read_engagement', 'pages_manage_engagement', 'publish_to_groups'];

      // $res = $fb->get('/me?fields=id,name,birthday,email,first_name,last_name,gender,picture');
      // $id = $res->getGraphNode()->getField('id');
      // $name = $res->getGraphNode()->getField('name');
      // $checkPermission = $fb->get('/' . $id . '/permissions');
      // $user = $fb->get('/' . $id . '/accounts');
      // $pages = $user->getGraphEdge()->asArray();

      return response()->json(123123);
    }
}