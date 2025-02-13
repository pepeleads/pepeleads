@extends('layouts.horizontal_layout_client')
@section('title', 'Active offers')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
              @if (count($sites) > 0)
                <!-- Page Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Active Offers</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Offers</a></li>
                                    <li class="breadcrumb-item active">Active Offers</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="target">Categories:</label>
                        <select id="filter-category" class="form-control select2" multiple="multiple">
                            <!-- Populate categories dynamically -->
                            @foreach ($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Allowed Media Dropdown -->
                    <div class="col-lg-3">
                        <label for="allowed-media">Allowed Media:</label>
                        <select id="allowed-media" name="allowed-media" class="form-control select2" multiple="multiple">
                            <option value="banner text link">Banner / Text Link Traffic</option>
                            <option value="contextual traffic">Contextual Traffic</option>
                            <option value="email">Email</option>
                            <option value="free social media">Free Social Media</option>
                            <option value="native push">Native/Push</option>
                            <option value="path linkout">Path / Linkout Traffic</option>
                            <option value="seo pages">Search Engine Optimized Pages</option>
                            <option value="video ads">Video Ads</option>
                            <option value="mobile">Mobile</option>
                            <option value="desktop web">Desktop / Web</option>
                        </select>
                    </div>

                    <div class="col-lg-3">
                        <label for="target">Device:</label>
                        <select id="filter-os" class="form-control select2" multiple="multiple">
                            <option value="web-and-mobile">Web & Mobile</option>
                            <option value="web">Web</option>
                            <option value="mobile">Mobile</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="target">Country:</label>
                        <select id="countries" class="form-control select2" multiple="multiple">
                            <option value="all">All</option>
                            @foreach ($isoCountries as $country)
                                <option value="{{ $country->COUNTRY_ISO }}">{{ $country->NAME }}</option>
                            @endforeach
                        </select>
                        </div>
                    
                </div>


                <div class="row mb-3">
                        

                        <!-- Traffic Types Permitted Dropdown -->
                        <div class="col-lg-4">
                        <label for="traffic-types">Traffic Types Permitted:</label>
                        <select id="traffic-types" name="traffic-types" class="form-control select2" multiple="multiple">
                            <option value="incent">Incent</option>
                            <option value="non incent">Non-Incent</option>
                            <option value="web mobile">Web and Mobile</option>
                            <option value="desktop only">Desktop Only</option>
                            <option value="android 9 plus">Android 9+ (or specified version)</option>
                            <option value="ios 12 plus">iOS 12+ (or specified version)</option>
                            <option value="chrome only">Chrome Only</option>
                            <option value="daytime only est">Day Time Only EST</option>
                            <option value="weekend traffic allowed">Weekend Traffic Allowed</option>
                        </select>
                        </div>

                        <!-- Target Dropdown -->
                        <div class="col-lg-4">
                        <label for="target">Target:</label>
                        <select id="target" name="target" class="form-control select2" multiple="multiple">
                            <option value="us only">US Only</option>
                            <option value="18 plus">18+</option>
                            <option value="specific audiences">Specific Audiences (e.g., Managers+ in specific industries)</option>
                        </select>
                        </div>

                        <!-- Conversion Type Dropdown -->
                        <div class="col-lg-4">
                        <label for="conversion-type">Conversion Type:</label>
                        <select id="conversion-type" name="conversion-type" class="form-control select2" multiple="multiple">
                            <option value="single opt in">Single Opt-in</option>
                            <option value="leadg eneration">Lead Generation</option>
                            <option value="purchase">Purchase</option>
                        </select>
                        </div>
                </div>



                <!-- DataTable -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="form-check-input check-all"></th>
                                            <th>ID</th>
                                            <th>Icon</th>
                                            <th>Preview</th>
                                            <th>Name</th>
                                            <th>Payout</th>
                                            <th>Locations</th>
                                            <th>Operating System</th>
                                            <th>Categories</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="offers-table-body">
                                        <!-- Rendered by DataTable -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @else 
                   @include('pages.business.sections.no_permission')
                @endif
            </div>
        </div>
        @include('dashboard.components.popup')
        @include('dashboard.components.footer')
    </div>

    <script>
        // $(document).ready(function() {
        // Initialize DataTable with server-side processing
        $('.select2').select2({
            placeholder: "Select an option to filter",
            allowClear: true
        });
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10, // Default number of rows per page
            lengthMenu: [
                [10, 25, 50, 100, 500, 1000],
                [10, 25, 50, 100, 500, 1000]
            ], // Page length options
            ajax: {
                url: '{{ route('offers.data_active') }}',
                data: function(d) {
                    d.category = $('#filter-category').val();
                    d.target = $('#filter-target').val();
                    d.os = $('#filter-os').val();
                    d.countries = $('#countries').val();
                    d.traffic_types= $('#traffic-types').val();
                    d.allowed_media = $('#allowed-media').val();
                    d.conversion_type = $('#conversion-type').val();
                    d.user_id= '{{ Auth::user()->id }}';

                }
            },
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'offer_id',
                    name: 'offer_id'
                },
                {
                    data: 'icon',
                    name: 'icon'
                },
                {
                    data: 'preview',
                    name: 'preview'
                },
                {
                    data: 'name',
                    name: 'name',
                    render: function(data, type, row) {
                        return `<a href="/offer_details/${btoa(row?.offer_id)}" class="view_details">${data}</a>`;
                    }
                },
                
                {
                    data: 'payout',
                    name: 'payout'
                },
                {
                    data: 'locations',
                    name: 'locations'
                },
                {
                    data: 'os',
                    name: 'os'
                },
                {
                    data: 'categories',
                    name: 'categories'
                },
                {
                    name: 'action',
                    data:'action',
                    render: function(data, type, row) {
                        return ` <td><a href="/request/offer-delete/${btoa(row?.oid)}" ><button class="btn btn-danger">Delete Offer</button></a></td>`;
                    }
                }
            ]
        });

        // Apply filter
        $('#filter-category, #filter-target, #filter-os, #countries, #traffic-types, #allowed-media, #conversion-type ').change(function() {
            table.draw();
        });
        // });
    </script>
@endsection
