@extends('layouts.admin')

@section('content')

<div class="container-fluid">
  <h1 class="page-header">
  Blog Categories
  </h1>
    <div class="col-md-4">
      <form action="/admin/add_post_category" method="post">
        <div class="form-group">
          <label for="category-title">Title</label>
          <input type="text" class="form-control" name="category_input">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Add Category" name="submit_category">
        </div>
      </form>
    </div>
  <div class="col-md-8">
    <table class="table">
      <thead>
        <tr>
          <th>Category Id</th>
          <th>Category Title</th>
        </tr>
      </thead>
      <tbody>
        @if(!empty($categories))
          @foreach($categories as $category)
            <tr>
            <td>$category->id</td>
            <td>$category->title</td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
  <form action="/admin/edit_post_category" method="post">
    {{ method_field('PATCH') }}
  <h1>Edit Categories</h1>
  <div class="col-md-4">
    <h3>Old Category Title</h3>
    <select name="category_select" id="" class="form-control">
      @if(!empty($categories))
        @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->title}}</option>;
        @endforeach
      @endif
    </select>
  </div>
  <div class="col-md-6">
    <h3>New Category Title</h3>
    <input type="text" class="form-control" name="title">
  </div>
  <div class="col-md-2">
    <button type="submit" name="submit_edit">Submit Edit</button>
  </div>
</form>
</div>
<!-- /.container-fluid -->


@endsection
