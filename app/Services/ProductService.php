<?php

namespace App\Services;

use App\Product;
use App\ProductCategory;


/*
|--------------------------------------------------------------------------
| ProductService Class
|--------------------------------------------------------------------------
|
| Class contains methods to facilitate actions required by cart
| index()
| save()
| patch()
|
|
*/


/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{

    /**
     *
     * @return mixed
     * get all products in descending order by id,
     * return to controller
     */
    public function index()
    {
        $products = Product::orderBy('category_id', 'DESC')->get();
        return $products;
    }

    /**
     * persist product to database
     * @param $request
     *
     */
    public function save($request)
    {
        //instantiate new product
        $product = new product;
        //assign data
        $product->title = $request->title;
        $product->description = $request->description;
        $product->slug = str_slug($product->title);
        $product->price = $request->price;
        //store image name to pass to image field
        $counter = 1;
        // dd($request->file('image'));
        foreach ($request->file('image') as $image) {
          if($image){
            $imageName = $image->getClientOriginalName();
            //move imave to directory
            $file = $image->move(public_path() . "/images/product_images/", $imageName);
            //save image name
            $product->{'image' . $counter} = $imageName;
            $counter++;
          }
        }

        //create new product
        $product->save();
        //if categories were applied attach them to the product
        $category = ProductCategory::find($request->category);
        $category->products()->save($product);
        $product->colors()->attach($request->colors);
        $product->sizes()->attach($request->sizes);
    }

    /**
     *
     * update product from patch request
     * @param $request
     * @param $product
     */
    public function patch($request, $product)
    {
        //assign data
        $product->title = $request->title;
        $product->description = $request->description;
        $product->slug = str_slug($product->title);
        $product->price = $request->price;
        //store image name to pass to image field
        $counter = 1;
        foreach ($request->file('image') as $image) {
          if($image){
            $imageName = $image->getClientOriginalName();
            //move imave to directory
            $file = $image->move(public_path() . "/images/product_images/", $imageName);
            //save image name
            $product->{'image' . $counter} = $imageName;
            $counter++;
          }
        }
        //create new product
        $product->save();
        //if categories were applied attach them to the product
        $product->colors()->attach($request->colors);
        $product->sizes()->attach($request->sizes);
        $category = ProductCategory::find($request->category);
        $category->products()->save($product);
    }


} //end PostService class
