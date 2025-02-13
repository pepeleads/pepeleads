@extends('layouts.admin')
@section('title','Add Network ')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                
                
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Add Network</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Network</a></li>
                                    <li class="breadcrumb-item active">Add Network</li>
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
                                    <div class="col-lg-8">
                                        <div>
                                            <form action="/admin/add_network" method="post">
                                                @csrf
                                            <div class="mb-3">
                                                <label for="network_name" class="form-label">Network Name</label>
                                                <input class="form-control" type="text"
                                                    placeholder="Network Name" id="network_name" name="network_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="network_status" class="form-label">
                                                    Network Status</label>
                                                <select class="form-control" id="network_status" name="network_status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="network_description" class="form-label">Network Short Description</label>
                                                <input class="form-control" type="text"
                                                    placeholder="Short Network Description" id="network_description" name="network_description" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="network_key" class="form-label">Network Key for UUID</label>
                                                <input class="form-control" type="text"
                                                    placeholder="Add Key without space" id="network_key" name="network_key" required>
                                            </div>
                                           
                                            <div class="mb-3">
                                                <button class="btn btn-primary" type="submit">Add Network</button>
                                            </div>
                                            </form>
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
                                                            It show the name of our API partner from where our offers coming.
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
    </script>
@endsection
