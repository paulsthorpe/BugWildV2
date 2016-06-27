<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function(){
  return view('layouts.landing');
});

Route::get('/shop', 'ShopController@index');

Route::get('/shop/{slug}', 'ShopController@item');

Route::get('/shop/category/{slug}', 'ShopController@category');

Route::get('/shop/featured', 'ShopController@featured');

Route::get('/shop/sale', 'ShopController@onSale');






Route::get('/cart', 'CartController@show');

Route::get('/review', 'CartController@review');

Route::get('/cart/add', 'CartController@addToCart');

Route::get('/cart/plus/{index}', 'CartController@increment');

Route::get('/cart/minus/{index}', 'CartController@decrement');

Route::get('/cart/trash/{index}', 'CartController@trashCart');

Route::post('/review', 'CartController@addSpecialInstructions');




Route::post('/paypal', 'PaypalController@createOrder');

Route::get('/paypal', 'PaypalController@getStatus');






Route::get('/admin/product', 'ProductController@index');

Route::get('/admin/add_product', 'ProductController@add');

Route::get('/admin/edit_product/{product}', 'ProductController@edit');

Route::post('/admin/product', 'ProductController@save');

Route::patch('/admin/product', 'ProductController@patch');

Route::delete('/admin/product', 'ProductController@destroy');







Route::get('/admin/product_category', 'ProductCategoriesController@index');

Route::post('/admin/product_category', 'ProductCategoriesController@save');

Route::patch('/admin/product_category', 'ProductCategoriesController@patch');

Route::delete('/admin/product_category', 'ProductCategoriesController@destroy');






Route::get('/admin/product_color', 'ProductColorController@index');

Route::post('/admin/product_color', 'ProductColorController@save');

Route::patch('/admin/product_color', 'ProductColorController@patch');

Route::delete('/admin/product_color', 'ProductColorController@destroy');




Route::get('/admin/product_size', 'ProductSizeController@index');

Route::post('/admin/product_size', 'ProductSizeController@save');

Route::patch('/admin/product_size', 'ProductSizeController@patch');

Route::delete('/admin/product_size', 'ProductSizeController@destroy');



Route::get('/admin/post', 'BlogController@index');

Route::get('/admin/add_post', 'BlogController@add');

Route::get('/admin/edit_post/{post}', 'BlogController@edit');

Route::post('/admin/post', 'BlogController@save');

Route::patch('/admin/post', 'BlogController@patch');

Route::delete('/admin/post', 'BlogController@destroy');



Route::get('/admin/post_category', 'BlogCategoriesController@index');

Route::post('/admin/post_category', 'BlogCategoriesController@save');

Route::patch('/admin/post_category', 'BlogCategoriesController@patch');

Route::delete('/admin/post_category', 'BlogCategoriesController@destroy');




Route::get('/admin', 'OrderController@index');

Route::get('/admin/order/{id}', 'OrderController@get');

Route::patch('/admin/order', 'OrderController@patch');







Route::group(['middleware' => 'auth'], function(){



  Route::get('/home', 'HomeController@index');

});

Route::auth();
