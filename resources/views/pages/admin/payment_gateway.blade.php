@extends('layouts.admin')
@section('title', 'Payment gateway ')

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
                            <h4 class="mb-sm-0 font-size-18">Payment gateway</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Payout Management</a>
                                    </li>
                                    <li class="breadcrumb-item active">Payment gateway</li>
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
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Business Name</label>
                                            <input class="form-control" type="text" value=""
                                                placeholder="Business Name" id="example-text-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="example-search-input" class="form-label">Business
                                                Domain</label>
                                            <input class="form-control" type="search" placeholder="Business Domain"
                                                id="example-search-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="example-email-input" class="form-label">Postback</label>
                                            <input class="form-control" type="text" id="example-email-input"
                                                placeholder="Postback">
                                        </div>
                                    </div>
                                </div>
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
                                            <th>Business Name</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>345678</td>
                                            <td>XYZ Company</td>
                                            <td>22/10/2022</td>
                                            <td>Pending</td>
                                            <td><a href="#"><i class="mdi mdi-eye"></i></a></td>
                                        </tr>

                                        {{-- @foreach ($sites as $site)
                                        <tr>
                                            <td>{{$site->id}}</td>
                                            <td>{{$site->site_name}}</td>
                                            <td>{{$site->created_at}}</td>
                                            <td>{{$site->api_key}}</td>
                                            <td>
                                                <div class="input-group auth-pass-inputgroup">
                                                <input class="password_{{ $site->id }}" type="password" value="{{$site->secret_key}}" class="form-control">
                                                <button class="btn btn-light shadow-none ms-0 view_password" type="button" data-id="{{ $site->id }}"><i class="mdi mdi-eye-outline"></i></button>
                  
                                            </div>
                                        </td>
                                            <td>@if ($site->status == 0) Pending @elseif($site->status==1) Approved @endif</td>
                                            <td>$0</td>
                                            <td><i class="fa fa-edit"></i>Edit</td>
                                        </tr>
                                        @endforeach --}}
                                        {{-- <tr>
                                            <td>2</td>
                                            <td>Dishant kapoort</td>
                                            <td>12 may 2021</td>
                                            <td>jhgfcg7hbgvh876jhjg</td>
                                            <td>********</td>
                                            <td>Completed</td>
                                            <td>$80</td>
                                            <td>edit</td>
                                        </tr> --}}

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
