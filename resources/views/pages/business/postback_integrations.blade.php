@extends('layouts.horizontal_layout_client')
@section('title','Postback ')

@section('content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Postback</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Integrations</a></li>
                                <li class="breadcrumb-item active">Postback</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h5 class="font-size-14 mb-3">Postback Example</h5>
                                <div class="row">
                                    <div class="col-12">
                                        <label>Our Offer URL</label>
                                        <p>You can pass parameters that will be transfered to your postback</p>
                                        <div class="add-on-item d-flex">
                                            <pre
                                                class="d-flex mb-0">https://pepeleads.com/offer?oid=our_offer_id&transaction_id=[transaction_id]&<code>&</code>sid1=[sid1]&sid2=[sid2]&sid3=[sid3]&sid4=[sid4]</pre>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="mt-4">Your Postback URL</label>
                                        <p>This is how you will get parameters in your postback</p>
                                        <div class="add-on-item d-flex">
                                            <pre
                                                class="d-flex mb-0">https://yourwebsite.com/postback_url?transaction_id=[transaction_id]&status=[status]&reward=[reward]<code>&</code>currency=[currency]&sid1=[sid1]&sid2=[sid2]&sid3=[sid3]&sid4=[sid4]</pre>
                                        </div>
                                    </div>
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
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S no.</th>
                                        <th>Name</th>
                                        <th>Short Code</th>
                                        <th>description</th>
                                        <th>Expected Value</th>
                                        <th>Required</th>
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
                                        <td>Required</td>
                                    </tr>
        
                                    <tr>
                                        <td>2</td>
                                        <td>Status</td>
                                        <td>
                                            <pre><code>[</code>status<code>]</code></pre>
                                        </td>
                                        <td>For Status</td>
                                        <td>1= Complete<br> 0= Incomplete</td>
                                        <td>Required</td>
                                    </tr>
        
                                    <tr>
                                        <td>3</td>
                                        <td>Reward</td>
                                        <td>
                                            <pre><code>[</code>reward<code>]</code></pre>
                                        </td>
                                        <td>Reward as per added in Sites Section</td>
                                        <td>0.1</td>
                                        <td>Required</td>
                                    </tr>
        
                                    <tr>
                                        <td>4</td>
                                        <td>Currency</td>
                                        <td>
                                            <pre><code>[</code>currency<code>]</code></pre>
                                        </td>
                                        <td>Currency as per added in Sites Section</td>
                                        <td>POINTS or USD</td>
                                        <td>Required</td>
                                    </tr>
        
                                    <tr>
                                        <td>5</td>
                                        <td>SID 1</td>
                                        <td>
                                            <pre><code>[</code>sid1<code>]</code></pre>
                                        </td>
                                        <td>SID 1 </td>
                                        <td>anything (Client Side)</td>
                                        <td>Optional</td>
                                    </tr>
        
                                    <tr>
                                        <td>6</td>
                                        <td>SID 2</td>
                                        <td>
                                            <pre><code>[</code>sid2<code>]</code></pre>
                                        </td>
                                        <td>SID 2 </td>
                                        <td>anything (Client Side)</td>
                                        <td>Optional</td>
                                    </tr>
        
                                    <tr>
                                        <td>7</td>
                                        <td>SID 3</td>
                                        <td>
                                            <pre><code>[</code>sid3<code>]</code></pre>
                                        </td>
                                        <td>SID 3 </td>
                                        <td>anything (Client Side)</td>
                                        <td>Optional</td>
                                    </tr>
        
                                    <tr>
                                        <td>8</td>
                                        <td>SID 4</td>
                                        <td>
                                            <pre><code>[</code>sid4<code>]</code></pre>
                                        </td>
                                        <td>SID 4 </td>
                                        <td>anything (Client Side)</td>
                                        <td>Optional</td>
                                    </tr>
        
        
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

@endsection


@section('scripts')
<script>
  $('#datatable').DataTable();
</script>
@endsection

