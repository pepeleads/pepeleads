@extends('layouts.horizontal_layout_client')
@section('title','Report ')@section('content')<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
          @if (count($sites) > 0)
        <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S no.</th>
                                        <th>Offer name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>IP</th>
                                        <th>Country</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($listCompleted as $key => $offer)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $offer->offer_name }}</td>
                                        <td>{{ $offer->date }}</td>
                                        <td>
                                            @if($offer->status == 'completed')
                                                <button class="btn btn-success waves-effect btn-label waves-light"><i class="bx bx-check-double label-icon"></i> Completed</button>
                                            @else
                                            <button type="button" class="btn btn-danger waves-effect btn-label waves-light" fdprocessedid="6icgbz"><i class="bx bx-block label-icon"></i> Reversed</button>
                                               
                                            @endif
                                        </td>
                                        <td>{{ $offer->start_ip }}</td>
                                        <td>{{ $offer->start_country }}</td>
                                        <td>$ {{ $offer->ref_credit }}</td>
                                        <td>
                                            <a href="#" data-details="{{ base64_encode(json_encode($offer)) }}" class="btn btn-primary btn-sm view_details">View More Details</a>
                                        </td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            @include('pages.business.sections.no_permission')
        @endif
    </div>
    @include('dashboard.components.footer')
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Detail View</h5>
                <button type="button" class="close" onclick="closeModal()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody id="table_items">
                       
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$('#datatable').DataTable();

$('.view_details').on('click', function() {
    var offerName = $(this).data('details');
   

    let details = JSON.parse(atob(offerName));
    console.log(details);   
    let notIncludes=['network','credit','source','created_at','updated_at','deleted_at','api_key','site_id','ref_credit','id','campaign_id','user_id',,'offer_id','hash_code','credit_mode','link_id','unique'];
    let html = '';
    for (const [key, value] of Object.entries(details)) {
        if(notIncludes.includes(key)){
           html+='';
        }else{
            html += `<tr>
                <td>${key}</td>
                <td>${value}</td>
            </tr>`;
        }
    }
    $('#table_items').html(html);

    $('#detailsModal').modal('show');
});

let closeModal = () => {
    $('#detailsModal').modal('hide');
}
</script>
@endsection