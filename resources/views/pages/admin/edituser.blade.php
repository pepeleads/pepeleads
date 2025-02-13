@extends('layouts.admin')
@section('title','Add Users ')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                
                
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Update Users</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                    <li class="breadcrumb-item active">Update User</li>
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
                    
                                                        <form method="post" action="{{ url('admin/updateuser') }}" enctype="multipart/form-data">
                                                        <div class="row mb-4">
                                                            <div class="col-md-12">
                                                                <label for="horizontal-firstname-input" class="col-form-label">Type</label>
                                                                <select class="form-control" id="horizontal-firstname-input" name="user_type">
                                                                    <option  value="">Select Type</option>
                                                                    <option @if($users->user_type == 'admin') selected @endif value="admin">Admin</option>
                                                                    <option @if($users->user_type == 'subadmin') selected @endif value="subadmin">Sub Admin</option>
                                                                    <option @if($users->user_type == 'user') selected @endif value="user">User</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="horizontal-firstname-input" class="col-form-label">User role</label>
                                                                <select class="form-control" id="horizontal-firstname-input" name="role_id">
                                                                    <option value="">Select Role</option>
                                                                    @foreach (DB::table('roles')->get() as $r)
                                                                        <option @if($users->role_id == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="horizontal-firstname-input" class="col-form-label">Assign Manager</label>
                                                                <select class="form-control" id="horizontal-firstname-input" name="assign_manager_id">
                                                                    <option value="">Select Manager</option>
                                                                    @foreach ($managers as $manager)
                                                                        <option @if($users->assign_manager_id == $manager->id) selected @endif value="{{  $manager->id }}">{{  $manager->name }} ({{  $manager->email }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            
                                                            
                                                            <div class="col-md-6">
                                                                <label for="horizontal-firstname-input" class="col-form-label">Full
                                                                    name</label>
                                                                <input type="text" class="form-control" id="horizontal-firstname-input"
                                                                name="full_name"
                                                                value="{{ $users->name }}"
                                                                    placeholder="Enter First Name">
                                                            </div>
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $users->id }}">
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
                                                                  name="email" value="{{ $users->email }}"  placeholder="Enter your Email" >
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="horizontal-firstname-input"
                                                                    class="col-form-label">Country</label>
                                                                <input type="text" class="form-control" id="horizontal-firstname-input"
                                                                    placeholder="Enter your Country" name="country" value="{{ $users->country }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="horizontal-firstname-input"
                                                                    class="col-form-label">City</label>
                                                                <input type="text" class="form-control" id="horizontal-firstname-input"
                                                                    placeholder="Enter your City"  name="city" value="{{ $users->city }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="horizontal-firstname-input"
                                                                    class="col-form-label">Address</label>
                                                                <input type="text" class="form-control" id="horizontal-firstname-input"
                                                                    placeholder="Enter your Address"  name="address" value="{{ $users->address }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="horizontal-firstname-input" class="col-form-label">Phone
                                                                    Number</label>
                                                                <input type="number" class="form-control"
                                                                    id="horizontal-firstname-input"
                                                                    name="phone" 
                                                                    placeholder="Enter your phone number" value="{{ $users->phone }}">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="horizontal-firstname-input"
                                                                    class="col-form-label">Skype ID</label>
                                                                <input type="text" class="form-control" id="horizontal-firstname-input"
                                                                  name="skype" value="{{ $users->skype }}"  placeholder="Enter your skype ID" >
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
