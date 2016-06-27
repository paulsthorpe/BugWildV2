<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProductCategory;
use App\Product;
use App\ProductColor;
use App\ProductSize;
use App\Services\ProductService;

class ProductController extends Controller
{

    public function __construct(ProductService $productService){
      $this->productService = $productService;
    }

    public function index(){
      $products = $this->productService->index();
      return view('admin.products_index', compact('products'));
    }

    public function edit(Product $product){
      $categories = ProductCategory::all();
      $colors = ProductColor::all();
      $sizes = ProductSize::all();
      return view('admin.edit_product', compact('product','categories','colors','sizes'));
    }

    public function add(){
      $categories = ProductCategory::all();
      $colors = ProductColor::all();
      $sizes = ProductSize::all();
      return view('admin.add_product', compact('categories','colors','sizes'));
    }

    public function save(Request $request){
        $this->productService->save($request);
        return redirect('/admin/product');
    }

    public function patch(Request $request){
      $product = Product::find($request->product_to_edit);
      $this->productService->patch($request,$product);
      return redirect('/admin/product');
    }

    public function destroy(Request $request){
      $product = Product::find($request->id);
      $product->delete();
      return back();
    }








}
