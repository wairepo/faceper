<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class WebhookController extends Controller
{
    public function create()
    {
      Post::create([
        'page_id' => 1111,
        'post_id' => 33333,
        'description' => 11111
      ]);
    }
}