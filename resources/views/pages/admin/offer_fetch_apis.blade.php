@extends('layouts.admin')
@section('title','Offers fetch APIs List ')

@section('content')

    <div class="main-content ">

        <div class="page-content ">
           
            <div class="container-fluid">

                {{-- https://platform.opinionsample.com/api/publisher/v1/publisher_users/c6347c00-e5c3-4b58-9f1b-fb9f00edf97a/publisher_offers --}}
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="/admin/offer_fetch_apis">
                            @csrf
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="example-text-input" class="form-label">API provider Name</label>
                                            <select class="form-control" name="api_name"
                                            id="api_name" required>
                                            @foreach($networks as $nw)
                                            <option value="{{ $nw->name}}">{{ $nw->name}}</option>
                                            @endforeach
                                        </select>
                                           
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="api_endpoint" class="form-label">Get API URL</label>
                                            <input class="form-control" type="text" name="api_endpoint" placeholder="API Url for fetch"
                                                id="api_endpoint" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="method" class="form-label">Select Method</label>
                                            <select class="form-control" name="method"
                                                id="method" required>
                                                <option value="GET">GET</option>
                                                <option value="POST">POST</option>
                                                <option value="PUT">PUT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="my-4">
                                           <button class="btn btn-primary" type="submit">Add API</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div> 
                </div>
                
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
                            <h4 class="mb-sm-0 font-size-18">Offers fetch APIs List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Offers Manage</a></li>
                                    <li class="breadcrumb-item active">Offers fetch APIs List</li>
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
                                            <th>API Provider Name</th>
                                            <th>Endpoint</th>
                                            <th>Method</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($providers as $pro)
                                            <tr>
                                                <td>{{$pro->id }}</td>
                                                <td>{{$pro->api_provider_name }}</td>
                                                <td>{{$pro->api_endpoint }}</td>
                                                <td>{{$pro->method }}</td>
                                                <td><a href="#"><i class="mdi mdi-eye"></i></a></td>
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
