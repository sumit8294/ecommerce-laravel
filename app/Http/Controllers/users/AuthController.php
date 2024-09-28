<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(Request $request) {
       
        if($request->name){
            $user = User::where('name',$request->name)->first();
            
            if($user && Hash::check( $request->password,$user->password )) {
                Session::put('user',$user);
                return redirect('/');
            }

        }

        Session::flash('error',"Wrong Credentials !!");
        return redirect('login-form');
        
    }

    public function signup(Request $request) {
        $request->validate([
            'email'=> 'required',
            'name'=> 'required',
            'password' => 'required',
        ]);
        
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = $request->password;
        
        $result = $user->save();

        if($result){
            Session::put('user',$user);
            return redirect('/');
        }else{
            Session::flash('error','Signup Failed, Try again !!');
            return redirect('/login-form');
        }
        

        
    }

    public function logout(Request $request){
        Session::flush();
        return redirect('/login-form');
    }
}
