@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(!empty($page_title))
              <h1 class="page-header">{{$page_title}}</h1>
            @else
              <h1 class="page-header">All Products</h1>
            @endif
            @if(!empty($categories))
            <form class="form-group col-lg-2" action="/admin/products_by_category" method="post">
              {{ csrf_field() }}
              <div class="row">
                <select class="form-control" name="category">
                  @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</options>
                  @endforeach
                </select>
              </div>
              <br>
              <input class="btn btn-primary" type="submit" value="Get by category">
            </form>
            <br>
            @endif
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Edit Product</th>
                    <th>Mark Featured</th>
                    <th>Mark Sale</th>
                    <th>Delete Product</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($products))
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->title}}</td>
                            <td>
                                <img src="/images/product_images/{{$product->image1}}" alt="">
                            </td>
                            <td>
                              @if(!empty($product->category->title))
                                {{$product->category->title}}
                              @endif
                            </td>
                            <td>{{number_format(($product->price /100), 2, '.', ' ')}}</td>
                            <td><a href="/admin/edit_product/{{$product->id}}">
                                    <button class="btn btn-primary">Edit this Product</button>
                                </a></td>
                            <td>
                                <form action="/admin/featured" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    @if($product->featured === 0)
                                    <button class="btn btn-info">Add to Featured</button>
                                    @elseif($product->featured === 1)
                                    <button class="btn btn-success"">Remove Featured</button>
                                    @endif
                                </form>
                            </td>
                            <td>
                                <form action="/admin/sale" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    @if($product->on_sale === 0)
                                    <button class="btn btn-info">Mark On Sale</button>
                                    @elseif($product->on_sale === 1)
                                    <button class="btn btn-success">Take Off Sale</button>
                                    @endif
                                </form>
                            </td>
                            <td>
                                <form action="/admin/product" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <button class="btn btn-danger"
                                            onclick='return confirm( "Are you sure you want to delete" )'>
                                        Delete this Product
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    </div>
@endsection
