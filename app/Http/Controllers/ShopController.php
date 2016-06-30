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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(9);
        $categories = ProductCategory::all();
        return view('shop.shop', compact('products', 'categories'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function item($slug)
    {
        $product = Product::with('colors', 'sizes', 'category')->where('slug', $slug)->first();
        $category = $product->category;
        $new_products = Product::take(4)->orderBy('id', 'DESC')->get();
        $categories = ProductCategory::all();
        return view('shop.maybeproduct', compact('product', 'categories', 'new_products', 'category'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function featured()
    {
        $products = Product::where('featured', 1)->paginate(9);
        $page_title = 'Featured Products';
        $categories = ProductCategory::all();
        return view('shop.shop', compact('products', 'page_title', 'categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sale()
    {
        $products = Product::where('on_sale', 1)->paginate(9);
        $page_title = 'On Sale';
        $categories = ProductCategory::all();
        return view('shop.shop', compact('products', 'page_title', 'categories'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($slug)
    {
        $category = ProductCategory::where('slug', $slug)->first();
        $page_title = $category->title;
        $products = Product::where('category_id', $category->id)->paginate(9);
        $categories = ProductCategory::all();
        return view('shop.shop', compact('products', 'page_title', 'categories', 'category'));
    }

}
