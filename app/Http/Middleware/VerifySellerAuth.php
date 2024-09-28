<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class VerifySellerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $path = $request->path();
        $restrictedPaths = ['seller/login', 'seller/signup', 'seller/login-form'];

        if(Session::has('user')) Session::flush();

        if(Session::has('seller')){
            
            
            if (in_array($path, $restrictedPaths)) {
                return redirect()->back();
            }
           
            return $next($request);
        }
        else{
            if (in_array($path, $restrictedPaths)) {
                return $next($request);
            }
            return redirect('/seller/login-form');
        }
        
    }
}
