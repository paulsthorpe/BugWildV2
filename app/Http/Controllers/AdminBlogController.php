<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\PostCategory;

class AdminBlogController extends Controller
{

    public function index(){
      $posts = Post::all();
      return view('admin.products_index', compact('posts'));
    }

    public function add(){
      $categories = PostCategory::all();
      return view('admin.add_post', compact('categories'));
    }

    public function save(Request $request){


      return redirect('/admin');
    }

    public function edit(Post $post){
      $categories = PostCategory::all();
      return view('admin.edit_post', compact('$post','categories'));
    }

    public function update(){


      return redirect('/admin');
    }

    public function delete(){


      return redirect('/admin');
    }

    public function categoryIndex(){
      $categories = PostCategory::all();
      return view('admin.post_categories', compact('categories'))
    }

    public function saveCategory(Request $request){
      $category = new PostCategory;
      $category->title = $request->title;
      $category->save();
      return redirect('/admin');
    }

    public function updateCategory(Request $request){
      $category = PostCategory::find($request->id);
      $category->title = $request->new_title;
      $category->save();
      return redirect('/admin');
    }

    public function deleteCategory(PostCategory $id){
      $id->delete();
      return redirect('/admin');
    }
}
