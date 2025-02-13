<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="/dashboard">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Offers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="/all_offers">
                                <span data-key="t-all-offers">All Offers</span>
                            </a>
                        </li>

                        <li>
                            <a href="/active_offers">
                                <span data-key="t-active-offers">Active Offers</span>
                            </a>
                        </li>

                        <li>
                            <a href="/pending_offers">
                                <span data-key="t-pending-offers">Pending Offers</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="/sites">
                        <i data-feather="layout"></i>
                        <span data-key="t-horizontal">Sites</span>
                    </a>
                </li>

                <li>
                    <a href="/reports">
                        <i data-feather="calendar"></i>
                        <span data-key="t-reports">Reports</span>
                    </a>
                </li>

                <li>
                    <a href="/finance">
                        <i data-feather="credit-card"></i>
                        <span data-key="t-finance">Finance</span>
                    </a>
                </li>

                <li>
                    <a href="/notifications">
                        <i data-feather="bell"></i>
                        <span data-key="t-notifications">Notifications</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Manage System</li>

                <li>
                    <a href="javascript:void(0);" class="has-arrow">
                        <i data-feather="code"></i>
                        <span data-key="t-integrations">Integrations</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="/api_integrations">
                                <span data-key="t-api">API Integrations</span>
                            </a>
                        </li>

                        <li>
                            <a href="/postback_integrations">
                                <span data-key="t-postback">Postback</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="/profile">
                        <i data-feather="user"></i>
                        <span data-key="t-profile">Profile</span>
                    </a>
                </li>

                <li>
                    <a href="/refer">
                        <i data-feather="dollar-sign"></i>
                        <span data-key="t-refer">Refer</span>
                    </a>
                </li>

                @if (session('adminLoggedIn') && session('admin_user_id'))
                    <li>
                        <a href="/admin/user_login/{{ session('admin_user_id') }}">
                            <button class="btn btn-primary">
                                <i class="mdi mdi-login"></i> Login As Admin
                            </button>
                        </a>
                    </li>
                @endif


                @if(isset(auth()->user()->assign_manager_id))
               
                <li>
                    <div
                        style="font-family: Arial, sans-serif;margin: 22px;max-width: 250px;border: 1px solid #e0e0e0;border-radius: 8px;padding: 11px 17px;background-color: #fff;box-shadow: 0 2px 4px rgba(0,0,0,0.1);justify-content: center;">
                        <div style="display: flex;align-items: center;margin-bottom: 1px;justify-content: center;">
                            <div class="display: flex; align-items: center; text-align:center; justify-content:center;">
                                <h3 style="font-size: 16px; color: #333;display: flex; align-items: center; text-align:center; justify-content:center;">{{ auth()->user()->assignedManager->name}}</h3>
                                <p style="font-size: 14px; color: #666; display: flex; align-items: center; text-align:center; justify-content:center;">Assigned Manager</p>
                            </div>
                        </div>
                        <div
                            style="background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 4px; padding: 8px;justify-content: center; display:flex;">
                            <p style="margin: 0 0 4px; font-size: 14px; color: #333;">
                                <strong>Skype:</strong> {{ auth()->user()->assignedManager->skype}}
                            </p>
                            {{-- <a href="skype:{{ auth()->user()->assignedManager->skype}}?call"
                                style="display: inline-block; background-color: #00aff0; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; font-size: 14px; margin-top: 8px;">
                                Call on Skype
                            </a> --}}
                        </div>
                    </div>
                </li>
                @endif
            </ul>


        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
