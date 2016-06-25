<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use App\ProductCategory;
use App\ProductSize;
use App\ProductColor;
use App\OnSale;
use App\FeaturedProduct;

class ShopController extends Controller
{

    public function index(){
      $products = Product::all();
      return view('shop.shop');
    }

    public function item($slug){
      $product = Product::where('slug',$slug)->firstOrFail();
      return view('shop.product', 'product');
    }

    // public function featured(){
    //
    // }
    //
    // public function onSale(){
    //
    // }

}
