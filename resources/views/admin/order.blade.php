@extends('layouts.admin')
@section('content')
    <br></br>
    <br></br>
    @if(!empty($order))
        <h1>Order Id : {{$order->id}}</h1>
        @if($order->shipped === 0)
            <h2 style="color:red;">PENDING SHIPMENT</h2>
        @elseif ($order->shipped === 1)
            <h2 style="color:green;">SHIPPED</h2>
        @endif
        <br></br>
        <br></br>
        <table class="table table-striped">
            <thead>
            <tr class="table-header">
                <th>Product</th>
                <th>Color</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->items as $item)
            <tr>
              <td>{{$item->title}}</td>
              <td>{{$item->color}}</td>
              <td>{{$item->size}}</td>
              <td>{{$item->quantity}}</td>
              <td>{{number_format(($item->total), 2, '.', ' ')}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br><br><br>
        <table class="table table-striped">
            <thead>
            <th>Order Date</th>
            <th>Order Amount</th>
            <th>Amt Recieved From Paypal</th>
            <th>PaylPal Trans ID</th>
            <th>PayPal Status</th>
            </thead>
            <tbody>
            <tr>
                <td>{{Carbon\Carbon::parse($order->created_at)->toFormattedDateString()}}</td>
                <td>{{ number_format(($order->total), 2, '.', ' ') }}</td>
                <td>{{ number_format(($order->paypal_total), 2, '.', ' ') }}</td>
                <td>{{$order->trans_id}}</td>
                <td>{{$order->paypal_status}}</td>
            </tr>
            </tbody>
        </table>
        <h3>Special Instructions</h3>
        <pre>{{$order->special}}</pre>
    @endif
@endsection
