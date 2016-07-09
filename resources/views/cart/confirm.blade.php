@extends('layouts.main')

@section('content')


@if(Session::has('failed'))
    <div class="alert alert-danger flash"
         style="postion:absolute;z-index:1000;top:0;bottom:0;width:100vw;">{{ Session::get('failed') }}</div>
@elseif(Session::has('paypal_failed'))
    <div class="alert alert-danger flash"
         style="postion:absolute;z-index:1000;top:0;bottom:0;width:100vw;">{{ Session::get('paypal_failed') }}</div>
@elseif(Session::has('success'))
    <div class="alert alert-success flash" style="min-height:55vh;"
         style="postion:absolute;z-index:1000;top:0;bottom:0;width:100vw;">{{ Session::get('success') }}</div>
         <br></br>
         <h1>Thanks for Ordering with Bugwild Fly Co.</h1>
         <br></br>
         <p>Your Payment has been processed through Paypal, your flies will be shipped once they are tied, please allow up to TWO WEEKS for order to be shipped during times of high volume.
         </p>
         <br></br>
         <h2>Order Summary:</h2>
         <br></br>
         Order recieved on : <?php echo date('M d Y'); ?>
         <br></br>
         Order Total: $ {{ number_format(((Session::get('total')) /100), 2, '.', ' ') }}
         <br></br>
         Bugwild Order Id: {{ Session::get('orderId')}}
         <br></br>
         Paypal Trans ID: {{ Session::get('transId') }}
         <br></br>
         @if(!empty(Session::get('special')))
         Your Special Instructions Were:
         <br></br>
         <pre>
         {{ Session::get('special') }}
         </pre>
         @endif
@endif


@endsection
