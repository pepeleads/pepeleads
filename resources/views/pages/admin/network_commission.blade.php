@extends('layouts.admin')
@section('title', 'Network Commission ')

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
                            <h4 class="mb-sm-0 font-size-18">Network Commission</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Commission Management</a>
                                    </li>
                                    <li class="breadcrumb-item active">Network Commission</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <form method="post" action="/admin/add-network_commission">
                                    @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="example-text-input" class="form-label">Select network </label>
                                           <select class="form-control" name="network_id">
                                               @foreach($networks as $network)
                                                  <option value="{{ $network->id }}">{{ $network->name }}</option>
                                               @endforeach
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="example-search-input" class="form-label">Commission Rate in % (Percentage)</label>
                                            <input class="form-control" type="text" placeholder="Commission rate"
                                                name="network_rate">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="pt-3">
                                            <button type="submit" class="btn btn-primary mt-3">Add Network Commission</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                                            <th>Network Name</th>
                                            <th>Commission Rate</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($commissions as $com)
                                        <tr>
                                            <td>{{$com->id}}</td>
                                            <td>{{ $com->network->name }}</td>
                                            <td>{{ $com->network_rate}}</td>
                                            <td>{{ $com->created_at}}</td>
                                            <td>{{ $com->updated_at}}</td>
                                        </tr>
                                        @endforeach

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
