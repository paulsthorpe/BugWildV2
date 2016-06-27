<?php

namespace App\Services;
use App\Product;
use App\ProductSize;
use Session;

/*
|--------------------------------------------------------------------------
| CartService Class
|--------------------------------------------------------------------------
|
| Provides useful static functions to use throught the appliction to assist in
| storing, sorting and displaying product record data
|
|
*/

class CartService {

  public function addToCart($request){
    $product = Product::find($request->id);
    $size = ProductSize::where('title',$request->size)->first();
    $config = [
      'product_id' => $product->id,
      'product_title' => $product->title,
      'color' => $request->color,
      'size' => $request->size,
      'base_price' => $product->price,
      'upcharge' => $size->price,
      'quantity' => $request->quantity,
      'price_each' => '',
      'price_as_config' => '',
    ];

    $config['price_each'] = ($config['base_price'] + $config['upcharge']);
    $config['price_as_config'] = (($config['base_price'] + $config['upcharge'])*$config['quantity']);

    Session::push('items', $config);
    $cartTotal = 0;
    $itemCount = 0;
    foreach(session('items') as $item){
      $cartTotal += $item['price_as_config'];
      $itemCount += $item['quantity'];
    }
  }

  public function incrementQty($index){
    $item = session('items')[$index];
    $item['quantity'] += 1;
    $item['price_as_config'] = (($item['base_price'] + $item['upcharge'])*$item['quantity']);
    session(['items.'.$index => $item]);
  }

  public function decrementQty($index){
    $item = session('items')[$index];
    $item['quantity'] -= 1;
    $item['price_as_config'] = (($item['base_price'] + $item['upcharge'])*$item['quantity']);
    session(['items.'.$index => $item]);
  }

} //end CartService class
