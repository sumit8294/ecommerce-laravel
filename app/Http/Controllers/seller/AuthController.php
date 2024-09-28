<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function signup(Request $request) {

        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);

        $seller = new Seller();

        $seller->name = $request->name;
        $seller->email = $request->email;
        $seller->password = $request->password;

        $result = $seller->save();

        if($result){
            Session::put('seller',$seller);
            return redirect('/seller');
        }
        
        Session::flash('error','Signup failed, Try again');
        return redirect('/seller/login-form');

        
    }

    public function login(Request $request) {
        
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $seller = Seller::where('name',$request->name)->first();

        if($seller && Hash::check($request->password, $seller->password)){
            Session::put('seller',$seller);
            return redirect('/seller');
        }

        Session::flash('error','Wrong Credentials');
        return redirect('/seller/login-form');

    }

    public function logout(Request $request){

        Session::flush();
        return redirect('/seller/login-form');
    }
}
