@extends('layouts.admin')

@section('content')

<div class="container-fluid">
  <div class="row">
    <h1 class="page-header">All Products</h1>
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
                {{$product->cat}}
              </td>
              <td>{{number_format(($product->price /100), 2, '.', ' ')}}</td>
              <td><a href="/admin/edit_product/{{$product->id}}"><button class="btn btn-primary">Edit this Product</button></a></td>
              <td>
                <form action="/admin/featured/{{$product->id}}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <button class="btn btn-info">
                    Mark Featured
                  </button>
                </form>
              </td>
              <td>
                <form action="/admin/on_sale/{{$product->id}}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <button class="btn btn-info">
                    Mark On Sale
                  </button>
                </form>
              </td>
              <td>
                <form action="/admin/product" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <input type="hidden" name="id" value="{{$product->id}}">
                  <button class="btn btn-danger"onclick='return confirm( "Are you sure you want to delete" )'>
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
