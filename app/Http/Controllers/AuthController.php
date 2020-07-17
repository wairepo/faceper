<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;

class AuthController extends Controller
{

    public function logout(){

    	$cookie = Cookie::get();
    	$cookie["fb_token"] = isset($cookie["fb_token"]) ? $cookie["fb_token"] : "";
    	$cookie["page_token"] = isset($cookie["page_token"]) ? $cookie["page_token"] : "";
    	$cookie["u"] = isset($cookie["u"]) ? $cookie["u"] : "";

    	
        if(!empty($cookie["u"])) Cookie::queue(Cookie::forget('u'));
        if(!empty($cookie["fb_token"])) Cookie::queue(Cookie::forget('fb_token'));
        if(!empty($cookie["page_token"])) Cookie::queue(Cookie::forget('page_token'));

        return redirect('/');
    }
}
