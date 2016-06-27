@extends('layouts.main')
@section('content')
    <body class="cart">
    <div class="container">
        <div class="row">
            <h1>Checkout</h1>
            <table class="table table-striped">
                <thead>
                <tr class="table-header">
                    <th>Product</th>
                    <th>Price Each</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Modify Quantity</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty(Session::get('items')))
                    <?php  $index = 0; ?>
                    @foreach(Session::get('items') as $item)
                        <tr>
                            <td>{{$item['product_title']}}</td>
                            <td>$ {{number_format((($item['base_price'] + $item['upcharge']) /100), 2, '.', ' ')}}</td>
                            <td>{{$item['color']}}</td>
                            <td>{{$item['size']}}</td>
                            <td>{{$item['quantity']}}</td>
                            <td>$ {{number_format(($item['price_as_config'] /100), 2, '.', ' ')}}</td>
                            <td>
                                <a href="/cart/plus/<?php  echo $index; ?>"><i class="fa fa-plus-square"></i></a>
                                <a href="/cart/minus/<?php  echo $index; ?>"><i class="fa fa-minus-square"></i></a>
                                <a href="/cart/trash/<?php  echo $index; ?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php  $index++; ?>
                    @endforeach
                @endif
                </tbody>
            </table>
            </table>
            <br></br>
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
                            <td><strong><span class="amount">$ {{number_format(($cartTotal /100), 2, '.', ' ')}}</span></strong>
                            </td>
                        </tr>
                        <tr class="shipping">
                            <th>Shipping and Handling</th>
                            <td>$7.00 Flat Rate Insured</td>
                        </tr>
                        <tr class="order-total">
                            <th>Order Total</th>
                            <td>
                              <strong>
                                <span class="amount">
                                  $ {{number_format((($cartTotal+700) /100), 2, '.', ' ')}}
                                </span>
                              </strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- CART TOTALS-->
                <div class="col-lg-2"></div>
                <div class="col-lg-6">
                    <br></br>
                    <div class="row">
                      @if(!empty(Session('items')))
                        <a href="/cart/flush"
                           style="color:#fff;"
                           class="btn btn-danger"
                           onclick="return confirm('Are you sure you want to empty your cart?')">
                            Clear Cart
                        </a>
                    </div>
                    <br></br>
                    <form action="/review" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">

                            <label for="special">Special Instructions</label>
          <textarea class="form-control" name="special" rows="8"
                    placeholder="If any special instructions need to be given for your order, please include them here. This is especially important forany deer hair flies. If I have any questions beyond the scope ofthis message, or if anything remains unclear, I will contact you by email to ensure the order is to your desired specifications."
                    style="text-align: left;"></textarea>
                            <br></br>
                            <button type="submit" class="btn btn-primary">Save Special Instructions and Review Order
                            </button>
                          @endif
                    </form>
                </div>
            </div>
        </div>  <!-- row -->
    </div><!--Main Content-->
    </div>
    </body>
@endsection
