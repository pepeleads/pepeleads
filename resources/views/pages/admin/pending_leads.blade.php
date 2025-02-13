@extends('layouts.admin')
@section('title','Form Submissions Leads ')

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
                            <h4 class="mb-sm-0 font-size-18">Form Submissions Leads</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Leads</a></li>
                                    <li class="breadcrumb-item active">Form Submissions Leads</li>
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
                                        {{-- "name": "test"
      +"email": "dishant.kapoor95@gmail.com"
      +"phone": null
      +"subject": "Test"
      +"company": null
      +"message": "test"
      +"page_name": null
      +"ip": "127.0.0.1"
      +"created_at": "2022-11-27 17:21:06"
      +"updated_at": "2022-11-27 17:21:06"
      +"deleted_at": null --}}
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Subject</th>
                                            <th>Company</th>
                                            <th>Message</th>
                                            <th>Page Name</th>
                                            <th>IP</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                    @foreach ($leads as $lead)
                                        <tr>
                                            <td>{{$lead->id}}</td>
                                            <td>{{$lead->name}}</td>
                                            <td>{{$lead->email}}</td>
                                            <td>{{$lead->phone}}</td>
                                            <td>{{$lead->subject}}</td>
                                            <td>{{$lead->company}}</td>
                                            <td>{{$lead->message}}</td>
                                            <td>{{$lead->page_name}}</td>
                                            <td>{{$lead->ip}}</td>
                                            <td>{{$lead->created_at}}</td>
                                            
                                        </tr>
                                    @endforeach

                                        {{-- @foreach($sites as $site)
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
                                            <td>@if($site->status==0) Pending @elseif($site->status==1) Approved @endif</td>
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
        $('#datatable').DataTable({
    order: [[0, 'desc']] // Order by the first column (index 0) in descending order
});

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
