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


/**
 * Blog Routes
 */
Route::get('/blog', 'BlogController@index');

Route::get('/blog/{slug}', 'BlogController@getPost');

Route::get('/blog/category/{slug}', 'BlogController@getCategory');


/**
 * Homepage
 */
Route::get('/', 'PagesController@homepage');

/**
 * Shop Routes
 */
Route::get('/shop', 'ShopController@index');

Route::get('/shop/{slug}', 'ShopController@item');

Route::get('/shop/category/{slug}', 'ShopController@category');

Route::get('/featured', 'ShopController@featured');

Route::get('/sale', 'ShopController@sale');

/**
 * Cart/Checkout Routes
 */
Route::get('/cart', 'CartController@show');

Route::get('/review', 'CartController@review');

Route::get('/cart/add', 'CartController@addToCart');

Route::get('/cart/plus/{index}', 'CartController@increment');

Route::get('/cart/minus/{index}', 'CartController@decrement');

Route::get('/cart/trash/{index}', 'CartController@trashCart');

Route::get('/cart/flush', 'CartController@flush');

Route::post('/review', 'CartController@addSpecialInstructions');

/**
 * PayPal Routes
 */
Route::post('/payment', 'PaypalController@createOrder');

Route::get('/payment', 'PaypalController@getStatus');


/**
 * Admin/Protected Routes
 */
Route::group(['middleware' => 'auth'], function () {


    Route::get('/register', 'PagesController@preventRegister');


    /**
     * Admin Product Routes
     */
    Route::get('/admin/product', 'ProductController@index');

    Route::get('/admin/add_product', 'ProductController@add');

    Route::get('/admin/edit_product/{product}', 'ProductController@edit');

    Route::post('/admin/products_by_category', 'ProductController@byCategory');

    Route::post('/admin/product', 'ProductController@save');

    Route::patch('/admin/product', 'ProductController@patch');

    Route::delete('/admin/product', 'ProductController@destroy');


    /**
     * Admin Product Category Routes
     */
    Route::get('/admin/product_category', 'ProductCategoriesController@index');

    Route::post('/admin/product_category', 'ProductCategoriesController@save');

    Route::patch('/admin/product_category', 'ProductCategoriesController@patch');

    Route::delete('/admin/product_category', 'ProductCategoriesController@destroy');


    /**
     * Admin Product Color Routes
     */
    Route::get('/admin/product_color', 'ProductColorController@index');

    Route::post('/admin/product_color', 'ProductColorController@save');

    Route::patch('/admin/product_color', 'ProductColorController@patch');

    Route::delete('/admin/product_color', 'ProductColorController@destroy');


    /**
     * Admin Product Size Routes
     */
    Route::get('/admin/product_size', 'ProductSizeController@index');

    Route::post('/admin/product_size', 'ProductSizeController@save');

    Route::patch('/admin/product_size', 'ProductSizeController@patch');

    Route::delete('/admin/product_size', 'ProductSizeController@destroy');


    /**
     * Admin Post Routes
     */
    Route::get('/admin/posts', 'PostController@index');

    Route::get('/admin/add_post', 'PostController@add');

    Route::get('/admin/edit_post/{post}', 'PostController@edit');

    Route::get('/admin/postStatus/{post}', 'PostController@status');

    Route::post('/admin/post', 'PostController@save');

    Route::patch('/admin/post', 'PostController@patch');

    Route::delete('/admin/post', 'PostController@destroy');


    /**
     * Admin Post Category Routes
     */
    Route::get('/admin/post_category', 'BlogCategoriesController@index');

    Route::post('/admin/post_category', 'BlogCategoriesController@save');

    Route::patch('/admin/post_category', 'BlogCategoriesController@patch');

    Route::delete('/admin/post_category', 'BlogCategoriesController@destroy');

    Route::get('/admin', 'OrderController@index');

    Route::get('/admin/order/{id}', 'OrderController@get');

    Route::patch('/admin/order', 'OrderController@patch');

    Route::patch('/admin/featured', 'ProductController@featured');

    Route::patch('/admin/sale', 'ProductController@sale');


    /**
     * Default Laravel Auth Home Route
     */
    Route::get('/home', 'HomeController@index');


});

Route::auth();
