@extends('layouts.admin')
@section('title','Add Users ')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                
                
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Add Users</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                    <li class="breadcrumb-item active">Add User</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-lg-8">
                                        
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div>
                                                        <h5 class="font-size-14 mb-3">General Information</h5>
                                                        <div class="border-bottom mb-2"></div>
                    
                                                        <form method="post" action="{{ url('admin/add_user') }}" enctype="multipart/form-data">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <label for="horizontal-firstname-input" class="col-form-label">Type</label>
                                                                <select class="form-control" id="horizontal-firstname-input" name="user_type"
                                                                    required>
                                                                    <option value="">Select Type</option>
                                                                    <option value="admin">Admin</option>
                                                                    <option value="subadmin">Sub Admin</option>
                                                                    <option value="user">User</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="horizontal-firstname-input" class="col-form-label">User role</label>
                                                                <select class="form-control" id="horizontal-firstname-input" name="role_id"
                                                                    required>
                                                                    <option value="">Select Role</option>
                                                                    @foreach (DB::table('roles')->get() as $r)
                                                                        <option value="{{ $r->id }}">{{ $r->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="horizontal-firstname-input" class="col-form-label">Full
                                                                    name</label>
                                                                <input type="text" class="form-control" id="horizontal-firstname-input"
                                                                name="full_name"
                                                                value=""
                                                                    placeholder="Enter First Name">
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
                                                                  name="email" value=""  placeholder="Enter your Email">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="horizontal-firstname-input"
                                                                    class="col-form-label">Country</label>
                                                                <input type="text" class="form-control" id="horizontal-firstname-input"
                                                                    placeholder="Enter your Country" name="country" >
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="horizontal-firstname-input"
                                                                    class="col-form-label">City</label>
                                                                <input type="text" class="form-control" id="horizontal-firstname-input"
                                                                    placeholder="Enter your City"  name="city" >
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="horizontal-firstname-input"
                                                                    class="col-form-label">Address</label>
                                                                <input type="text" class="form-control" id="horizontal-firstname-input"
                                                                    placeholder="Enter your Address"  name="address" >
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="horizontal-firstname-input" class="col-form-label">Phone
                                                                    Number</label>
                                                                <input type="number" class="form-control"
                                                                    id="horizontal-firstname-input"
                                                                    name="phone" 
                                                                    placeholder="Enter your phone number">
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="mt-4">
                                                                    <button type="submit" class="btn btn-primary w-100">Add</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                        
                                                    </div>
                    
                                                </div>
                                                
                                            </div>
                                            
                                        
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mt-3 mt-lg-0">
                                            <h5>FAQ</h5>
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            Add User or Create New Business.
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingOne"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            Create User from your side without verification and an auto generated password mail sent to the email of the user you entered.
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
                
            </div> 
        </div>
        


        @include('dashboard.components.footer')
    </div>
    
@endsection


@section('scripts')
    <script>
        $('#datatable').DataTable();
    </script>
@endsection
