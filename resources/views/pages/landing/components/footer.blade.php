<!--footer section start-->
<footer class="footer-section">
    <!--footer top start-->
    <div class="footer-top gradient-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="footer-nav-wrap text-white mb-0 mb-md-4 mb-lg-0">
                        <a class="d-block" href="#"><img src="{{ asset('home/img/logo-white.png') }}" alt="footer logo" width="150" class="img-fluid mb-1"></a>
                        <p> Attract your users to popular businesses. They express their opinions and are compensated in in-app cash.</p>
                        <ul class="list-unstyled social-list mb-0">
                            <li class="list-inline-item"><a href="https://www.facebook.com/PepeLeads" class="rounded"><span class="ti-facebook white-bg color-2 shadow rounded-circle"></span></a></li>
                            {{-- <li class="list-inline-item"><a href="#" class="rounded"><span class="ti-twitter white-bg color-2 shadow rounded-circle"></span></a></li> --}}
                            <li class="list-inline-item"><a href="https://www.linkedin.com/company/PepeLeads/" class="rounded"><span class="ti-linkedin white-bg color-2 shadow rounded-circle"></span></a></li>
                            {{-- <li class="list-inline-item"><a href="#" class="rounded"><span class="ti-instagram white-bg color-2 shadow rounded-circle"></span></a></li> --}}
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-12">
                    <div class="footer-nav-wrap text-white">
                        <h5 class="text-white">Usefull Links</h5>
                        <ul class="list-unstyled footer-nav-list mt-3">
                            <li><a href="/privacy-policies" class="text-foot"><span class="ti-angle-double-right"></span> Privacy Policy</a></li>
                            <li><a href="/payment-policies" class="text-foot"><span class="ti-angle-double-right"></span> Payment Policy</a></li>
                            <li><a href="/terms-and-conditions" class="text-foot"><span class="ti-angle-double-right"></span> Terms of Services</a></li>
                            <li><a href="#apis" class="text-foot"><span class="ti-angle-double-right"></span> API Documentation</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-12">
                    <div class="footer-nav-wrap text-white">
                        <h5 class="text-white">Company</h5>
                        <ul class="list-unstyled footer-nav-list mt-3">
                            <li><a href="#about" class="page-scroll text-foot"><span class="ti-angle-double-right"></span> About us</a></li>
                            <li><a href="#service" class="page-scroll text-foot"><span class="ti-angle-double-right"></span> Services</a></li>
                            <li><a href="#faq" class="page-scroll text-foot"><span class="ti-angle-double-right"></span> FAQ</a></li>
                            
                            <li><a href="#contact" class="page-scroll text-foot"><span class="ti-angle-double-right"></span> Contact Us</a></li>
                            <li><a href="/blog" class="page-scroll text-foot"><span class="ti-angle-double-right"></span> Blog</a></li>
                        </ul>
                    </div>
                </div>



                <div class="col-lg-4 col-md-4 col-12">
                    <div class="footer-nav-wrap text-white">
                        <h5 class="text-light footer-head">Newsletter</h5>
                        <p>Subscribe our newsletter to get our update. We don't send span email to you.</p>
                        <form action="#" class="newsletter-form mt-3">
                            <div class="input-group">
                                <input type="email" class="form-control" id="subscribe-email" placeholder="Enter your email" required="">
                                <div class="input-group-append">
                                    <button class="btn solid-btn subscribe-btn btn-hover" type="submit">
                                        Subscribe
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--footer top end-->

    <!--footer copyright start-->
    <div class="footer-bottom gray-light-bg py-3">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-md-6 col-lg-5"><p class="copyright-text pb-0 mb-0">Copyrights © {{ date('Y')}}. All
                    rights reserved by
                    <a href="https://PepeLeads.com" target="_blank">PepeLeads</a></p>
                </div>
            </div>
        </div>
    </div>
    <!--footer copyright end-->
</footer>
<!--footer section end-->

<!--bottom to top button start-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="ti-angle-up"></span>
</button>
<!--bottom to top button end-->


<!--jQuery-->
<script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
<!--Popper js-->
<script src="{{ asset('home/js/popper.min.js') }}"></script>
<!--Bootstrap js-->
<script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
<!--Magnific popup js-->
<script src="{{ asset('home/js/jquery.magnific-popup.min.js') }}"></script>
<!--jquery easing js-->
<script src="{{ asset('home/js/jquery.easing.min.js') }}"></script>
<!--wow js-->
<script src="{{ asset('home/js/wow.min.js') }}"></script>
<!--owl carousel js-->
<script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
<!--countdown js-->
<script src="{{ asset('home/js/jquery.countdown.min.js') }}"></script>
<!--validator js-->
<script src="{{ asset('home/js/validator.min.js') }}"></script>
<!--custom js-->
<script src="{{ asset('home/js/scripts.js') }}"></script>