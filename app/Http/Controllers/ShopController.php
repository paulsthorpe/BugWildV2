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
      $product = Product::with('colors' , 'sizes')->where('slug',$slug)->firstOrFail();
      $new_products = Product::orderBy('id','DESC')->take(3);
      $categories = ProductCategory::all();
      return view('shop.product', compact('product', 'categories', 'new_products'));
    }

    // public function featured(){
    //
    // }
    //
    // public function onSale(){
    //
    // }

}
