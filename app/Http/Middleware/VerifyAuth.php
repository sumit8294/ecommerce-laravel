<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class VerifyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $restrictedPaths = ['login-form','login','signup'];

        if(Session::has('seller')) Session::flush();

        if(Session::has('user')){
            if( in_array($request->path(),$restrictedPaths) ){
                return redirect()->back();
            }
            return $next($request);
        }
        else{
            if( in_array($request->path(),$restrictedPaths) ){
                return $next($request);
            }
            return redirect('/login-form');
        }
        
    }
}
