<?php

namespace App\Services;

use Carbon\Carbon;
use App\Sale;
use App\Post;

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
    public function save($request)
    {
        //instantiate new post
        $post = new Post;
        //assign data
        $post->title = $request->title;
        $post->body = $request->body;
        $post->tags = $request->tags;
        $post->slug = str_slug($post->title);
        //store image name to pass to image field
        if (!empty($request->file)) {
            $imageName = $request->file('image')->getClientOriginalName();
            //move imave to directory
            $file = $request->file('image')->move(public_path() . "/images/blog_images/", $imageName);
            //save image name
            $post->image = $imageName;
        }
        //create new post
        $post->save();
        //if categories were applied attach them to the post
        $post->category()->attach($request->category);
    }

    /**
     * @param $post
     * @param $request
     */
    public function update($post, $request)
    {
        //assign data
        $post->id = $post->id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = str_slug($post->title);
        //store image name to pass to image field, if image was uploaded
        if ($request->file('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            //move imave to directory
            $file = $request->file('image')->move(public_path() . "/blog_images/", $imageName);
            //save image name
            $post->image = $imageName;
        }
        //create new post
        $post->save();
        //if categories were applied attach them to the post after detaching previous
        $post->category()->attach($request->category);
    }


} //end PostService class
