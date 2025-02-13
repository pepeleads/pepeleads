@extends('layouts.admin')
@section('title', 'Pending Offers list ')

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
                            <h4 class="mb-sm-0 font-size-18">List Pending for Approval Offers</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Offers</a></li>
                                    <li class="breadcrumb-item active">List Pending for Approval Offers</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <div class="d-flex ">
                            <button class="btn btn-danger m-1" id="delete-selected"><i class="fa fa-trash"></i> Disapprove Selected
                                Offers</button>
                            <form action="/admin/offers/disapprove" name="delete-form" method="post">
                                <input type="hidden" name="delete-ids[]" value="" id="delete-ids" />
                                @csrf
                            </form>
    
                            <button class="btn btn-success m-1" id="approve-selected"><i class="fa fa-check"></i>Approve Selected
                                Offers</button>
                            <form action="/admin/offers/approve" name="approve-form" method="post">
                                <input type="hidden" name="approve-ids[]" value="" id="approve-ids" />
                                @csrf
                            </form>
                        </div>
                        <a href="/admin/add_offer"><button class="btn btn-primary">+ Add Offer</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="form-check-input check-all"></th>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Offer Name</th>
                                            <th>Date</th>
                                            <th>User</th>
                                            <th>User Email</th>
                                            <th>User ID</th>
                                            {{-- <th>Network</th> --}}
                                            <th>Countries</th>
                                            <th>Credit</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
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
        //$(document).ready(function() {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/api/list-pending-offers",
                    "type": "GET"
                },
                "pageLength": 10, // default page length
                "lengthMenu": [10, 25, 50, 100, 500, 1000],
                "columns": [{
                        "data": "checkbox",
                        "orderable": false 
                    },
                    {
                        "data": "campaign_id",
                        "searchable": true
                    },
                    {
                        "data": "image_url",
                        "render": function(data) {
                            return `<img src="${data}" height="40px" width="40px">`;
                        }
                    },
                    {
                        "data": "name",
                        "searchable": true
                    },
                    {
                        "data": "created_at"

                    },
                    {
                        "data": "user_name",
                        "searchable": true
                    },
                    {
                        "data": "user",
                        "render": function(data) {
                            return `<p>${data.email}</p>`;
                        }
                    },
                    {
                        "data": "user",
                        "render": function(data) {
                            return `<p>${data.id}</p>`;
                        },
                        "searchable": true
                    },
                    // {
                    //     "data": "network"
                    // },
                    {
                        "data": "countries",
                        "searchable": true
                    },
                    {
                        "data": "credit",
                        "searchable": true
                    },
                    {
                        "data": "active",
                        "searchable": true
                    },
                    {
                        "data": "actions",
                        "render": function(data, type, row) {
                            return `${data}`;
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


        $('#approve-selected').on('click', function(e) {
            e.preventDefault();

            var ids = [];
            $('.check-items').each(function(item, index) {
                if ($(this).is(':checked')) {
                    ids.push($(this).val());
                }
            })

            if (ids.length == 0) {
                alert('Please select at least one offer to approve');
                return;
            } else {
                if (confirm('Are you sure you want to approve selected offers?')) {
                    $('#approve-ids').val(ids);
                    document.forms["approve-form"].submit();
                }
            }

        });
    </script>
@endsection
