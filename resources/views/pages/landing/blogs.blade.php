<!doctype html>
<html lang="en">

   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- SEO Meta description -->
      <meta name="description"
         content="We will help you to monetize your business with PepeLeads.
         PepeLeads  Attract your users to popular businesses. They express their opinions and are compensated in in-app cash.">
      <meta name="author" content="PepeLeads.com">
      <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
      <meta property="og:site_name" content="PepeLeads - Earn Online" />
      <!-- website name -->
      <meta property="og:site" content="https://pepeleads.com" />
      <!-- website link -->
      <meta property="og:title" content="PepeLeads - Blog" />
      <!-- title shown in the actual shared post -->
      <meta property="og:description"
         content="We will help you to monetize your business with PepeLeads.
         PepeLeads  Attract your users to popular businesses. They express their opinions and are compensated in in-app cash." />
      <!-- description shown in the actual shared post -->
      <meta property="og:image" content="" />
      <!-- image link, make sure it's jpg -->
      <meta property="og:url" content="https://pepeleads.com" />
      <!-- where do you want your post to link to -->
      <meta property="og:type" content="article" />
      <!--title-->
      <title>PepeLeads - Blog</title>
      <!-- Hotjar Tracking Code for https://PepeLeads.com -->
      <script>
         (function(h, o, t, j, a, r) {
             h.hj = h.hj || function() {
                 (h.hj.q = h.hj.q || []).push(arguments)
             };
             h._hjSettings = {
                 hjid: 3374235,
                 hjsv: 6
             };
             a = o.getElementsByTagName('head')[0];
             r = o.createElement('script');
             r.async = 1;
             r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
             a.appendChild(r);
         })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
      </script>
      <!--favicon icon-->
      <link rel="icon" href="home/img/favicon.png" type="image/png" sizes="16x16">
      <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/blogstyle.css') }}">
      <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
      <!-- Hotjar Tracking Code for https://pepeleads.com -->
      <script>
         (function(h,o,t,j,a,r){
             h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
             h._hjSettings={hjid:5109305,hjsv:6};
             a=o.getElementsByTagName('head')[0];
             r=o.createElement('script');r.async=1;
             r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
             a.appendChild(r);
         })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
      </script>
      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-6VJR5TPY2C"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         
         gtag('config', 'G-6VJR5TPY2C');
      </script>

      @include('pages.landing.components.styles')
   </head>
   <body>
      @include('pages.landing.components.header')
      <!--body content wrap start-->
<main class="main-content">
      <!-- Hero Section -->
      <section class="hero-section text-center pt-100 pb-100 " style="background: url('home/img/hero-bg-4.jpg') no-repeat center / cover; background-image:linear-gradient(to left, rgb(255 140 0), rgb(253 141 0), rgb(253 141 0), rgb(248 137 0), rgb(255 124 0))!important;">
         <div class="container">
            <h1 class="text-white font-weight-bold">Welcome to PepeLeads Blog</h1>
            <p class="text-white lead">Discover strategies and insights to help you earn online and grow your business.</p>
         </div>
      </section>

      <!-- Featured Post Section -->
      @if(isset($featured))
      <section class="featured-post ptb-100 bg-light">
         <div class="container">
            <h2 class="section-title">Featured Post</h2>
            <div class="row align-items-center">
               <div class="col-md-6">
                  <img src="{{$featured->image}}" alt="{{$featured->name}}" class="img-fluid rounded">
               </div>
               <div class="col-md-6">
                  <h3 class="post-title">{{$featured->name}}</h3>
                  <p class="post-excerpt">{{$featured->meta_description}}</p>
                  <a href="{{ url('blog/'.$featured->slug) }}" class="btn btn-primary mt-3"  style="background-image:linear-gradient(to left, rgb(255 140 0), rgb(253 141 0), rgb(253 141 0), rgb(248 137 0), rgb(255 124 0))!important;">Read More</a>
               </div>
            </div>
         </div>
      </section>
      @endif

      <!-- Recent Posts Section -->
      <section class="recent-posts ptb-100">
         <div class="container">
            <h2 class="section-title text-center mb-5">All Posts</h2>
            <div class="row">
               @foreach($data as $post)
               <div class="col-md-3 mb-2">
                  <div class="post-card">
                     <a href="{{ url('blog/' . $post->slug) }}" class="post-thumbnail" ></a>
                     <div class="post-content p-3">
                        <img src="{{ $post->image }}" alt="{{ $post->name }}" style="height:auto; width:100%;"/>
                        <h4 class="post-title"><a href="{{ url('blog/' . $post->slug) }}">{{ $post->name }}</a></h4>
                        <p class="post-date">{{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }} | By <span class="author">{{$post->meta_author}}</span></p>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </section>

      <!-- Categories Section -->
      {{-- <section class="categories-section bg-light ptb-100">
         <div class="container">
            <h2 class="section-title text-center">Categories</h2>
            <div class="row justify-content-center">
               <div class="col-md-3 text-center">
                  <a href="#" class="category-link">Affiliate Marketing</a>
               </div>
               <div class="col-md-3 text-center">
                  <a href="#" class="category-link">Business Growth</a>
               </div>
               <div class="col-md-3 text-center">
                  <a href="#" class="category-link">Online Earnings</a>
               </div>
               <div class="col-md-3 text-center">
                  <a href="#" class="category-link">Product Reviews</a>
               </div>
            </div>
         </div>
      </section> --}}
   </main>
      <!--body content wrap end-->
      @include('pages.landing.components.footer')
   </body>
</html>