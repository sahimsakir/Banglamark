<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
   
    public function handle(Request $request, Closure $next)
    {
        
        if(auth()->check() && auth()->user()->role=='Admin' ){
            
            return $next($request);
        }
        
        abort(401,'Not Authorized');

       
        
    }
}
