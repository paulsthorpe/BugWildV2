<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ProductColor;

class ProductColorController extends Controller
{
    public function index()
    {
        $colors = ProductColor::all();
        return view('admin.colors', compact('colors'));
    }

    public function save(Request $request)
    {
        $color = new ProductColor;
        $color->title = $request->title;
        $color->save();
        return back();
    }

    public function patch(Request $request)
    {
        $color = ProductColor::find($request->id);
        $color->title = $request->title;
        $color->save();
        return back();
    }

    public function destroy(Request $request)
    {
        $color = ProductColor::find($request->id);
        $color->delete();
        return back();
    }
}
