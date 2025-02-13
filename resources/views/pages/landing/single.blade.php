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
  
   

    <footer class="pt-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="about-company pe-5">
                        <div class="logo text-white mb-4">
                            <h2 class="text-white">PepeLeads</h2>
                        </div>
                        <div class="about-company-content">
                            <p class="text-white">Follow us on social media <br>Contact Us at info@PepeLeads.com </p>
                        </div>
                        <div class="social-icons">
                            <ul class="mb-0 ps-0 d-flex">
                                <li
                                    class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <a href="#" class="d-flex justify-content-center align-items-center"><i
                                            class="fab fa-facebook-f"></i></a>
                                </li>
                                <li
                                    class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <a href="#" class="d-flex justify-content-center align-items-center"><i
                                            class="fab fa-twitter"></i></a>
                                </li>
                                <li
                                    class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <a href="#" class="d-flex justify-content-center align-items-center"><i
                                            class="fab fa-instagram"></i></a>
                                </li>
                                <li
                                    class="bg-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <a href="#" class="d-flex justify-content-center align-items-center"><i
                                            class="fab fa-linkedin-in"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-column">
                        <h4 class="text-white mb-2">Our Services</h4>
                        <div class="footer-border mb-4"></div>
                        <ul class="mb-0 ps-0">
                            <li class="mb-2"><a href="#" class="text-white">Offer Wall</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Monetization</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Promote</a></li>
                            <li class="mb-2"><a href="#" class="text-white">API Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-column">
                        <h4 class="text-white mb-2">Resources</h4>
                        <div class="footer-border mb-4"></div>
                        <ul class="mb-0 ps-0">
                            <li class="mb-2"><a href="#" class="text-white">Basic Integration</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Docs</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Login</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Register</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-column">
                        <h4 class="text-white mb-2">Legal</h4>
                        <div class="footer-border mb-4"></div>
                        <ul class="mb-0 ps-0">
                            <li class="mb-2"><a href="#" class="text-white">Terms and Conditions</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Privacy and Policies</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Payment Policies</a></li>
                            <li class="mb-2"><a href="#" class="text-white">Data Security</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="mt-5 mb-4 text-white">
                <div class="col-12">
                    <div class="copyright">
                        <p class="mb-4 text-white text-center">Copyright © 2022. All rights reserved to PepeLeads.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
