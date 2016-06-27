<?php

namespace App\Services;
use App\Product;


/*
|--------------------------------------------------------------------------
| ProductService Class
|--------------------------------------------------------------------------
|
| Provides useful static functions to use throught the appliction to assist in
| storing, sorting and displaying product record data
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

  public function save($request){
    //instantiate new product
    $product = new product;
    //assign data
    $product->title = $request->title;
    $product->description = $request->description;
    $product->slug = str_slug($product->title);
    $product->price = $request->price;
    //store image name to pass to image field
    $counter = 1;
    foreach ($request->file('image') as $image) {
      $imageName = $image->getClientOriginalName();
      //move imave to directory
      $file = $image->move(public_path()."/images/product_images/", $imageName);
      //save image name
      $product->{'image'.$counter} = $imageName;
      $counter++;
    }

    //create new product
    $product->save();
    //if categories were applied attach them to the product

    $product->category()->attach($request->category);
    $product->colors()->attach($request->colors);
    $product->sizes()->attach($request->sizes);
  }

  public function patch($request,$product){
    //assign data
    $product->title = $request->title;
    $product->description = $request->description;
    $product->slug = str_slug($product->title);
    $product->price = $request->price;
    //store image name to pass to image field
    if(!empty($request->file)){
      $counter = 1;
      foreach ($request->file('image') as $image) {
        $imageName = $image->getClientOriginalName();
        //move imave to directory
        $file = $image->move(public_path()."/images/product_images/", $imageName);
        //save image name
        $product->{'image'.$counter} = $imageName;
        $counter++;
      }
    }
    //create new product
    $product->save();
    //if categories were applied attach them to the product
    $product->colors()->attach($request->colors);
    $product->sizes()->attach($request->sizes);
    $product->category()->attach($request->category);
  }


} //end PostService class
