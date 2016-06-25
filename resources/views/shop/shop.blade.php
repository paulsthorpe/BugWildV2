@extends('layouts.main')
@section('title')
@if(!empty($page_title))
BugWildFlyCo. {{$page_title}}
@else
BugWildFlyCo.
@endif
@endsection
@section('content')
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
      <div class="col-lg-1">
      </div>
      <div class="product_categories col-lg-2">
        <h1>Product Categories</h1>
          <ul class="side-nav">
            @if(!empty($categories))
              @foreach($categories as $category)
                <li><a href="/shop/category/{{$category->title}}">{{$category->title}}</a></li>
              @endforeach
            @endif
            <li><a href="/shop/featured">Featured</a></li>
            <li><a href="/shop/sale">On Sale</a></li>
          </ul>
      </div>
      <div class="products-container col-lg-9">
        @if(!empty($products))
          @foreach($products as $product)
            <div class="col-lg-3" id="item-thumbnail">
              <div class="thumbnail-content-container">
                <div class="thumbnail-image">
                  <img src="/images/product_images/{{$product->image1}}">
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
