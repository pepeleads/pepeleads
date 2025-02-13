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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"
        type="text/css" />

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


    {{-- User Profile Modal Style  --}}
    <style>

.my-lable{
    display: flex;
    align-items: center;
    justify-content: space-between;
}

        #regForm {
            background-color: #ffffff;
            margin: 0px auto;
            /* font-family: Raleway; */
            /* padding: 40px; */
            border-radius: 10px
        }

        h1 {
            text-align: center
        }

        input {
            padding: 10px;
            width: 100%;
            font-size: 17px;
            font-family: Raleway;
            border: 1px solid #aaaaaa
        }

        input.invalid {
            background-color: #ffdddd
        }

        .tab {
            display: none
        }

        button {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer
        }

        button:hover {
            opacity: 0.8
        }

        #prevBtn {
            background-color: #bbbbbb
        }

        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5
        }

        .step.active {
            opacity: 1
        }

        .step.finish {
            background-color: #4CAF50
        }

        .all-steps {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px
        }

        .thanks-message {
            display: none
        }

        .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }


        /* Hide the browser's default radio button */

        .container input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }


        /* Create a custom radio button */

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 50%;
        }


        /* On mouse-over, add a grey background color */

        .container:hover input~.checkmark {
            background-color: #ccc;
        }


        /* When the radio button is checked, add a blue background */

        .container input:checked~.checkmark {
            background-color: #2196F3;
        }


        /* Create the indicator (the dot/circle - hidden when not checked) */

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }


        /* Show the indicator (dot/circle) when checked */

        .container input:checked~.checkmark:after {
            display: block;
        }


        /* Style the indicator (dot/circle) */

        .container .checkmark:after {
            top: 9px;
            left: 9px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }
    </style>

</head>

<body>
    <div class="offerwall-background">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="customize-menu">
                    </div>
                    <div class="PepeLeads-logo d-flex justify-content-center mx-auto">
                        <img src="{{ asset('assets/images/logo-white.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="offerwall-tabs">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card border-0">

                        <div class="card-body p-3">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active p-sm-3 p-2" data-bs-toggle="tab" href="#home-1"
                                        role="tab">
                                        <span>
                                            <div class="tab-img mb-2 mx-auto"><img
                                                    src="{{ asset('assets/images/survey.svg') }}" alt=""
                                                    class="img-fluid"></div> All Surveys
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link p-sm-3 p-2" data-bs-toggle="tab" href="#profile-1"
                                        role="tab">
                                        <span>
                                            <div class="tab-img mb-2 mx-auto"><img
                                                    src="{{ asset('assets/images/offers.svg') }}" alt=""
                                                    class="img-fluid"></div> Offers
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link p-sm-3 p-2" data-bs-toggle="tab" href="#messages-1"
                                        role="tab">
                                        <span>
                                            <div class="tab-img mb-2 mx-auto"><img
                                                    src="{{ asset('assets/images/mobile.svg') }}" alt=""
                                                    class="img-fluid"></div> App
                                        </span>
                                    </a>
                                </li>
                                {{-- <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link p-sm-3 p-2" data-bs-toggle="tab" href="#settings-1"
                                        role="tab">

                                        <span>
                                            <div class="tab-img mb-2 mx-auto"><img
                                                    src="{{ asset('assets/images/web.svg') }}" alt=""
                                                    class="img-fluid"></div> Web
                                        </span>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="offerwall-tabs-options pb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card border-0">

                        <div class="card-body p-0">
                            <!-- Tab panes -->
                            <div class="tab-content text-muted">
                                <div class="tab-pane active" id="home-1" role="tabpanel">
                                    <div class="survey-container">
                                        <div class="row">
                                            @if (count($data) > 0)
                                                @foreach ($data as $d)
                                                    <div class="col-lg-4 mb-3">
                                                        <div class="survey-item d-flex bg-white p-2">
                                                            <div class="survey-img me-2">
                                                                <img src="{{ $d['image_url'] }}" alt=""
                                                                    class="img-fluid">
                                                            </div>
                                                            <div
                                                                class="survey-content d-flex justify-content-between align-items-center w-100">
                                                                <div class="me-2">
                                                                    <h6 class="mb-1">{{ $d['name'] }}</h6>
                                                                    <p class="mb-0">{{ $d['description'] }}</p>
                                                                </div>
                                                                <div class="survey-btn">
                                                                    <a href="{{ $d['click_path'] }}" target="_blank">
                                                                        <button
                                                                            class="btn text-white">
                                                                            @if(is_numeric($d['credit']))
                                                                            {{ roundoff((($details->currency_value??0) * ((($d['rate']['rate']['network_rate'] ??0)* ($d['credit'])??0) / 100)) / 100) }}
                                                                            @else
                                                                            Variable

                                                                          @endif
                                                                            <br class="d-block d-md-none d-lg-block">
                                                                            @if (isset($details->virtual_currency))
                                                                                {{ $details->virtual_currency }}
                                                                            @else
                                                                                USD
                                                                            @endif
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-lg-12 mb-3">
                                                    <div class="survey-item survey-second-layout bg-white p-3">

                                                        <div class="survey-content">
                                                            <h5 class="mb-1 mt-2">No Offer Available</h5>
                                                            <p class="mb-2">Sorry No survey available at the moment!
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- <div class="col-lg-4 mb-3">
                                                <div class="survey-item d-flex bg-white p-2">
                                                    <div class="survey-img me-2">
                                                        <img src="{{ asset('assets/images/small/img-1.jpg') }}" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                    <div
                                                        class="survey-content d-flex justify-content-between align-items-center w-100">
                                                        <div class="me-2">
                                                            <h6 class="mb-1">Client Survey Premium</h6>
                                                            <p class="mb-0">New Surveys get offered every day !</p>
                                                        </div>
                                                        <div class="survey-btn">
                                                            <button class="btn text-white">0.9 <br
                                                                    class="d-block d-md-none d-lg-block"> USD</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="survey-item d-flex bg-white p-2">
                                                    <div class="survey-img me-2">
                                                        <img src="{{ asset('assets/images/small/img-1.jpg') }}" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                    <div
                                                        class="survey-content d-flex justify-content-between align-items-center w-100">
                                                        <div class="me-2">
                                                            <h6 class="mb-1">Client Survey Premium</h6>
                                                            <p class="mb-0">New Surveys get offered every day !</p>
                                                        </div>
                                                        <div class="survey-btn">
                                                            <button class="btn text-white">0.9 <br
                                                                    class="d-block d-md-none d-lg-block"> USD</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="survey-item d-flex bg-white p-2">
                                                    <div class="survey-img me-2">
                                                        <img src="{{ asset('assets/images/small/img-1.jpg') }}" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                    <div
                                                        class="survey-content d-flex justify-content-between align-items-center w-100">
                                                        <div class="me-2">
                                                            <h6 class="mb-1">Client Survey Premium</h6>
                                                            <p class="mb-0">New Surveys get offered every day !</p>
                                                        </div>
                                                        <div class="survey-btn">
                                                            <button class="btn text-white">0.9 <br
                                                                    class="d-block d-md-none d-lg-block"> USD</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="survey-item d-flex bg-white p-2">
                                                    <div class="survey-img me-2">
                                                        <img src="{{ asset('assets/images/small/img-1.jpg') }}" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                    <div
                                                        class="survey-content d-flex justify-content-between align-items-center w-100">
                                                        <div class="me-2">
                                                            <h6 class="mb-1">Client Survey Premium</h6>
                                                            <p class="mb-0">New Surveys get offered every day !</p>
                                                        </div>
                                                        <div class="survey-btn">
                                                            <button class="btn text-white">0.9 <br
                                                                    class="d-block d-md-none d-lg-block"> USD</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="survey-item d-flex bg-white p-2">
                                                    <div class="survey-img me-2">
                                                        <img src="{{ asset('assets/images/small/img-1.jpg') }}" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                    <div
                                                        class="survey-content d-flex justify-content-between align-items-center w-100">
                                                        <div class="me-2">
                                                            <h6 class="mb-1">Client Survey Premium</h6>
                                                            <p class="mb-0">New Surveys get offered every day !</p>
                                                        </div>
                                                        <div class="survey-btn">
                                                            <button class="btn text-white">0.9 <br
                                                                    class="d-block d-md-none d-lg-block"> USD</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="survey-item survey-second-layout bg-white p-3">
                                                    <div class="survey-img">
                                                        <img src="{{ asset('assets/images/small/img-1.jpg') }}" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="survey-content">
                                                        <h5 class="mb-1 mt-2">Client Survey Premium</h5>
                                                        <p class="mb-2">New Surveys get offered every day !</p>
                                                        <div class="survey-btn">
                                                            <button class="btn text-white">0.9 USD</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile-1" role="tabpanel">
                                    <div class="col-lg-12 mb-3">
                                        <div class="survey-item survey-second-layout bg-white p-3">

                                            <div class="survey-content">
                                                <div class="row">
                                                    @if (count($data_web) > 0)
                                                        @foreach ($data_web as $d)
                                                            <div class="col-lg-4 mb-3">
                                                                <div class="survey-item d-flex bg-white p-2">
                                                                    <div class="survey-img me-2">
                                                                        <img src="{{ $d['image_url'] }}" alt=""
                                                                            class="img-fluid">
                                                                    </div>
                                                                    <div
                                                                        class="survey-content d-flex justify-content-between align-items-center w-100">
                                                                        <div class="me-2">
                                                                            <h6 class="mb-1">{{ $d['name'] }}</h6>
                                                                            <p class="mb-0">{{ $d['description'] }}</p>
                                                                        </div>
                                                                        <div class="survey-btn">
                                                                            <a href="{{ $d['click_path'] }}" target="_blank">
                                                                                <button
                                                                                    class="btn text-white">
                                                                                    @if(is_numeric($d['credit']))
                                                                                    {{ roundoff((($details->currency_value??0) * ((($d['rate']['rate']['network_rate'] ??0)* ($d['credit'])??0) / 100)) / 100) }}
                                                                                    @else
                                                                                    Variable
        
                                                                                  @endif
                                                                                    <br class="d-block d-md-none d-lg-block">
                                                                                    @if (isset($details->virtual_currency))
                                                                                        {{ $details->virtual_currency }}
                                                                                    @else
                                                                                        USD
                                                                                    @endif
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    </div>
        
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="col-lg-12 mb-3">
                                                            <div class="survey-item survey-second-layout bg-white p-3">
        
                                                                <div class="survey-content">
                                                                    <h5 class="mb-1 mt-2">No Offer Available</h5>
                                                                    <p class="mb-2">Sorry No survey available at the moment!
                                                                    </p>
        
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages-1" role="tabpanel">
                                    <div class="col-lg-12 mb-3">
                                        <div class="survey-item survey-second-layout bg-white p-3">

                                            <div class="survey-content">
                                                <div class="row">
                                                    @if (count($data_mob) > 0)
                                                        @foreach ($data_mob as $d)
                                                            <div class="col-lg-4 mb-3">
                                                                <div class="survey-item d-flex bg-white p-2">
                                                                    <div class="survey-img me-2">
                                                                        <img src="{{ $d['image_url'] }}" alt=""
                                                                            class="img-fluid">
                                                                    </div>
                                                                    <div
                                                                        class="survey-content d-flex justify-content-between align-items-center w-100">
                                                                        <div class="me-2">
                                                                            <h6 class="mb-1">{{ $d['name'] }}</h6>
                                                                            <p class="mb-0">{{ $d['description'] }}</p>
                                                                        </div>
                                                                        <div class="survey-btn">
                                                                            <a href="{{ $d['click_path'] }}" target="_blank">
                                                                                <button
                                                                                    class="btn text-white">
                                                                                    @if(is_numeric($d['credit']))
                                                                                    {{ roundoff((($details->currency_value??0) * ((($d['rate']['rate']['network_rate'] ??0)* ($d['credit'])??0) / 100)) / 100) }}
                                                                                    @else
                                                                                    Variable
        
                                                                                  @endif
                                                                                    <br class="d-block d-md-none d-lg-block">
                                                                                    @if (isset($details->virtual_currency))
                                                                                        {{ $details->virtual_currency }}
                                                                                    @else
                                                                                        USD
                                                                                    @endif
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    </div>
        
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="col-lg-12 mb-3">
                                                            <div class="survey-item survey-second-layout bg-white p-3">
        
                                                                <div class="survey-content">
                                                                    <h5 class="mb-1 mt-2">No Offer Available</h5>
                                                                    <p class="mb-2">Sorry No survey available at the moment!
                                                                    </p>
        
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings-1" role="tabpanel">
                                    <div class="col-lg-12 mb-3">
                                        <div class="survey-item survey-second-layout bg-white p-3">

                                            <div class="survey-content">
                                                <h5 class="mb-1 mt-2">No Offer Available</h5>
                                                <p class="mb-2">Sorry No survey available at the moment!</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    @if ($user_status == 0)
        <!-- Modal -->
        <div class="modal fade" id="user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="user_modalLabel">Complete your Profile</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-md-12">
                                    <form id="regForm">
                                        <h5 id="register">Disclaimer: if you answer this profiler dishonestly you will
                                            likely have trouble getting surveys to credit.</h5>
                                        <div class="all-steps" id="all-steps"> 
                                            <span class="step"></span> 
                                            <span class="step"></span> 
                                            <span class="step"></span> 
                                            <span class="step"></span> 
                                        </div>
                                        <div class="tab">
                                            <h5>Your Gender</h5>
                                            <div class="d-flex">
                                                <label class="my-lable">Male &nbsp; &nbsp;<input type="radio" checked="checked" name="radio">
                                                </label>
                                                
                                                <label class="my-lable">Female  &nbsp; &nbsp;<input type="radio" name="radio">
                                                </label>  
                                                
                                                <label class="my-lable">Other  &nbsp; &nbsp;<input type="radio" name="radio">
                                                </label>  
                                            </div>
                                            <p><input type="text" placeholder="Amount"
                                                    oninput="this.className = ''" name="amount"></p>

                                        </div>
                                        <div class="tab">
                                            <p><input placeholder="First Name" oninput="this.className = ''"
                                                    name="first"></p>
                                            <p><input placeholder="Last Name" oninput="this.className = ''"
                                                    name="last"></p>
                                            <p><input placeholder="Email" oninput="this.className = ''"
                                                    name="email">
                                            </p>
                                            <p><input placeholder="Phone" oninput="this.className = ''"
                                                    name="phone">
                                            </p>
                                            <p><input placeholder="Street Address" oninput="this.className = ''"
                                                    name="address"></p>
                                            <p><input placeholder="City" oninput="this.className = ''"
                                                    name="city">
                                            </p>
                                            <p><input placeholder="State" oninput="this.className = ''"
                                                    name="state">
                                            </p>
                                            <p><input placeholder="Country" oninput="this.className = ''"
                                                    name="country">
                                            </p>

                                        </div>
                                        <div class="tab">
                                            <p><input placeholder="Credit Card #" oninput="this.className = ''"
                                                    name="email"></p>
                                            <p>Exp Month
                                                <select id="month">
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </p>
                                            <p>Exp Year
                                                <select id="year">
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                </select>
                                            </p>

                                            <p><input placeholder="CVV" oninput="this.className = ''" name="phone">
                                            </p>
                                        </div>

                                        <div class="thanks-message text-center" id="text-message"> <img
                                                src="https://i.imgur.com/O18mJ1K.png" width="100" class="mb-4">
                                            <h3>Thanks for your Donation!</h3> <span>Your donation has been entered! We
                                                will
                                                contact you shortly!</span>
                                        </div>
                                        <div style="overflow:auto;" id="nextprevious">
                                            <div style="float:right;">
                                                <button type="button" class="btn btn-primary" id="prevBtn"
                                                    onclick="nextPrev(-1)">Previous</button>
                                                <button type="button" class="btn btn-primary" id="nextBtn"
                                                    onclick="nextPrev(1)">Next</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="text-center">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © PepeLeads.com
                    </p>
                </div>
            </div>
        </div>
    </footer>

    
    <!-- END layout-wrapper -->


    <!-- Right Sidebar -->

    <div class="rightbar-overlay"></div>







    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/app.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>


    @if ($user_status == 0)
        <script>
            let myModal = new bootstrap.Modal(document.getElementById('user_modal'), {});
            myModal.show();
            // $('#user_modal').modal('show')


            var currentTab = 0;
            document.addEventListener("DOMContentLoaded", function(event) {


                showTab(currentTab);

            });

            function showTab(n) {
                var x = document.getElementsByClassName("tab");
                x[n].style.display = "block";
                if (n == 0) {
                    document.getElementById("prevBtn").style.display = "none";
                } else {
                    document.getElementById("prevBtn").style.display = "inline";
                }
                if (n == (x.length - 1)) {
                    document.getElementById("nextBtn").innerHTML = "Submit";
                } else {
                    document.getElementById("nextBtn").innerHTML = "Next";
                }
                fixStepIndicator(n)
            }

            function nextPrev(n) {
                var x = document.getElementsByClassName("tab");
                if (n == 1 && !validateForm()) return false;
                x[currentTab].style.display = "none";
                currentTab = currentTab + n;
                if (currentTab >= x.length) {
                    // document.getElementById("regForm").submit();
                    // return false;
                    //alert("sdf");
                    document.getElementById("nextprevious").style.display = "none";
                    document.getElementById("all-steps").style.display = "none";
                    document.getElementById("register").style.display = "none";
                    document.getElementById("text-message").style.display = "block";




                } else {

                    showTab(currentTab);
                }
            }

            function validateForm() {
                var x, y, i, valid = true;
                x = document.getElementsByClassName("tab");
                y = x[currentTab].getElementsByTagName("input");
                for (i = 0; i < y.length; i++) {
                    if (y[i].value == "") {
                        y[i].className += " invalid";
                        valid = false;
                    }
                }
                if (valid) {
                    document.getElementsByClassName("step")[currentTab].className += " finish";
                }
                return valid;
            }

            function fixStepIndicator(n) {
                var i, x = document.getElementsByClassName("step");
                for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                }
                x[n].className += " active";
            }
        </script>
    @endif
</body>

</html>
