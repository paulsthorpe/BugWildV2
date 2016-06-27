<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProductSize;

class ProductSizeController extends Controller
{
  public function index(){
    $sizes = ProductSize::all();
    return view('admin.sizes', compact('sizes'));
  }

  public function save(Request $request){
    $size = new ProductSize;
    $size->title = $request->title;
    $size->price = $request->price;
    $size->save();
    return back();
  }

  public function patch(Request $request){
    $size = ProductSize::find($request->id);
    $size->title = $request->title;
    $size->price = $request->price;
    $size->save();
    return back();
  }

  public function destroy(Request $request){
    $size = ProductSize::find($request->id);
    $size->delete();
    return back();
  }
}
