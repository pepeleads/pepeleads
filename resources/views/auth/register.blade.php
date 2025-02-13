@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                    autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<style>
    .step {
        display: none;
    }
    .step.active {
        display: block;
    }
    #multistep-form {
        width: 100%;
        max-height: 500px;
        overflow-y: scroll;
    }
    #progressbar {
        display: flex;
        justify-content: space-between;
        list-style: none;
        padding: 0;
    }
    #progressbar li {
        flex: 1;
        text-align: center;
        padding: 10px;
        border-bottom: 2px solid #ccc;
    }
    #progressbar li.active {
        border-bottom: 2px solid #007bff;
        font-weight: bold;
    }
    .is-invalid {
        border-color: #dc3545; /* Red border color */
    }
    .is-valid {
        border-color: #28a745; /* Green border color */
    }
    .invalid-feedback {
        display: none;
        color: #dc3545; /* Red text color */
    }
    .valid-feedback {
        display: none;
        color: #28a745; /* Green text color */
    }
    .is-invalid ~ .invalid-feedback {
        display: block;
    }
    .is-valid ~ .valid-feedback {
        display: block;
    }
    .text-success {
        color: #28a745;
    }
    .text-warning {
        color: #ffc107;
    }
    .text-danger {
        color: #dc3545;
    }
    .text-muted {
        color: #6c757d;
    }
</style>
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="auth-full-page-content d-flex p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class=" text-center">
                                <a href="/" class="d-block auth-logo">
                                    <img src="{{ asset('assets/images/logo2.png')}}" alt="" height="44">
                                    {{-- <h4>PepeLeads</h4> --}}
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Register Account</h5>
                                    <p class="text-muted mt-2">Get your free PepeLeads account now.</p>
                                </div>
                                <!-- <form class="needs-validation mt-4 pt-2" method="POST" action="{{ route('register') }}">

                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-lanel">Full Name</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus
                                            placeholder="Enter Full Name">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            placeholder="Enter Email Address" value="{{ old('email') }}" required
                                            autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Mobile Number</label>
                                        <input type="number"
                                            class="form-control  @error('password') is-invalid @enderror" id="phone"
                                            placeholder="Enter Mobile Number" name="phone" required>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Invalid Mobile Number</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" type="password" placeholder="Enter Password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password-confirm" class="form-label">Confirm Password</label>

                                        {{-- <div class="col-md-6"> --}}
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="Confirm Password">
                                        {{-- </div> --}}
                                    </div>

                                    <div class="mb-3">
                                        <label for="refer_id" class="form-label">Referel Id (Optional)</label>

                                        {{-- <div class="col-md-6"> --}}
                                        <input id="refer_id" type="text" class="form-control" name="refer_id"
                                            placeholder="Enter Referer ID (optional)">
                                        {{-- </div> --}}
                                    </div>

                                    <div class="mb-4">
                                        <p class="mb-0">By registering you agree to the PepeLeads <a href="#"
                                                class="text-primary">Terms of Use</a></p>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light"
                                            type="submit">Register</button>
                                    </div>
                                </form> -->

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="needs-validation px-2" id="multistep-form" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <ul id="progressbar">
                                        <li class="active">Account Details</li>
                                        <li>User Details</li>
                                        <li>Additional Questions</li>
                                        <li>Partner Sign Up</li>
                                    </ul>

                                    <!-- Step 1: Account Details -->
                                    <div class="step active" id="step1">
                                        <h3>Account Details</h3>
                                        <div class="form-group my-2">
                                            <label for="refer_id">Refer Id</label>
                                            <input id="refer_id" type="text" class="form-control" name="refer_id" value="@if(Session::has ('ref_id')){{ Session::get('ref_id') }}@else{{ old('refer_id') }}@endif"  autofocus placeholder="Enter Refer Id (Optional)">
                                            {{-- <div class="invalid-feedback">Please enter a valid company name.</div> --}}
                                            {{-- <div class="valid-feedback">Looks good!</div> --}}
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="companyName">Company Name</label>
                                            <input id="companyName" type="text" class="form-control" name="companyName" value="{{ old('companyName') }}" required autofocus placeholder="Enter Company Name">
                                            <div class="invalid-feedback">Please enter a valid company name.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="website">Website</label>
                                            <input id="website" type="url" class="form-control" name="website" value="{{ old('website') }}" required placeholder="Enter Website">
                                            <div class="invalid-feedback">Please enter a valid website URL.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="address1">Address 1</label>
                                            <input id="address1" type="text" class="form-control" name="address1" value="{{ old('address1') }}" required placeholder="Enter Address 1">
                                            <div class="invalid-feedback">Please enter a valid address.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="address2">Address 2</label>
                                            <input id="address2" type="text" class="form-control" name="address2" placeholder="Enter Address 2">
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="city">City</label>
                                            <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required placeholder="Enter City">
                                            <div class="invalid-feedback">Please enter a valid city.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="country">Country</label>
                                            <input id="country" type="text" class="form-control" name="country" value="{{ old('country') }}" required placeholder="Enter Country">
                                            <div class="invalid-feedback">Please enter a valid country.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="state">State</label>
                                            <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" required placeholder="Enter State">
                                            <div class="invalid-feedback">Please enter a valid state.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="zipcode">Zipcode</label>
                                            <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ old('zipcode') }}" required placeholder="Enter Zipcode">
                                            <div class="invalid-feedback">Please enter a valid zipcode.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="phone">Phone</label>
                                            <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required placeholder="Enter Phone Number">
                                            <div class="invalid-feedback">Please enter a valid phone number.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <button type="button" class="btn btn-primary my-2" onclick="nextStep()">Next</button>
                                    </div>

                                    <!-- Step 2: User Details -->
                                    <div class="step" id="step2">
                                        <h3>User Details</h3>
                                        <div class="form-group my-2">
                                            <label for="name">Full Name</label>
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="Enter Full Name">
                                            <div class="invalid-feedback">Please enter a valid Full name.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                      
                                        <div class="form-group my-2">
                                            <label for="title">Title</label>
                                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter Title">
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="email">Email Address</label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Enter Email Address">
                                            <div class="invalid-feedback">Please enter a valid email address.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <!-- <div class="form-group my-2">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" onkeyup="checkPasswordStrength()" required placeholder="Enter Password">
                                            <small id="passwordHelp" class="form-text text-muted">
                                                Password Strength: <span id="passStrength">poor</span>
                                                <ul>
                                                    <li>Between 8 and 16 characters</li>
                                                    <li>At least one uppercase letter</li>
                                                    <li>At least one lowercase letter</li>
                                                    <li>Enter a number or a special character</li>
                                                </ul>
                                            </small>
                                            <div class="invalid-feedback">Please enter a valid password.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="confirmPassword">Confirm Password</label>
                                            <input id="confirmPassword" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                                            <div class="invalid-feedback">Passwords do not match.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div> -->
                                        <div class="form-group my-2">
                                            <label for="password">Password</label>
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control" name="password" onkeyup="checkPasswordStrength()" required placeholder="Enter Password">
                                                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('password', 'togglePasswordIcon')">
                                                    <i id="togglePasswordIcon" class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                            <small id="passwordHelp" class="form-text text-muted">
                                                Password Strength: <span id="passStrength">poor</span>
                                                <ul>
                                                    <li>Between 8 and 16 characters</li>
                                                    <li>At least one uppercase letter</li>
                                                    <li>At least one lowercase letter</li>
                                                    <li>Enter a number or a special character</li>
                                                </ul>
                                            </small>
                                            <div class="invalid-feedback">Please enter a valid password.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="confirmPassword">Confirm Password</label>
                                            <div class="input-group">
                                                <input id="confirmPassword" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                                                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('confirmPassword', 'toggleConfirmPasswordIcon')">
                                                    <i id="toggleConfirmPasswordIcon" class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                            <div class="invalid-feedback">Passwords do not match.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <button type="button" class="btn btn-secondary my-2" onclick="prevStep()">Previous</button>
                                        <button type="button" class="btn btn-primary my-2" onclick="nextStep()">Next</button>
                                    </div>

                                    <!-- Step 3: Additional Questions -->
                                    <div class="step" id="step3">
                                        <h3>Additional Questions</h3>
                                        <div class="form-group my-2">
                                            <label for="question1">How are you going to promote our offers?</label>
                                            <textarea id="question1" class="form-control" name="question1" rows="3" required placeholder="Enter your answer"></textarea>
                                            <div class="invalid-feedback">Please provide an answer.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="question2">What kind of verticals you work with?</label>
                                            <textarea id="question2" class="form-control" name="question2" rows="3" required placeholder="Enter your answer"></textarea>
                                            <div class="invalid-feedback">Please provide an answer.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="question3">Do you have a website? If so please add it.</label>
                                            <textarea id="question3" class="form-control" name="question3" rows="3" required placeholder="Enter your answer"></textarea>
                                            <div class="invalid-feedback">Please provide a valid website or leave blank.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="question4">How long have you been online marketing?</label>
                                            <textarea id="question4" class="form-control" name="question4" rows="3" required placeholder="Enter your answer"></textarea>
                                            <div class="invalid-feedback">Please provide an answer.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="question5">What other networks you work with?</label>
                                            <textarea id="question5" class="form-control" name="question5" rows="3" required placeholder="Enter your answer"></textarea>
                                            <div class="invalid-feedback">Please provide an answer.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="question6">Can you provide references?</label>
                                            <textarea id="question6" class="form-control" name="question6" rows="3" required placeholder="Enter your answer"></textarea>
                                            <div class="invalid-feedback">Please provide references or leave blank.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="question7">Is all the info above correct? (Fake info get you rejected).</label>
                                            <textarea id="question7" class="form-control" name="question7" rows="3" required placeholder="Enter your answer"></textarea>
                                            <div class="invalid-feedback">Please confirm the information.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="skype">What is your Skype account?</label>
                                            <input id="skype" type="text" class="form-control" name="skype" value="{{ old('skype') }}" required placeholder="Enter Skype Account">
                                            <div class="invalid-feedback">Please provide a valid Skype account.</div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="linkedin">LinkedIn Account?</label>
                                            <input id="linkedin" type="text" class="form-control" name="linkedin" value="{{ old('linkedin') }}" placeholder="Enter LinkedIn Account">
                                        </div>
                                        <button type="button" class="btn btn-secondary my-2" onclick="prevStep()">Previous</button>
                                        <button type="button" class="btn btn-primary my-2" onclick="nextStep()">Next</button>
                                    </div>

                                    <!-- Step 4: Partner Sign Up -->
                                    <div class="step" id="step4">
                                        <h3>Partner Sign Up</h3>
                                        <div class="form-group my-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="terms1" name="terms1" required>
                                                <label for="terms1">
                                                    I agree to the Conditions with PepeLeads.
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="terms2" name="terms2" required>
                                                <label for="terms2">
                                                    I hereby consent and allow the use of my and/or my company's information, including sharing with a third party, to assess, detect, prevent or otherwise enable detection and prevention of invalid or unlawful activity and/or general fraud prevention.
                                                </label>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary my-2" onclick="prevStep()">Previous</button>
                                        <button type="submit" class="btn btn-success my-2 waves-effect waves-light">Submit</button>
                                    </div>
                                </form>

                                {{-- <div class="mt-4 pt-2 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign up using -</h5>
                                        </div>

                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-primary text-white border-primary">
                                                    <i class="mdi mdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-info text-white border-info">
                                                    <i class="mdi mdi-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-danger text-white border-danger">
                                                    <i class="mdi mdi-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div> --}}

                                <div class="text-center mt-5">
                                    <p class="text-muted mb-0">Already have an account ? 
                                        <a href="/login" class="text-primary fw-semibold"> Login </a> 
                                    </p>
                                </div>
                            </div>
                            <div class=" text-center">
                                <p class="mb-0">©
                                    <script>
                                    document.write(new Date().getFullYear())
                                    </script> PepeLeads
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-primary"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-7">
                            <div class="p-0 p-sm-4 px-xl-0">
                                <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div
                                        class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                        <button type="button" data-bs-target="#reviewcarouselIndicators"
                                            data-bs-slide-to="0" class="active" aria-current="true"
                                            aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators"
                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators"
                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“I never knew how to
                                                    monetize my website and make money from it. But then I found this
                                                    PepeLeads and now I know how to do exactly that! Web Monetization
                                                    made me feel more confident about running a business because now I
                                                    know what to do with my site. Literally, appreciate men.”
                                                </h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                                                class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Richard Drews
                                                            </h5>
                                                            <p class="mb-0 text-white-50">Publisher</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“It helped me communicate,
                                                    collaborate, and work more efficiently than ever before. It also
                                                    helped me save time and money which I would have otherwise spent on
                                                    meetings for web Offers and ads.”</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{ asset('assets/images/users/avatar-2.jpg') }}"
                                                                class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Rosanna French
                                                            </h5>
                                                            <p class="mb-0 text-white-50">User</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">Offers service was
                                                    great. I had a lot of success with it, and the customer support was
                                                    always there to help me when I needed them.”</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <img src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                                            class="avatar-md img-fluid rounded-circle" alt="...">
                                                        <div class="flex-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Ilse R. Eaton</h5>
                                                            <p class="mb-0 text-white-50">User
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- <div class="step-bar">
                    <div class="step-indicator active" id="indicator1">Step 1</div>
                    <div class="step-indicator" id="indicator2">Step 2</div>
                    <div class="step-indicator" id="indicator3">Step 3</div>
                    <div class="step-indicator" id="indicator4">Step 4</div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- end container fluid -->
</div>
<script>
   
</script>
<script>
    // Initial step
    let currentStep = 0;

    // Show a specific step
    function showStep(stepIndex) {
        const steps = document.querySelectorAll('.step');
        steps.forEach((step, index) => {
            step.classList.remove('active');
            if (index === stepIndex) {
                step.classList.add('active');
            }
        });
        updateProgressBar(stepIndex);
    }

    // Update the progress bar based on the current step
    function updateProgressBar(stepIndex) {
        const progressBarItems = document.querySelectorAll('#progressbar li');
        progressBarItems.forEach((item, index) => {
            item.classList.remove('active');
            if (index <= stepIndex) {
                item.classList.add('active');
            }
        });
    }

    // Validate the current step
    function validateCurrentStep() {
        const currentForm = document.querySelector('.step.active');
        const inputs = currentForm.querySelectorAll('input, select, textarea');
        let isValid = true;
        inputs.forEach(input => {
            //if (input.id === 'linkedin') {
            //    return; // Skip LinkedIn field validation
            //}
            if (!input.checkValidity()) {
                isValid = false;
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            } else if (input.required) { // Only mark as valid if the field is required
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        });
        return isValid;
    }

    // Show and hide the Password
    function togglePasswordVisibility(passwordFieldId, toggleIconId) {
        const passwordField = document.getElementById(passwordFieldId);
        const toggleIcon = document.getElementById(toggleIconId);

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Move to the next step
    function nextStep() {
        if (validateCurrentStep()) {
            currentStep++;
            showStep(currentStep);
        }
    }

    // Move to the previous step
    function prevStep() {
        currentStep--;
        showStep(currentStep);
    }

    // Check password strength and display feedback
    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthSpan = document.getElementById('passStrength');
        const passwordField = document.getElementById('password');
        const passwordHelpListItems = document.querySelectorAll('#passwordHelp ul li');

        let strength = 'poor';
        let valid = true;

        // Check password length
        if (password.length >= 8 && password.length <= 16) {
            passwordHelpListItems[0].classList.add('text-success'); // Length criteria met
        } else {
            passwordHelpListItems[0].classList.remove('text-success');
            valid = false;
        }

        // Check for at least one uppercase letter
        if (/[A-Z]/.test(password)) {
            passwordHelpListItems[1].classList.add('text-success'); // Uppercase letter criteria met
        } else {
            passwordHelpListItems[1].classList.remove('text-success');
            valid = false;
        }

        // Check for at least one lowercase letter
        if (/[a-z]/.test(password)) {
            passwordHelpListItems[2].classList.add('text-success'); // Lowercase letter criteria met
        } else {
            passwordHelpListItems[2].classList.remove('text-success');
            valid = false;
        }

        // Check for at least one number or special character
        if (/[0-9!@#$%^&*()_+{}\[\]:;"'<>,.?~`-]/.test(password)) {
            passwordHelpListItems[3].classList.add('text-success'); // Number/special character criteria met
        } else {
            passwordHelpListItems[3].classList.remove('text-success');
            valid = false;
        }

        // Update strength span text
        if (valid) {
            strength = 'strong';
            passwordField.classList.remove('is-invalid');
            passwordField.classList.add('is-valid');
        } else {
            strength = 'medium';
            passwordField.classList.add('is-invalid');
            passwordField.classList.remove('is-valid');
        }
        strengthSpan.textContent = strength;
    }

    // Check if passwords match
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const confirmPasswordField = document.getElementById('confirmPassword');

        // Check if passwords match
        if (password === confirmPassword && password.length >= 8) {
            confirmPasswordField.classList.remove('is-invalid');
            confirmPasswordField.classList.add('is-valid');
        } else {
            confirmPasswordField.classList.add('is-invalid');
            confirmPasswordField.classList.remove('is-valid');
        }
    }

    // Add event listeners for real-time validation
    document.getElementById('password').addEventListener('keyup', checkPasswordStrength);
    document.getElementById('confirmPassword').addEventListener('keyup', checkPasswordMatch);

    // Validate form on submit
    document.getElementById('multistep-form').addEventListener('submit', function(event) {
        if (!validateCurrentStep()) {
            event.preventDefault();
            event.stopPropagation();
        }
    });

    // Setup MutationObserver for detecting autofill
    document.addEventListener('DOMContentLoaded', function () {
        showStep(currentStep);

        const observer = new MutationObserver(() => {
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                if (input.matches(':focus')) {
                    return; // Skip if the input is currently focused
                }
                if (input.value) {
                    if (input.checkValidity()) {
                        if (input.required) { // Only mark as valid if the field is required
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                        }
                    } else {
                        input.classList.add('is-invalid');
                        input.classList.remove('is-valid');
                    }
                }
            });
        });

        // Observe changes in the form fields
        observer.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['value']
        });
    });

    // Add input event listeners for real-time validation
    document.querySelectorAll('input, select, textarea').forEach(input => {
        input.addEventListener('input', () => {
            if (input.checkValidity()) {
                if (input.required) { // Only mark as valid if the field is required
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                }
            } else {
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }
        });

        // Check autofill for initial value
        if (input.value) {
            if (input.checkValidity()) {
                if (input.required) { // Only mark as valid if the field is required
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                }
            } else {
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }
        }
    });
</script>

@endsection