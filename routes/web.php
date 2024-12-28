<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Admin'],function(){
    route::group(['prefix' =>'category'],function(){
        route::get('/','categoryController@index');
        route::post('/save','categoryController@create')->name('category.create');
    });

    route::group(['prefix' =>'product'],function(){
        route::get('/','productController@index');
        route::post('/save','productController@create')->name('product.create');
    });

    // new cart
    Route::post('/cart/add/{id}', 'cartController@addToCart')->name('cart.add');
    Route::get('/cart/view', 'cartController@viewCart')->name('cart.view');

    // Route::post('/remove-from-cart', 'cartController@removeFromCart')->name('remove.from.cart');

});
