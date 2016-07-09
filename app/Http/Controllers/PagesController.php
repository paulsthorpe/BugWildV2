<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\Post;

class PagesController extends Controller
{
    public function homepage(){
        $new_products = Product::take(4)->orderBy('id', 'DESC')->get();
        $recent_posts = Post::take(4)->where('status', 1)->orderBy('id', 'DESC')->get();
        return view('layouts.landing', compact('new_products', 'recent_posts'));
    }

    public function preventRegister(){
      return redirect('/');
    }
}
