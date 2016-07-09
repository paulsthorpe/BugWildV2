@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="page-header">All Post</h1>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Set Status</th>
                    <th>Edit Post</th>
                    <th>Delete Post</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($posts))
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>
                                <img src="/images/blog_images/{{$post->image}}" alt="">
                            </td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->category->title}}</td>
                            @if($post->status === 0)
                            <td>Draft</td>
                            <td>
                              <a href="/admin/postStatus/{{$post->id}}"class="btn btn-primary">
                                  Change Status
                              </a>
                            </td>
                            @else
                            <td>Published</td>
                            <td>
                              <a href="/admin/postStatus/{{$post->id}}"class="btn btn-success">
                                  Change Status
                              </a>
                            </td>
                            @endif
                            <td>
                                <a href="/admin/edit_post/{{$post->id}}">
                                    <button class="btn btn-primary">Edit this Post</button>
                                </a>
                            </td>
                            <td>
                                <form action="/admin/post" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="post" value="{{$post->id}}">
                                    <button class="btn btn-danger"
                                            onclick='return confirm( "Are you sure you want to delete this post?" )'>
                                        Delete this Post
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
