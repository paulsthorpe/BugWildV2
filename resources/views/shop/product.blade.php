@extends('layout.main')

@section('title')
BugWild Fly Co. {{$product->title}}
@endsection


@section('content')
<style>
</style>
<body>
  @if(!empty($product))
      <div class="item-display">
        <div class="item-picture">
          <div class="magnify"><i class="fa fa-search-plus"></i></div>
          <img class="default-image" src="{{$post->image1}}"/>
          <img class="blow-up-image" src="{{$post->image1}}"/>
          <div class="item-thumbs"><img src="{{$post->image1}}" alt=""></div>
          @if(!empty($product->image2))
            <div class="item-thumbs"><img src="{{$post->image2}}" alt=""></div>
          @endif
          @if(!empty($product->image3))
            <div class="item-thumbs" style="float: right;"><img src="{{$post->image2}}" alt=""></div>
          @endif
        </div>
        <div class="item-details">
        <form action="/add_to_cart" method="post">
          {{ csrf_token() }}
          <input type="hidden" name="product_id" value="$product->product_id">
          <h1>{{$product->title}}</h1>
          <div class="option-selectors">
            <div class="quantity">
              <label>Quantity</label>
              <i class='qty-minus fa fa-minus-square'></i>
              <select class="qty-select" name="quantity">
                <option id="qty-counter" value="1">1</option>
              </select>
              <i class='qty-plus fa fa-plus-square'></i>
            </div>
            <div class="color-selector">
              <label>Color</label>
              <select class="" name="color">
                @foreach($product->colors as $color)
                  <option value="{{$color->id}}">{{$color->title}}</option>
                @endforeach
              </select>
              <label>Size</label>
              <select class="" name="size">
                @foreach($product->sizes as $size)
                  <option value="{{$size->id}}">{{$size->title}} @if($size->price!==0) + ${{$size->price}}</option>
                @endforeach
              </select>
            </div>
            <div class="add">
              <h3>Price Each: $ {{$product->price}}</h3>
              <button class="btn-small" type="submit" name="add-to-cart" href="#">Add to Cart</button>
            </form>
            </div>
          </div>
          <div class="description"><pre>{{$product->description}}</pre></div>
        </div>

      </div>
      @if(!empty($new_products))
        @foreach($new_products as $new)
          <h1>Featured Flies</h1>
          <div class="newest-flies">
            <div class="new-fly-thumbs" id="item-thumbnail">

               <div class="thumbnail-content-container">
                  <img src="{{$new->image1}}" class="thumbnail-image">
                  <h3>{{$new->title}}</h3>
                  <a href="/shop/item/{{$new->slug}}">
                    <button class="btn-small">More Details...</button>
                  </a>
                </div>
            </div>

          </div>
        @endforeach
      @endif
</body>

@endsection
