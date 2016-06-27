@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="page-header">All Post</h1>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Edit Post</th>
                    <th>Delete Post</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($posts))
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->cat}}</td>
                            <td>
                                <a href="/admin/edit_post/{{$post->id}}">
                                    <button class="btn btn-primary">Edit this Post</button>
                                </a>
                            </td>
                            <td>
                                <form action="/admin/post" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="id" value="{{$post->id}}">
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
@endsection
