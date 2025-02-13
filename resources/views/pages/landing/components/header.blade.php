<!--header section start-->
<header class="header">
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg fixed-top bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('home/img/logo-white.png') }}" width="160" alt="logo" class="img-fluid"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-menu"></span>
            </button>
            <div class="collapse navbar-collapse h-auto" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto menu">
                   
                    <li><a href="#about" class="page-scroll">About</a></li>

                    <!-- <li><a href="#service" class="page-scroll">Services</a></li>
                    <li><a href="#apis" class="page-scroll">API Docs</a></li>
                    <li><a href="#faq" class="page-scroll">FAQ</a></li>
                    <li><a href="#contact" class="page-scroll">Contact Us</a></li> -->
                    <li><a href="{{ url('blog') }}" class="page-scroll">Blogs</a></li>

                    @auth
                    @if (auth()->user()->user_type == 'admin')
                        <li>
                            <a class="page-scroll"
                                href="/admin/dashboard">Dashboard</a>
                        </li>
                    @else
                        <li>
                            <a class="page-scroll"
                                href="/dashboard">Dashboard</a>
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
<!--header section end-->