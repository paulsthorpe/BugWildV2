<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\ProductSize;
use Session;


class CartController extends Controller
{
    public function show(){
      $cartTotal = 0;
      $itemCount = 0;
      if(!empty(session('items'))){
        foreach(session('items') as $item){
          $cartTotal += $item['price_as_config'];
          $itemCount += $item['quantity'];
        }
      }

      return view('cart.cart', compact('cartTotal','itemCount'));
    }

    public function addItem(Request $request){
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
      return view('cart.cart', compact('cartTotal','itemCount'));
    }

    public function plus($index){
      $item = session('items')[$index];
      $item['quantity'] += 1;
      $item['price_as_config'] = (($item['base_price'] + $item['upcharge'])*$item['quantity']);
      session(['items.'.$index => $item]);
      return back();
    }

    public function minus($index){
      $item = session('items')[$index];
      $item['quantity'] -= 1;
      $item['price_as_config'] = (($item['base_price'] + $item['upcharge'])*$item['quantity']);
      session(['items.'.$index => $item]);
      return back();
    }

    public function trash($index){
      Session::forget('items.'.$index);
      return back();
    }

    public function flush(){
      session()->flush();
      return redirect('/cart');
    }


}
