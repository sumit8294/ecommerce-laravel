<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Seller;


class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'category_id',
        'sku',
        'seller_id',
        'image',
        'visible',
        'ratings',
        'mrp',
        'selling_price',
        'description',
        'quantity',
        'item_sold',
        'reach',
        'tags'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function seller(){
        return $this->belongsTo(Seller::class,'seller_id');
    }

    public function getDiscountAttribute(){
        return (($this->attributes['mrp'] - $this->attributes['selling_price'])/$this->attributes['mrp'])*100;
    }

    public function getSoldvalueAttribute(){
        return $this->attributes['selling_price'] * $this->attributes['item_sold'];
    }

}
