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
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Role Name</th>
                                            <th>User Roll</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name}}</td>
                                            <td>{{ DB::table('users')->where('id' , $user->user_id)->first()->name }}</td>
                                            <td><a href="{{ url('admin/editrole') }}/{{$user->id}}"><button class="btn btn-primary"><i class="mdi mdi-pen"></i> Edit</button></a></td>
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
