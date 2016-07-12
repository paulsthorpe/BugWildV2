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

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->index();
        // $categories = ProductCategory::all();
        return view('admin.products_index', compact('products'));
    }

    public function byCategory(Request $request)
    {
      $category = ProductCategory::where('id', $request->category)->first();
      $products = Product::where('category_id', $request->category)->orderBy('id','DESC')->get();
      $categories = ProductCategory::all();
      $page_title = $category->title;
      return view('admin.products_index', compact('products','page_title','categories'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        $colors = ProductColor::all();
        $sizes = ProductSize::all();
        return view('admin.edit_product', compact('product', 'categories', 'colors', 'sizes'));
    }

    public function add()
    {
        $categories = ProductCategory::all();
        $colors = ProductColor::all();
        $sizes = ProductSize::all();
        return view('admin.add_product', compact('categories', 'colors', 'sizes'));
    }

    public function save(Request $request)
    {
        $this->productService->save($request);
        return redirect('/admin/product');
    }

    public function patch(Request $request)
    {
        $product = Product::find($request->product_to_edit);
        $this->productService->patch($request, $product);
        return redirect('/admin/product');
    }

    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();
        return back();
    }

    public function sale(Request $request)
    {
        $product = Product::find($request->id);
        if ($product->on_sale === 0) {
            $product->on_sale = 1;
        } else {
            $product->on_sale = 0;
        }
        $product->save();
        return back();
    }

    public function featured(Request $request)
    {
        $product = Product::find($request->id);
        if ($product->featured === 0) {
            $product->featured = 1;
        } else {
            $product->featured = 0;
        }
        $product->save();
        return back();
    }


}
