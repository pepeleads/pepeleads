
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Offer Wall - PepeLeads</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <style>
        .offerwall-background {
            background: #ff8b00;
            min-height: 260px;
        }

        .offerwall-tabs .card {
            box-shadow: 0px 5px 4px 0px #0000000d;
        }

        .offerwall-tabs ul li .active {
            box-shadow: 0px 0px 10px 0px #ff8b0054;
            border-radius: 4px;
        }

        .PepeLeads-logo {
            max-width: 500px;
        }

        .offerwall-tabs {
            margin-top: -65px;
            /* background: #f4f4f4; */
        }

        .offerwall-tabs-options {
            background: #f4f4f4;
            padding-top: 140px;
            margin-top: -96px;
            min-height: 470px;
        }

        .offerwall-tabs-options .card {
            background-color: transparent;
        }

        .survey-img {
            max-width: 76px;
        }

        .survey-btn button {
            background: #ff8b00;
            min-width: 70px;
            padding: 6px;
            font-size: 13px;
        }

        .survey-content p {
            font-size: 12px;
        }

        .survey-item {
            box-shadow: 2px 2px 8px 0px #00000021;
            border-radius: 8px;
        }

        .offerwall .card {
            background-color: transparent;
        }

        .survey-second-layout .survey-img {
            max-width: 100%;
        }

        .survey-second-layout .survey-content p {
            font-size: 16px;
        }

        .survey-second-layout .survey-btn button {
            padding: 6px 24px;
            font-size: 16px;
        }

        .tab-img {
            max-width: 48px;
        }

        .offerwall-tabs .nav-pills .nav-link.active img,
        .offerwall-tabs .nav-pills .show>.nav-link img {
            filter: invert(1);
        }

        footer {
            left: 0px !important;
        }

        @media screen and (max-width:992px) {
            .survey-img {
                max-width: 124px;
            }

            .survey-content h6 {
                font-size: 18px !important;
            }

            .survey-content p {
                font-size: 16px;
            }

            .survey-btn button {
                padding: 6px 12px;
                font-size: 16px;
            }
        }

        @media screen and (max-width:576px) {
            .survey-img {
                max-width: 76px;
            }

            .survey-content h6 {
                font-size: 14px !important;
            }

            .survey-content p {
                font-size: 12px;
            }

            .survey-btn button {
                padding: 6px;
                font-size: 12px;
                min-width: 60px;
            }

            .tab-img {
                max-width: 36px;
            }

            .nav-link {
                font-size: 12px;
            }

            .offerwall-background {
                min-height: 240px;
            }

            .offerwall-tabs {
                margin-top: -88px;
            }

            .offerwall-tabs-options {
                padding-top: 90px;
                margin-top: -76px;
            }

            .PepeLeads-logo {
                max-width: 220px;
            }
        }
    </style>

</head>

<body>
    <div class="my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h1 class="display-1 fw-semibold">4<span class="text-primary mx-2">0</span>4</h1>
                        <h4 class="text-uppercase">Sorry, page not found</h4>
                        <div class="mt-5 text-center">
                            <a class="btn btn-primary waves-effect waves-light" href="/">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-8">
                    <div>
                        <img src="assets/images/error-img.png" alt="" class="img-fluid">
                    </div>
                </div>
                
            </div>
            
        </div>
        <!-- end container -->
    </div>
  
    

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-center">
                        <script>document.write(new Date().getFullYear())</script> © PepeLeads.com
                    </p>
                </div>
            </div>
        </div>
    </footer>

    
    <!-- END layout-wrapper -->


    <!-- Right Sidebar -->
    {{-- <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center bg-dark p-3">

                <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="m-0" />

            <div class="p-4">
                <h6 class="mb-3">Layout</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout" id="layout-vertical" value="vertical">
                    <label class="form-check-label" for="layout-vertical">Vertical</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout" id="layout-horizontal"
                        value="horizontal">
                    <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-light"
                        value="light">
                    <label class="form-check-label" for="layout-mode-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-dark" value="dark">
                    <label class="form-check-label" for="layout-mode-dark">Dark</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-width" id="layout-width-fuild"
                        value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                    <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-width" id="layout-width-boxed"
                        value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                    <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-position" id="layout-position-fixed"
                        value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                    <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-position" id="layout-position-scrollable"
                        value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                    <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-light"
                        value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                    <label class="form-check-label" for="topbar-color-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-dark" value="dark"
                        onchange="document.body.setAttribute('data-topbar', 'dark')">
                    <label class="form-check-label" for="topbar-color-dark">Dark</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-default"
                        value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                    <label class="form-check-label" for="sidebar-size-default">Default</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-compact"
                        value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                    <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-small"
                        value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                    <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-light"
                        value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                    <label class="form-check-label" for="sidebar-color-light">Light</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-dark"
                        value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                    <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                </div>
                <div class="form-check sidebar-setting">
                    <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-brand"
                        value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                    <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                </div>

                <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-ltr"
                        value="ltr">
                    <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-rtl"
                        value="rtl">
                    <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>