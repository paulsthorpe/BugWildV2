<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\ProductSize;
use Session;
use App\Services\CartService;


class CartController extends Controller
{

  public function __construct(CartService $cartService){
    $this->cartService = $cartService;
  }

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

    public function review(){
      $cartTotal = 0;
      $itemCount = 0;
      if(!empty(session('items'))){
        foreach(session('items') as $item){
          $cartTotal += $item['price_as_config'];
          $itemCount += $item['quantity'];
        }
      }
      return view('cart.review', compact('cartTotal','itemCount'));
    }

    public function addToCart(Request $request){
      $this->cartService->addToCart($request);
      return back();
    }

    public function increment($index){
      $this->cartService->incrementQty($index);
      return back();
    }

    public function decrement($index){
      $this->cartService->decrementQty($index);
      return back();
    }

    public function trashCart($index){
      Session::forget('items.'.$index);
      return back();
    }

    public function flush(){
      Session::flush();
      return back();
    }

    public function addSpecialInstructions(Request $request){
      $special = $request->special;
      session(['special' => $special]);
      return redirect('/review');
    }



}
