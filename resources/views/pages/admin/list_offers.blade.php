@extends('layouts.admin')
@section('title', 'Offers list ')

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
                            <h4 class="mb-sm-0 font-size-18">List all Offers <button type="button" id="openModalBtn" class=" m-3 btn btn-primary"
                                                        data-toggle="modal" data-target="#importModal">
                                                        Bulk Offer Import
                                                    </button></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Offers</a></li>
                                    <li class="breadcrumb-item active">List all Offers</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <button class="btn btn-danger" id="delete-selected"><i class="fa fa-trash"></i> Delete Selected
                            Offers</button>
                        <form action="/admin/offers/delete" name="delete-form" method="post">
                            <input type="hidden" name="delete-ids[]" value="" id="delete-ids" />
                            @csrf
                        </form>
                        <a href="/admin/add_offer"><button class="btn btn-primary">+ Add Offer</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable-button" class="table table-bordered dt-responsive nowrap w-100">
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
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>



        <div class="modal" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Bulk Offers</h5>
                        <button type="button" class="close btn btn-default" id="closeModalBtn" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true" class="text-lg">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/admin/import_offers') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Choose File</label>
                                <input type="file" class="form-control" name="file" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Import Questions</button>
                            <a target="_blank" href="/uploads/demo_offers_file.csv"
                                download="demo_offers_file.csv"><button type="button" class="btn btn-secondary mt-3"
                                    data-dismiss="modal">Download Dummy File</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @include('dashboard.components.footer')
    </div>

@endsection


@section('scripts')
    <script>

     document.getElementById('openModalBtn').addEventListener('click', function() {
            $('#importModal').modal('show');
        });

        document.getElementById('closeModalBtn').addEventListener('click', function() {
            $('#importModal').modal('hide');
        });
        
        //$(document).ready(function() {
            $('#datatable-button').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/api/list-offers",
                    "type": "GET"
                },
                "pageLength": 10, // default page length
                "lengthMenu": [10, 25, 50, 100, 500, 1000],
                "columns": [{
                        "data": "checkbox",
                        "orderable": false 
                    },
                    {
                        "data":"id",
                        "orderable": true 
                    },
                    {
                        "data": "image_url",
                        "render": function(data) {
                            return `<img src="${data}" height="100%" width="100%" style="height: 50px; width: 50px;">`;
                        }
                    },
                    {
                        "data": "name",
                         "render": function(data,type,row) {
                           // return `<a target="_blank" href="${row.target_url}">${data}</a>`;
                           return `<a href="/offer_details/${btoa(row.id)}">${data}</a>`;
                        }
                    },
                    {
                        "data": "network"
                    },
                    {
                        "data": "countries"
                    },
                    {
                        "data": "credit"
                    },
                    {
                        "data": "active"
                    },
                    {
                        "data": "actions",
                        "render": function(data, type, row) {
                            return `<a href="/admin/edit_offer/${row.id}"><i class="fa fa-edit"></i></a> <a href="#"><i class="fa fa-ban"></i></a>`;
                        }
                    }
                ]
            });
        //});


        $('.check-all').on('click', function() {
            if ($(this).prop('checked') == true) {

                $('.check-items').each(function(item, index) {
                    $(this).attr('checked', true);
                })
            } else {
                $('.check-items').each(function(item, index) {
                    $(this).attr('checked', false);
                    // console.log($(this).val())
                })
            }
        })


        $('#delete-selected').on('click', function(e) {
            e.preventDefault();

            var ids = [];
            $('.check-items').each(function(item, index) {
                if ($(this).is(':checked')) {
                    ids.push($(this).val());
                }
            })

            if (ids.length == 0) {
                alert('Please select at least one offer to delete');
                return;
            } else {
                if (confirm('Are you sure you want to delete selected offers?')) {
                    $('#delete-ids').val(ids);
                    document.forms["delete-form"].submit();
                }
            }

        });
    </script>
@endsection
