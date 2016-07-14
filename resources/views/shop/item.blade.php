@extends('layouts.main')

@section('title')
    @if(!empty($page_title))
        BugWildFlyCo. {{$page_title}}
    @else
        BugWildFlyCo.
    @endif
@endsection


@section('content')


    <body class="item-page-maybe">
    @if(Session::has('added'))
        <div class="alert alert-success added"
             style="postion:absolute;z-index:1000;top:0;bottom:0;width:100vw;">{{ Session::get('added') }}</div>
    @endif
    @if(!empty($product))
        <div class="item-display" style="min-height:55vh;">
            <div class="quick-links">
                <span><a href="/shop">Shop</a></span> / <span><a
                            href="/shop/category/{{$category->slug}}">{{$category->title}}</a></span> /
                <span>Product</span>
            </div>
            <div class="row">
                <div class="item-picture col-lg-4 col-md-4 col-sm-12">
                    <img class="default-image" src="/images/product_images/{{$product->image1}}"/>
                    <img class="blow-up-image" src="/images/product_images/{{$product->image1}}"/>
                    <div class="thumbs-container">
                        <div class="item-thumbs"><img src="/images/product_images/{{$product->image1}}" alt=""></div>
                        @if(!empty($product->image2))
                            <div class="item-thumbs"><img src="/images/product_images/{{$product->image2}}" alt="">
                            </div>
                        @endif
                        @if(!empty($product->image3))
                            <div class="item-thumbs" style="float: right;"><img
                                        src="/images/product_images/{{$product->image3}}" alt=""></div>
                        @endif
                    </div>
                </div>
                <div class="item-details col-lg-8 col-md-8 col-sm-12">
                    <form action="/cart/add" method="product">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <h1>{{$product->title}}</h1>
                        <h3>Price Each: $ {{number_format(($product->price /100), 2, '.', ' ')}}</h3>
                        <div class="option-selectors">
                            <div class="quantity">
                                <div class="row">
                                    <label>Quantity</label>
                                    <i class='qty-minus fa fa-minus-square'></i>
                                    <select class="qty-select" name="quantity">
                                        <option id="qty-counter" value="1">1</option>
                                    </select>
                                    <i class='qty-plus fa fa-plus-square'></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="color">
                                    <label>Color</label>
                                    <select class="" name="color">
                                        @if(!empty($product->colors))
                                            @foreach($product->colors as $color)
                                                <option value="{{$color->title}}">{{$color->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="size">
                                    <label>Size</label>
                                    <select class="" name="size">
                                        @if(!empty($product->sizes))
                                            @foreach($product->sizes as $size)
                                                <option value="{{$size->title}}">
                                                    {{$size->title}}
                                                    @if($size->price!==0)
                                                        + ${{number_format(($size->price/100), 2, '.', ' ')}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <button class="btn-small" type="submit">Add to Cart</button>
                        </div>
                    </form>
                    <div class="description">
                        <div class="tab">
                            <p>Description</p>
                        </div>
                        <div class="description-content">{{$product->description}}</div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        @if(!empty($new_products))
            <div class="newest-flies">
              <hr class="left">
              <h1>Newest Flies</h1>
              <hr class="right">
              <div style="clear:both;"></div>
                <div class="row">
                @foreach($new_products as $new)
                        <div class="col-lg-3 col-md-6 col-sm-6" id="item-thumbnail">
                            <div class="thumbnail-content-container">
                                <div class="thumbnail-image"
                                     style="background-image:url('/images/product_images/{{$new->image1}}');">
                                    <a href="/shop/{{$new->slug}}">
                                        <button class="btn-small">More Details...</button>
                                    </a>
                                </div>
                                <a href="/shop/{{$new->slug}}">
                                    <h2>{{$new->title}}</h2>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        @endif
    @endif
    </body>

@endsection
