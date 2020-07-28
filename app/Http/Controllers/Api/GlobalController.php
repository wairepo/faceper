<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Facebook\Facebook as Facebook;
// use Facebook\Exceptions\FacebookResponseException;
// use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Auth;

class GlobalController extends Controller
{

    public function global()
    {
      $params = [

        "user" => [

          "id" => 1,
          "email" => "kwai8891@gmail.com"

        ],
        "env" => [

          "website_base" => ".faceper.co",
          "app_env" => ENV('APP_ENV'),
          "locale" => "en_US",
          "fb_app_id" => ENV('FB_APP_ID'),
          "fb_default_version" => ENV('FB_DEFAULT_VERSION')

        ]

      ];

      return response()->json($params);
    }
}































