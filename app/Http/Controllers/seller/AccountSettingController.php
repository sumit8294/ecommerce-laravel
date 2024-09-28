<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Session;

class AccountSettingController extends Controller
{

    public function getSettings(){
        $loggedSeller = Session::get('seller');
        $seller = Seller::find($loggedSeller->id);

        return view('seller/settings',compact('seller'));
    }

    public function updateSettings(Request $request,$id = null){
        $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);

        $seller = Seller::find($id);

        $seller->fill($request->except('profile'));

        if($request->file('profile')){
            $filename = time() . "-" . $request->file('profile')->getClientOriginalName();
            $path = $request->file('profile')->storeAs('uploads/seller/profile', $filename, 'public');

            $seller->profile = $path;
        }

        $res = $seller->save();

        if($res) return redirect()->back()->with('success','Seller Info Updated');
        return redirect()->back()->with('error','Seller not updated!!');
    }
}
