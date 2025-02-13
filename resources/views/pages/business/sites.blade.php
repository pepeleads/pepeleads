@extends('layouts.horizontal_layout_client')
@section('title','Sites ')

@section('content')

    <div class="main-content ">

        <div class="page-content ">
           
            <div class="container-fluid">

                
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="/sites/add">
                            <button type="button"
                                class="btn btn-primary btn-lg waves-effect waves-light d-flex align-items-center">Add
                                New Sites <i class="bx bx-plus ms-2"></i></button>
                            </a>
                        </div>
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">ManageSites</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sites</a></li>
                                    <li class="breadcrumb-item active">Sites</li>
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
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>API Key</th>
                                            <th>Secret Key</th>
                                            <th>Status</th>
                                            {{-- <th>Earned</th> --}}
                                            <th>Actions</th>
                                        </tr>
                                    </thead>


                                    <tbody>
@php
    $i=1;
@endphp
                                        @foreach($sites as $site)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$site->site_name}}</td>
                                            <td>{{$site->created_at}}</td>
                                            <td>{{$site->api_key}}</td>
                                            <td>
                                                <div class="input-group auth-pass-inputgroup">
                                                <input class="password_{{ $site->id }}" type="password" value="{{$site->secret_key}}" class="form-control">
                                                <button class="btn btn-light shadow-none ms-0 view_password" type="button" data-id="{{ $site->id }}"><i class="mdi mdi-eye-outline"></i></button>
                  
                                            </div>
                                        </td>
                                            <td>@if($site->status==0) Pending @elseif($site->status==1) Approved @endif</td>
                                            {{-- <td>$0</td> --}}
                                            <td>
                                                <a href="/sites/edit/{{ Crypt::encrypt($site->id) }}"><i class="fa fa-edit"></i>Edit</a>
                                                <button class="btn btn-sm btn-info ms-2" onclick="openPostbackTest('{{ $site->id }}', '{{ $site->post_back }}')">
                                                    <i class="fa fa-paper-plane"></i> Test Postback
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        {{-- <tr>
                                            <td>2</td>
                                            <td>Dishant kapoort</td>
                                            <td>12 may 2021</td>
                                            <td>jhgfcg7hbgvh876jhjg</td>
                                            <td>********</td>
                                            <td>Completed</td>
                                            <td>$80</td>
                                            <td>edit</td>
                                        </tr> --}}

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> 
                </div> 

                
            </div> 
        
        </div>
        


        @include('dashboard.components.footer')
    </div>

   <div class="modal fade" id="postbackTestModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title">Test Postback URL</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <div class="mb-3">
                   <label class="form-label">Postback URL</label>
                   <input type="text" class="form-control" id="postbackUrl" readonly>
               </div>
               <div class="mb-3">
                <label class="form-label">You have to pass Parameter in Offer URL</label>
                <pre  class="d-flex mb-0">https://pepeleads.com/offer?oid=our_offer_id&transaction_id=[transaction_id]&status=[status]&reward=[reward]<code>&</code>currency=[currency]&sid1=[sid1]&sid2=[sid2]&sid3=[sid3]&sid4=[sid4]</pre>
               </div>
               <div class="mb-3">
                   <label class="form-label">Test Parameters</label>
                   <input type="text" class="form-control" id="testParams" placeholder="transaction_id=[transaction_id]&status=[status]">
               </div>
               <div class="mb-3">
                   <label class="form-label">Response</label>
                   <textarea class="form-control" id="postbackResponse" rows="4" readonly></textarea>
               </div>
               
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary" onclick="testPostback()">Test</button>
           </div>
           <div class="card">
            <div class="card-body overflow-y table-responsive">
                <table id="datatabl_integration" class="table table-bordered dt-responsive table-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>S no.</th>
                            <th>Name</th>
                            <th>Short Code</th>
                            <th>description</th>
                            <th>Expected Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Transaction ID</td>
                            <td>
                                <pre><code>[</code>transaction_id<code>]</code></pre>
                            </td>
                            <td>Unique Transaction ID </td>
                            <td>10fg4ab4-10f8-4257-c368-3aba849d7e2b</td>
                            
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Status</td>
                            <td>
                                <pre><code>[</code>status<code>]</code></pre>
                            </td>
                            <td>For Status</td>
                            <td>1= Complete<br> 0= Incomplete</td>
                            
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Reward</td>
                            <td>
                                <pre><code>[</code>reward<code>]</code></pre>
                            </td>
                            <td>Reward as per added in Sites Section</td>
                            <td>0.1</td>
                            
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>Currency</td>
                            <td>
                                <pre><code>[</code>currency<code>]</code></pre>
                            </td>
                            <td>Currency as per added in Sites Section</td>
                            <td>POINTS or USD</td>
                            
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>SID 1</td>
                            <td>
                                <pre><code>[</code>sid1<code>]</code></pre>
                            </td>
                            <td>SID 1 </td>
                            <td>anything (Client Side)</td>
                            
                        </tr>

                        <tr>
                            <td>6</td>
                            <td>SID 2</td>
                            <td>
                                <pre><code>[</code>sid2<code>]</code></pre>
                            </td>
                            <td>SID 2 </td>
                            <td>anything (Client Side)</td>
                            
                        </tr>

                        <tr>
                            <td>7</td>
                            <td>SID 3</td>
                            <td>
                                <pre><code>[</code>sid3<code>]</code></pre>
                            </td>
                            <td>SID 3 </td>
                            <td>anything (Client Side)</td>
                            
                        </tr>

                        <tr>
                            <td>8</td>
                            <td>SID 4</td>
                            <td>
                                <pre><code>[</code>sid4<code>]</code></pre>
                            </td>
                            <td>SID 4 </td>
                            <td>anything (Client Side)</td>
                            
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
       </div>
   </div>
</div>
    
@endsection


@section('scripts')
    <script>
        $('#datatable').DataTable();
        $('#datatabl_integration').DataTable();

        $(document).on('click','.view_password', function(){
            $('.password_'+$(this).data('id')).attr('type','text');
            $(this).addClass('hide_password');
            $(this).removeClass('view_password');
            $(this).html('<i class="mdi mdi-eye-off-outline"></i>')
        })

        $(document).on('click','.hide_password', function(){
            $('.password_'+$(this).data('id')).attr('type','password');
            $(this).addClass('view_password');
            $(this).removeClass('hide_password');
            $(this).html('<i class="mdi mdi-eye-outline"></i>')
            // alert($(this).data('id'))
        })

        function openPostbackTest(siteId, postbackUrl) {
       $('#postbackUrl').val(postbackUrl);
       $('#postbackResponse').val('');
       $('#testParams').val('');
       $('#postbackTestModal').modal('show');
   }
    function testPostback() {
       const url = $('#postbackUrl').val();
       const params = $('#testParams').val();
       const fullUrl = params ? `${url}?${params}` : url;
       
       $('#postbackResponse').val('Testing...');
       
       fetch(fullUrl)
           .then(response => response.text())
           .then(data => {
               $('#postbackResponse').val(data);
           })
           .catch(error => {
               $('#postbackResponse').val('Error: ' + error.message);
           });
   }
    </script>
@endsection
