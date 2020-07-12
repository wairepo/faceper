<?php

namespace App\Http\Middleware;

use closure;

class Cors
{
	public function handle($request, Closure $next)
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT');
		header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers, Authorization, X-CSRF-Token');
		header('Access-Control-Allow-Credentials: true');
		return $next($request);
	}
}