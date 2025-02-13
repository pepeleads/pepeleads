@extends('layouts.admin')
@section('title', 'All leads ')

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
                            <h4 class="mb-sm-0 font-size-18">All Leads</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Leads</a></li>
                                    <li class="breadcrumb-item active">All Leads</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-success" id="bulk-complete"><i class="fa fa-check"></i> Bulk Complete</button>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                  <div class="tavle-responsive">
                                      <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                          <thead>
                                              <tr>
                                                  {{-- <th><input type="checkbox" name="checkAll" id="checkAll"></th> --}}
                                                  <th><input type="checkbox" id="select-all"></th>
                                                  <th>ID</th>
                                                  <th>CAMPAIGN ID</th>
                                                  <th>CAMPAIGN NAME</th>
                                                  <th>IP ADDRESS</th>
                                                  <th>DATE</th>
                                                  <th>STATUS</th>
                                                  <th>AFFILIATE ID</th>
                                                  <th>AFFILIATE</th>
                                                  <th>Credit</th>
                                                  <th>PAYOUT</th>
                                                  <th>NETWORK</th>
                                                  <th>HASH</th>
                                                  <th>COUNTRY</th>
                                                  {{-- <th>Action</th> --}}
                                                  
                                              </tr>
                                          </thead>
                                          <tbody>
                                                   @foreach($offers as $offer)
                                                      <tr>
                                                          <td><input type="checkbox" class="lead-checkbox" value="{{ $offer->id }}"></td>
                                                       
                                                          <td>{{ @$offer->id }}</td>
                                                          <td>{{ @$offer->campaign_id }}</td>
                                                          <td>{{ @$offer->offer_name }}</td>
                                                          <td>{{ @$offer->start_ip }}</td>
                                                          <td>{{ @$offer->date }}</td>
                                                          <td>{{ @$offer->status }}</td>
                                                          <td>{{ @$offer->offer_id }}</td>
                                                          <td>{{ @$offer->user_id }}</td>
                                                          <td>{{ @$offer->credit }}</td>
                                                          <td>{{ @$offer->ref_credit }}</td>
                                                          <td>{{ @$offer->network }}</td>
                                                          <td>{{ @$offer->hash_code }}</td>
                                                          <td>{{ @$offer->offer->countries }}</td>
                                                          {{-- <td><button class="btn btn-primary">Mark Complete</button></td> --}}
                                                          
                                                      </tr>
                                                   @endforeach
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
    <script>
        $('#datatable').DataTable();

        $(document).on('click', '.view_password', function() {
            $('.password_' + $(this).data('id')).attr('type', 'text');
            $(this).addClass('hide_password');
            $(this).removeClass('view_password');
            $(this).html('<i class="mdi mdi-eye-off-outline"></i>')
        })

        $(document).on('click', '.hide_password', function() {
            $('.password_' + $(this).data('id')).attr('type', 'password');
            $(this).addClass('view_password');
            $(this).removeClass('hide_password');
            $(this).html('<i class="mdi mdi-eye-outline"></i>')
            // alert($(this).data('id'))
        });

         // Select all functionality
         $('#select-all').on('click', function() {
            $('.lead-checkbox').prop('checked', $(this).prop('checked'));
        });

        // Bulk complete functionality 
        $('#bulk-complete').on('click', function() {
            var selectedLeads = [];
            
            $('.lead-checkbox:checked').each(function() {
                selectedLeads.push($(this).val());
            });

            if(selectedLeads.length === 0) {
                alert('Please select at least one lead to complete');
                return;
            }

            if(confirm('Are you sure you want to mark complete the selected leads?')) {
                $.ajax({
                    url: '/admin/complete-leads',
                    type: 'POST',
                    data: {
                        leads: selectedLeads,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.success) {
                            alert('Selected leads have been completed successfully');
                            location.reload();
                        } else {
                            alert('Error reversing leads. Please try again.');
                        }
                    },
                    error: function() {
                        alert('Error reversing leads. Please try again.');
                    }
                });
            }
        });
    </script>
@endsection
