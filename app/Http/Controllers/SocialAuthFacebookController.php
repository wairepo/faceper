<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Facebookapi\AccountService;
use Socialite;
use Cookie;

use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class SocialAuthFacebookController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect()
    {
      $permissions = ['pages_show_list', 'pages_read_user_content', 'pages_manage_posts', 'publish_video', 'pages_messaging', 'pages_read_engagement', 'pages_manage_engagement', 'publish_to_groups'];
      $fields = ['email', 'first_name', 'last_name', 'picture'];

      return Socialite::driver('facebook')->fields($fields)->scopes($permissions)->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(AccountService $service)
    {
      $abc = Socialite::driver('facebook')->user();
		  $user = $service->createOrGetUser($abc);
      $token = $abc->token;

      $fb = new Facebook([
        'app_id' => ENV('FB_APP_ID'),
        'app_secret' => ENV('FB_APP_SECRET'),
        'default_graph_version' => 'v2.3',
      ]);

      $fb->setDefaultAccessToken((string)$token);

      $checkToken = $fb->get('/oauth/access_token?grant_type=fb_exchange_token&client_id='. ENV('FB_APP_ID') .'&client_secret='. ENV('FB_APP_SECRET') .'&fb_exchange_token=' . (string)$token);

      $checkTokenRes = $checkToken->getGraphNode();

      $accessToken = $checkTokenRes['access_token'];
      $fb->setDefaultAccessToken($accessToken);

      Cookie::queue( "fb_token", $accessToken, 43800 );
      Cookie::queue( "u", $user->id, 43800 );

      auth()->login($user, true);

      return redirect()->to('/pages');
    }
}