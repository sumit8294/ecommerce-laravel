<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function getProducts(Request $request){

        $search = $request->input('search');
        
        $products = Product::with(['seller','category'])
        ->where('name','like',"%{$search}%")
        ->paginate(10)
        ->appends(['search'=>$search]);
        // return $products;
        return view('/seller/productsList', compact('products','search'));
    }


    public function fetchProducts(Request $request,$id = null){
       
        $res = $id === null ? Product::get() : Product::find($id);

        return response()->json($res);
    }


    public function add(Request $request){
        $request->validate([
            'name'=>'required',
            'category_id' => 'required',
            'sku' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'mrp' => 'required',
            'selling_price' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'tags' => 'required',
        ]);

        $product = new Product();

        $product->fill($request->all());
       
       
        if($request->file('image')){
            $filename = time() . '-' . $request->file('image')->getClientOriginalName();
            $product->image = $request->file('image')->storeAs('uploads',$filename,'public');
        }

        $loggedInSeller = Session::Get('seller');
        $product->seller_id = $loggedInSeller->id;

        

        $res = $product->save();

        if($res) return redirect()->back()->with('success','Product added');
        return redirect()->back()->with('error','Failed to add product');

    }

    public function delete(Request $request,$id){

        $res = Product::where('id',$id)->delete();

        if($res) return redirect()->back()->with('succes','Product deleted');
        return redirect()->back()->with('error','Failed to delete product');
    }

    public function update(Request $request,$id){

        $request->validate([
            'name'=>'required',
            'category_id' => 'required',
            'sku' => 'required',
            'mrp' => 'required',
            'selling_price' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'tags' => 'required',
        ]);

        $product = Product::find($id);

        $product->fill($request->except('image'));

        if($request->file('image')){
            $filename = time() . '-' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads',$filename,'public');
            $product->image = $path;
        }

        $res = $product->save();

        if($res) return redirect()->back()->with('succes','Product deleted');
        return redirect()->back()->with('error','Failed to delete product');
    }
}
