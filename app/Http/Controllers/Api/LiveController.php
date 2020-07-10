<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class LiveController extends Controller
{

    public function list()
    {

      $fb = new Facebook([
        'app_id' => $_ENV['FB_APP_ID'],
        'app_secret' => $_ENV['FB_APP_SECRET'],
        'default_graph_version' => 'v2.3',
      ]);

      $permissions = ['email', 'pages_show_list', 'pages_read_user_content', 'pages_manage_posts', 'publish_video', 'pages_messaging', 'pages_read_engagement', 'pages_manage_engagement', 'publish_to_groups'];

      $res = $fb->get('/me?fields=id,name,birthday,email,first_name,last_name,gender,picture');
      $id = $res->getGraphNode()->getField('id');
      $name = $res->getGraphNode()->getField('name');
      $checkPermission = $fb->get('/' . $id . '/permissions');
      $user = $fb->get('/' . $id . '/accounts');
      $pages = $user->getGraphEdge()->asArray();

      return response()->json(123123);
    }
}