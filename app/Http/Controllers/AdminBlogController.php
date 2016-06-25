<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\PostCategory;

class AdminBlogController extends Controller
{

    public function index(){
      $posts = Post::orderBy('id','DESC')->get();;
      return view('admin.posts_index', compact('posts'));
    }

    public function add(){
      $categories = PostCategory::all();
      return view('admin.add_post', compact('categories'));
    }

    public function save(Request $request){
      //instantiate new post
        $post = new Post;
        //assign data
        $post->title = $request->title;
        $post->body = $request->body;
        $post->tags = $request->tags;
        $post->slug = str_slug($post_title);
        //store image name to pass to image field
        $imageName = $request->file('image')->getClientOriginalName();
        //move imave to directory
        $file = $request->file('image')->move(public_path()."/images/blog_images/", $imageName);
        //save image name
        $post->image = $imageName;
        //create new post
        $post->save();
        //if categories were applied attach them to the post
        if($request->categories){

          foreach($request->categories as $cat){
            $post->categories()->attach($cat);
          }//foreach

        }//if

      return redirect('/admin');
    }

    public function edit(Post $post){
      $categories = PostCategory::all();
      return view('admin.edit_post', compact('$post','categories'));
    }

    public function update($post,Request $request){
      //assign data
      $post->id = $post->id;
      $post->title = $request->title;
      $post->body = $request->body;
      $post->slug = str_slug($post->title);
      //store image name to pass to image field, if image was uploaded
      if($request->file('image')){
        $imageName = $request->file('image')->getClientOriginalName();
        //move imave to directory
        $file = $request->file('image')->move(public_path()."/blog_images/", $imageName);
        //save image name
        $post->image = $imageName;
      }
      //create new post
      $post->save();
      //if categories were applied attach them to the post after detaching previous
      if($request->categories){
        $post->categories()->detach();
        foreach($request->categories as $cat){
          $post->categories()->attach($cat);
        }//foreach

      }//if

      return redirect('/admin');
    }

    public function delete(Post $id){
      $id->delete();
      return redirect('/admin');
    }

    public function categoryIndex(){
      $categories = PostCategory::all();
      return view('admin.blog_categories', compact('categories'));
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
