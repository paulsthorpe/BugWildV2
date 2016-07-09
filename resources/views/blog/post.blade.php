@extends('layouts.main')

@section('title')
  @if(!empty($post))
    BugWildFlyCo. {{$post->title}}
  @else
    BugWildFlyCo.
  @endif
@endsection

@section('content')
<body>
<style>
    .post-bottom-nav .col-lg-2 ul li {
        list-style: none;
        text-decoration: none !important;
        color: black;
    }

    #sidenav ul a li:hover {
        color: darkorange;
        font-weight: 800;
        transition: color .5s, font-weight .5s;
    }


    #content{
        text-align: center;
    }

    .post-container {
        margin: 20px auto;
        padding-top: 20px;
    }

    .post-container img{
        width: 80%;
    }
</style>

<div class="content-container" style="min-height:100vh;">
  <div class="container-fluid">
    <div class="row">
       <div class="col-lg-12" id="content">
        @if(!empty($post))
            <div class="post-container">
               <img src='/images/blog_images/{{$post->image}}'>
               <a href="post.php?post_id=$post->post_id"><h2>{{$post->title}}</h2></a>
               <h3>{{Carbon\Carbon::parse($post->created_at)->format('M  d, Y')}}</h3>
               <h3>In: {{$post->category->title}}</h3>
               <pre>{{$post->body}}</pre>
            </div>
        @else
        Post Not Found
        @endif
       </div>
    </div>
    <div class="row post-bottom-nav">
    <h1>More From The Blog...</h1>
    <div class="col-lg-4"></div>
      <div class="col-lg-2 post-recent-post">
        <h3>RECENT POST</h3>
        <ul>
          @if(!empty($recent_posts))
          @foreach($recent_posts as $post)
              <li><a href="/post/{{$post->slug}}">{{$post->title}}</a></li>
          @endforeach
          @else
              <li>There are no post...</li>
          @endif
        </ul>
      </div>
      <div class="col-lg-2 post-post-categories">
        <h3>CATEGORIES</h3>
         <ul>
           @if(!empty($categories))
           @foreach($categories as $category)
             <li><a href="/post/category/{{$category->slug}}">{{$category->title}}</a></li>
           @endforeach
           @else
            <li>There are no blog categories...</li>
           @endif
         </ul>
      </div>
    </div>
  </div>
</div>
</body>
@endsection
