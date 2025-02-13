@php
    $currentUrl = request()->path();
    $rules = App\Models\roles::where('id', Auth::user()->role_id)->first();
    $permissions = $rules ? json_decode($rules->permissions, true) : [];
@endphp
<!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" data-key="t-menu">Menu</li>

                    <li>
                        <a href="/admin/dashboard">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>
                    @if(isset($permissions['offers']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="grid"></i>
                            <span data-key="t-apps">Offers</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (isset($permissions['offers']['listoffers']) && $permissions['offers']['listoffers'] === 'on')
                                <li>
                                    <a href="/admin/list_offers">
                                        <span data-key="t-calendar">List All Offers</span>
                                    </a>
                                </li>
                            @endif
                            @if (isset($permissions['offers']['activeoffers']) && $permissions['offers']['activeoffers'] === 'on')
                                <li>
                                    <a href="/admin/active_offers">
                                        <span data-key="t-chat">Active Offers</span>
                                    </a>
                                </li>
                            @endif
                            @if (isset($permissions['offers']['banneroffers']) && $permissions['offers']['banneroffers'] === 'on')
                                <li>
                                    <a href="/admin/banned_offers">
                                        <span data-key="t-chat">Banned Offers</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                    @if(isset($permissions['users']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="users"></i>
                            <span data-key="t-authentication">Users</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (isset($permissions['users']['listuser']) && $permissions['users']['listuser'] === 'on')
                            <li><a href="/admin/list_users" data-key="t-login">List Users</a></li>
                            @endif
                            @if (isset($permissions['users']['userrolls']) && $permissions['users']['userrolls'] === 'on')
                            <li><a href="{{ url('admin/userrolls') }}" data-key="t-login">User Rolls</a></li>
                            @endif
                            @if (isset($permissions['users']['addrole']) && $permissions['users']['addrole'] === 'on')
                            <li><a href="{{ url('admin/addroll') }}" data-key="t-login">Add Roll</a></li>
                            @endif
                            @if (isset($permissions['users']['addusers']) && $permissions['users']['addusers'] === 'on')
                            <li><a href="/admin/add_user" data-key="t-register">Add User</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(isset($permissions['leads']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="file-text"></i>
                            <span data-key="t-pages">Leads</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (isset($permissions['leads']['allleads']) && $permissions['leads']['allleads'] === 'on')
                            <li><a href="/admin/all_leads" data-key="t-starter-page">All Leads</a></li>
                            @endif
                            @if (isset($permissions['leads']['completeleads']) && $permissions['leads']['completeleads'] === 'on')
                            <li><a href="/admin/completed_leads" data-key="t-maintenance">Completed Leads</a></li>
                            @endif
                            @if (isset($permissions['leads']['pendingleads']) && $permissions['leads']['pendingleads'] === 'on')
                            <li><a href="/admin/pending_leads" data-key="t-coming-soon">Form Submissions Leads</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(isset($permissions['approvals']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="file-text"></i>
                            <span data-key="t-pages">Approvals</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (isset($permissions['approvals']['pendingapprovals']) && $permissions['approvals']['pendingapprovals'] === 'on')
                            <li><a href="/admin/pending_approvals" data-key="t-starter-page">Pending Offer Approvals</a></li>
                            @endif
                            @if (isset($permissions['approvals']['approvedapprovals']) && $permissions['approvals']['approvedapprovals'] === 'on')
                            <li><a href="/admin/completed_approvals" data-key="t-maintenance">Approved Offer Approvals</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(isset($permissions['notification']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="file-text"></i>
                            <span data-key="t-pages">Notifications</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (isset($permissions['notification']['addnotification']) && $permissions['notification']['addnotification'] === 'on')
                            <li><a href="/admin/notifications/add" data-key="t-starter-page">Add Notification</a></li>
                            @endif
                            @if (isset($permissions['notification']['editnotification']) && $permissions['notification']['editnotification'] === 'on')
                            <li><a href="/admin/notifications/edit/{id}" data-key="t-maintenance">Edit Notification</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(isset($permissions['blogs']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="file-text"></i>
                            <span data-key="t-pages">Blogs</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (isset($permissions['blogs']['allblogs']) && $permissions['blogs']['allblogs'] === 'on')
                            <li><a href="{{ url('admin/allblogs') }}" data-key="t-starter-page">All blogs</a></li>
                            @endif
                            @if (isset($permissions['blogs']['addblogs']) && $permissions['blogs']['addblogs'] === 'on')
                            <li><a href="{{ url('admin/addblog') }}" data-key="t-maintenance">Add Blogs</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="file-text"></i>
                            <span data-key="t-pages">Files</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('admin/upload_files') }}" data-key="t-starter-page">All files</a></li>
                        </ul>
                    </li>
                    @if(isset($permissions['managesite']))
                    @if (isset($permissions['managesite']['managesites']) && $permissions['managesite']['managesites'] === 'on')
                    <li>
                        <a href="/admin/list_sites">
                            <i data-feather="layout"></i>
                            <span data-key="t-horizontal">Manage Sites</span>
                        </a>
                    </li>
                    @endif
                    @endif
                    <li class="menu-title mt-2" data-key="t-components">Manage System</li>
                    @if(isset($permissions['offermanage']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="briefcase"></i>
                            <span data-key="t-components">Offers Manage</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (isset($permissions['offermanage']['fetchapi']) && $permissions['offermanage']['fetchapi'] === 'on')
                            <li><a href="/admin/offer_fetch_apis" data-key="t-alerts">Offers fetch APIs List</a></li>
                            @endif
                            @if (isset($permissions['offermanage']['fetchoffers']) && $permissions['offermanage']['fetchoffers'] === 'on')
                            <li><a href="/admin/fetch_offers" data-key="t-buttons">Fetch Offers</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(isset($permissions['network']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="sliders"></i>
                            <span data-key="t-tables">Networks</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (isset($permissions['network']['listnetwork']) && $permissions['network']['listnetwork'] === 'on')
                            <li><a href="/admin/networks" data-key="t-basic-tables">List Networks</a></li>
                            @endif
                            @if (isset($permissions['network']['addnetwork']) && $permissions['network']['addnetwork'] === 'on')
                            <li><a href="/admin/add_network" data-key="t-data-tables">Add Network</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(isset($permissions['commission']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="pie-chart"></i>
                            <span data-key="t-charts">Comission Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (isset($permissions['commission']['networkcomission']) && $permissions['commission']['networkcomission'] === 'on')
                            <li><a href="/admin/network_commission" data-key="t-apex-charts">Network Comission</a></li>
                            @endif
                            @if (isset($permissions['commission']['globalcomission']) && $permissions['commission']['globalcomission'] === 'on')
                            <li><a href="/admin/global_commission" data-key="t-e-charts">Global Commission</a></li>
                            @endif
                            @if (isset($permissions['commission']['commissionrates']) && $permissions['commission']['commissionrates'] === 'on')
                            <li><a href="/admin/commission_rates" data-key="t-chartjs-charts">Manage Comission Rates</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(isset($permissions['ipmanage']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="cpu"></i>
                            <span data-key="t-icons">IP Managements</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (isset($permissions['ipmanage']['apiwhitelist']) && $permissions['ipmanage']['apiwhitelist'] === 'on')
                            <li><a href="/admin/whitelist_ip" data-key="t-boxicons">API whitelist IPs</a></li>
                            @endif
                            @if (isset($permissions['ipmanage']['bannedip']) && $permissions['ipmanage']['bannedip'] === 'on')
                            <li><a href="/admin/banned_ip" data-key="t-material-design">Banned IPs</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(isset($permissions['payoutmanagment']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="map"></i>
                            <span data-key="t-maps">Payout management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (isset($permissions['payoutmanagment']['payments']) && $permissions['payoutmanagment']['payments'] === 'on')
                            <li><a href="/admin/payments" data-key="t-l-maps">Payments</a></li>
                            @endif
                            @if (isset($permissions['payoutmanagment']['paymentsmanagment']) && $permissions['payoutmanagment']['paymentsmanagment'] === 'on')
                            <li><a href="/admin/payment_gateway" data-key="t-g-maps">Payment Gateway Management</a></li>
                            @endif
                            @if (isset($permissions['payoutmanagment']['paymentpolicy']) && $permissions['payoutmanagment']['paymentpolicy'] === 'on')
                            <li><a href="/admin/payment_policy" data-key="t-v-maps">Payment Policies</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(isset($permissions['postback']))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="share-2"></i>
                            <span data-key="t-multi-level">Postback</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            @if (isset($permissions['postback']['commonpostback']) && $permissions['postback']['commonpostback'] === 'on')
                            <li><a href="/admin/common_postback" data-key="t-level-1-1">Common Postback</a></li>
                            @endif
                            @if (isset($permissions['postback']['listpostback']) && $permissions['postback']['listpostback'] === 'on')
                            <li><a href="/admin/list_postback" data-key="t-level-1-1">List Postback</a></li>
                            @endif
                            @if (isset($permissions['postback']['addpostback']) && $permissions['postback']['addpostback'] === 'on')
                            <li><a href="/admin/add_postback" data-key="t-level-1-1">Add Postback</a></li>
                            @endif

                        </ul>
                    </li>
                    @endif
                </ul>


            </div>
            <!-- Sidebar -->
        </div>
    </div>
<!-- Left Sidebar End -->