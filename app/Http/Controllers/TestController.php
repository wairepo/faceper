<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
// require_once __DIR__ . '/vendor/autoload.php';
// require 'vendor/autoload.php';

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */     
    public function __construct()
    {
        // $this->middleware('auth');
        session_start();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // require_once('../../../vendor/autoload.php');

        // session_start();

        // $fb = new Facebook([
        //     'app_id' => $_ENV['FB_APP_ID'],
        //     'app_secret' => $_ENV['FB_APP_SECRET'],
        //     'default_graph_version' => 'v2.3',
        // ]);

        // $permissions = ['email'];

        // echo 'Facebook SDK initialized.<br>';

        // $pageId = '{page_id}';  # DeafScoop ID

        // echo 'Attempting to login...<br>';
        // $helper = $fb->getRedirectLoginHelper();
        // echo 'LoginHelper loaded, now getting Access Token...<br>';



        // $permissions = ['email']; // Optional permissions
        // $loginUrl = $helper->getLoginUrl('https://abc.test/fbcallback', $permissions);

        // echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';


        // return;

        return view('home');
    }

    public function fblogin()
    {

        // require_once('../../../vendor/autoload.php');

        // session_start();

        $fb = new Facebook([
            'app_id' => $_ENV['FB_APP_ID'],
            'app_secret' => $_ENV['FB_APP_SECRET'],
            'default_graph_version' => 'v2.3',
        ]);

        $permissions = ['email', 'pages_show_list', 'pages_read_user_content', 'pages_manage_posts', 'publish_video', 'pages_messaging', 'pages_read_engagement', 'pages_manage_engagement', 'publish_to_groups'];

        echo 'Facebook SDK initialized.<br>';

        unset($_SESSION['fb_access_token']);

        // $pageId = '{page_id}';  # DeafScoop ID

        echo 'Attempting to login...<br>';
        $helper = $fb->getRedirectLoginHelper();
        echo 'LoginHelper loaded, now getting Access Token...<br>';

        $loginUrl = $helper->getLoginUrl('https://abc.test/fbcallback', $permissions);

        echo $loginUrl;
        echo "<br>";
        echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

        return;
    }

    public function callback()
    {
        // session_start();

        // Include the required dependencies.
        // require_once('vendor/autoload.php');

        $fb = new Facebook([
            'app_id' => $_ENV['FB_APP_ID'],
            'app_secret' => $_ENV['FB_APP_SECRET'],
            'default_graph_version' => 'v2.3',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        // echo "<pre>";
        // var_dump($helper);

        if (isset($_GET['state'])) {
            $helper->getPersistentDataHandler()->set('state', $_GET['state']);
        }

        if( !isset($_SESSION['fb_access_token']) ) {
            try {
                $accessToken = $helper->getAccessToken();
                $fb->setDefaultAccessToken($accessToken);
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            $_SESSION['fb_access_token'] = (string)$accessToken;

            // exit(var_dump($_SESSION['fb_access_token']));

            $checkToken = $fb->get('/oauth/access_token?grant_type=fb_exchange_token&client_id='. $_ENV['FB_APP_ID'] .'&client_secret='. $_ENV['FB_APP_SECRET'] .'&fb_exchange_token=' . $_SESSION['fb_access_token']);
            $checkTokenRes = $checkToken->getGraphNode();

            $accessToken = $checkTokenRes['access_token'];
            $fb->setDefaultAccessToken($accessToken);

            // Logged in
            // echo '<h3>Access Token</h3>';
            // var_dump($accessToken->getValue());

            // The OAuth 2.0 client handler helps us manage access tokens

            
        } else {
            $accessToken = $_SESSION['fb_access_token'];
        }

        // if (! $accessToken->isLongLived()) {
        $oAuth2Client = $fb->getOAuth2Client();
            // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
            // echo '<h3>Metadata</h3>';
            // var_dump($tokenMetadata);

            // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId($_ENV['FB_APP_ID']);
            // If you know the user ID this access token belongs to, you can validate it here
            //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();
            // Exchanges a short-lived access token for a long-lived one
        try {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            $fb->setDefaultAccessToken($accessToken);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
            exit;
        }
        // }

        // EAAKLt7ySZCTIBAPDhK6xUYcvYZBs4pI00e3GM2mUibZBclTy4vVsNV4tHQTGiP0EMS6PxySuYFyxwFeDgOXjXTRJoSZCipara1qr96rcZA02tzyERReNpoNRjUiHN7xFBsZA6XedbRbWO74Rer3LjuvzhmMZCaVt7t9vucLT3cS3Dol7gLwTQZBwmZA2Os08s0tEZD



        // $accessToken = $helper->getAccessToken();

        // exit(var_dump($fb));
        // exit(var_dump($_SESSION['fb_access_token']));

        // exit;

        // try {
        //     $accessToken = $helper->getAccessToken();
        // } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // // When Graph returns an error
        //     echo 'Graph returned an error: ' . $e->getMessage();
        //     exit;
        // } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // // When validation fails or other local issues
        //     echo 'Facebook SDK returned an error: ' . $e->getMessage();
        //     exit;
        // }

        // if (! isset($accessToken)) {
        //     if ($helper->getError()) {->getGraphPage()
        //         header('HTTP/1.0 401 Unauthorized');
        //         echo "Error: " . $helper->getError() . "\n";
        //         echo "Error Code: " . $helper->getErrorCode() . "\n";
        //         echo "Error Reason: " . $helper->getErrorReason() . "\n";
        //         echo "Error Description: " . $helper->getErrorDescription() . "\n";
        //     } else {
        //         header('HTTP/1.0 400 Bad Request');
        //         echo 'Bad request';
        //     }
        //     exit;
        // }



        echo "<pre>";

        


        $res = $fb->get('/me?fields=id,name,birthday,email,first_name,last_name,gender,picture');
        $id = $res->getGraphNode()->getField('id');
        $name = $res->getGraphNode()->getField('name');
        $checkPermission = $fb->get('/' . $id . '/permissions');
        $user = $fb->get('/' . $id . '/accounts');
        $pages = $user->getGraphEdge()->asArray();







        // foreach ($pages as $key => $value) {
            // $pagePost = $fb->post('/105651984516437/feed', ['message' => 'Testing here'], 'EAAKLt7ySZCTIBAKrnyZBfJkLcnTZAZAnTij5adKPGEYb5tvk1zynTOGODPLZB5t4argGRmw9gEkwEJUnXU8wkyJkYlTCuTBhD4NUBd2GPZCf6yIHW05ikallBAacp1Xt4FBE7VsZBZBvIt8gf5qwNubVZClP6ZBcZAmjqkSZAkUZCpLZBMqeATtCFwqwvq10osH03RDbAZD');
            // $resPage = $pagePost->getGraphNode();

        $pageGet = $fb->get('/105651984516437_105988747816094/comments', 'EAAKLt7ySZCTIBAKrnyZBfJkLcnTZAZAnTij5adKPGEYb5tvk1zynTOGODPLZB5t4argGRmw9gEkwEJUnXU8wkyJkYlTCuTBhD4NUBd2GPZCf6yIHW05ikallBAacp1Xt4FBE7VsZBZBvIt8gf5qwNubVZClP6ZBcZAmjqkSZAkUZCpLZBMqeATtCFwqwvq10osH03RDbAZD');
            // $pageReturn = $pageGet->getGraphNode();
        $pageReturn = $pageGet->getGraphEdge()->asArray();

        foreach ($pageReturn as $key => $value) {
            
            if( $value['message'] == 'hi' ) {
                $pagePost = $fb->post('/'. $value['id'] .'/comments', ['message' => 'Testing here'], 'EAAKLt7ySZCTIBAKrnyZBfJkLcnTZAZAnTij5adKPGEYb5tvk1zynTOGODPLZB5t4argGRmw9gEkwEJUnXU8wkyJkYlTCuTBhD4NUBd2GPZCf6yIHW05ikallBAacp1Xt4FBE7VsZBZBvIt8gf5qwNubVZClP6ZBcZAmjqkSZAkUZCpLZBMqeATtCFwqwvq10osH03RDbAZD');
                

                // exit(var_dump($pagePost));
            }

        }


        exit(var_dump($pageReturn));
        // }


        // $userRes = $userRes->asArray();
        
        exit(var_dump($checkPermission->getGraphEdge()->asArray()));
        return $res;
    }
}



// array(6) {
//   ["access_token"]=>
//   string(204) "EAAKLt7ySZCTIBAKrnyZBfJkLcnTZAZAnTij5adKPGEYb5tvk1zynTOGODPLZB5t4argGRmw9gEkwEJUnXU8wkyJkYlTCuTBhD4NUBd2GPZCf6yIHW05ikallBAacp1Xt4FBE7VsZBZBvIt8gf5qwNubVZClP6ZBcZAmjqkSZAkUZCpLZBMqeATtCFwqwvq10osH03RDbAZD"
//   ["category"]=>
//   string(17) "Shopping & retail"
//   ["category_list"]=>
//   array(1) {
//     [0]=>
//     array(2) {
//       ["id"]=>
//       string(15) "200600219953504"
//       ["name"]=>
//       string(17) "Shopping & retail"
//     }
//   }
//   ["name"]=>
//   string(13) "Test bot next"
//   ["id"]=>
//   string(15) "105651984516437"
//   ["tasks"]=>
//   array(5) {
//     [0]=>
//     string(7) "ANALYZE"
//     [1]=>
//     string(9) "ADVERTISE"
//     [2]=>
//     string(8) "MODERATE"
//     [3]=>
//     string(14) "CREATE_CONTENT"
//     [4]=>
//     string(6) "MANAGE"
//   }
// }










