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
              <td>{{$product->price}}</td>
              <td><a href="/admin/edit_product/{{$product->id}}"><button class="btn btn-primary">Edit this Product</button></a></td>
              <td>
                <form action="/admin/product/{{$product->id}}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
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
