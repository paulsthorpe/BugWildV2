<?php

namespace App\Services;
use App\Product;


/*
|--------------------------------------------------------------------------
| ProductService Class
|--------------------------------------------------------------------------
|
| Provides useful static functions to use throught the appliction to assist in
| storing, sorting and displaying sales record data
|
|
*/

class ProductService {

  public function index(){
    $products = Product::with('category')->orderBy('id','DESC')->get();
    foreach($products as $product){
      foreach($product->category as $category){
        $product->cat = $category->title;
      }
    }
    return $products;
  }


} //end PostService class
