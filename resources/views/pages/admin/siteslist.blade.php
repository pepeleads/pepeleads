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
                            <h4 class="mb-sm-0 font-size-18">Sites List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sites</a></li>
                                    <li class="breadcrumb-item active">List Sites</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Site Name</th>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>Domain</th>
                                            <th>Postback</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach($sites as $site)
                                        <tr>
                                            <td>{{ $site->id }}</td>
                                            <td>{{ $site->site_name}}</td>
                                            <td>{{ $site?->user?->name}}</td>
                                            <td>{{ $site?->user?->email}}</td>
                                            <td>{{ $site->domain_name}}</td>
                                            <td>{{ $site->post_back}}</td>
                                            <td>{{ $site->created_at}}</td>
                                            <td>@if($site->status==1)<a href="/admin/site-status?id={{$site->id}}">Active</a> @else <a href="/admin/site-status?id={{$site->id}}">Inactive</a> @endif</td>
                                            <td><a href="{{ url('admin/user_login') }}/{{$site?->user?->id}}"><button class="btn btn-primary"><i class="mdi mdi-login"></i></button></a></td>
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
