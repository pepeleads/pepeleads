@extends('layouts.admin')
@section('title','Create User rolls')

@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Create User rolls</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                    <li class="breadcrumb-item active">Create User roll</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card h-100">
                                            <form method="post" action="{{ url('admin/createuserrole') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-body">
                                                    <div>
                                                        <h5 class="font-size-14 mb-3">Create User roll</h5>
                                                        <div class="border-bottom mb-2"></div>
                                                            <div class="row mb-4">
                                                                <div class="col-md-12">
                                                                    <label for="horizontal-firstname-input" class="col-form-label">Name</label>
                                                                    <input type="Text" class="form-control" 
                                                                    
                                                                    id="horizontal-firstname-input"
                                                                        name="name">
                                                                </div>
                                                                <div class="col-md-12">
                                                                     <label for="horizontal-firstname-input" class="col-form-label">Users</label>
                                                                    <select class="form-control" id="horizontal-firstname-input" name="user_id"
                                                                        required>
                                                                        <option value="">Select User</option>
                                                                        @foreach (DB::table('users')->get() as $u)
                                                                            <option value="{{ $u->id }}">{{ $u->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12">
                                                                     <label for="horizontal-firstname-input" class="col-form-label">Description</label>
                                                                    <textarea class="form-control" name="description" required></textarea>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="card-header flex-wrap py-5">
                                                    <div class="card-title">
                                                        <h3 class="card-label">
                                                            Permission Flags
                                                        </h3>
                                                    </div>
                                                    <div class="card-toolbar">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="allPermissions">
                                                            <label class="form-check-label" for="allPermissions">All Permissions</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body" style="height: 500px; overflow: auto;">
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="offers">
                                                                        <label class="form-check-label" for="offers">Offers</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item offers" id="listoffers" name="permissions[offers][listoffers]">
                                                                                <label class="form-check-label" for="listoffers">List All Offers</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item offers" id="activeoffers" name="permissions[offers][activeoffers]">
                                                                                <label class="form-check-label" for="activeoffers">Active Offers</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item offers" id="banneroffers" name="permissions[offers][banneroffers]">
                                                                                <label class="form-check-label" for="banneroffers">Banned Offers</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="users">
                                                                        <label class="form-check-label" for="users">Users</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item users" id="listuser" name="permissions[users][listuser]">
                                                                                <label class="form-check-label" for="listuser">List Users</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item users" id="userrolls" name="permissions[users][userrolls]">
                                                                                <label class="form-check-label" for="userrolls">User Rolls</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item users" id="addrole" name="permissions[users][addrole]">
                                                                                <label class="form-check-label" for="addrole">Add Roll</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item users" id="addusers" name="permissions[users][addusers]">
                                                                                <label class="form-check-label" for="addusers">Add Users</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="leads">
                                                                        <label class="form-check-label" for="leads">Leads</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item leads" id="allleads" name="permissions[leads][allleads]">
                                                                                <label class="form-check-label" for="allleads">All Leads</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item leads" id="completeleads" name="permissions[leads][completeleads]">
                                                                                <label class="form-check-label" for="completeleads">Complete Leads</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item leads" id="pendingleads" name="permissions[leads][pendingleads]">
                                                                                <label class="form-check-label" for="pendingleads">Pending Leads</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="approvals">
                                                                        <label class="form-check-label" for="approvals">Approvals</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item approvals" id="pendingapprovals" name="permissions[approvals][pendingapprovals]">
                                                                                <label class="form-check-label" for="pendingapprovals">Pending Approvals</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item approvals" id="approvedapprovals" name="permissions[approvals][approvedapprovals]">
                                                                                <label class="form-check-label" for="approvedapprovals">Approved Approvals</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="notification">
                                                                        <label class="form-check-label" for="notification">Notification</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item notification" id="addnotification" name="permissions[notification][addnotification]">
                                                                                <label class="form-check-label" for="addnotification">Add Notification</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item notification" id="editnotification" name="permissions[notification][editnotification]">
                                                                                <label class="form-check-label" for="editnotification">Edit Notifications</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="notification">
                                                                        <label class="form-check-label" for="notification">Blogs</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item blogs" id="addblogs" name="permissions[blogs][addblogs]">
                                                                                <label class="form-check-label" for="addblogs">Add Blogs</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item blogs" id="allblogs" name="permissions[blogs][allblogs]">
                                                                                <label class="form-check-label" for="allblogs">All Blogs</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="managesite">
                                                                        <label class="form-check-label" for="managesite">Manage Sites</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item managesite" id="managesites" name="permissions[managesite][managesites]">
                                                                                <label class="form-check-label" for="managesites">Manage Site</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="offermanage">
                                                                        <label class="form-check-label" for="offermanage">Offer Manage</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item offermanage" id="fetchapi" name="permissions[offermanage][fetchapi]">
                                                                                <label class="form-check-label" for="fetchapi">Offers Fetch APIs List</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item offermanage" id="fetchoffers" name="permissions[offermanage][fetchoffers]">
                                                                                <label class="form-check-label" for="fetchoffers">Fetch Offers</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="network">
                                                                        <label class="form-check-label" for="network">Network</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item network" id="listnetwork" name="permissions[network][listnetwork]">
                                                                                <label class="form-check-label" for="listnetwork">List network</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item network" id="addnetwork" name="permissions[network][addnetwork]">
                                                                                <label class="form-check-label" for="addnetwork">Add Network</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="commission">
                                                                        <label class="form-check-label" for="commission">Comission Management</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item commission" id="networkcomission" name="permissions[commission][networkcomission]">
                                                                                <label class="form-check-label" for="networkcomission">Network Commission</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item commission" id="globalcomission" name="permissions[commission][globalcomission]">
                                                                                <label class="form-check-label" for="globalcomission">Global Commission</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item commission" id="commissionrates" name="permissions[commission][commissionrates]">
                                                                                <label class="form-check-label" for="commissionrates">Commission Rates</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="ipmanage">
                                                                        <label class="form-check-label" for="ipmanage">IP Managements</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item ipmanage" id="apiwhitelist" name="permissions[ipmanage][apiwhitelist]">
                                                                                <label class="form-check-label" for="apiwhitelist">API Whitelist IPs</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item ipmanage" id="bannedip" name="permissions[ipmanage][bannedip]">
                                                                                <label class="form-check-label" for="bannedip">Banned IPs</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="payoutmanagment">
                                                                        <label class="form-check-label" for="payoutmanagment">Payout Managment</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item payoutmanagment" id="payments" name="permissions[payoutmanagment][payments]">
                                                                                <label class="form-check-label" for="payments">Payments</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item payoutmanagment" id="paymentsmanagment" name="permissions[payoutmanagment][paymentsmanagment]">
                                                                                <label class="form-check-label" for="paymentsmanagment">Payment Gateway Managment</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item payoutmanagment" id="paymentpolicy" name="permissions[payoutmanagment][paymentpolicy]">
                                                                                <label class="form-check-label" for="paymentpolicy">Payment Policies</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input permission-header" id="postback">
                                                                        <label class="form-check-label" for="postback">Postback</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="collapse show">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item postback" id="commonpostback" name="permissions[postback][commonpostback]">
                                                                                <label class="form-check-label" for="commonpostback">Common Post Back</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item postback" id="listpostback" name="permissions[postback][listpostback]">
                                                                                <label class="form-check-label" for="listpostback">List Post Back</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input permission-item postback" id="addpostback" name="permissions[postback][addpostback]">
                                                                                <label class="form-check-label" for="addpostback">Add Post Back</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Add other sections here as needed -->
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mt-4">
                                                            <button type="submit" class="btn btn-primary w-100">Create</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
    </script>
<script>
    $(document).ready(function () {
        // Handle header checkbox change event
        $('.permission-header').change(function () {
            var categoryClass = $(this).attr('id');
            $('.' + categoryClass).prop('checked', $(this).prop('checked'));
        });

        // Handle individual checkbox change event
        $('.permission-item').change(function () {
            var categoryClass = $(this).attr('class').split(' ')[1];
            var allChecked = $('.' + categoryClass).length === $('.' + categoryClass + ':checked').length;
            var anyChecked = $('.' + categoryClass + ':checked').length > 0;

            // Update parent checkbox based on the state of child checkboxes
            $('#' + categoryClass).prop('checked', anyChecked);

            // Update the state of the "All Permissions" checkbox
            var allPermissionsChecked = $('.permission-item').length === $('.permission-item:checked').length;
            $('#allPermissions').prop('checked', allPermissionsChecked);
        });

        // Handle 'All Permissions' checkbox change event
        $('#allPermissions').change(function () {
            $('.permission-item, .permission-header').prop('checked', $(this).prop('checked'));
        });

        // Initialize state of header checkboxes based on individual checkboxes
        $('.permission-header').each(function () {
            var categoryClass = $(this).attr('id');
            var allChecked = $('.' + categoryClass).length === $('.' + categoryClass + ':checked').length;
            $(this).prop('checked', allChecked);
        });

        // Initialize state of 'All Permissions' checkbox based on individual checkboxes
        var allPermissionsChecked = $('.permission-item').length === $('.permission-item:checked').length;
        $('#allPermissions').prop('checked', allPermissionsChecked);
    });
</script>
@endsection
