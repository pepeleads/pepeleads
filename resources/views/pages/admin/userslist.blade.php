@extends('layouts.admin')
@section('title','Users list ')

@section('content')

    <div class="main-content ">

        <div class="page-content ">
           
            <div class="container-fluid">

                
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="/sites/add">
                            {{-- <button type="button"
                                class="btn btn-primary btn-lg waves-effect waves-light d-flex align-items-center">Add
                                New Sites <i class="bx bx-plus ms-2"></i></button> --}}
                            </a>
                        </div>
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Users List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                    <li class="breadcrumb-item active">List Users</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive">

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Type</th>
                                            <th>User Roll</th>
                                            <th>Business Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>Website</th>
                                            <th>State</th>
                                            <th>Zipcode</th>
                                            <th>Title</th>
                                            <th>Skype</th>
                                            <th>Linkedin</th>
                                            <th>Question1</th>
                                            <th>Question2</th>
                                            <th>Question3</th>
                                            <th>Question4</th>
                                            <th>Question5</th>
                                            <th>Question6</th>
                                            <th>Question7</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->user_type }}</td>
                                            <td>@if($user->role_id){{ DB::table('roles')->where('id' , $user->role_id)->first()->name }}@endif</td>
                                            <td>{{ $user->name}}</td>
                                            <td>{{ $user->email}}</td>
                                            <td>{{ $user->created_at}}</td>
                                            <td>@if($user->status==1)Active @else Inactive @endif</td>
                                            <td>{{ @$user->phone}}</td>
                                            <td>{{ @$user->city}}</td>
                                            <td>{{ @$user->country}}</td>
                                            <td>{{ @$user->website}}</td>
                                            <td>{{ @$user->state}}</td>
                                            <td>{{ @$user->zipcode}}</td>
                                            <td>{{ @$user->title}}</td>
                                            <td>{{ @$user->skype}}</td>
                                            <td>{{ @$user->linkedin}}</td>
                                            <td>{{ @$user->question1}}</td>
                                            <td>{{ @$user->question2}}</td>
                                            <td>{{ @$user->question3}}</td>
                                            <td>{{ @$user->question4}}</td>
                                            <td>{{ @$user->question5}}</td>
                                            <td>{{ @$user->question6}}</td>
                                            <td>{{ @$user->question7}}</td>
                                            <td><a href="{{ url('admin/edituser') }}/{{$user->id}}"><button class="btn btn-primary"><i class="mdi mdi-pen"></i></button></a></td>
                                            <td><a href="{{ url('admin/user_login') }}/{{$user->id}}"><button class="btn btn-primary"><i class="mdi mdi-login"></i></button></a></td>
                                        </tr>

                                        @endforeach

                                        

                                    </tbody>
                                </table>

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

        $(document).on('click','.view_password', function(){
            $('.password_'+$(this).data('id')).attr('type','text');
            $(this).addClass('hide_password');
            $(this).removeClass('view_password');
            $(this).html('<i class="mdi mdi-eye-off-outline"></i>')
        })

        $(document).on('click','.hide_password', function(){
            $('.password_'+$(this).data('id')).attr('type','password');
            $(this).addClass('view_password');
            $(this).removeClass('hide_password');
            $(this).html('<i class="mdi mdi-eye-outline"></i>')
            // alert($(this).data('id'))
        })
    </script>
@endsection
