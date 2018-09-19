<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class DistrictOfficerMiddleware
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
        if(Auth::user()->role['name'] == 'district_officer'){
            return $next($request);
        }
        else{
            return redirect('/register');
        }
    }
}
