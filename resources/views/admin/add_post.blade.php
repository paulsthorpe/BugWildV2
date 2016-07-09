@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <h1 class="page-header">Add Post</h1>
            </div>
            <form action="/admin/post" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="product-title">Post Title </label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="post-content">Post Content</label>
                        <textarea name="body" id="" cols="30" rows="30" class="form-control"></textarea>
                    </div>
                </div><!--Main Content-->
                <!-- SIDEBAR-->
                <aside id="admin_sidebar" class="col-md-4">
                    <!-- Product Categories-->
                    <div class="form-group">
                        <label for="post_categories">Post Category</label>
                        <hr>
                        <select name="category" id="" class="form-control">
                            @if(!empty($categories))
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>;
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <!-- Product Tags -->
                    <div class="form-group">
                        <label for="product-title">Post Keywords</label>
                        <hr>
                        <input type="text" name="tags" class="form-control">
                    </div>
                    <!-- Product Image -->
                    <div class="form-group">
                        <label for="product-title">Post Image</label>
                        <input type="file" name="image">
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
