<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;

class AuthController extends Controller
{

    public function logout(){
        if(!empty(\SF::get_cookies()["u"])) Cookie::queue(Cookie::forget('u'));
        if(!empty(\SF::get_cookies()["fb_token"])) Cookie::queue(Cookie::forget('fb_token'));
        if(!empty(\SF::get_cookies()["page_token"])) Cookie::queue(Cookie::forget('page_token'));

        return redirect('/');
    }
}
