@extends('layouts.admin')
@section('title','Profile ')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h5 class="font-size-14 mb-3">Profile</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card h-100">
                            <div class="card-body">
                                <div>
                                    <h5 class="font-size-14 mb-3">General Information</h5>
                                    <div class="border-bottom mb-2"></div>

                                    <form method="post" action="/update_profile" enctype="multipart/form-data">
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="horizontal-firstname-input" class="col-form-label">Full
                                                name</label>
                                            <input type="text" class="form-control" id="horizontal-firstname-input"
                                            name="full_name"
                                            value="{{ auth()->user()->name}}"
                                                placeholder="Enter your First Name">
                                        </div>
                                        @csrf
                                        <div class="col-md-6">
                                            <label for="horizontal-firstname-input" class="col-form-label">Upload Profile(.PNG, .JPG, .JPEG)</label>
                                            <input type="file" class="form-control" 
                                            
                                            id="horizontal-firstname-input"
                                                name="profile_photo">
                                        </div>
                                        <div class="col-12">
                                            <label for="horizontal-firstname-input"
                                                class="col-form-label">Email</label>
                                            <input type="email" class="form-control" id="horizontal-firstname-input"
                                              name="email" value="{{ auth()->user()->email}}" disabled  placeholder="Enter your Email">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="horizontal-firstname-input"
                                                class="col-form-label">Country</label>
                                            <input type="text" class="form-control" id="horizontal-firstname-input"
                                                placeholder="Enter your Country" name="country" value="{{ auth()->user()->country}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="horizontal-firstname-input"
                                                class="col-form-label">City</label>
                                            <input type="text" class="form-control" id="horizontal-firstname-input"
                                                placeholder="Enter your City"  name="city" value="{{ auth()->user()->city}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="horizontal-firstname-input"
                                                class="col-form-label">Address</label>
                                            <input type="text" class="form-control" id="horizontal-firstname-input"
                                                placeholder="Enter your Address"  name="address" value="{{ auth()->user()->address}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="horizontal-firstname-input" class="col-form-label">Phone
                                                Number</label>
                                            <input type="number" class="form-control"
                                                id="horizontal-firstname-input"
                                                name="phone" value="{{ auth()->user()->phone}}"
                                                placeholder="Enter your phone number">
                                        </div>
                                        <div class="col-12">
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary w-100">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    
                                </div>

                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="col-lg-5">
                        <div class="card h-100">
                            <div class="card-body">
                                <div
                                    class="profile-info d-flex justify-content-center align-items-center flex-column h-100">
                                    <div class="user-image">
                                        @if(auth()->user()->profile_picture)
                                        
                                         <img src="{{ auth()->user()->profile_picture }}"  height="100px" style="border-radius: 50%;"/>
                                         @else
                                         
                                         <img src="{{ asset('assets/images/profile.png') }}"  height="100px" style="border-radius: 50%;"/>
                                       

                                        @endif
                                    </div>
                                    <div class="user-name">
                                        <p><strong>{{ auth()->user()->name}}</strong></p>
                                    </div>
                                    <div class="user-email">
                                        <p>{{ auth()->user()->email}}</p>
                                    </div>
                                    <div class="phone-number">

                                        @if(isset(auth()->user()->phone))
                                        <p><i class="bx bx-phone"></i> +91 {{ auth()->user()->phone}}</p>
                                        @endif
                                    </div>
                                    <div class="delete-btn mt-4">
                                        <button
                                            class="border-0 bg-danger text-white py-2 px-4 d-flex align-items-center"><i
                                                class="bx bx-trash me-2"></i> Delete Account</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div> 
        </div>
        


        @include('dashboard.components.footer')
    </div>
    
@endsection


@section('scripts')

@if(session('status'))
<script>

alert("{{ session('status')}}");
// Swal.fire({title:"{{ session('status')}}",confirmButtonColor:"#ff8b00"})

</script>
@endif
    <script>
        $('#datatable').DataTable();
    </script>
@endsection
