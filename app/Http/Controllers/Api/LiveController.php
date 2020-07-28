<?php

namespace App\Http\Controllers\Api;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facebook\Facebook as Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class LiveController extends Controller
{

    public function list(Request $request)
    {
      // $fb = new Facebook([
      //   'default_graph_version' => 'v2.4'
      // ]);

      // $fb->setDefaultAccessToken($request->cookie('fb_token'));

      // 106492701074229_145341577189341/sharedposts?fields=from,created_time,to{name,profile_type}

      // try {
      //   // Returns a `FacebookFacebookResponse` object
      //   $response = $fb->get(
      //     '/' . $request->cookie('page_token') . '_' . $request['post_id'],
      //     $request->cookie('fb_token')
      //   );
      // } catch(FacebookExceptionsFacebookResponseException $e) {
      //   echo 'Graph returned an error: ' . $e->getMessage();
      //   exit;
      // } catch(FacebookExceptionsFacebookSDKException $e) {
      //   echo 'Facebook SDK returned an error: ' . $e->getMessage();
      //   exit;
      // }
      // $graphNode = $response->getGraphNode();


      // https://www.facebook.com/testbot/posts/145341577189341?__xts__[0]=68.ARDlH2PvSCMc_6ERrbJefpiNB2XseFqI60tCAahhTIcPJavMl-PQWkblbPHh1gI7meQS7m0e2KMb16VXwqlohgeyDiSgkcquOQZ9lhUDCZLvgJu3mPXsTDqO2djzyZWlEjesFCz9jNoiWJLfrPrnYRFaFJYdUuOqSAUY_QE1Bi0F9gwTukFeaWvkpB4XKQqt0fESh82usK0MTrpFOogRcaWpo5LX8j-_c8Z-aUBee15z1BLBg-5NkuRgznrBQXJEJN6dl9mr-HEEFBKzH71F9xxmQlKtZNInFV_rp6Fpj3SgevMD9w-uZuSWRVQuEFzmPCMmdy6Q5xQo9Fdnty0&__tn__=-R


      // $url = '/' . $request->cookie('page_token') . '/feed/?message=ABCDEFGHIJKLMNOPQRSTUVWXYZ&access_token=' . $request->cookie('fb_token');
      // $res = $fb->get('/me?fields=id,name,birthday,email,first_name,last_name,gender,picture');
      // $res = $fb->get('/'.$request->cookie('page_token').'_145341577189341', $request->cookie('fb_token'));
      // $account = $fb->get('/'. Auth::user()->fb_user_id .'/accounts?access_token=' . $request->cookie('fb_token'));

      // $pages = $account->getGraphEdge()->asArray();

      // exit(var_dump($graphNode));

      // return response()->json($res);

      // $permissions = ['email', 'pages_show_list', 'pages_read_user_content', 'pages_manage_posts', 'publish_video', 'pages_messaging', 'pages_read_engagement', 'pages_manage_engagement', 'publish_to_groups'];

      // $res = $fb->get('/me?fields=id,name,birthday,email,first_name,last_name,gender,picture');
      // $id = $res->getGraphNode()->getField('id');
      // $name = $res->getGraphNode()->getField('name');
      // $checkPermission = $fb->get('/' . $id . '/permissions');
      // $user = $fb->get('/' . $id . '/accounts');
      // $pages = $user->getGraphEdge()->asArray();

      return response()->json(["success" => true, "data" => [123123,123123,123231]]);
    }

    public function create(Request $request)
    {

      $post = Post::where("post_id", $request['post_id'])->first();

      if( $post ) {
        return response()->json([ "success" => false, "message" => "post_already_exists" ]);
      }

      $post = Post::create([
        'page_id' => $request->cookie("p"),
        'post_id' => $request['post_id'],
        'type' => $request['type'],
        'title' => isset($request['data']['title']) ? $request['data']['title'] : null,
        'url' => $request['data']['permalink_url'],
        'published_at' => $request['data']['updated_time']['date'],
        'timezone' => $request['data']['updated_time']['timezone'],
        'description' => isset($request['data']['description']) ? $request['data']['description'] : null
      ]);

      if( $post ) {
        return response()->json([ "success" => true, "message" => "record_create_successfully", "data" => $post ]);
      }
        
      return response()->json([ "success" => false, "message" => "post_create_failed" ]);
    }

    public function retrieve(Request $request, $id)
    {

      if( !$id ) {
        return response()->json([ "success" => false, "message" => "Post_ID_not_found" ]);
      }

      $post = Post::find($id);

      if( $post ) {
        return response()->json([ "success" => true, "data" => $post ]);
      }

      return response()->json([ "success" => false, "message" => "post_not_found" ]);      
    }

    public function webhook()
    {
      Post::create([
        'page_id' => 1111,
        'post_id' => 33333,
        'description' => 11111
      ]);
    }

    public function check_url(Request $request)
    {

      $post = Post::where("post_id", $request['post_id'])->first();

      if( $post ) {
        return response()->json([ "success" => false, "message" => "post_already_exists" ]);
      }

      if( !is_numeric($request['post_id']) ) {
        return response()->json(["success" => false, "message" => "post_id_invalid", "data" => []]);
      }

      try {

        $fb = new Facebook();

        $fb->setDefaultAccessToken($request->cookie('fb_token'));

        $response = $fb->get( "/" . (integer)$request['post_id'] . "?fields=permalink_url,embed_html,from,format,embeddable,title,description,updated_time" );

        $response = $response->getGraphNode()->asArray();

        if( isset($response['error']) ) {
          return response()->json([ "success" => false, "message" => "fb_video_not_found", "data" => $response ]);
        }

        return response()->json([ "success" => true, "data" => $response ]);

      } catch(FacebookResponseException $e) {

        return response()->json([ "success" => false, "message" => "fb_response_error", "data" => General::fb_error_return($e->getResponseData()['error']['code']), "ref" => $e->getResponseData() ]);

      } catch(FacebookSDKException $e) {

        return response()->json([ "success" => false, "message" => "fb_sdk_error", "data" => $e->getMessage() ]);

      }
    }
}































