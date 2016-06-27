<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\PaypalService;

use App\Http\Requests;
use Redirect;
use Session;

class PaypalController extends Controller
{

    public function __construct(PaypalService $service){
        $this->paypalService = $service;
    }

    public function createOrder(){
      $url = $this->paypalService->createOrder();
      return Redirect::away($url);
    }

    public function getStatus(Request $request){

      if (empty($request->PayerID || $request->token)){
        Session::flash('paypal_failed', 'Order Unsuccessful, something went wrong with you paypal transaction. Check your account and try again');
        return redirect('/shop');
      }

      $status = $this->paypalService->getStatus($request);

      if($status === 0){
        Session::flash('failed', 'Order Unsuccessful, please check your paypal account or contact BugWild directly at bugwildflyco@gmail.com');
      } elseif($status === 1){
        Session::flash('success', 'Order Successful, please allow up to two weeks for your order to be shipped.');
      }

      return redirect('/shop');
    }

}
