<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\PaypalService;

use App\Http\Requests;

class PaypalController extends Controller
{
    public function getStatus(){
      PaypalService::getStatus();
    }
}
