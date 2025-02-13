@extends('layouts.horizontal_layout_client')
@section('title', 'Pending offers ')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @if (count($sites) > 0)
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Pending Offers</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Offers</a></li>
                                        <li class="breadcrumb-item active">Pending Offers</li>
                                    </ol>
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
                                                <th><input type="checkbox" class="form-check-input check-all"></th>
                                                <th>ID</th>
                                                <th>Icon</th>
                                                <th>Preview</th>
                                                <th>Name</th>
                                                <th>Payout</th>
                                                <th>Apply</th>
                                                <th>Locations</th>
                                                <th>Operating System</th>
                                                <th>Categories</th>
                                            </tr>
                                        </thead>
                                        <tbody id="offers-table-body">
                                            <!-- Render limited entries dynamically using JavaScript -->
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

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Get the offers data from the server
                const offers = {!! json_encode($offers) !!};

                // Set the number of entries to render
                const entriesToShow = 1500; // Change this value as per your requirement

                // Render limited entries dynamically
                const tbody = document.getElementById("offers-table-body");
                for (let i = 0; i < entriesToShow && i < offers.length; i++) {
                    const offer = offers[i];
                    const row = document.createElement("tr");
                    let countries = (offer?.offers?.countries).split('|');
                    let categories = (offer?.offers?.categories).split('|');
                    row.innerHTML = `
                <td>
                    <input type="checkbox" class="form-check-input check-items" name="id[]" value="${offer?.offers?.id}">
                </td>
                <td>${offer?.offers?.id}</td>
                <td><img src="${offer?.offers?.image_url}" height="18"/></td>
                <td><a target="_blank" href="${(offer?.offers?.preview_url)? offer?.offers?.preview_url: '#'}" ${offer?.offers?.preview_url ? '' : `onclick="alert('No Preview Found')"`} onclick><button class="btn btn-warning d-flex"><i class=" fas fa-eye m-1"></i>Preview Offer</button></a></td>
                <td class="pl-0"><a href="#" class="m-0 p-0" >${offer?.offers?.name}</a></td>
                <td>$${parseFloat((offer?.offers?.credit*offer?.offers?.rate?.rate?.network_rate)/100).toFixed(2)}</td>
                <td><a href="/request/offer-delete/${btoa(offer?.id)}" ><button class="btn btn-danger">Delete Offer</button></a></td>
                <td title="${(countries.length>1) && countries.join('|')}" style="color:${(countries.length>1)?'blue':'black'}; font-weight:600;width: 20px;overflow: hidden;white-space: nowrap;">${countries.join("|")}</td>
                <td>${offer?.offers?.targets}</td>
                <td>${offer?.offers?.categories}</td>
            `;
                    tbody.appendChild(row);
                }
            });
        </script>
    </div>
@endsection
