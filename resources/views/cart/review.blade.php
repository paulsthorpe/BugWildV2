@extends('layouts.main')

@section('content')

<body>
  <div class="container">
    <div class="row">
      <h1>Order Details</h1>
        <table class="table table-striped">
          <thead>
            <tr class="table-header">
               <th>Product</th>
               <th>Price Each</th>
               <th>Color</th>
               <th>Quantity</th>
               <th>Sub-total</th>
            </tr>
          </thead>
          <tbody>
            @if(!empty(Session::get('items')))
              @foreach(Session::get('items') as $item)
                <tr>
                  <td>{{$item['product_title']}}</td>
                  <td>$ {{number_format((($item['base_price'] + $item['base_price']) /100), 2, '.', ' ')}}</td>
                  <td>{{$item['color']}}</td>
                  <td>{{$item['size']}}</td>
                  <td>{{$item['quantity']}}</td>
                  <td>$ {{number_format(($item['price_as_config'] /100), 2, '.', ' ')}}</td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
    </div>
<!--  ***********CART TOTALS*************-->
      <div class="row">
        <div class="col-lg-4">
          <h2>Cart Totals</h2>
          <table class="table table-bordered" cellspacing="0">
            <tr class="cart-items">
              <th>Items:</th>
              <td><span class="amount">{{$itemCount}}</span></td>
            </tr>
            <tr class="order-total">
              <th>Items Total Price</th>
              <td><strong><span class="amount">$ {{number_format(($cartTotal /100), 2, '.', ' ')}}</span></strong> </td>
            </tr>
            <tr class="shipping">
              <th>Shipping and Handling</th>
              <td>$7.00 Flat Rate Insured</td>
            </tr>
            <tr class="order-total">
              <th>Order Total</th>
              <td><strong><span class="amount">$ {{number_format((($cartTotal+700) /100), 2, '.', ' ')}}</span></strong> </td>
            </tr>
          </table>
        </div><!-- CART TOTALS-->
        <br></br><br></br>
        <div class="col-lg-8">
        @if(empty(Session::get('special')))
          <h2>You Have Not Included Special Instructions<br>Go
            <a href='/cart'>Here</a>if you wish to add some.</h2>
        @else
          <pre><h1>Special Instructions</h1>{{Session::get('special')}}</pre>
        @endif
        <form action="/payment" method="post">
          {{ csrf_field() }}
          <input type="image"
          src="https://www.paypalobjects.com/en_US/i/btn/btn_xpressCheckout_SM.gif"
          alt="PayPal - The safer, easier way to pay online">
        </form>
        </div>
      </div>  <!-- row -->

  </div><!--Main Content-->

</body>


@endsection
