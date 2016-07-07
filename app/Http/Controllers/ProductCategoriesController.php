<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProductCategory;

class ProductCategoriesController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view('admin.product_categories', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $category = new ProductCategory;
        $category->title = $request->title;
        $category->slug = str_slug($category->title);
        $category->save();
        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patch(Request $request)
    {
        $category = ProductCategory::find($request->id);
        $category->title = $request->title;
        $category->slug = str_slug($category->title);
        $category->save();
        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $category = ProductCategory::find($request->id);
        $category->delete();
        return back();
    }
}
