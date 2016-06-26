<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\PaypalService;

use App\Http\Requests;

class PaypalController extends Controller
{

    public function __construct(PaypalService $service){
        $this->paypalService = $service;
    }

    public function createOrder(){
      $url = $this->paypalService->createOrder();
      return \Redirect::away($url);
    }

    public function getStatus(Request $request){
      // dd($request->token);
      if (empty($request->PayerID || $request->token)){
        dd('Failed');
      }

      $this->paypalService->getStatus($request);
    }

}
