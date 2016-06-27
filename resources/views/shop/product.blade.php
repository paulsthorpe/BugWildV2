@extends('layouts.main')

@section('title')
@if(!empty($page_title))
BugWildFlyCo. {{$page_title}}
@else
BugWildFlyCo.
@endif
@endsection


@section('content')
<style>
</style>
<body class="item-page">
  @if(!empty($product))
      <div class="item-display">
        <div class="row">
          <div class="item-picture">
            <img class="default-image" src="/images/product_images/{{$product->image1}}"/>
            <img class="blow-up-image" src="/images/product_images/{{$product->image1}}"/>
            <div class="item-thumbs"><img src="/images/product_images/{{$product->image1}}" alt=""></div>
            @if(!empty($product->image2))
              <div class="item-thumbs"><img src="/images/product_images/{{$product->image2}}" alt=""></div>
            @endif
            @if(!empty($product->image3))
              <div class="item-thumbs" style="float: right;"><img src="/images/product_images/{{$product->image2}}" alt=""></div>
            @endif
          </div>
          <div class="item-details">
          <form action="/cart/add" method="product">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$product->id}}">
            <h1>{{$product->title}}</h1>
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
                <div class="color-selector">
                  <label>Color</label>
                  <select class="" name="color">
                    @if(!empty($product->colors))
                      @foreach($product->colors as $color)
                        <option value="{{$color->title}}">{{$color->title}}</option>
                      @endforeach
                    @endif
                  </select>
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
              <div class="row">
                <div class="add col-lg-12">
                  <h3>Price Each: $ {{number_format(($product->price /100), 2, '.', ' ')}}</h3>
                  <button class="btn-small" type="submit">Add to Cart</button>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="description"><pre>{{$product->description}}</pre></div>
      </div>
      @if(!empty($new_products))
        @foreach($new_products as $new)
          <h1>New Flies</h1>
          <div class="newest-flies">
            <div class="new-fly-thumbs" id="item-thumbnail">
               <div class="thumbnail-content-container">
                  <img src="{{$new->image1}}" class="thumbnail-image">
                  <h3>{{$new->title}}</h3>
                  <a href="/shop/{{$new->slug}}">
                    <button class="btn-small">More Details...</button>
                  </a>
                </div>
            </div>
          </div>
        @endforeach
      @endif
    @endif
</body>

@endsection
