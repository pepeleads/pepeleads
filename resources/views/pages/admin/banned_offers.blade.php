@extends('layouts.admin')
@section('title', 'Banned Offers ')

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
                            <h4 class="mb-sm-0 font-size-18">Banned Offers</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Offers</a></li>
                                    <li class="breadcrumb-item active">Banned Offers</li>
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
                                            <th><input type="checkbox" class="form-check-input check-all"></th>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Offer Name</th>
                                            <th>Network</th>
                                            <th>Countries</th>
                                            <th>Credit</th>
                                            <th>Status</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($offers as $offer)
                                            <tr>
                                                <td><input type="checkbox" class="form-check-input check-items"
                                                        name="id[]" value="{{ $offer->id }}"></td>
                                                <td>{{ $offer->campaign_id }}</td>
                                                <td><img src="{{ $offer->image_url }}" height="30px" width="30px"></td>
                                                <td>{{ $offer->name }}</td>
                                                <td>{{ $offer->network }}</td>
                                                <td>{{ $offer->countries }}</td>
                                                <td>{{ $offer->credit }}</td>
                                                <td>{{ $offer->active }}</td>
                                                <td><a href="#"><i class="fa fa-edit"></i></a> <a href="#"><i class="fa fa-ban"></i></a></td>
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
