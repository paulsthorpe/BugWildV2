<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\ProductSize;
use Session;
use App\Services\CartService;


class CartController extends Controller
{

    /**
     * inject CartService class
     * CartController constructor.
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * show cart with or without products
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $cartTotal = 0;
        $itemCount = 0;
        if (!empty(session('items'))) {
            foreach (session('items') as $item) {
                $cartTotal += $item['price_as_config'];
                $itemCount += $item['quantity'];
            }
        }
        return view('cart.cart', compact('cartTotal', 'itemCount'));
    }

    /**
     * show cart review 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function review()
    {
        $cartTotal = 0;
        $itemCount = 0;
        if (!empty(session('items'))) {
            foreach (session('items') as $item) {
                $cartTotal += $item['price_as_config'];
                $itemCount += $item['quantity'];
            }
        }
        return view('cart.review', compact('cartTotal', 'itemCount'));
    }

    /**
     * save item to session/cart
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request)
    {
        $this->cartService->addToCart($request);
        return back();
    }

    /**
     * increment cart item qty, gets items index in session from view
     * @param $index
     * @return \Illuminate\Http\RedirectResponse
     */
    public function increment($index)
    {
        $this->cartService->incrementQty($index);
        return back();
    }

    /**
     * increment cart item qty, gets items index in session from view
     * @param $index
     * @return \Illuminate\Http\RedirectResponse
     */
    public function decrement($index)
    {
        $this->cartService->decrementQty($index);
        return back();
    }

    /**
     * clear session/cart item, individually
     * @param $index
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trashCart($index)
    {
        Session::forget('items.' . $index);
        return back();
    }

    /**
     * clear all session/cart values
     * @return \Illuminate\Http\RedirectResponse
     */
    public function flush()
    {
        Session::flush();
        return back();
    }

    /**
     * save special instructions to session to persist after order completion
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addSpecialInstructions(Request $request)
    {
        $special = $request->special;
        session(['special' => $special]);
        return redirect('/review');
    }


}
