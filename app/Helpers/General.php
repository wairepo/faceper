<?php

namespace App\Helpers;
use Cookie;

class General{

  public static function set_cookie( $name, $value, $time = 0 ){

    Cookie::queue( $name, $value, $time );

  }

  public static function fb_error_return($error_code){

    $message = "";

    switch ($error_code) {
      case '100':
      case '803':
        $message = "Object ID does not Exist"; // {"error":{"message":"Unsupported get request. Object with ID '166353470416259' does not exist, cannot be loaded due to missing permissions, or does not support this operation. Please read the Graph API documentation at https:\/\/developers.facebook.com\/docs\/graph-api","type":"GraphMethodException","code":100,"error_subcode":33,"fbtrace_id":"Av3kqY6390C5KXCVm2XLSlt"}
        break;
    }


    return [ "code" => $error_code, "message" => $message ];

  }
}
