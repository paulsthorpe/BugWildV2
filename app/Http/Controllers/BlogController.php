<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\PostCategory;
use App\Services\PostService;

class BlogController extends Controller
{
    public function __contruct(PostService $postService){
      $this->postService = $postService;
    }

    public function index(){
      $posts = Post::with('category')->orderBy('id','DESC')->get();
      foreach($posts as $post){
        foreach($post->category as $id){
          $category = PostCategory::find($id)
          $post->cat = $category->title;
        }
      }
      return view('admin.posts_index', compact('posts'));
    }

    public function add(){
      $categories = PostCategory::all();
      return view('admin.add_post', compact('categories'));
    }

    public function save(Request $request){
      $this->postService->save($request);
      return redirect('/admin/post');
    }

    public function edit(Post $post){
      $categories = PostCategory::all();
      return view('admin.edit_post', compact('post','categories'));
    }

    public function update(Post $post,Request $request){
      $this->postService->update($post,$request);
      return redirect('/admin/post');
    }

    public function destroy(Request $request){
      $post = Post::find($request->id);
      $post->delete();
      return back();
    }
}
