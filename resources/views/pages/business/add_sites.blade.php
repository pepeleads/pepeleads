@extends('layouts.horizontal_layout_client')
@section('title', 'Add Site ')

@section('content')
<div class="main-content">
    <div class="page-content ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Create Site</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Sites</a></li>
                                <li class="breadcrumb-item active">Create Site</li>
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
                                    <form action="{{ url('add_site') }}" method="POST">
                                        @csrf
                                        <div>
                                            <div class="mb-3">
                                                <label for="site_name" class="form-label">Site Name</label>
                                                <input class="form-control" type="text" value="" placeholder="Site Name"
                                                    name="site_name" id="site_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="domain_name" class="form-label">Site
                                                    Domain</label>
                                                <input class="form-control" type="text" placeholder="Site Domain"
                                                    id="domain_name" name="domain_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="post_back_link" class="form-label">Postback</label>
                                                <input class="form-control" type="text" name="post_back_link"
                                                    id="post_back_link" placeholder="https://" required>
                                            </div>
                                            {{-- <div class="mb-3">
                                                <label for="virtual_currency" class="form-label">Offerwall Virtual
                                                    Currency</label>
                                                <input class="form-control" type="text" 
                                                    placeholder="e.g. Points, credits" id="virtual_currency" name="virtual_currency"  required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="currency_value" class="form-label">Offerwall Currency
                                                    multiplier</label>
                                                <input class="form-control" type="tel" placeholder="value per $1"
                                                    id="currency_value" name="currency_value" required>
                                            </div> --}}
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <input class="form-control" type="text" placeholder="Short Description"
                                                    id="description" name="description" required>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" type="submit">Add Website</button> <a href="/postback_integrations" target="_blank"> <button class="btn btn-primary ml-2" type="button" >Postback Documentation</button> </a>
                                            </div>
                                        </div>
                                    </form>
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
                                                            What is this Site?
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <strong>This is the site that needs to be added before applying for the offer.</strong> It is shown by default until the offer is applied.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            How does Postback work and is there any Documentation?
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <strong>The postback has some parameters that need to be passed in the offer link, and you will receive them back in your postback.</strong> It is hidden by default until the offer is applied.
                                                            To read the documentation, <a target="_blank" href="/postback_integrations">click here</a>.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingThree">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                            aria-expanded="false" aria-controls="collapseThree">
                                                            Is there any API to fetch available Offers?
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThree" class="accordion-collapse collapse"
                                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <strong>Yes, once your site is approved, you can request some offers and use the APIs.</strong> 
                                                            You will receive API keys to use the API. It is hidden by default until you click on the Eye button. 
                                                            If you want to read the API documentation, <a target="_blank" href="/api_integrations">click here</a>.
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