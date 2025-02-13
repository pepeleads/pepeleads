@extends('layouts.admin')
@section('title','Add Postback ')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                
                
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Add Postback</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Postback</a></li>
                                    <li class="breadcrumb-item active">Add Postback</li>
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
                                                <label for="example-text-input" class="form-label">Business Name</label>
                                                <input class="form-control" type="text" value=""
                                                    placeholder="Business Name" id="example-text-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-search-input" class="form-label">Business
                                                    Domain</label>
                                                <input class="form-control" type="search" placeholder="Business Domain"
                                                    id="example-search-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-email-input" class="form-label">Postback</label>
                                                <input class="form-control" type="text" id="example-email-input"
                                                    placeholder="Postback">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-url-input" class="form-label">Offerwall Virtual
                                                    Currency</label>
                                                <input class="form-control" type="url"
                                                    placeholder="e.g. Points, credits" id="example-url-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-tel-input" class="form-label">Offerwall Currency
                                                    multiplier</label>
                                                <input class="form-control" type="tel" placeholder="value per $1"
                                                    id="example-tel-input">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-password-input"
                                                    class="form-label">Description</label>
                                                <input class="form-control" type="text" placeholder="Description"
                                                    id="example-password-input">
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
