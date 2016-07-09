<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\PostCategory;
use App\Services\PostService;

class PostController extends Controller
{
    /**
     * inject PostService class
     * @param PostService $postService
     */
    public function __contruct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'DESC')->get();

        return view('admin.posts_index', compact('posts'));
    }

    /**
     * serve view containing add post form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $categories = PostCategory::all();
        return view('admin.add_post', compact('categories'));
    }

    /**
     * persist post to database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        PostService::save($request);
        return redirect('/admin/posts');
    }

    /**
     * serve view per-filled with post data to submit patch request
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $categories = PostCategory::all();
        return view('admin.edit_post', compact('post', 'categories'));
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function patch(Request $request)
    {
        PostService::patch($request);
        return redirect('/admin/posts');
    }

    /**
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function status(Post $post)
    {
        if($post->status === 0){
          $post->status = 1;
        } else {
          $post->status = 0;
        }
        $post->save();
        return redirect('/admin/posts');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $post = Post::find($request->post);
        $post->delete();
        return back();
    }
}
