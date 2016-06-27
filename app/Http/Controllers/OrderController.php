<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon;
use App\Order;

class OrderController extends Controller
{



  public function index(){
    $orders = Order::orderBy('id','DESC')->paginate(50);
    return view('admin.orders', compact('orders'));
  }

  public function get($id){
    $order = Order::with('items')->where('id',$id)->firstOrFail();
    return view('admin.order', compact('order'));
  }

  public function patch(Request $request){
    $order = Order::find($request->id);
    if($order->shipped === 0){
      $order->shipped = 1;
    } elseif($order->shipped === 1){
      $order->shipped = 0;
    }
    $order->save();
    return back();
  }



}
