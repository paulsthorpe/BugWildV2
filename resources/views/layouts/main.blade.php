<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/app.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="/js/scripts.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
    <title>@yield('title')</title>
</head>
<header class="main-nav">
    <div class="logo">
        <img src="/images/design_images/bw.png" alt="bugwild logo , bugwildflyco , custom flies , fly tying">
    </div>
    <button class="drop-button">
        <i class="fa fa-bars"></i>
    </button>
    <nav>
        <ul id="menu" class="">
            <li class="menu-items"><a href="/">Home</a></li>
            <li class="menu-items"><a href="/shop">Shop</a></li>
            <li></li>
            <li class="menu-items"><a href="/cart">Cart</a></li>
            <li class="menu-items"><a href="/blog">Blog</a></li>
        </ul>
    </nav>
</header>


@yield('content')


<footer>
    <div class="footer-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <h3>Find Me On Social Media</h3>
                    <a href='http://www.facebook.com/Bug-Wild-1580034655571591/'><i
                                class="fa fa-facebook-square"></i></a>
                    <a href="http://www.instagram.com/bug.wild/"><i class="fa fa-instagram"></i></a>
                </div>
                <div class="col-lg-4">
                    <h3>Quick Links</h3>
                    <ul>
                        <a href="/Shop">
                            <li>Shop</li>
                        </a>
                        <a href="/sale">
                            <li>On Sale</li>
                        </a>
                        <a href="/featured">
                            <li>Featured Products</li>
                        </a>
                        <a href="/cart">
                            <li>Cart</li>
                        </a>
                    </ul>
                </div>
                <!-- <div class="col-lg-4">
                    <h3>Recent Post</h3>
                    <ul>
                        @if(!empty($recent_posts))
                            @foreach($recent_posts as $recent_post)
                                <li><a href="/blog/{{$recent_post->slug}}">{{$recent_post->title}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div> -->
                <div class="col-lg-4">
                    <h3>New Flies</h3>
                    <ul>
                        @if(!empty($new_products))
                            @foreach($new_products as $featured)
                                <li><a href="/shop/{{$featured->slug}}">{{$featured->title}}</a></li>
                            @endforeach
                        @else
                            <li>There are no currently featured products</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; <?php echo date("Y"); ?> Bugwild</p>
                    <p>Website Designed and Developed by <a href="http://www.paulthorpe.co">Paul Thorpe</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
  $('.menu-items:nth-child(5)').hover(function(){
    var prev = $(this).text;
    $(this).text('Coming Soon!').css('color','darkorange');
  }, function(){
    $(this).text('Blog').css('color','darkorange');
  });
</script>
