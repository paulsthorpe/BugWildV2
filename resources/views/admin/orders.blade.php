@extends('layouts.admin')
@section('content')
    <br></br>
    <br></br>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-6">
                <form action="admin.php?source=sort_orders" method="POST">
                    <h1 class="page-header">Orders</h1>
                    <h3>Filter Orders By:</h3>
                    <label for="Month">Month</label>
                    <select name="month" id="">
                        <option value="01">January</options>
                        <option value="02">February</options>
                        <option value="03">March</options>
                        <option value="04">April</options>
                        <option value="05">May</options>
                        <option value="06">June</options>
                        <option value="07">July</options>
                        <option value="08">August</options>
                        <option value="09">September</options>
                        <option value="10">October</options>
                        <option value="11">November</options>
                        <option value="12">December</options>
                    </select>
                    <label for="Year">Year</label>
                    <select name="year" id="">
                        <option value="2016">2016</options>
                        <option value="2017">2017</options>
                        <option value="2018">2018</options>
                    </select>
                    <input class="btn btn-primary" type="submit" name="filter_orders" value="Filter Orders">
            </div>
            <div class="col-lg-6">
                <h1>Financials: Quick Look</h1>
                <label for="MonthlyTotal">Monthly Total:</label>
                <input type="text" name="monthly_total" value="">
                <br></br>
                <label for="YearlyTotal">Yearly Total:</label>
                <input type="text" name="yearly_total" value="">
                </form>
            </div>
        </div>
        <!-- /.row -->
        <!-- SECOND ROW WITH TABLES-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Order Date</th>
                                    <th>Order Contents</th>
                                    <th>Order Amount</th>
                                    <th>Paypal Amount Recieved</th>
                                    <th>Paylpal Trans ID</th>
                                    <th>Paypal Status</th>
                                    <th>Pending/Shipped</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($orders))
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{Carbon\Carbon::parse($order->created_at)->toFormattedDateString()}}</td>
                                            <td><a href="/admin/order/{{$order->id}}">More Here</a></td>
                                            <td>$ {{number_format(($order->total), 2, '.', ' ')}}</td>
                                            <td>$ {{number_format(($order->paypal_total), 2, '.', ' ')}}</td>
                                            <td>{{$order->trans_id}}</td>
                                            <td>{{$order->paypal_status}}</td>
                                            @if($order->shipped === 0)
                                                <td>PENDING</td>
                                            @else
                                                <td>Shipped</td>
                                            @endif
                                            <td>
                                                <form action="/admin/order" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    <input type="hidden" name="id" value="{{$order->id}}">
                                                    @if($order->shipped === 0)
                                                    <input type="submit" name="changeStatus"
                                                           class="btn btn-danger btn-sm"
                                                           value="Set Status"
                                                           onclick='return confirm("Are you sure you want to change shipment status of order {{$order->id}}?")'>
                                                    @else
                                                    <input type="submit" name="changeStatus"
                                                           class="btn btn-success btn-sm"
                                                           value="Set Status"
                                                           onclick='return confirm("Are you sure you want to change shipment status of order {{$order->id}}?")'>
                                                    @endif

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
