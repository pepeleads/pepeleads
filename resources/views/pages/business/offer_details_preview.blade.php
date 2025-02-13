@extends('layouts.horizontal_layout_client')
@section('title','Offer Details')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Title and Breadcrumbs -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Offer Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Offers</a></li>
                                <li class="breadcrumb-item active">Offer Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                       <div class="card-header">
                            <h4 class="card-title"><img src="@if(($offer?->image_url == '/img/reward.png')){{$offer?->image_url}}@else/image/{{$offer?->id}}@endif"  height="30px" class="m-3"/>{{ $offer?->name}}</h4>
                            <p class="card-title-desc">{!! $offer?->description!!}</p>
                        </div>

                         <div class="border-top">
                            <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                <h6>Categories</h6>
                                 {{ $offer?->categories}}
                                </div>
                                <div class="col-md-6">
                                  <h6>Targets</h6>
                                {{ $offer?->targets}}
                                </div>
                            </div>
                            </div>
                            <div class="border-top">
                            <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                <h6>Payout</h6>
                                @if(is_numeric($offer?->credit) && is_numeric($offer?->rate?->rate?->network_rate)) 
                                $ {{number_format(($offer?->credit * $offer->rate?->rate?->network_rate) / 100, 4)}}
                                @else
                                 $ 0.00
                                 @endif
                                </div>
                                <div class="col-md-6">
                                  <h6>Countries</h6>
                                {{ $offer?->countries}}
                                </div>
                            </div>
                            </div>
                         </div>

                         @if($show_preview)
                        <div class="card-body p-4">
                            <h4 class="card-title">Request Offer</h4>
                           <a href="/request/offer/{{base64_encode($offer?->id)}}" class="btn btn-primary" >Request Offer</a>
                        </div>
                         @else
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form class="row gx-3 gy-2 align-items-center">
                                        <div class="hstack gap-3">
                                            <input id="itemInput" class="form-control me-auto" type="text" placeholder="Add your item here..." value="{{env('APP_URL').'/offer?oid='.encode_data($offer?->id)}}">
                                            <button type="button" class="btn btn-secondary" onclick="refreshInput()"><i class="fas fa-redo-alt"></i></button>
                                            <button type="button" class="btn btn-secondary" onclick="copyToClipboard()"><i class="fas fa-copy"></i></button>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="shortUrlCheck" onclick="toggleShortUrl()">
                                                <label class="form-check-label text-nowrap" for="shortUrlCheck">Short URL</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    <form class="row gx-3 gy-2 align-items-center">
                                        <div class="hstack gap-3">
                                            <input id="impressionInput" class="form-control me-auto" type="text" placeholder="Add your item here..." value="{{env('APP_URL').'/offer?oid='.encode_data($offer?->id)}}">
                                            <button type="button" class="btn btn-secondary" onclick="refreshImpressionInput()"><i class="fas fa-redo-alt"></i></button>
                                            <button type="button" class="btn btn-secondary" onclick="copyImpressionToClipboard()"><i class="fas fa-copy"></i></button>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="impressionPixelCheck" onclick="toggleImpressionPixel()">
                                                <label class="form-check-label text-nowrap" for="impressionPixelCheck">Impression pixel</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form class="row gx-3 gy-2 align-items-center">
                                        <div class="hstack gap-3">
                                            <input id="itemInput" class="form-control me-auto" type="text" placeholder="Add your item here..." value="{{env('APP_URL').'/offer?oid='.encode_data($offer?->id)}}">
                                            <button type="button" class="btn btn-secondary" onclick="refreshInput()"><i class="fas fa-redo-alt"></i></button>
                                            <button type="button" class="btn btn-secondary" onclick="copyToClipboard()"><i class="fas fa-copy"></i></button>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="shortUrlCheck" onclick="toggleShortUrl()">
                                                <label class="form-check-label text-nowrap" for="shortUrlCheck">Short URL</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    <form class="row gx-3 gy-2 align-items-center">
                                        <div class="hstack gap-3">
                                            <input id="impressionInput" class="form-control me-auto" type="text" placeholder="Add your item here..." value="{{env('APP_URL').'/offer?oid='.encode_data($offer?->id)}}">
                                            <button type="button" class="btn btn-secondary" onclick="refreshImpressionInput()"><i class="fas fa-redo-alt"></i></button>
                                            <button type="button" class="btn btn-secondary" onclick="copyImpressionToClipboard()"><i class="fas fa-copy"></i></button>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="impressionPixelCheck" onclick="toggleImpressionPixel()">
                                                <label class="form-check-label text-nowrap" for="impressionPixelCheck">Impression pixel</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons Section -->
                        <div class="border-top">
                            <div class="card-header">
                                <div class="hstack gap-3">
                                    <label for="trackingLinkInput">Customize Your Tracking Link</label>
                                    <button type="button" class="btn btn-secondary" onclick="toggleSection('affilatedSourceSection')">Add Source</button>
                                    {{-- <button type="button" class="btn btn-danger" onclick="toggleSection('creativeSection')">Add Creative</button> --}}
                                    <button type="button" class="btn btn-success" onclick="toggleSection('subIdsSection')">Add Sub IDs</button>
                                    <button type="button" class="btn btn-warning" onclick="toggleSection('clickIdSection')">Add Click</button>
                                    <button type="button" class="btn btn-info" onclick="toggleSection('uniqueSection')">Add Unique</button>
                                </div>
                            </div>

                            <!-- Hidden Sections -->
                            <div class="card-body p-4 border-top collapse" id="affilatedSourceSection">
                                <h4 class="card-title">Add Affilated Source</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form class="row gx-3 gy-2 align-items-center" id="affilatedSourceBox">
                                            <div class="hstack gap-3">
                                                <input id="affilatedSourceInput" class="form-control me-auto" type="text" placeholder="Add your item here...">
                                                <button type="button" class="btn btn-danger" onclick="addAffilatedSource()">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>You can view data aggregated by non-unique traffic source value in the performance report. This parameter accepts up to 255 standard alphanumeric characters.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-4 border-top collapse" id="creativeSection">
                                <h4 class="card-title">Add Creative</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="row gx-3 gy-2 align-items-center" id="creativeBox">
                                            <div class="hstack gap-3">
                                                <input id="creativeInput" class="form-control me-auto" type="file" placeholder="Add your item here...">
                                                <button type="button" class="btn btn-danger" onclick="addCreative()">Add</button>
                                                <button type="button" class="btn btn-warning">Preview</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-4 border-top collapse" id="subIdsSection">
                                <h4 class="card-title">Add Sub IDs</h4>
                                <p>You can view data aggregated by non-unique sub IDs values(e.g. sub site, keyword, creative) in the performance report. This parameter accepts up to 500 standard alphanumeric characters.</p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="row gx-3 gy-2 align-items-center" id="subIdsBox">
                                            <div class="hstack gap-3">
                                                <div class="gap-3">
                                                    <label>Sub ID 1</label>
                                                    <input id="subId1" class="form-control me-auto" type="text" placeholder="Add your item here...">
                                                </div>
                                                <div class="gap-3">
                                                    <label>Sub ID 2</label>
                                                    <input id="subId2" class="form-control me-auto" type="text" placeholder="Add your item here...">
                                                </div>
                                                <div class="gap-3">
                                                    <label>Sub ID 3</label>
                                                    <input id="subId3" class="form-control me-auto" type="text" placeholder="Add your item here...">
                                                </div>
                                                <div class="gap-3">
                                                    <label>Sub ID 4</label>
                                                    <input id="subId4" class="form-control me-auto" type="text" placeholder="Add your item here...">
                                                </div>
                                                <div class="gap-3">
                                                    <button type="button" class="btn btn-warning" onclick="updateSubIds()">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-4 border-top collapse" id="clickIdSection">
                                <h4 class="card-title">Add Click ID</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form class="row gx-3 gy-2 align-items-center" id="clickIdBox">
                                            <div class="hstack gap-3">
                                                <input id="clickIdInput" class="form-control me-auto" type="text" placeholder="Add your item here...">
                                                <button type="button" class="btn btn-danger" onclick="addClickId()">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>You can use affilated click ID value reference individual clicks across tracking system. This parameter accepts up to 255 standard alphanumeric characters.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-4 border-top collapse" id="uniqueSection">
                                <h4 class="card-title">Add Unique</h4>
                                <p>You can use unique values(e.g. user hashes programmatic API values) to store additional metadata about click user. This parameter accepts up to 250 standard alphanumeric characters each.</p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="row gx-3 gy-2 align-items-center" id="uniqueBox">
                                            <div class="hstack gap-3">
                                                <div class="gap-3">
                                                    <label>Affilate Unique 1</label>
                                                    <input id="unique1" class="form-control me-auto" type="text" placeholder="Add your item here...">
                                                </div>
                                                <div class="gap-3">
                                                    <label>Affilate Unique 2</label>
                                                    <input id="unique2" class="form-control me-auto" type="text" placeholder="Add your item here...">
                                                </div>
                                                <div class="gap-3">
                                                    <label>Affilate Unique 3</label>
                                                    <input id="unique3" class="form-control me-auto" type="text" placeholder="Add your item here...">
                                                </div>
                                                <div class="gap-3">
                                                    <label>Affilate Unique 4</label>
                                                    <input id="unique4" class="form-control me-auto" type="text" placeholder="Add your item here...">
                                                </div>
                                                <div class="gap-3">
                                                    <button type="button" class="btn btn-warning" onclick="updateUnique()">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.components.popup')
    @include('dashboard.components.footer')
</div>


@endsection


@section('scripts')
<script>



   


    

    function refreshInput() {
        document.getElementById('itemInput').value = "{{env('APP_URL').'/offer?oid='.encode_data($offer?->offer_id)}}";
        syncInputs();
    }

    function copyToClipboard() {
        const input = document.getElementById('itemInput');
        input.select();
        input.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand('copy');
        alert('Copied: ' + input.value);
    }

    function toggleShortUrl() {
        const input = document.getElementById('itemInput');
        const checkbox = document.getElementById('shortUrlCheck');

        if (checkbox.checked) {
            // Simulate URL shortening by adding a random short path
            const shortenedUrl = 'https://short.ly/' + Math.random().toString(36).substring(7);
            input.value = shortenedUrl;
            alert('URL shortened to: ' + shortenedUrl);
        } else {
            // Reset to default URL
            input.value = "{{env('APP_URL').'/offer?oid='.encode_data($offer?->offer_id)}}";
        }
        syncInputs();
    }

    function refreshImpressionInput() {
        document.getElementById('impressionInput').value = "{{env('APP_URL').'/offer?oid='.encode_data($offer?->offer_id)}}";
    }

    function copyImpressionToClipboard() {
        const input = document.getElementById('impressionInput');
        input.select();
        input.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand('copy');
        alert('Copied: ' + input.value);
    }

    function toggleImpressionPixel() {
        const input = document.getElementById('impressionInput');
        const checkbox = document.getElementById('impressionPixelCheck');

        if (checkbox.checked) {
            const imageUrl = input.value;
            const imageTag = `<img src="${imageUrl}" alt="Impression Pixel">`;
            input.value = imageTag;
            alert('Converted to Image Tag: ' + imageTag);
        } else {
            // Reset to default URL (or handle the unchecking case as needed)
            input.value = 'https://default-url.com';
        }
    }

    function addAffilatedSource() {
        const input = document.getElementById('affilatedSourceInput').value.trim();
        const itemInput = document.getElementById('itemInput');

        if (input !== '' && input.length <= 255) {
            itemInput.value += '&source=' + input;
            syncInputs();
            alert('Parameter added: ' + input);
            document.getElementById('affilatedSourceInput').value = ''; // Clear the input field
        } else {
            alert('Please enter a valid parameter up to 255 characters.');
        }
    }

    function updateSubIds() {
        const subId1 = document.getElementById('subId1').value.trim();
        const subId2 = document.getElementById('subId2').value.trim();
        const subId3 = document.getElementById('subId3').value.trim();
        const subId4 = document.getElementById('subId4').value.trim();
        const itemInput = document.getElementById('itemInput');

       const allSubIds = [subId1, subId2, subId3, subId4].filter(id => id !== '').join('&sub=');

        if (allSubIds.length <= 500) {
            let subs=[subId1, subId2, subId3, subId4];
            subs.forEach((sub,index)=>{
                if(sub){
                    let subIndex=index+1;
                     itemInput.value += '&sub'+subIndex+'=' + sub;
                }
            });
            syncInputs();
            alert('Parameters added: ' + allSubIds);
            document.getElementById('subId1').value = '';
            document.getElementById('subId2').value = '';
            document.getElementById('subId3').value = '';
            document.getElementById('subId4').value = '';
        } else {
            alert('Please enter valid parameters up to a total of 500 characters.');
        }
    }

    function addClickId() {
        const input = document.getElementById('clickIdInput').value.trim();
        const itemInput = document.getElementById('itemInput');

        if (input !== '' && input.length <= 255) {
            itemInput.value += '&click_id=' + input;
            syncInputs();
            alert('Parameter added: ' + input);
            document.getElementById('clickIdInput').value = ''; // Clear the input field
        } else {
            alert('Please enter a valid parameter up to 255 characters.');
        }
    }

    function updateUnique() {
        const unique1 = document.getElementById('unique1').value.trim();
        const unique2 = document.getElementById('unique2').value.trim();
        const unique3 = document.getElementById('unique3').value.trim();
        const unique4 = document.getElementById('unique4').value.trim();
        const itemInput = document.getElementById('itemInput');

        const allUniques = [unique1, unique2, unique3, unique4].filter(unique => unique !== '').join('/');

        if (allUniques.length <= 1000) { // Sum of 4 inputs should be <= 1000
            let uniques=[unique1, unique2, unique3, unique4];
            uniques.forEach((unique,index)=>{
                if(unique){
                    let uniqueIndex=index+1;
                     itemInput.value += '&unique'+uniqueIndex+'=' + unique;
                }
            });
            syncInputs();
            alert('Parameters added: ' + allUniques);
            document.getElementById('aff1').value = '';
            document.getElementById('aff2').value = '';
            document.getElementById('aff3').value = '';
            document.getElementById('aff4').value = '';
        } else {
            alert('Please enter valid parameters up to a total of 1000 characters.');
        }
    }

    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section.classList.contains('collapse')) {
            section.classList.remove('collapse');
            section.style.transition = 'height 0.3s ease';
        } else {
            section.classList.add('collapse');
        }
    }

    function syncInputs() {
        const itemInputValue = document.getElementById('itemInput').value;
        document.getElementById('impressionInput').value = itemInputValue;
    }

    // Initial sync on page load
    document.addEventListener('DOMContentLoaded', function() {
        syncInputs();
        document.getElementById('itemInput').addEventListener('input', syncInputs);
    });
</script>
@endsection