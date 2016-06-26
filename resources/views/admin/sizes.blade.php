@extends('layouts.admin')

@section('content')

<div class="container-fluid">
  <div class="row">
    <h1 class="page-header">
    Product Sizes
    </h1>
      <div class="col-md-4">
        <form action="/admin/product_sizes" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="size-title">Size</label>
            <input type="text" class="form-control" name="title">
          </div>
          <div class="form-group">
            <label for="size-title">Price Upcharge</label>
            <input type="text" class="form-control" name="price">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Add size">
          </div>
        </form>
      </div>
    <div class="col-md-8">
      <table class="table">
        <thead>
          <tr>
            <th>Size Id</th>
            <th>Size</th>
            <th>Size Upcharge</th>
          </tr>
        </thead>
        <tbody>
          @if(!empty($sizes))
            @foreach($sizes as $size)
              <tr>
              <td>{{$size->id}}</td>
              <td>{{$size->title}}</td>
              <td>{{number_format(($size->price /100), 2, '.', ' ')}}</td>
              <td>
                <form action="/admin/product_sizes/{{$size->id}}" method="post">
                  {{ method_field('DELETE') }}
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <form action="/admin/product_sizes" method="post">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
    <h1>Edit Sizes</h1>
    <div class="col-md-4">
      <h3>Size To Edit</h3>
      <select name="id" id="" class="form-control">
        @if(!empty($sizes))
          @foreach($sizes as $size)
            <option value="{{$size->id}}">{{$size->title}}</option>;
          @endforeach
        @endif
      </select>
      <br>
      <label for="size-title">Size</label>
      <input type="text" class="form-control" name="title">
      <br>
      <label for="size-title">New Upcharge</label>
      <input type="text" class="form-control" name="price">
      <br>
      <button type="submit" class="btn btn-primary">Submit Edit</button>
    </div>
  </form>
  </div>

</div>
<!-- /.container-fluid -->


@endsection
