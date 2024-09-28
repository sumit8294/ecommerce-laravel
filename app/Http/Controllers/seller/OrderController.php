<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Product;


class OrderController extends Controller
{
    public function getOrders(){
        $loggedSeller = Session::get('seller');

        $orders = Order::where('seller_id',$loggedSeller->id)->with(['user','product'])->paginate(10);
        // return $orders;
        return view('seller/orders',compact('orders'));

    }

    public function getOrderById(Request $request,$orderId){
        $order = Order::where('id',$orderId)->with(['user','product'])->get();

        return response()->json($order);
    }

    public function updateOrderStatus(Request $request){

        $order = Order::find($request->order_id);

        if($request->status === "delivered"){
            $product = Product::where('product_id',$order->product_id);
            $product->item_sold = $product->item_sold+1;
            $result = $product->save();

        } 

        $order->status = $request->status;
        $res = $order->save();

        if($res) return redirect()->back()->with('success','Order status updated');
        return redirect()->back()->with('error','Failed to update order status');

    }
}
