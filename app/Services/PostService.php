<?php

namespace App\Services;
use Carbon\Carbon;
use App\Sale;
use App\Post;

/*
|--------------------------------------------------------------------------
| Sales Class
|--------------------------------------------------------------------------
|
| Provides useful static functions to use throught the appliction to assist in
| storing, sorting and displaying blog post data
|
|
*/

class PostService {

  public function save($request){
    //instantiate new post
      $post = new Post;
      //assign data
      $post->title = $request->title;
      $post->body = $request->body;
      $post->tags = $request->tags;
      $post->slug = str_slug($post->title);
      //store image name to pass to image field
      if(!empty($request->file)){
        $imageName = $request->file('image')->getClientOriginalName();
        //move imave to directory
        $file = $request->file('image')->move(public_path()."/images/blog_images/", $imageName);
        //save image name
        $post->image = $imageName;
      }
      //create new post
      $post->save();
      //if categories were applied attach them to the post
      $post->category()->attach($request->category);
  }

  public function update($post,$request){
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
    $post->category()->attach($request->category);
  }


} //end PostService class
