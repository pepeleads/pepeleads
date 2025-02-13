@extends('layouts.horizontal_layout_sub_user')
@section('title','Dashboard ')
<link href="https://cdn.jsdelivr.net/gh/StephanWagner/svgMap@v2.7.2/dist/svgMap.min.css" rel="stylesheet">
@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">TOTAL IMPRESSIONS</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="{{ $total_clicks }}">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-3">
                                       <img src="/img/impression-rate.png" height="40" width="40"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                           <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">TOTAL ACTIVE OFFERS</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="{{ $total_active_offers }}">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-3">
                                       <img src="/img/active.png" height="40" width="40"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-->


                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">TOTAL COMPLETED</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="{{ $completed }}">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-3">
                                       <img src="/img/completed.png" height="40" width="40"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                           <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">TOTAL REVENUE</span>
                                        <h4 class="mb-3">
                                            $ <span class="counter-value" data-target="{{ $total_earning }}">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-3">
                                       <img src="/img/increase.png" height="40" width="40"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                <!-- end row-->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">MAP</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <div id="svgMap"></div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="border rounded py-2 px-2">
                                            <h4 class="card-title">Overall</h4>
                                            <p>-{{$totalLifetimeReversed}} $</p>
                                        </div>
                                        <div class="border rounded py-2 px-2 mt-4">
                                            <h4 class="card-title">Last Month</h4>
                                            <p>-{{$lastMonthReversed}} $</p>
                                        </div>
                                        <div class="border rounded py-2 px-2 mt-4">
                                            <h4 class="card-title">Current Month</h4>
                                            <p>-{{$currentMonthReversed}} $</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
                
                <div class="row">
                    <div class="col-xl-12">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center mb-4">
                                    <h5 class="card-title me-2">Recent Notifications</h5>
                                </div>

                                <div class="row align-items-center">
                                    <div class="d-none col-sm">
                                        <div id="wallet-balance" data-colors='["#777aca", "#ff8b00", "#a8aada"]' class="apex-charts"></div>
                                    </div>
                                    <div class="col-sm align-self-center">
                                        <div class="mt-4 mt-sm-0">
                                        @foreach($notification as $notifications)
                                            <div>
                                                <div class="balance-item d-flex justify-content-between align-items-center mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="balance-icon purple-bg-light rounded-2 me-2 d-flex align-items-center justify-content-center p-2">
                                                             <i class="mdi mdi-bell"></i>
                                                        </div>
                                                        <div class="balance-name">
                                                            <h5 class="font-size-14 mb-1">{{ $notifications->notification_title }}</h5>
                                                            <p class="text-muted mb-0">{{ $notifications->notification_description }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="text-sm">
                                                        <strong>{{ $notifications->created_at}}</strong>
                                                    </div>
                                                </div>
                                                <div class="border-bottom my-3"></div>
                                            </div>
                                           
                                        @endforeach
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                 
                    
                </div> 
                <!-- end row-->
                @if(count($sites)>0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Featured Offers</h4>
                            </div>
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Payout</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($latest_offers as $offers)
                                    <tr>
                                        <td>{{ $offers->name }}</td>
                                        <td>{!! $offers->description !!}</td>
                                        <td>@if(is_numeric(($offers->credit))) ${{ (($offers->credit)*($offers?->rate?->rate?->network_rate)/100) }} @else $0 @endif</td>
                                        {{-- <td><a href="/" target="_blank" class="btn btn-primary btn-sm">View</a></td> --}}
                                    </tr>
                                    @endforeach
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
        

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete the selected items?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete the selected items?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>


        @include('dashboard.components.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/svg-pan-zoom@3.6.1/dist/svg-pan-zoom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/StephanWagner/svgMap@v2.7.2/dist/svgMap.min.js"></script>
    <script>
        new svgMap({
            targetElementID: 'svgMap',
            data: {
                data: {
                revenue: {
                    name: 'Revenue',
                    format: '{0} USD',
                    thousandSeparator: ',',
                    thresholdMax: 50000,
                    thresholdMin: 1000
                }
                },
                applyData: 'revenue',
                values: {!!$graphData!!}
            }
        });
    </script>
    
@endsection

