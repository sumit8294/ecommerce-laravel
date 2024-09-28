<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Cart extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    // Method to calculate the total price of the cart items
    public static function getTotalPrice($userId)
    {
        // Fetch all cart items for the user
        $cartItems = self::where('user_id', $userId)->with('product')->get();
        
        // Calculate the total price by summing up the price * quantity of each product
        $totalPrice = $cartItems->sum(function($cartItem) {
            return $cartItem->product->selling_price * $cartItem->quantity;
        });

        return $totalPrice;
    }


}
