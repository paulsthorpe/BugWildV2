<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\PostCategory;

class blogController extends Controller
{
    public function index(){
      $posts = Post::where('status', 1)->paginate(5);
      $categories = PostCategory::all();
      $recent_posts = Post::take(4)->where('status', 1)->orderBy('id', 'DESC')->get();
      return view('blog.blog', compact('posts', 'categories', 'recent_posts'));
    }

    public function getPost($slug){
      $post = Post::where('slug', $slug)->first();
      $categories = PostCategory::all();
      $recent_posts = Post::take(4)->where('status', 1)->orderBy('id', 'DESC')->get();
      return view('blog.post', compact('post', 'categories', 'recent_posts'));
    }

    public function getCategory($slug){
      $category = PostCategory::where('slug', $slug)->first();
      $posts = $category->post()->where('status', 1)->paginate(5);
      $page_title = $category->title;
      $categories = PostCategory::all();
      $recent_posts = Post::take(4)->where('status', 1)->orderBy('id', 'DESC')->get();
      return view('blog.blog', compact('posts', 'categories', 'recent_posts', 'page_title'));
    }
}
