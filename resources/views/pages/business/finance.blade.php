@extends('layouts.horizontal_layout_client')
@section('title','Finance ')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h5 class="font-size-14 mb-3">Finances</h5>
                    </div>
                    <div class="col-lg-4">
                        <div class="card d-flex align-items-center justify-content-center py-5 purple-bg">
                            <h2 class="mb-3 text-white">${{ auth()->user()->balance }}</h2>
                            <p class="mb-0 text-white">Available Balance</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card d-flex align-items-center justify-content-center py-5 purple-bg">
                            <h2 class="mb-3 text-white">$0</h2>
                            <p class="mb-0 text-white">Pending Withdraw</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card d-flex align-items-center justify-content-center py-5 purple-bg">
                            <h2 class="mb-3 text-white">$0</h2>
                            <p class="mb-0 text-white">Total Withdrawn</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h5 class="font-size-14 mb-3">Payment Method</h5>
                                    <div class="row">
                                        <form method="post" action="/add_payment_details">
                                            @csrf
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <select class="form-control" data-trigger
                                                    name="payment_type" id="payment_type"

                                                    placeholder="This is a search placeholder" required>
                                                    <option value="bank_transfer">Bank Transfer</option>
                                                    <option value="paypal">Paypal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="mb-3">
                                                <input class="form-control" name="payment_details" @if($status) value="{{ $details->details}}" @endif type="text" id="payment_details"
                                                    placeholder="Payment Details" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-6">
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary w-100">save</button>
                                            </div>
                                        </div>

                                        </form>

                                    </div>
                                    
                                </div>

                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h5 class="font-size-14 mb-3">Transactions</h5>
                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th>Payment Method</th>
                                                <th>Payment Details</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            {{-- <tr>
                                                <td>1876567</td>
                                                <td>12 may 2021</td>
                                                <td>Completed</td>
                                                <td>1500/-</td>
                                                <td>Online</td>
                                                <td>ICICI bank</td>
                                            </tr> --}}


                                        </tbody>
                                    </table>
                                    
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

@if(session('status'))
<script>

alert("{{ session('status')}}");
// Swal.fire({title:"{{ session('status')}}",confirmButtonColor:"#ff8b00"})

</script>
@endif

    <script>
        $('#datatable').DataTable();
    </script>
@endsection
