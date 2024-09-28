<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request){

        
        // $categories = Category::with('children')->get();
        // return Category::where('parent_id',null)->select('name')->get();
        $category_wise_products = Category::where('parent_id',null)
            ->select('id','name')
            ->with('products')
            ->has('products','>=',15)
            ->orderBy('name','desc')->get();

        $categories = $this->getCategoriesTree();

        $categories = array_reverse($categories);

        return view('home',compact('category_wise_products','categories'));
    }

    public function getCategoriesTree($parentId = null)
    {
        $categories = Category::where('parent_id', $parentId)->get();

        $categoryTree = [];
        foreach ($categories as $category) {
            $categoryTree[] = [
                'category' => $category,
                'children' => $this->getCategoriesTree($category->id),
            ];
        }

        return $categoryTree;
    }

    public function cart(Request $request){

        $loggedUser = Session::get('user');

        $cart_products = Cart::where('user_id',$loggedUser->id)->with('product')->get();

        $total_price = Cart::getTotalPrice($loggedUser->id);

        return view('users/cart',compact('cart_products','total_price'));
    }

    public function addToCart(Request $request,$product_id){

        if(!Session::has('user')) return response()->json(['message'=>'Please Login for Add to Cart'],401);
        
        $loggedUser = Session::get('user');

        $cartExists = Cart::where('product_id',$product_id)->where('user_id',$loggedUser->id)->first();

        if($cartExists) return response()->json(['message'=>'Item Already exist in Cart'],409);
        
        $cart = new Cart();

        $cart->product_id = $product_id;
        $cart->user_id = $loggedUser->id;
        $cart->quantity = 1;

        $res = $cart->save();

        if($res) return response()->json(['message'=>'Item Added Successfully']);
        
        return response()->json(['message'=>'Item failed to Add']);
    }

    public function updateCart(Request $request,$id){

        $cart = Cart::find($id);

        $cart->quantity = $request->quantity;

        $res = $cart->save();

        if($res){
            return response()->json(['message'=>'Item Updated Successfully']);
        }
        return response()->json(['message'=>'Item failed to Update']);
    }

    public function deleteFromCart(Request $request,$cartId){

        $res = Cart::where('id',$cartId)->delete();

        if($res){
            return response()->json(['message'=>'Item deleted Successfully']);
        }
        return response()->json(['message'=>'Item deletion failed']);
    }


    public function getCategoryProducts(Request $request,$categoryId){
        $products = Product::where('category_id',$categoryId)->get();
        $category = Category::find($categoryId);
        // return Category::find(2);
        // return $products;
        $categories = $this->getCategoriesTree();
        return view('categories',compact('products','categories','category'));
    }


}
