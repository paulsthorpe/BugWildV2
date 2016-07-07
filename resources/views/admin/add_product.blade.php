@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <h1 class="page-header">Add Product</h1>

            </div>
            <form action="/admin/product" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="product-title">Product Title </label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="product-description">Product Description</label>
                        <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-3">
                            <label for="product-price">Product Price</label>
                            <input name="price" class="form-control" size="60">
                        </div>
                    </div> <!-- price row -->
                    <!-- COLOR INPUTS -->
                    <div class="form-group colors">
                        <label for="product_colors">Product Colors</label>
                        <hr>
                        @if(!empty($colors))
                            @foreach($colors as $color)
                            <div class="color-box">
                              <label for="">{{$color->title}}</label>
                              <input type="checkbox" name="colors[]" value="{{$color->id}}">
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <div style="clear:both;">

                    </div>
                    <br><br><br>
                    <!-- SIZE INPUTS -->
                    <div class="form-group sizes">
                        <label for="product_sizes">Product Sizes</label>
                        <hr>
                        @if(!empty($sizes))
                            @foreach($sizes as $size)
                            <div class="size-box">
                              <label for="">Size: {{$size->title}} Upcharge: $ {{number_format((($size->price) /100), 2, '.', ' ')}}</label>
                              <input type="checkbox" name="sizes[]" value="{{$size->id}}">
                            </div>
                            @endforeach
                        @endif
                    </div>

                </div><!--Main Content-->
                <!-- SIDEBAR-->
                <aside id="admin_sidebar" class="col-md-4">
                    <!-- Product Categories-->
                    <div class="form-group">
                        <label for="product-title">Product Category</label>
                        <hr>
                        <select name="category" id="" class="form-control">
                            @if(!empty($categories))
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <!-- Product Tags -->
                    <div class="form-group">
                        <label for="product-title">Product Tags</label>
                        <hr>
                        <input type="text" name="product_tags" class="form-control">
                    </div>
                    <!-- Product Image -->
                    <div class="form-group">
                        <label for="product-title">Product Image</label>
                        <input type="file" name="image[]">
                    </div>
                    <div class="form-group">
                        <label for="product-title">Product Image 2</label>
                        <input type="file" name="image[]">
                    </div>
                    <div class="form-group">
                        <label for="product-title">Product Image 3</label>
                        <input type="file" name="image[]">
                    </div>
                    <!-- PUBLISH -->
                    <div class="form-group">
                        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
                    </div>
                </aside><!--SIDEBAR-->
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection

<style media="screen">
  .size-box {
    padding: 10px;
    border: 1px solid black;
    width: 25%;
    display: block;
    float: left;
  }
  .color-box {
    padding: 10px;
    border: 1px solid black;
    width: 25%;
    display: block;
    float: left;
  }
</style>
