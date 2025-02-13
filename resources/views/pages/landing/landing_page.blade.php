<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
    <title>PepeLeads</title>
    <!-- Hotjar Tracking Code for https://PepeLeads.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:3374235,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top mt-3 py-0">
        <div class="container bg-white p-2">
            <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/logo2.png') }}"
                    height="44" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth
                        @if (auth()->user()->user_type == 'admin')
                            <li class="nav-item me-3">
                                <a class="nav-link purple-btn text-white border-0 btn px-5 fw-medium"
                                    href="/admin/dashboard">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item me-3">
                                <a class="nav-link purple-btn text-white border-0 btn px-5 fw-medium"
                                    href="/dashboard">Dashboard</a>
                            </li>
                        @endif
                    @endauth
                    @guest
                        <li class="nav-item me-3">
                            <a class="nav-link purple-btn text-white border-0 btn px-5 fw-medium" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link purple-btn text-white border-0 btn px-5 fw-medium"
                                href="/register">Signup</a>
                        </li>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="hero-section pt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 my-5 ">
                    <div class="hero-container py-5">
                        <h1 class="fw-bold mb-4">A variety of options <br>
                            to meet your <br>Digitalization Goals !!!!!
                        </h1>
                        <p class="fs-18 mb-5">The whole bunch of downloads, and in-store traffic, we always look for the
                            forefront of innovations and have an advanced level of integrations. </p>
                        <button class="gradient-btn text-white border-0 btn fw-medium get-started">Get Started For Free
                            <i class="fas fa-long-arrow-alt-right ms-2"></i></button>
                    </div>
                </div>
                <div class="col-lg-6 my-4">
                    <div class="hero-img position-relative mx-auto" style="max-width: 100% !important;">
                        <img src="{{ asset('assets/images/banner.png') }}" alt=""
                            style="border-radius: 20px; width:100% !important; height:328px !important;"
                            class="img-fluid">
                    </div>
                    <div class="background-img position-absolute top-0 end-0">
                        <img src="{{ asset('assets/images//landing-page/hero-design.png') }}" alt=""
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="better-alternative py-5 my-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="better-alternative-img text-center">
                        <img src="{{ asset('assets/images/business.png') }}" style="width:50%;" alt=""
                            class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="better-alternative-content ms-lg-5 ps-lg-4">
                        <div class="heading">
                            <h2>Self-serve Destination</h2>
                        </div>
                        <p class="mb-0">The Lifeline of online advertising is always on the move. With our Self Serve
                            space, you can create new campaigns, manage your traffic, optimize your budget, and target
                            your audience. With a push of a button, Show your product to our in-house direct traffic
                            with PepeLeads</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="what-do-we-do py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="heading text-center">
                        <h2>What do we do?</h2>
                        <p>Know more about our buiness</p>
                    </div>
                </div>
                <div class="col-md-4 my-4">
                    <div class="what-do-we-do-item d-flex flex-column justify-content-center align-items-center">
                        <div class="what-do-we-do-img mb-4">
                            <img src="{{ asset('assets/images/landing-page/monetize.svg') }}" alt=""
                                class="img-fluid">
                        </div>
                        <div class="what-do-we-do-content text-center">
                            <h4 class="mb-3">Who We Are?</h4>
                            <p>PepeLeads is an Advertising and Monetization platform for Advertisers and Affiliates.
                                We tie up Advertisers and Market Researchers with users worldwide working on reward
                                platforms.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-4">
                    <div class="what-do-we-do-item d-flex flex-column justify-content-center align-items-center">
                        <div class="what-do-we-do-img mb-4">
                            <img src="{{ asset('assets/images/landing-page/user-acquisition.svg') }}" alt=""
                                class="img-fluid">
                        </div>
                        <div class="what-do-we-do-content text-center">
                            <h4 class="mb-3">What We Do?</h4>
                            <p>We have created a platform for Advertisers and Market Researchers to Engage with new
                                users and generate leads. We help Publishers to generate revenue and reward their users
                                through our platform.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-4">
                    <div class="what-do-we-do-item d-flex flex-column justify-content-center align-items-center">
                        <div class="what-do-we-do-img mb-4">
                            <img src="{{ asset('assets/images/landing-page/market-research.svg') }}" alt=""
                                class="img-fluid">
                        </div>
                        <div class="what-do-we-do-content text-center">
                            <h4 class="mb-3">Why We Do It?</h4>
                            <p>Most Advertisers and Market Researchers are not well connected with the right audience,
                                PepeLeads platform helps publishers to do so. We started it for Publishers to work
                                decently.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="world-wide my-5">
        <div class="container px-0">
            <div class="row">
                <div class="col-12">
                    <div class="world-wide-container py-5">
                        <div class="heading text-center mb-5 pb-4 mt-3">
                            <h2 class="text-white">Trusted by users worldwide</h2>
                            <p class="text-white">Place where you can promote your business</p>
                        </div>
                        <div class="d-flex justify-content-around">
                            <div class="world-wide-item text-center my-3">
                                <h3 class="text-white">200+</h3>
                                <p class="text-white">Publishers</p>
                            </div>
                            <div class="world-wide-item text-center my-3">
                                <h3 class="text-white">500K+</h3>
                                <p class="text-white">Completed Offers</p>
                            </div>
                            <div class="world-wide-item text-center my-3">
                                <h3 class="text-white">1M+</h3>
                                <p class="text-white">Clicks Made</p>
                            </div>
                            <div class="world-wide-item text-center my-3">
                                <h3 class="text-white">$500K+</h3>
                                <p class="text-white">Revenue Generated</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
    <section class="contact-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="contact-img">
                        <img src="{{ asset('assets/images/landing-page/contact-us.svg') }}" alt=""
                            class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="heading">
                        <h2 class="mb-2">Get In Touch</h2>
                        <p class="mb-4">Feel free to contact us. </p>
                    </div>
                    <div class="contact-form">
                        <form>
                            <div class="mb-4">
                                <input type="text" class="form-control rounded-pill" id="name"
                                    placeholder="Full Name">
                            </div>
                            <div class="mb-4">
                                <input type="email" class="form-control rounded-pill" id="email"
                                    placeholder="Email">
                            </div>
                            <div class="mb-4">
                                <input type="number" class="form-control rounded-pill" id="phone"
                                    placeholder="Phone">
                            </div>
                            <div class="mb-4">
                                <input type="text" class="form-control rounded-pill" id="subject"
                                    placeholder="Subject">
                            </div>
                            <div class="mb-4">
                                <textarea name="message" id="message" class="form-control rounded-3" rows="4" placeholder="Message"></textarea>
                            </div>

                            <button type="submit"
                                class="purple-btn text-white rounded-pill border-0 btn px-5 fw-medium">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

   @include('pages.landing.components.new_footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
