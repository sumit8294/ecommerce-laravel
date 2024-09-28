<?php

use App\Http\Controllers\seller\AccountSettingController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\VerifyAuth;

use App\Http\Controllers\seller\AuthController as AdminAuth;
use App\Http\Controllers\seller\ProductController;
use App\Http\Controllers\seller\CategoryController;
use App\Http\Controllers\seller\OrderController;
use App\Http\Controllers\seller\SaleController;
use App\Http\Middleware\VerifySellerAuth;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\users\AuthController;
use App\Http\Controllers\OrderController as UserOrderController;


Route::get('/',[HomeController::class,'index']);
Route::get('/category/{categoryId}',[HomeController::class,'getCategoryProducts']);


Route::prefix('seller')->group(function(){
    
    Route::get('/logout',[AdminAuth::class, 'logout']);

    Route::middleware(VerifySellerAuth::class)->group(function(){

        Route::view('/login-form','seller/login');
        Route::post('/login',[AdminAuth::class, 'login']);
        Route::post('/signup',[AdminAuth::class, 'signup']);

        Route::get('/orders',[OrderController::class, 'getOrders']);
        Route::put('/orders/update',[OrderController::class, 'updateOrderStatus']);
        Route::get('/ajax/orders/{id?}',[OrderController::class, 'getOrderById'])->name('orders');
        
        Route::get('/',[SaleController::class, 'getSales']);
        Route::get('/ajax/sales/month/{month?}',[SaleController::class, 'getSaleByMonth'])->name('getMonthlySale');
        Route::get('/ajax/sales/year/{year?}',[SaleController::class, 'getSaleByYear'])->name('getYearlySale');
        Route::get('/settings',[AccountSettingController::class, 'getSettings']);
        Route::put('/settings/{id}',[AccountSettingController::class, 'updateSettings']);
        
        Route::get('/categories',[CategoryController::class, 'getCategories']);
        Route::get('/ajax/categories/{id?}',[CategoryController::class,'fetchCategories'])->name('categories');
        Route::post('/category/add',[CategoryController::class, 'addCategory']);
        Route::put('/category/update/{id}',[CategoryController::class, 'update']);
        Route::DELETE('/category/delete/{id}',[CategoryController::class, 'delete']);


        Route::get('/products',[ProductController::class, 'getProducts']);
        Route::get('/ajax/products/{id?}',[ProductController::class, 'fetchProducts'])->name('products');
        Route::post('/products/add',[ProductController::class, 'add']);
        Route::put('/products/update/{id}',[ProductController::class, 'update']);
        Route::delete('/products/delete/{id}',[ProductController::class, 'delete']);
    });  

});


Route::get('/logout',[AuthController::class,'logout']);

Route::middleware(VerifyAuth::class)->group(function(){
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/signup',[AuthController::class,'signup']);
    Route::view('/login-form','users/login');
    
    Route::get('/cart',[HomeController::class,'cart']);
    Route::put('/cart/update/{cartId}',[HomeController::class,'updateCart']);
    Route::delete('/cart/delete/{cartId}',[HomeController::class,'deleteFromCart']);

    Route::get('/orders',[UserOrderController::class,'getOrders']);
    Route::get('/order/process/{productId}',[UserOrderController::class,'processOrder']);
    Route::post('/order/add',[UserOrderController::class,'addOrder']);
    Route::post('/order/bulk',[UserOrderController::class,'bulkOrderByCart']);

});

Route::post('/cart/add/{id}',[HomeController::class,'addToCart']);



