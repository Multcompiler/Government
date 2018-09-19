<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class HeadMasterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role['name'] == 'headmaster'){
            return $next($request);
        }
        else{
            return redirect('/register');
        }
    }
}
