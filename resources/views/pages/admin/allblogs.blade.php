@extends('layouts.admin')
@section('title', 'All Blogs ')

@section('content')

    <div class="main-content ">

        <div class="page-content ">

            <div class="container-fluid">

                
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">All Blogs</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Blogs</a></li>
                                    <li class="breadcrumb-item active">All Blogs</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                  <div class="tavle-responsive">
                                      <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                          <thead>
                                                <tr>
                                                  <th>ID</th>
                                                  <th>image</th>
                                                  <th>Banner Image</th>
                                                  <th>Name</th>
                                                  <th>Status</th>
                                                  <th>Action</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $r)
                                                <tr>
                                                    <td>{{ $r->id }}</td>
                                                    <td>
                                                        @if($r->image)
                                                            <img src="{{ url($r->image) }}" class="img-thumbnail" width="50">
                                                        @else
                                                            <img src="{{ asset('path/to/default/image.png') }}" class="img-thumbnail" width="50"> <!-- Default image -->
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($r->blogbanner)
                                                            <img src="{{ url($r->blogbanner) }}" class="img-thumbnail" width="50">
                                                        @else
                                                            <img src="{{ asset('path/to/default/banner.png') }}" class="img-thumbnail" width="50"> <!-- Default banner -->
                                                        @endif
                                                    </td>
                                                    <td>{{ $r->name }}</td>
                                                    <td>@if($r->status == 1 ) Active @else Disabled @endif</td>
                                                    <td>
                                                        <a href="{{ url('admin/editblog', $r->id) }}" class="btn btn-primary"><i class="bx bx-pen"></i></a>
                                                        <a href="{{ url('admin/deleteblog', $r->id) }}" class="btn btn-primary"><i class="bx bx-trash"></i></a>
                                                    </td>
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

        </div>
        


        @include('dashboard.components.footer')
    </div>
    
@endsection


@section('scripts')
    <script>
        $('#datatable').DataTable();

        $(document).on('click', '.view_password', function() {
            $('.password_' + $(this).data('id')).attr('type', 'text');
            $(this).addClass('hide_password');
            $(this).removeClass('view_password');
            $(this).html('<i class="mdi mdi-eye-off-outline"></i>')
        })

        $(document).on('click', '.hide_password', function() {
            $('.password_' + $(this).data('id')).attr('type', 'password');
            $(this).addClass('view_password');
            $(this).removeClass('hide_password');
            $(this).html('<i class="mdi mdi-eye-outline"></i>')
            // alert($(this).data('id'))
        })
    </script>
@endsection
