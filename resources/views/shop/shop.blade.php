@extends('layouts.main')
@section('title')
@if(!empty($page_title))
BugWildFlyCo. {{$page_title}}
@else
BugWildFlyCo.
@endif
@endsection
@section('content')

<!--
Flash messages to report errors to customers.
 -->
@if(Session::has('failed'))
  <div class="alert alert-danger flash"
  style="postion:absolute;z-index:1000;top:0;bottom:0;width:100vw;">{{ Session::get('failed') }}</div>
@elseif(Session::has('paypal_failed'))
  <div class="alert alert-danger flash"
  style="postion:absolute;z-index:1000;top:0;bottom:0;width:100vw;">{{ Session::get('paypal_failed') }}</div>
@elseif(Session::has('success'))
  <div class="alert alert-success flash"
  style="postion:absolute;z-index:1000;top:0;bottom:0;width:100vw;">{{ Session::get('success') }}</div>
@endif
<body class="shop">
  <h1 style="font-size: 5em; margin-top: 75px;">
    @if(!empty($page_title))
    {{$page_title}}
    @else
    Shop
    @endif
  </h1>
  <div class="container-fluid product-display">
    <div class="row">
      <div class="product_categories col-lg-2 col-sm-12">
        <h1>Product Categories</h1>
          <ul class="side-nav">
            @if(!empty($categories))
              @foreach($categories as $category)
                <li><a href="/shop/category/{{$category->title}}">{{$category->title}}</a></li>
              @endforeach
            @endif
          </ul>
      </div>
      <div class="products-container col-lg-8">
        @if(!empty($products))
          @foreach($products as $product)
            <div class="col-lg-4 col-sm-6" id="item-thumbnail">
              <div class="thumbnail-content-container">
                <div class="thumbnail-image" style="background-image:url(/images/product_images/{{$product->image1}});">
                  <!-- <img src="/images/product_images/{{$product->image1}}"> -->
                </div>
                <h2>{{$product->title}}</h2>
                <a href="/shop/{{$product->slug}}">
                  <button class="btn-small">More Details...</button>
                </a>
              </div>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
</body>
@endsection
