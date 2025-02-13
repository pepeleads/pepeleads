@extends('layouts.admin')
@section('title', 'Add Offer')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                
                
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Add Offer</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Offers</a></li>
                                    <li class="breadcrumb-item active">Add Offer</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <form action="/admin/add_offer" method="post">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div>
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="uuid" class="form-label">Campaign Id Name</label>
                                                    <input class="form-control" type="text" placeholder="Campaign ID"
                                                        id="uuid" readonly="true" value="{{ uuid4() }}"
                                                        name="uuid" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="offer_description" class="form-label">Offer
                                                        Description</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Offer Description" id="offer_description"
                                                        name="offer_description" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="offer_status" class="form-label">
                                                        Offer Status</label>
                                                    <select class="form-control" id="offer_status" name="offer_status">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="countries" class="form-label">Countries</label>
                                                    <select class="select2 form-control" id="countries" multiple name="countries[]"
                                                        required>
                                                        <option value="ALL">All</option>
                                                        @foreach ($countries as $c)
                                                            <option value="{{ $c->COUNTRY_ISO }}">{{ $c->NAME }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="users" class="form-label">Users</label>
                                                    <select class="select2 form-control" id="users" name="users[]" multiple required>
                                                        <option value="NONE" selected>None</option>
                                                        <option value="ALL">All</option>
                                                        @foreach ($users as $u)
                                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                                <div class="mb-3">
                                                    <label for="image_url" class="form-label">Image URL</label>
                                                    <input class="form-control" type="url" placeholder="Enter Image URL" id="image_url" name="image_url" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="hash_code" class="form-label">Hash Code</label>
                                                    <input class="form-control" type="number" placeholder="Enter Hash Code" id="hash_code" name="hash_code" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="hits" class="form-label">Hits</label>
                                                    <input class="form-control" type="number" placeholder="Enter Hits" id="hits" name="hits" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="limit" class="form-label">Limit</label>
                                                    <input class="form-control" type="number" placeholder="Enter Limit" id="limit" name="limit" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="target_url" class="form-label">Target URL</label>
                                                    <input class="form-control" type="url" placeholder="Enter Target URL" id="target_url" name="target_url" required>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="preview_url" class="form-label">Preview URL</label>
                                                    <input class="form-control" type="url" placeholder="Enter Preview URL" id="preview_url" name="preview_url" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="date" class="form-label">Date</label>
                                                    <input class="form-control" type="date" placeholder="Select Date" id="date" name="date" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="mobile" class="form-label">Mobile</label>
                                                    <select class="form-control" id="mobile" name="mobile" required>
                                                        <option value="">Select</option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="offer_name" class="form-label">Offer Name</label>
                                                    <input class="form-control" type="text" placeholder="Offer Name"
                                                        id="network_name" name="offer_name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="credit" class="form-label">Credit</label>
                                                    <input class="form-control" type="text" placeholder="Credit"
                                                        id="credit" name="credit" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="offer_status" class="form-label">
                                                        Network</label>
                                                    <select class="form-control" id="network" name="network">
                                                       
                                                        @foreach ($networks as $nw)
                                                            <option value="{{ $nw->name }}">{{ $nw->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="network_description" class="form-label">Network Short
                                                        Description</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Short Network Description" id="network_description"
                                                        name="network_description" required>
                                                </div>

                                                <div class="mb-3">
                                                    <button class="btn btn-primary" type="submit">Add Network</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mt-3 mt-lg-0">
                                                <h5>FAQ</h5>
                                                <div class="accordion" id="accordionExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                                aria-expanded="true" aria-controls="collapseOne">
                                                                What is Network?
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                                            aria-labelledby="headingOne"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <strong>This network is use to identify the offer.</strong>
                                                                It show the name of our API partner from where our offers
                                                                coming.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                                aria-expanded="false" aria-controls="collapseTwo">
                                                                What should be the name of network?
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwo"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <strong>Naming system of network</strong>
                                                                It is use for Offer Identification so it should be the
                                                                name of the Provider of the Offer API
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                </form>
                            </div>
                        </div>
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
        $('#countries').select2({
            multiple: true,
        });
        $('#users').select2({
            multiple: true,
        });
    </script>
@endsection
