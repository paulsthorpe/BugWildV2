@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <h1 class="page-header">
                Product Colors
            </h1>
            <div class="col-md-4">
                <form action="/admin/product_color" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="color-title">Color</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add color">
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Color Id</th>
                        <th>Color</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($colors))
                        @foreach($colors as $color)
                            <tr>
                                <td>{{$color->id}}</td>
                                <td>{{$color->title}}</td>
                                <td>
                                    <form action="/admin/product_color" method="post">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$color->id}}">
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

        <form action="/admin/product_color" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <h1>Edit colors</h1>
            <div class="col-md-4">
                <h3>Old Color Title</h3>
                <select name="id" class="form-control">
                    @if(!empty($colors))
                        @foreach($colors as $color)
                            <option value="{{$color->id}}">{{$color->title}}</option>;
                        @endforeach
                    @endif
                </select>
                <br>
                <h3>New Color Title</h3>
                <input type="text" class="form-control" name="title">
                <br>
                <button type="submit" class="btn btn-primary">Submit Edit</button>
            </div>

        </form>
    </div>
    <!-- /.container-fluid -->


@endsection
