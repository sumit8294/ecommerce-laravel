<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{
    public function getOrders(Request $request){
        $loggedUser = Session::get('user');

        $orders = Order::where('user_id',$loggedUser->id)->get();

        return view('users/orders',compact('orders'));
    }

    public function bulkOrderByCart(Request $request){

        $request->validate([
            'address'=>'required',
        ]);

        $loggedUser = Session::get('user');

        $cart_items = Cart::where('user_id',$loggedUser->id)->with('product')->get();

        if ($cart_items->isEmpty()) {
            return redirect()->back()->with('error', 'No items in the cart to place an order.');
        }

        $user_address = $request->address;

        $orders = $cart_items->map(function ($item) use ($loggedUser, $user_address) {
            return [
                'user_id' => $loggedUser->id,
                'product_id' => $item->product_id,
                'seller_id' => $item->product->seller_id,
                'status' => 'pending',
                'quantity' => $item->quantity,
                'address' => $user_address,
                'payment_id' => 12345, 
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        $res = Order::insert($orders->toArray());

        if($res) return redirect()->back()->with('success','Order Placed');
        return redirect()->back()->with('error','Failed to Place Order');
    }

    public function processOrder(Request $request,$productId){
        $product = Product::find($productId);

        return view('users/processOrder',compact('product'));
    }

    public function addOrder(Request $request){

        $request->validate([
            'address'=>'required',
        ]);

        $order = new Order();

        $order->user_id = Session::get('user')->id;
        $order->product_id = $request->product_id;
        $order->seller_id = $request->seller_id;
        $order->status = "pending";
        $order->quantity = $request->quantity;
        $order->address = $request->address;
        $order->payment_id = 12345;

        $res = $order->save();

        if($res) return redirect()->back()->with('success','Order Placed');
        return redirect()->back()->with('error','Failed to Place Order');
    }
}
