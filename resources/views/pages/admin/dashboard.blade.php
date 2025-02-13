@extends('layouts.admin')
@section('title', 'Dashboard ')

@section('content')


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
                    <div class="col-xl-4 col-md-6">
                        <!-- card -->
                        <div class="card">
                            <h5 class="card-header bg-transparent border-bottom text-uppercase">Balance</h5>
                            <div class="card-body">
                                <div class="balance-item d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="balance-icon purple-bg-light rounded-2 me-2 d-flex align-items-center justify-content-center p-2">
                                            <i class="mdi mdi-cursor-default-click-outline"></i>
                                        </div>
                                        <div class="balance-name">
                                            Clicks
                                        </div>
                                    </div>
                                    <div class="balance-amount">
                                        <strong>46</strong>
                                    </div>
                                </div>
                                <div class="border-bottom my-3"></div>
                                <div class="balance-item d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="balance-icon yellow-bg-light rounded-2 me-2 d-flex align-items-center justify-content-center p-1">
                                            <img src="{{ asset('assets/images/good-conversion-rate.png') }}" alt=""
                                                class="img-fluid">
                                        </div>
                                        <div class="balance-name">
                                            Conversions
                                        </div>
                                    </div>
                                    <div class="balance-amount">
                                        <strong>14</strong>
                                    </div>
                                </div>
                                <div class="border-bottom my-3"></div>
                                <div class="balance-item d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="balance-icon purple-bg-light rounded-2 me-2 d-flex align-items-center justify-content-center p-2">
                                            <i class="far fa-money-bill-alt"></i>
                                        </div>
                                        <div class="balance-name">
                                            Earnings
                                        </div>
                                    </div>
                                    <div class="balance-amount">
                                        <strong>$0.02600</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6">
                        <!-- card -->
                        <div class="card">
                            <h5 class="card-header bg-transparent border-bottom text-uppercase">Offers/ Survey</h5>
                            <div class="card-body">
                                <div class="balance-item d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="balance-icon purple-bg-light rounded-2 me-2 d-flex align-items-center justify-content-center p-2">
                                            <i class="mdi mdi-cursor-default-click-outline"></i>
                                        </div>
                                        <div class="balance-name">
                                            Clicks
                                        </div>
                                    </div>
                                    <div class="balance-amount">
                                        <strong>46</strong>
                                    </div>
                                </div>
                                <div class="border-bottom my-3"></div>
                                <div class="balance-item d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="balance-icon yellow-bg-light rounded-2 me-2 d-flex align-items-center justify-content-center p-1">
                                            <img src="{{ asset('assets/images/good-conversion-rate.png') }}" alt=""
                                                class="img-fluid">
                                        </div>
                                        <div class="balance-name">
                                            Conversions
                                        </div>
                                    </div>
                                    <div class="balance-amount">
                                        <strong>14</strong>
                                    </div>
                                </div>
                                <div class="border-bottom my-3"></div>
                                <div class="balance-item d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="balance-icon purple-bg-light rounded-2 me-2 d-flex align-items-center justify-content-center p-2">
                                            <i class="far fa-money-bill-alt"></i>
                                        </div>
                                        <div class="balance-name">
                                            Earnings
                                        </div>
                                    </div>
                                    <div class="balance-amount">
                                        <strong>$0.02600</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-->

                    <div class="col-xl-4 col-md-6">
                        <!-- card -->
                        <div class="card">
                            <h5 class="card-header bg-transparent border-bottom text-uppercase">PTC</h5>
                            <div class="card-body">
                                <div class="balance-item d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="balance-icon purple-bg-light rounded-2 me-2 d-flex align-items-center justify-content-center p-2">
                                            <i class="mdi mdi-cursor-default-click-outline"></i>
                                        </div>
                                        <div class="balance-name">
                                            Clicks
                                        </div>
                                    </div>
                                    <div class="balance-amount">
                                        <strong>46</strong>
                                    </div>
                                </div>
                                <div class="border-bottom my-3"></div>
                                <div class="balance-item d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="balance-icon yellow-bg-light rounded-2 me-2 d-flex align-items-center justify-content-center p-1">
                                            <img src="{{ asset('assets/images/good-conversion-rate.png') }}" alt=""
                                                class="img-fluid">
                                        </div>
                                        <div class="balance-name">
                                            Conversions
                                        </div>
                                    </div>
                                    <div class="balance-amount">
                                        <strong>14</strong>
                                    </div>
                                </div>
                                <div class="border-bottom my-3"></div>
                                <div class="balance-item d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="balance-icon purple-bg-light rounded-2 me-2 d-flex align-items-center justify-content-center p-2">
                                            <i class="far fa-money-bill-alt"></i>
                                        </div>
                                        <div class="balance-name">
                                            Earnings
                                        </div>
                                    </div>
                                    <div class="balance-amount">
                                        <strong>$0.02600</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end row-->
            </div>
            
        </div>
        

    </div>
    


    @include('dashboard.components.footer')
    </div>
    
@endsection
