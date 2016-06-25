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
      $categories = ProductCategory::all();
      return view('shop.shop', compact('products', 'categories'));
    }

    public function item($slug){
      $product = Product::where('slug',$slug)->firstOrFail();
      $categories = ProductCategory::all();
      return view('shop.product', compact('product', 'categories'));
    }

    // public function featured(){
    //
    // }
    //
    // public function onSale(){
    //
    // }

}
