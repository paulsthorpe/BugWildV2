<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Order;

class AdminController extends Controller
{
    public function index(){
      $orders = Order::orderBy('id','DESC')->get();
      return view('admin.orders', compact('orders'));
    }

}
