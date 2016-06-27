<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProductCategory;

class ProductCategoriesController extends Controller
{

  public function index(){
    $categories = ProductCategory::all();
    return view('admin.product_categories', compact('categories'));
  }

  public function save(Request $request){
    $category = new ProductCategory;
    $category->title = $request->title;
    $category->slug = str_slug($category->title);
    $category->save();
    return back();
  }

  public function patch(Request $request){
    $category = ProductCategory::find($request->id);
    $category->title = $request->title;
    $category->save();
    return back();
  }

  public function destroy(Request $request){
    $category = ProductCategory::find($request->id);
    $category->delete();
    return back();
  }
}
