<?php

namespace App\Services;

use App\Sale;
use App\Post;
use App\PostCategory;

/*
|--------------------------------------------------------------------------
| PostService Class
|--------------------------------------------------------------------------
|
| class contains methods to facilate actions required to handle blog post
|save()
|update()
|
*/

/**
 * Class PostService
 * @package App\Services
 */
class PostService
{


    /**
     * @param $request
     */
    public static function save($request)
    {
        //instantiate new post
        $post = new Post;
        //assign data
        $post->title = $request->title;
        $post->body = $request->body;
        $post->tags = $request->tags;
        $post->slug = str_slug($post->title);
        //store image name to pass to image field
        if ($request->file('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            //move imave to directory
            $file = $request->file('image')->move(public_path() . "/images/blog_images/", $imageName);
            //save image name
            $post->image = $imageName;
        }


        //if categories were applied attach them to the post
        $category = PostCategory::find($request->category);

        $category->post()->save($post);

    }

    /**
     * @param $post
     * @param $request
     */
    public static function patch($request)
    {
        $post = Post::find($request->post);
        //assign data
        $post->id = $post->id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = str_slug($post->title);
        //store image name to pass to image field, if image was uploaded
        if ($request->file('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            //move imave to directory
            $file = $request->file('image')->move(public_path() . "/images/blog_images/", $imageName);
            //save image name
            $post->image = $imageName;
        }


        //if categories were applied attach them to the post after detaching previous
        $category = PostCategory::find($request->category);
        $category->post()->save($post);
    }


} //end PostService class
