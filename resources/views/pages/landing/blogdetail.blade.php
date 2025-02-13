<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta description -->
    <meta name="description"
        content="{{ $data?->meta_description ?? 'Discover strategies and insights to help you earn online and grow your business.' }}">

    <meta name="author" content="pepeleads.com">

    <!-- website name -->
    <meta property="og:site" content="https://pepeleads.com" />
    <meta property="og:site_name" content="PepeLeads - Blog" />

    <!-- Open Graph Tags -->
    <meta property="og:title" content="{{ $data?->og_title ?? 'PepeLeads - Earn Online with Insights' }}" />
    <meta property="og:description"
        content="{{ $data?->og_description ?? 'Discover strategies and insights to help you earn online and grow your business.' }}" />
    <meta property="og:image" content="{{ $data?->og_image ?? asset('images/default-og-image.jpg') }}" />
    <meta property="og:url" content="https://pepeLeads.com/blog/{{ $data?->slug ?? '' }}" />
    <meta property="og:type" content="article" />
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=672d04181aada400124e96bb&product=sticky-share-buttons&source=platform" async="async"></script>

    <!-- Page Title -->
    <title>{{ $data?->meta_title ?? 'PepeLeads Blog - Your Source for Online Earning Insights' }}</title>

    <!-- Canonical Tag -->
    <link rel="canonical" href="https://pepeLeads.com/blog/{{ $data?->slug ?? '' }}">

    <!-- Meta Keywords -->
    <meta name="keywords" content="{{ $data?->meta_keywords ?? 'PepeLeads, online earning, blog, insights' }}">

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@PepeLeads">
    <meta name="twitter:title" content="{{ $data?->twitter_title ?? 'PepeLeads - Earn Online with Insights' }}">
    <meta name="twitter:description"
        content="{{ $data?->twitter_description ?? 'Discover strategies and insights to help you earn online and grow your business.' }}">
    <meta name="twitter:image" content="{{ $data?->twitter_image ?? $data->image }}">
    <meta name="twitter:image:alt" content="{{ $data?->twitter_title ?? 'PepeLeads - Earn Online' }}">


    @if (isset($data?->meta_schema))
        <!-- Schema Markup for Blog Page -->
        <script type="application/ld+json">
         {{$data?->meta_schema}}
        </script>
    @endif

    @if (isset($data?->custom_css))
        <!-- Custom CSS-->
        {{ $data?->custom_css }}
    @endif

    @if (isset($data?->custom_js))
        <!-- Custom CSS-->
        {{ $data?->custom_js }}
    @endif


    <!--favicon icon-->
    <link rel="icon" href="/home/img/favicon.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/blogstyle.css') }}">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <!-- Hotjar Tracking Code for https://pepeleads.com -->
    <script>
        (function(h, o, t, j, a, r) {
            h.hj = h.hj || function() {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {
                hjid: 5109305,
                hjsv: 6
            };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6VJR5TPY2C"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-6VJR5TPY2C');
    </script>

    @include('pages.landing.components.styles')
</head>

<body>
    <header class="header">
        <!--start navbar-->
        <nav class="navbar navbar-expand-lg fixed-top " style="background-image:linear-gradient(to left, rgba(255, 139, 0, 0.90), rgba(255, 139, 0, 0.88), rgba(255, 139, 0, 0.85), rgba(255, 139, 0, 0.88), rgba(255, 139, 0, 0.90));">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('home/img/logo-white.png') }}" width="160" alt="logo"
                        class="img-fluid" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="ti-menu"></span>
                </button>
                <div class="collapse navbar-collapse h-auto" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto menu">

                        <li><a href="#about" class="page-scroll">About</a></li>
                        <li><a href="{{ url('blog') }}" class="page-scroll">Blogs</a></li>
                        @auth
                            @if (auth()->user()->user_type == 'admin')
                                <li>
                                    <a class="page-scroll" href="/admin/dashboard">Dashboard</a>
                                </li>
                            @else
                                <li>
                                    <a class="page-scroll" href="/dashboard">Dashboard</a>
                                </li>
                            @endif
                        @endauth
                        @guest
                            <li><a href="/login" class="page-scroll">Login</a></li>
                            <li><a href="/register" class="page-scroll">Register</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="main">
        <div id="content" class="site-content" style="margin-top: 100px;">
            <div class="container">
                <div class="row justify-content-center site-content-row">
                    <div id="primary" class="col-lg-8 content-area">
                        <main id="main" class="site-main">
                            <div
                                class="post-3025 post type-post status-publish format-standard has-post-thumbnail hentry category-news">
                                <header class="entry-header">
                                    <h1 class="entry-title">{{ $data->name }}</h1>
                                    <div class="entry-meta d-flex">
                                        <div class="date"><span>{{ \Carbon\Carbon::parse($data->created_at)->format('F d, Y') }}</span>
                                        </div>
                                        <div class="by-author vcard author"><span> | {{ $data->meta_author }}</span>
                                        </div>
                                    </div>
                                    <nav aria-label="breadcrumb">
                                        <ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">
                                            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                                                itemtype="https://schema.org/ListItem">
                                                <a href="/" itemprop="item">
                                                    <span itemprop="name">Home</span>
                                                </a>
                                                <meta itemprop="position" content="1" />
                                            </li>
                                            <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                                                itemtype="https://schema.org/ListItem">
                                                <a href="/blog" itemprop="item">
                                                    <span itemprop="name">Blog</span>
                                                </a>
                                                <meta itemprop="position" content="2" />
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page"
                                                itemprop="itemListElement" itemscope
                                                itemtype="https://schema.org/ListItem">
                                                <span itemprop="name">{{ $data->breadcrumb_title }}</span>
                                                <meta itemprop="position" content="3" />
                                            </li>
                                        </ol>
                                    </nav>

                                </header>
                                <div class="entry-content">
                                    {!! $data->description !!}
                                    <p></p>
                                </div>
                                <!-- .entry-content -->
                            </div>
                            <!-- .post-3025 -->
                        </main>

                        <!-- #main -->
                    </div>
                    <!-- #primary -->
                    <aside id="secondary" class="col-lg-4 widget-area" role="complementary">
                        <div id="sticky-wrapper" class="sticky-wrapper is-sticky" style="height: 122px;">
                            <div class="sticky-sidebar" style="width: 381.104px;  top: 46.6733px; z-index: inherit;">
                                {{-- <section id="categories-4" class="widget widget_categories">
                                    <h3 class="widget-title">Categories</h3>
                                    <ul>
                                        <li class="cat-item cat-item-4"><a href="javascript:void(0)">News</a> (30)</li>
                                    </ul>
                                </section> --}}
                            </div>
                        </div>

                        <!-- .sticky-sidebar -->
                    </aside>
                    <!-- #secondary -->
                </div>
                <!-- row -->
            </div>
            <!-- .container -->
        </div>
    </div>
    <!--body content wrap end-->
    @include('pages.landing.components.footer')
</body>

</html>
