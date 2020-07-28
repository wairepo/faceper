<?php

namespace App\Http\Controllers\Api;

// use App\Helpers\General;
// use Facebook\Facebook as Facebook;
// use Facebook\Exceptions\FacebookResponseException;
// use Facebook\Exceptions\FacebookSDKException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Keyword;
use Validator;

class KeywordController extends Controller
{
    public function create(Request $request)
    {
      $post = Post::where("post_id", $request['post_id'])->first();

      if( $post ) {
        return response()->json([ "success" => false, "message" => "post_already_exists" ]);
      }

      $validator = Validator::make($request->all(), [
        'post_id' => 'required',
        'name' => 'required',
      ]);

      if ( $validator->fails() ) {
            return response()->json([ "success" => false, "message" => $validator->errors() ]);
        }

      // $keyword = Keyword::create([
      //   'post_id' => $request['post_id'],
      //   'name' => $request['name'],
      //   'is_free_shipping' => $request['is_free_shipping'],
      //   'is_inventory' => $request['is_inventory'],
      //   'inventory' => $request['inventory'],
      //   'published_at' => $request['published_at']
      // ]);

      // if( $keyword ) {
      //   return response()->json([ "success" => true, "message" => "record_create_successfully", "data" => $keyword ]);
      // }
        
      return response()->json([ "success" => false, "message" => "keyword_create_failed" ]);
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
}































