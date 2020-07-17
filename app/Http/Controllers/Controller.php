<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {

      // if(in_array($request->path(), $this->blank_view_routes)){
      //   if(in_array($request->path(), ['login','signup','signup-now']) && !empty($request->cookie("esw"))){
      //     // return redirect('/home');
      //   }
      //   // return view('app');
      // }else{
        // return view('sidebar');
      // }
      return view('app');
    }
}
