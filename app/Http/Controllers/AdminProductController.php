<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProductCategory;
use App\Product;

class AdminProductController extends Controller
{

    public function index(){
      $products = Product::orderBy('id','DESC')->get();;
      return view('admin.products_index', compact('products'));
    }

    public function add(){
      $categories = ProductCategory::all();
      return view('admin.add_product', compact('categories'));
    }

    public function save(Request $request){
        // return var_dump($request->file('image'));
      //instantiate new product
        $product = new product;
        //assign data
        $product->title = $request->title;
        $product->description = $request->description;
        $product->slug = str_slug($product->title);
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

    }

    public function edit(Product $product){
      $categories = ProductCategory::all();
      return view('admin.edit_product', compact('$product','categories'));
    }

    public function update(){

    }

    public function delete(Product $id){
      $id->delete();
      return redirect('/admin');
    }

    public function categoryIndex(){
      $categories = ProductCategory::all();
      return view('admin.product_categories', compact('categories'));
    }

    public function saveCategory(Request $request){
      $category = new ProductCategory;
      $category->title = $request->title;
      $category->save();
      return back();
    }

    public function updateCategory(Request $request){
      $category = ProductCategory::find($request->id);
      $category->title = $request->new_title;
      $category->save();
      return redirect('/admin');
    }

    public function deleteCategory(ProductCategory $id){
      $id->delete();
      return redirect('/admin');
    }

}
