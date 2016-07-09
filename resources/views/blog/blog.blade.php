@extends('layouts.main')

@section('title')
        BugWildFlyCo. Blog
@endsection

@section('content')
<body>
   <div class="content-container" style="min-height:100vh;">
   <h1 style="font-size: 4em;">
     @if(!empty($page_title))
         {{$page_title}}
     @else
         From The Blog
     @endif
   </h1>
       <aside class="col-lg-3" id="sidenav">
           <h3>RECENT POST</h3>
           <ul>
             @if(!empty($recent_posts))
             @foreach($recent_posts as $post)
                 <li><a href="/blog/{{$post->slug}}">{{$post->title}}</a></li>
             @endforeach
             @else
                 <li>There are no post...</li>
             @endif
           </ul>
           <h3>CATEGORIES</h3>
           <ul>
             @if(!empty($categories))
             @foreach($categories as $category)
               <li><a href="/blog/category/{{$category->slug}}">{{$category->title}}</a></li>
             @endforeach
             @else
              <li>There are no blog categories...</li>
             @endif
           </ul>
       </aside>
       <div class="col-lg-9" id="content">
         @foreach($posts as $post)
            <div class="post-container">
                <img src='/images/blog_images/{{$post->image}}'>
                <a href="/blog/{{$post->slug}}"><h2>{{$post->title}}</h2></a>
                <h4>Date: {{Carbon\Carbon::parse($post->created_at)->format('M  d, Y')}}</h4>
                <h4>In: {{$post->category->title}}</h4>
                <pre class="excerpt">{{substr($post->body, 0, 300)}}<a href="/blog/{{$post->slug}}">More</a></pre>
            </div>
          @endforeach
          {{ $posts->links() }}
       </div>

   </div>
</body>

@endsection
