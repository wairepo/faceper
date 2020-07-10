<?php

namespace App\Http\Middleware;

use closure;

class VerifyPageToken
{
	public function handle($request, Closure $next)
	{


        return redirect('/');;
	}
}