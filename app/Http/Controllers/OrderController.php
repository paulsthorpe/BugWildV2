<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon;
use App\Order;
use App\ProductColor;

class OrderController extends Controller
{


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(50);
        return view('admin.orders', compact('orders'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get($id)
    {
        $order = Order::with('items')->where('id', $id)->first();
        foreach($order->items as $item){
          $color = ProductColor::where('id', $item->color)->value('title');
          $item->color = $color;
        }
        return view('admin.order', compact('order'));
    }

    /**
     * change shipment status
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patch(Request $request)
    {
        $order = Order::find($request->id);
        if ($order->shipped === 0) {
            $order->shipped = 1;
        } elseif ($order->shipped === 1) {
            $order->shipped = 0;
        }
        $order->save();
        return back();
    }


}
