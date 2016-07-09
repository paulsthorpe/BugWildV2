<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/app.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montez' rel='stylesheet' type='text/css'>
</head>
<body class="homepage">
<div class="landing">
    <div class="logo">
        <img src="images/design_images/bw.png" alt="LOGO">
    </div>
    <div class="background">
        <img src="images/design_images/river.jpg" alt="">
        <div class="color"></div>
    </div>
    <nav>
        <ul id="home-nav">
            <li><a class="nav-tags" href="/">Home</a></li>
            <li><a class="nav-tags" href="/shop">Shop</a></li>
            <li></li>
            <li></li>
            <li><a class="nav-tags" href="/cart">Cart</a></li>
            <li><a class="nav-tags" href="/blog">Blog</a></li>
        </ul>
    </nav>
    <div class="logo-caption">

        <h1 class="home-header">BugWild Fly Co.</h1>
        <h1 class="home-header">Not Your Grandpa's Wooly Buggers</h1>
        <!-- <a href="#about">
            <button id="learn-more" class="btn-large">
                Learn More...
            </button>
        </a>
        <a href="/shop">
            <button id="shop" class="btn-large">Shop</button>
        </a> -->
    </div>
    <div class="top">
        <button class="nav-button">
            <i class="fa fa-bars"></i>
        </button>
    </div>
</div>
<div class="home-content">
    <div class="new-flies row">
        <h1>Newest Flies</h1>

        @if(!empty($new_products))
            @foreach($new_products as $new)
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <img src="/images/product_images/{{$new->image1}}"/>
                    <a href="/shop/{{$new->slug}}">
                        <button class="btn-small">More Details...</button>
                    </a>

                    <a href="/shop/{{$new->slug}}">
                        <h2>{{$new->title}}</h2>
                    </a>

                </div>
            @endforeach
        @endif

    </div>


    <div class="recent-posts row">
        <h1>Recent Blog Posts</h1>
        @if(!empty($recent_posts))
            <div class="col-lg-2 col-md-2 col-sm-2"></div>
            @foreach($recent_posts as $post)
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 post-thumb">
                    <img src='/images/blog_images/{{$post->image}}'>


                    <a href="/blog/{{$post->slug}}"><h2>{{$post->title}}</h2></a>
                    <h4>Date: {{Carbon\Carbon::parse($post->created_at)->format('M  d, Y')}}</h4>
                    <h4>In: {{$post->category->title}}</h4>
                <!-- <pre class="excerpt">{{substr($post->body, 0, 300)}}... &nbsp<a href="/blog/{{$post->slug}}">More</a></pre> -->

                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 post-thumb">

                    <img src='/images/blog_images/{{$post->image}}'>


                    <a href="/blog/{{$post->slug}}"><h2>{{$post->title}}</h2></a>
                    <h4>Date: {{Carbon\Carbon::parse($post->created_at)->format('M  d, Y')}}</h4>
                    <h4>In: {{$post->category->title}}</h4>
                <!-- <pre class="excerpt">{{substr($post->body, 0, 300)}}... &nbsp<a href="/blog/{{$post->slug}}">More</a></pre> -->

                </div>
            @endforeach
        @endif
    </div>


    <div class="row about" id="about">
        <h1>BugWild, The Fly Tying of Daniel Seaman</h1>
        <img src="/images/design_images/danielbass.jpg" alt="" />
        <div class="row col-lg-8 col-lg-offset-2">

            <p>
                My name is Daniel Seaman and I own and operate Bug Wild out of eastern North Carolina. I have been
                fishing a little here and there my whole life, but really started fishing consistently while in college
                with some friends. After graduation, the job search was a bit slower than expected, mostly due to the
                downturn of the economy (especially with an architectural degree). I needed something to pass the time
                while job searching…so I began fishing more and more, basically every day. Eventually, spin fishing got
                somewhat predictable to me so I decided to pursue fly fishing. I quickly found that fly fishing was
                actually more efficient at catching fish than traditional spin fishing, at least for me (I was never a
                great fisherman).
                <br></br>
                After two years of slinging other people’s files—mostly from online value stores—I decided to give tying
                my own flies a shot. I have always been somewhat “artsy”, so this was a good way to incorporate that
                into a useable application. Living in Rocky Mount, NC a lot of folks around here don’t fly fish at all.
                In fact, the closest fly shop is several hours away. I really have to rely on the internet for advice,
                materials and ideas.
                <br></br>
                I purchased my first vise in June 2014. Needless to say, it has been slowly downhill since then (in a
                good way). I have never been as addicted to anything in my entire life, as I am with tying flies.
                Something about the mindset and process really calms me down. If you know me personally, you understand
                what I mean by this. I have little, to no patience for anything…..except tying flies.
                <br></br>
                When I first started tying, I began researching fly patterns and popular artists and stumbled upon Pat
                Cohen’s work randomly in Google Images. I thought his deer hair work was the coolest thing I’ve ever
                seen and knew I had to try it myself. After several hundred attempts of my own, folks were starting to
                notice my work and wanted to purchase flies from me. I had no intentions on selling flies, and never
                thought I would ever be at this point….it just sort-of happened.
                <br></br>
                I tie mostly warm water flies, specifically for targeting the larger species in my local waters, such as
                bass and carp. I really love when a big bucket mouth inhales a fly. I enjoy tying articulated flies and
                top water bugs. You can easily see who some of my major influences are in my flies (including
                FrankenFly). I would not be where I am today without help, advice, and ideas from the best fly tiers in
                the world.
                <br></br>
                I am not a large commercial fly tier; I really prefer small custom orders. I work a full time “8-5” job
                as an estimator at a metal building company, so this is absolutely not my main source of income. I
                honestly don’t know how folks do this as a full time job. I have tremendous respect for the
                professionals. I always believe in quality over quantity, in everything I do in life. I am probably much
                slower than some folks, but I believe if you take your time, you can accomplish anything. People
                constantly ask me for advice on how to improve their fly tying and I say, “test your flies.” You can tie
                the prettiest flies in the world, but if you don’t test them out in the water, they could look like
                total garbage to a fish and not perform as expected. You don’t need anything fancy to do this, just a
                sink or a bathtub.
                <br></br>
                I am very glad people are enjoying my work; it makes me extremely happy, and motivates me to continue
                doing what I do. I am also very thankful for certain companies for giving me professional opportunities
                along the way. Stay tuned for more to come!
            </p>
        </div>
    </div>
    <div class="row affiliates">
      <h1>Affiliates</h1>
      <div class="affiliate-container">
        <div class="af-link">
            <a href="http://www.flyfishfood.com/">
            <div class="af-image">
              <img src="/images/design_images/fff.png" alt="" />
            </div>
          </a>
        </div>
        <div class="af-link">
          <a href="http://www.castersonlineflyshop.com/">
          <div class="af-image">
            <img src="/images/design_images/casters.png" alt="" />
          </div>

          </a>
        </div>
        <div class="af-link">
          <a href="http://www.deercreek.co.uk/">
          <div class="af-image">
            <img src="/images/design_images/deercreek.png" alt="" />
          </div>
          </a>
        </div>
      </div>
    </div>
</div>

</body>
<footer style="margin-top: 100px;">
    <div class="footer-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3>Find Me On Social Media</h3>
                    <a href='http://www.facebook.com/Bug-Wild-1580034655571591/'><i
                                class="fa fa-facebook-square"></i></a>
                    <a href="http://www.instagram.com/bug.wild/"><i class="fa fa-instagram"></i></a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3>Quick Links</h3>
                    <ul>
                        <a href="/featured">
                            <li>Featured Products</li>
                        </a>
                        <a href="/Shop">
                            <li>Shop</li>
                        </a>
                        <a href="/sale">
                            <li>On Sale</li>
                        </a>
                        <a href="/cart">
                            <li>Cart</li>
                        </a>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3>Recent Post</h3>
                    <ul>
                        @if(!empty($recent_posts))
                            @foreach($recent_posts as $post)
                                <li><a href="/blog/{{$post->slug}}">{{$post->title}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
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
                <div class="col-lg-12 affilate-links">
                    <p>Affilates</p>
                    <ul>
                        <a href="http://www.flyfishfood.com/">
                            <li>Fly Fish Food</li>
                        </a>
                        <a href="http://www.deercreek.co.uk/">
                            <li>Deer Creek</li>
                        </a>
                        <a href="http://www.castersonlineflyshop.com/">
                            <li>Casters Online Fly Shop</li>
                        </a>
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
