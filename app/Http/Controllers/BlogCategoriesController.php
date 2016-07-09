<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PostCategory;

class BlogCategoriesController extends Controller
{
  public function index(){
    $categories = PostCategory::all();
    return view('admin.blog_categories', compact('categories'));
  }

  public function save(Request $request){
    $category = new PostCategory;
    $category->title = $request->title;
    $category->slug = str_slug($category->title);
    $category->save();
    return back();
  }

  public function patch(Request $request){
    $category = PostCategory::find($request->id);
    $category->title = $request->title;
    $category->slug = str_slug($category->title);
    $category->save();
    return back();
  }

  public function destroy(Request $request){
    $category = PostCategory::find($request->id);
    $category->delete();
    return back();
  }
}
