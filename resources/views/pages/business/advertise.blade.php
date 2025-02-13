@extends('layouts.horizontal_layout_client')
@section('title','Finance ')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button"
                                class="btn btn-primary btn-lg waves-effect waves-light d-flex align-items-center">Add
                                Advertisment <i class="bx bx-plus ms-2"></i></button>
                        </div>
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Manage Ads</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Advertise</a></li>
                                    <li class="breadcrumb-item active">Advertise</li>
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
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>CPV</th>
                                            <th>Views</th>
                                            <th>Budget</th>
                                            <th>Spent</th>
                                            <th>Paid</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <tr>
                                            <td>Dishant kapoort</td>
                                            <td>12 may 2021</td>
                                            <td>mnhbg</td>
                                            <td>Views</td>
                                            <td>80,000</td>
                                            <td>$80</td>
                                            <td>Yes</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> 
                </div> 

                
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Create PTC</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Advertise</a></li>
                                    <li class="breadcrumb-item active">Create PTC</li>
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
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">PTC Name</label>
                                                <input class="form-control" type="text" value=""
                                                    placeholder="Enter PTC Name" id="example-text-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-search-input" class="form-label">PTC
                                                    Description</label>
                                                <input class="form-control" type="search"
                                                    placeholder="Enter PTC Description" id="example-search-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-email-input" class="form-label">URL</label>
                                                <input class="form-control" type="text" id="example-email-input"
                                                    placeholder="https://www.example.com">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Views</label>
                                                <input class="form-control" type="url" placeholder="1000"
                                                    id="example-url-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-tel-input" class="form-label">Duration</label>
                                                <div class="mb-3">
                                                    <select class="form-control" data-trigger
                                                        name="choices-single-default" id="all-sites"
                                                        placeholder="This is a search placeholder">
                                                        <option value="">All Sites</option>
                                                        <option value="Choice 1">Choice 1</option>
                                                        <option value="Choice 2">Choice 2</option>
                                                        <option value="Choice 3">Choice 3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mt-3 mt-lg-0">
                                            <h5>FAQs</h5>
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            Accordion Item #1
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingOne"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <strong>This is the first item's accordion
                                                                body.</strong> It is shown by default, until the
                                                            collapse plugin adds the appropriate classes that we use
                                                            to style each element. These classes control the overall
                                                            appearance, as well as the showing and hiding via CSS
                                                            transitions. You can modify any of this with custom CSS
                                                            or overriding our default variables. It's also worth
                                                            noting that just about any HTML can go within the
                                                            <code>.accordion-body</code>, though the transition does
                                                            limit overflow.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            Accordion Item #2
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <strong>This is the second item's accordion
                                                                body.</strong> It is hidden by default, until the
                                                            collapse plugin adds the appropriate classes that we use
                                                            to style each element. These classes control the overall
                                                            appearance, as well as the showing and hiding via CSS
                                                            transitions. You can modify any of this with custom CSS
                                                            or overriding our default variables. It's also worth
                                                            noting that just about any HTML can go within the
                                                            <code>.accordion-body</code>, though the transition does
                                                            limit overflow.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThree" aria-expanded="false"
                                                            aria-controls="collapseThree">
                                                            Accordion Item #3
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThree" class="accordion-collapse collapse"
                                                        aria-labelledby="headingThree"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <strong>This is the third item's accordion
                                                                body.</strong> It is hidden by default, until the
                                                            collapse plugin adds the appropriate classes that we use
                                                            to style each element. These classes control the overall
                                                            appearance, as well as the showing and hiding via CSS
                                                            transitions. You can modify any of this with custom CSS
                                                            or overriding our default variables. It's also worth
                                                            noting that just about any HTML can go within the
                                                            <code>.accordion-body</code>, though the transition does
                                                            limit overflow.
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
