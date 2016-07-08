<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\PostCategory;

class blogController extends Controller
{
    public function index(){
      $posts = Post::paginate(5);
      $categories = PostCategory::all();
      $recent_posts = Post::take(4)->orderBy('id', 'DESC')->get();
      return view('blog.blog', compact('posts', 'categories', 'recent_posts'));
    }

    public function getPost($slug){
      $post = Post::where('slug', $slug)->get();
      $categories = PostCategory::all();
      $recent_posts = Post::take(4)->orderBy('id', 'DESC')->first();
      return view('blog.post', compact('post', 'categories', 'recent_posts'));
    }

    public function getCategory($slug){
      $category = PostCategory::where('slug', $slug)->first();
      $posts = $category->posts;
      $page_title = $category->title;
      $categories = PostCategory::all();
      $recent_posts = Post::take(4)->orderBy('id', 'DESC')->get();
      return view('blog.blog', compact('posts', 'categories', 'recent_posts', 'page_title'));
    }
}
