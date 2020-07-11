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
      $permissions = ['pages_show_list', 'pages_read_user_content', 'pages_manage_posts', 'publish_video', 'pages_messaging', 'pages_read_engagement', 'pages_manage_engagement', 'publish_to_groups', 'pages_manage_metadata'];
      // $permissions = ['pages_show_list', 'pages_read_user_content', 'pages_manage_posts', 'publish_video', 'pages_messaging', 'pages_read_engagement', 'pages_manage_engagement', 'publish_to_groups', 'pages_manage_metadata', 'manage_page'];
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
      $fbresult = Socialite::driver('facebook')->user();
		  $user = $service->createOrGetUser($fbresult);
      $accessToken = $fbresult->token;

      $fb = new Facebook([
        'app_id' => ENV('FB_APP_ID'),
        'app_secret' => ENV('FB_APP_SECRET'),
        'default_graph_version' => 'v2.3',
      ]);

      $fb->setDefaultAccessToken((string)$accessToken);

      $checkToken = $fb->get('/oauth/access_token?grant_type=fb_exchange_token&client_id='. ENV('FB_APP_ID') .'&client_secret='. ENV('FB_APP_SECRET') .'&fb_exchange_token=' . (string)$accessToken);

      $checkTokenRes = $checkToken->getGraphNode();

      $accessToken = $checkTokenRes['access_token'];
      $fb->setDefaultAccessToken((string)$accessToken);

      // if (! $accessToken->isLongLived()) {

        $oAuth2Client = $fb->getOAuth2Client();
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);

        $tokenMetadata->validateAppId(ENV('FB_APP_ID'));
        $tokenMetadata->validateExpiration();
        try {
          $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
          $fb->setDefaultAccessToken($accessToken);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
          echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
          exit;
        }
      // }

      Cookie::queue( "fb_token", $accessToken, 43800 );
      Cookie::queue( "u", $user->id, 43800 );

      auth()->login($user, true);

      return redirect()->to('/pages');
    }
}