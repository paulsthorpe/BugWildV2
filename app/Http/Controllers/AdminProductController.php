<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProductCategory;
use App\Product;
use App\ProductColor;
use App\ProductSize;
use App\Services\ProductService;

class AdminProductController extends Controller
{

    public function __construct(ProductService $productService){
      $this->productService = $productService;
    }

    public function index(){
      $products = $this->productService->index();
      return view('admin.products_index', compact('products'));
    }

    public function add(){
      $categories = ProductCategory::all();
      $colors = ProductColor::all();
      $sizes = ProductSize::all();
      return view('admin.add_product', compact('categories','colors','sizes'));
    }

    public function save(Request $request){
        $this->productService->save($request);
        return redirect('/admin/products');
    }

    public function edit(Product $product){
      $categories = ProductCategory::all();
      $colors = ProductColor::all();
      $sizes = ProductSize::all();
      return view('admin.edit_product', compact('product','categories','colors','sizes'));
    }

    public function update(Request $request, Product $product){
      $this->productService->update($request,$product);
      return redirect('/admin/products');
    }

    public function destroy(Request $request, Product $product){
      $product->delete();
      return back();
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

    public function colorIndex(){
      $colors = ProductColor::all();
      return view('admin.colors', compact('colors'));
    }

    public function addColor(Request $request){
      $color = new ProductColor;
      $color->title = $request->title;
      $color->save();
      return back();
    }

    public function patchColor(Request $request){
      $color = ProductColor::find($request->id);
      $color->title = $request->title;
      $color->save();
      return back();
    }

    public function destroyColor(ProductColor $color){
      $color->delete();
      return back();
    }


    public function sizeIndex(){
      $sizes = ProductSize::all();
      return view('admin.sizes', compact('sizes'));
    }

    public function addSize(Request $request){
      $size = new ProductSize;
      $size->title = $request->title;
      $size->price = $request->price;
      $size->save();
      return back();
    }

    public function patchSize(Request $request){
      $size = ProductSize::find($request->id);
      $size->title = $request->title;
      $size->price = $request->price;
      $size->save();
      return back();
    }

    public function destroySize(ProductSize $size){
      $size->delete();
      return back();
    }

}
