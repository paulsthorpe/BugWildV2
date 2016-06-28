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
            <div class="product_categories col-lg-3 col-sm-12">
                <h1>Product Categories</h1>
                <ul class="side-nav">
                    @if(!empty($categories))
                        @foreach($categories as $category)
                            <li><a href="/shop/category/{{$category->slug}}">{{$category->title}}</a></li>
                        @endforeach
                    @endif
                    <li><a href="/featured">Featured Products</a></li>
                    <li><a href="/sale">On Sale</a></li>
                </ul>
            </div>
            <div class="products-container col-lg-9">
                @if(!empty($products))
                    @foreach($products as $product)
                        <div class="col-lg-4 col-sm-6" id="item-thumbnail">
                            <div class="thumbnail-content-container">
                                <div class="thumbnail-image"
                                     style="background-image:url('/images/product_images/{{$product->image1}}');">
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
            {{ $products->links() }}
        </div>
    </div>
    </body>
@endsection
