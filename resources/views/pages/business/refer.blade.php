@extends('layouts.horizontal_layout_client')
@section('title', 'Refer ')

@section('content')
    <style>
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            padding: 50px 0;
        }

        .header h1 {
            font-size: 36px;
            color: #2a9d8f;
        }

        .header p {
            font-size: 18px;
            color: #555;
        }

        .section {
            background-color: #fff;
            padding: 40px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            font-size: 28px;
            color: #264653;
            margin-bottom: 20px;
        }

        .section p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .cta-button {
            display: inline-block;
            background-color: #e76f51;
            color: #fff;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #d45d3b;
        }

        .highlight {
            color: #e76f51;
            font-weight: bold;
        }
    </style>

    <div class="main-content" >

        <div class="page-content" >
            <div class="container-fluid" id="referral-link" >


                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            {{-- <h4 class="mb-sm-0 font-size-18">Join Referral Program</h4> --}}

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Referral</a></li>
                                    <li class="breadcrumb-item active">Referral</li>
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
                                    <h5 class="font-size-14 mb-3">Referral Link</h5>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="add-on-item d-flex">
                                                <pre class="d-flex mb-0"><code>https://PepeLeads.com?ref_id={{ $ref_id }}</code></pre>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-lg-12">

                        <div class="container">

                            <!-- Header Section -->
                            <div class="header">
                                <h1>Earn More with PepeLeads</h1>
                                <p>Your one-stop platform for exclusive offers and rewards. Earn credits by completing
                                    offers and sharing with friends!</p>
                            </div>

                            <!-- Sales Pitch Section -->
                            <div class="section">
                                <h2>Boost Your Earnings with Our Referral Program</h2>
                                <p>At <span class="highlight">PepeLeads</span>, we believe that sharing is
                                    rewarding. That's why we’re excited to offer you the chance to maximize your earnings
                                    with our referral program.</p>
                                <p>Simply share your referral link, and when someone signs up through your link and
                                    completes any offer, you’ll earn <span class="highlight">15% of their offer credit
                                        payout</span>. It’s that easy!</p>
                                <p>There’s no limit to how much you can earn—refer as many people as you want and keep
                                    watching your rewards grow. It's a win-win for you and your friends!</p>
                                <a href="#referral-link" class="cta-button">Start Referring Now</a>
                            </div>

                            <!-- Referral Details Section -->
                            <div id="refer-section" class="section">
                                <h2>How It Works</h2>
                                <p>Here’s a quick guide to how you can earn even more by referring others to <span
                                        class="highlight">PepeLeads</span>:</p>
                                <ol>
                                    <li><strong>Share your unique referral link.</strong> You can find it in your account
                                        dashboard. Send it to friends, family, or colleagues.</li>
                                    <li><strong>They sign up and complete offers.</strong> When they join through your link
                                        and complete any offer on our platform, you get rewarded.</li>
                                    <li><strong>Earn 15% of their offer payout.</strong> For every offer they complete,
                                        you’ll receive 15% of the credit payout in your account, automatically.</li>
                                </ol>
                                <p>It’s that simple! The more they complete offers, the more you earn—so start sharing your
                                    link today and watch your credits multiply.</p>
                                <a href="#referral-link" class="cta-button">Share Link</a>
                            </div>

                        </div>
                        {{-- <div class="card">
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>S no.</th>
                                            <th>Completed Survey</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr>
                                        <td>1</td>
                                        <td>1000</td>
                                        <td>$5.00</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>5000</td>
                                            <td>$30.00</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>10000</td>
                                            <td>$60.00</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>50000</td>
                                            <td>$300.00</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>100000</td>
                                            <td>$700.00</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>150000</td>
                                            <td>$1000.00</td>
                                        </tr>
                                    
                                </tbody>
                                </table>
                            </div>
                        </div> --}}
                    </div>
                </div>


                <div class="row p-2">
                    <div class="col-lg-12">
                        <div class="card p-4">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S no.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Join Date</th>
                                        <th>Survey Completed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $j = 1;
                                    @endphp
                                    @foreach ($refs as $r)
                                        <tr>
                                            <td>{{ $j++ }}</td>
                                            <td>{{ $r->name }}</td>
                                            <td>{{ $r->email }}</td>
                                            <td>{{ $r->created_at }}</td>
                                            <td>0</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
