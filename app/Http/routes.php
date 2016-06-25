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

Route::get('/shop/featured', 'ShopController@featured');

Route::get('/shop/on_sale', 'ShopController@onSale');

Route::get('/blog', 'BlogController@index');

Route::get('/blog/{slug}', 'BlogController@post');



Route::get('/admin', 'AdminController@index');

Route::get('/admin/products', 'AdminProductController@index');

Route::get('/admin/add_product', 'AdminProductController@add');

Route::post('/admin/product', 'AdminProductController@save');

Route::get('/admin/edit_product/{product}', 'AdminProductController@edit');

Route::patch('/admin/product/{product}', 'AdminProductController@update');

Route::delete('/admin/product/{product}', 'AdminProductController@destroy');







Route::get('/admin/product_categories', 'AdminProductController@categoryIndex');

Route::get('/admin/add_product_category', 'AdminProductController@addCategory');

Route::post('/admin/add_product_category', 'AdminProductController@saveCategory');

Route::patch('/admin/edit_product_category/{id}', 'AdminProductController@updateCategory');

Route::patch('/admin/delete_product_category/{id}', 'AdminProductController@deleteCategory');






Route::get('/admin/product_colors', 'AdminProductController@colorIndex');

Route::post('/admin/product_colors', 'AdminProductController@addColor');

Route::patch('/admin/product_colors', 'AdminProductController@patchColor');

Route::delete('/admin/product_colors/{color}', 'AdminProductController@destroyColor');


Route::get('/admin/product_sizes', 'AdminProductController@sizeIndex');

Route::post('/admin/product_sizes', 'AdminProductController@addSize');

Route::patch('/admin/product_sizes', 'AdminProductController@patchSize');

Route::delete('/admin/product_sizes/{size}', 'AdminProductController@destroySize');



Route::get('/admin/posts', 'AdminBlogController@index');

Route::get('/admin/add_post', 'AdminBlogController@add');

Route::post('/admin/post', 'AdminBlogController@save');

Route::get('/admin/edit_post/{post}', 'AdminBlogController@edit');

Route::patch('/admin/post/{post}', 'AdminBlogController@update');

Route::delete('/admin/post/{post}', 'AdminBlogController@destroy');



Route::get('/admin/post_categories', 'AdminBlogController@categoryIndex');

Route::get('/admin/add_post_category', 'AdminBlogController@addCategory');

Route::post('/admin/post_category', 'AdminBlogController@saveCategory');

Route::patch('/admin/post_category', 'AdminBlogController@updateCategory');

Route::delete('/admin/post_category/{id}', 'AdminBlogController@destroyCategory');







Route::group(['middleware' => 'auth'], function(){



  Route::get('/home', 'HomeController@index');

});

Route::auth();
