<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\ActiveOffers;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        # code...
        return response()->json(['code' => 200, 'message' => 'Server is Working Properly']);
    }

    public function listReport(Request $request)
    {
        # code...
        return response()->json(['code' => 200, 'message' => 'Rahul is Working on it']);
    }

    public function list_offers(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'campaign_id',
            2 => 'image_url',
            3 => 'name',
            4 => 'network',
            5 => 'countries',
            6 => 'credit',
            7 => 'active',
            8 => 'actions'
        ];



        $totalData = Offer::count();
        $totalFiltered = $totalData;

        $limit = @$request->input('length');
        $start = @$request->input('start');
        $order = $columns[@$request->input('order.0.column')];
        $dir = @$request->input('order.0.dir');

        if (empty(@$request->input('search.value'))) {
            $offers = Offer::with('rate')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = @$request->input('search.value');

            $offers = Offer::with('rate')
                ->where('campaign_id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('network', 'LIKE', "%{$search}%")
                ->orWhere('countries', 'LIKE', "%{$search}%")
                ->orWhere('credit', 'LIKE', "%{$search}%")
                ->orWhere('active', 'LIKE', "%{$search}%")
                ->orWhere('id', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Offer::with('rate')
                ->where('campaign_id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('network', 'LIKE', "%{$search}%")
                ->orWhere('countries', 'LIKE', "%{$search}%")
                ->orWhere('credit', 'LIKE', "%{$search}%")
                ->orWhere('active', 'LIKE', "%{$search}%")
                ->orWhere('id', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();

        if (!empty($offers)) {
            foreach ($offers as $offer) {
                $nestedData['checkbox'] = '<input type="checkbox" class="form-check-input check-items" name="id[]" value="' . $offer->id . '">';
                $nestedData['campaign_id'] = $offer->campaign_id;
                $nestedData['id'] = $offer->id;
                $nestedData['image_url'] = $offer->image_url;
                $nestedData['target_url'] = $offer->target_url;
                $nestedData['preview_url'] = $offer->preview_url;
                $nestedData['preview_url'] = $offer->preview_url;
                $nestedData['name'] = $offer->name;
                $nestedData['network'] = $offer->network;
                $nestedData['countries'] = $offer->countries;
                $nestedData['credit'] = $offer->credit;
                $nestedData['active'] = $offer->active;
                $nestedData['actions'] = '<a href="#"><i class="fa fa-edit"></i></a> <a href="#"><i class="fa fa-ban"></i></a>';

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        // dd($json_data);

        return response()->json($json_data);
    }

    // public function list_offers_client(Request $request)
    // {
    //    $columns = [
    //       0 => 'id',
    //       1 => 'campaign_id',
    //       2 => 'image_url',
    //       2 => 'preview_url',
    //       3 => 'name',
    //       4 => 'apply',
    //       5 => 'countries',
    //       6 => 'payout',
    //       7 => 'active',
    //    ];



    //    $totalData = Offer::count();
    //    $totalFiltered = $totalData;

    //    $limit = @$request->input('length');
    //    $start = @$request->input('start');
    //    $order = $columns[@$request->input('order.0.column')];
    //    $dir = @$request->input('order.0.dir');

    //    if (empty(@$request->input('search.value'))) {
    //       $offers = Offer::with('rate')
    //          ->offset($start)
    //          ->limit($limit)
    //          ->orderBy($order, $dir)
    //          ->get();
    //    } else {
    //       $search = @$request->input('search.value');

    //       $offers = Offer::with('rate')
    //          ->where('campaign_id', 'LIKE', "%{$search}%")
    //          ->orWhere('name', 'LIKE', "%{$search}%")
    //          ->orWhere('network', 'LIKE', "%{$search}%")
    //          ->orWhere('countries', 'LIKE', "%{$search}%")
    //          ->orWhere('credit', 'LIKE', "%{$search}%")
    //          ->orWhere('active', 'LIKE', "%{$search}%")
    //          ->offset($start)
    //          ->limit($limit)
    //          ->orderBy($order, $dir)
    //          ->get();

    //       $totalFiltered = Offer::with('rate')
    //          ->where('campaign_id', 'LIKE', "%{$search}%")
    //          ->orWhere('name', 'LIKE', "%{$search}%")
    //          ->orWhere('network', 'LIKE', "%{$search}%")
    //          ->orWhere('countries', 'LIKE', "%{$search}%")
    //          ->orWhere('credit', 'LIKE', "%{$search}%")
    //          ->orWhere('active', 'LIKE', "%{$search}%")
    //          ->count();
    //    }

    //    $data = array();

    //    if (!empty($offers)) {
    //       foreach ($offers as $offer) {
    //          $nestedData['checkbox'] = '<input type="checkbox" class="form-check-input check-items" name="id[]" value="' . $offer->id . '">';
    //          $nestedData['campaign_id'] = $offer->campaign_id;
    //          $nestedData['image_url'] = $offer->image_url;
    //          $nestedData['name'] = $offer->name;
    //          $nestedData['network'] = $offer->network;
    //          $nestedData['countries'] = $offer->countries;
    //          $nestedData['payout'] = $offer->credit;
    //          // $nestedData['active'] = $offer->active;
    //          $nestedData['preview_url'] ='<a href="'.$offer->preview_url.'">Preview</a>' ;
    //          $nestedData['apply'] = '<a href="/">Request Approval</a>';

    //          $data[] = $nestedData;
    //       }
    //    }

    //    $json_data = array(
    //       "draw" => intval($request->input('draw')),
    //       "recordsTotal" => intval($totalData),
    //       "recordsFiltered" => intval($totalFiltered),
    //       "data" => $data
    //    );
    //    // dd($json_data);

    //    return response()->json($json_data);
    // }

    public function list_offers_client(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'campaign_id',
            2 => 'image_url',
            3 => 'preview_url',
            4 => 'name',
            5 => 'apply',
            6 => 'countries',
            7 => 'payout',
            8 => 'active',
        ];

        $totalData = Offer::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $offers = Offer::with('rate')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $offers = Offer::with('rate')
                ->where('campaign_id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('network', 'LIKE', "%{$search}%")
                ->orWhere('countries', 'LIKE', "%{$search}%")
                ->orWhere('credit', 'LIKE', "%{$search}%")
                ->orWhere('active', 'LIKE', "%{$search}%")
                ->orWhere('id', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Offer::with('rate')
                ->where('campaign_id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('network', 'LIKE', "%{$search}%")
                ->orWhere('countries', 'LIKE', "%{$search}%")
                ->orWhere('credit', 'LIKE', "%{$search}%")
                ->orWhere('active', 'LIKE', "%{$search}%")
                ->orWhere('id', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();

        if (!empty($offers)) {
            foreach ($offers as $offer) {
                $countries = explode('|', $offer->countries);
                $payout = number_format(($offer->credit * $offer->rate->network_rate) / 100, 2);

                $nestedData['checkbox'] = '<input type="checkbox" class="form-check-input check-items" name="id[]" value="' . $offer->id . '">';
                $nestedData['id'] = $offer->id;
                $nestedData['icon'] = '<img src="' . $offer->image_url . '" height="18"/>';
                $nestedData['preview'] = '<a href="' . ($offer->preview_url ?: '#') . '" ' . ($offer->preview_url ? '' : 'onclick="alert(\'No Preview Found\')"') . '><button class="btn btn-warning d-flex"><i class="fas fa-eye m-1"></i>Preview Offer</button></a>';
                $nestedData['name'] = $offer->name;
                $nestedData['payout'] = '$' . $payout;
                $nestedData['apply'] = '<a href="/request/offer/' . base64_encode($offer->id) . '" target="_blank"><button class="btn btn-warning">Request Offer</button></a>';
                $nestedData['locations'] = '<span style="color:' . (count($countries) > 1 ? 'blue' : 'black') . '; font-weight:600; width:20px; overflow:hidden; white-space:nowrap;" title="' . implode('|', $countries) . '">' . implode('|', $countries) . '</span>';
                $nestedData['operating_system'] = $offer->targets;
                $nestedData['categories'] = $offer->categories;

                $data[] = $nestedData;
            }
        }

        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        return response()->json($json_data);
    }



    public function list_pending_offers(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'campaign_id',
            2 => 'image_url',
            3 => 'name',
            4 => 'network',
            5 => 'countries',
            6 => 'credit',
            7 => 'active',
            8 => 'actions',
            9 => 'created_at'
        ];



        $totalData = ActiveOffers::where('approved_status', 0)->count();
        $totalFiltered = $totalData;

        $limit = @$request->input('length');
        $start = @$request->input('start');
        $order = $columns[@$request->input('order.0.column')];
        $dir = @$request->input('order.0.dir');

        if (empty(@$request->input('search.value'))) {
            $offers = ActiveOffers::where('approved_status', 0)->with('offers')->with('user')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = @$request->input('search.value');

            $offers = ActiveOffers::where('approved_status', 0)
                ->where(function($query) use ($search) {
                    $query->whereHas('offers', function($q) use ($search) {
                        $q->where('campaign_id', 'LIKE', "%{$search}%")
                          ->orWhere('name', 'LIKE', "%{$search}%")
                          ->orWhere('network', 'LIKE', "%{$search}%") 
                          ->orWhere('countries', 'LIKE', "%{$search}%")
                          ->orWhere('credit', 'LIKE', "%{$search}%")
                          ->orWhere('active', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%")
                          ->orWhere('email', 'LIKE', "%{$search}%");
                    });
                })
                ->with(['offers', 'user'])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = ActiveOffers::where('approved_status', 0)->with('offers')->with('user')
                ->whereHas('offers', function($q) use ($search) {
                    $q->where('campaign_id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%") 
                    ->orWhere('network', 'LIKE', "%{$search}%")
                    ->orWhere('countries', 'LIKE', "%{$search}%")
                    ->orWhere('credit', 'LIKE', "%{$search}%")
                    ->orWhere('active', 'LIKE', "%{$search}%");
                })
                ->count();
        }

        $data = array();

        if (!empty($offers)) {
            foreach ($offers as $offer) {
                $nestedData['checkbox'] = '<input type="checkbox" class="form-check-input check-items" name="id[]" value="' . $offer->id . '">';
                $nestedData['campaign_id'] = $offer->offers->campaign_id;
                $nestedData['image_url'] = $offer->offers->image_url;
                $nestedData['name'] = $offer->offers->name;
                $nestedData['network'] = $offer->offers->network;
                $nestedData['countries'] = $offer->offers->countries;
                $nestedData['credit'] = $offer->offers->credit;
                $nestedData['active'] = $offer->offers->active;
                $nestedData['user'] = $offer->user;
                $nestedData['user_name'] = $offer->user?->name;
                $nestedData['created_at'] = Carbon::parse($offer->created_at)->format('Y-m-d h:i:s');
                $nestedData['actions'] = '<a href="/admin/offer/approve/' . $offer->id . '"><i class="fa fa-check"></i> Mark as Approved</a>';

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        return response()->json($json_data);
    }

    public function list_approved_offers(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'campaign_id',
            2 => 'image_url',
            3 => 'name',
            4 => 'network',
            5 => 'countries',
            6 => 'credit',
            7 => 'active',
            8 => 'actions',
            9 => 'updated_at'
        ];



        $totalData = ActiveOffers::where('approved_status', 1)->count();
        $totalFiltered = $totalData;

        $limit = @$request->input('length');
        $start = @$request->input('start');
        $order = $columns[@$request->input('order.0.column')];
        $dir = @$request->input('order.0.dir');

        if (empty(@$request->input('search.value'))) {
            $offers = ActiveOffers::where('approved_status', 1)->with('offers')->with('user')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = @$request->input('search.value');

            $offers = ActiveOffers::where('approved_status', 1)->with('offers')->with('user')
            ->whereHas('offers', function($q) use ($search) {
                $q->where('campaign_id', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%") 
                  ->orWhere('network', 'LIKE', "%{$search}%")
                  ->orWhere('countries', 'LIKE', "%{$search}%")
                  ->orWhere('credit', 'LIKE', "%{$search}%")
                  ->orWhere('active', 'LIKE', "%{$search}%");
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = ActiveOffers::where('approved_status', 1)->with('offers')->with('user')
            ->whereHas('offers', function($q) use ($search) {
                $q->where('campaign_id', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%") 
                  ->orWhere('network', 'LIKE', "%{$search}%")
                  ->orWhere('countries', 'LIKE', "%{$search}%")
                  ->orWhere('credit', 'LIKE', "%{$search}%")
                  ->orWhere('active', 'LIKE', "%{$search}%");
            })
                ->count();
        }

        $data = array();

        if (!empty($offers)) {
            foreach ($offers as $offer) {
                $nestedData['checkbox'] = '<input type="checkbox" class="form-check-input check-items" name="id[]" value="' . $offer->id . '">';
                $nestedData['campaign_id'] = $offer->offers->id;
                $nestedData['image_url'] = $offer->offers->image_url;
                $nestedData['name'] = $offer->offers->name;
                $nestedData['network'] = $offer->offers->network;
                $nestedData['countries'] = $offer->offers->countries;
                $nestedData['credit'] = $offer->offers->credit;
                $nestedData['active'] = $offer->offers->active;
                $nestedData['user'] = $offer->user;
                $nestedData['updated_at'] = Carbon::parse($offer->updated_at)->format('Y-m-d h:i:s');
                $nestedData['actions'] = '<a href="#"><i class="fa fa-edit"></i></a> <a href="#"><i class="fa fa-ban"></i></a>';

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        // dd($json_data);

        return response()->json($json_data);
    }



    public function getOffersData(Request $request)
    {
        $query = Offer::query();

        if ($request->category) {
            $query->where(function ($q) use ($request) {
                foreach ($request->category as $category) {
                    $q->orWhere('categories', 'like', '%' . $category . '%');
                }
            });
        }

        if ($request->target || $request->conversion_type || $request->traffic_types || $request->allowed_media) {
            $query->where(function ($q) use ($request) {
                if ($request->target) {
                    foreach ($request->target as $target) {
                        $q->orWhere('targets', 'like', '%' . $target . '%');
                    }
                }
                if ($request->allowed_media) {
                    foreach ($request->allowed_media as $allowed_media) {
                        $q->orWhere('targets', 'like', '%' . $allowed_media . '%');
                    }
                }
                if ($request->conversion_type) {
                    foreach ($request->conversion_type as $conversion_type) {
                        $q->orWhere('targets', 'like', '%' . $conversion_type . '%');
                    }
                }
                if ($request->traffic_types) {
                    foreach ($request->traffic_types as $traffic_types) {
                        $q->orWhere('targets', 'like', '%' . $traffic_types . '%');
                    }
                }
            });
        }
        if ($request->countries) {
            $query->where(function ($q) use ($request) {
                foreach ($request->countries as $country) {
                    $q->orWhere('countries', 'like', '%' . $country . '%');
                }
            });
        }

        if ($request->os) {
            $query->where(function ($q) use ($request) {
                if (in_array('web', $request->os)) {
                    $q->orWhere(function ($q) {
                        $q->where('web', 1)->where('mobile', 0);
                    });
                }

                if (in_array('mobile', $request->os)) {
                    $q->orWhere(function ($q) {
                        $q->where('mobile', 1)->where('web', 0);
                    });
                }

                if (in_array('web-and-mobile', $request->os)) {
                    $q->orWhere(function ($q) {
                        $q->where('web', 1)->where('mobile', 1);
                    });
                }
            });
        }

        $query->orderBy('id', 'desc');

        return DataTables::of($query)
            ->addColumn('checkbox', function ($offer) {
                return '<input type="checkbox" class="form-check-input check-items" name="id[]" value="' . $offer->id . '">';
            })
            ->addColumn('offer_id', function ($offer) {
                return $offer->id;
            })
            ->addColumn('icon', function ($offer) {
                $baseUrl = env('APP_URL');

                // Check if image URL is '/img/reward.png'
                if ($offer->image_url == '/img/reward.png') {
                    // Return the image URL as is
                    $imageUrl = $offer->image_url;
                } else {
                    // Fallback to using the image based on the offer ID
                    $imageUrl = '/image/' . $offer->id;
                }

                // Return the HTML for the image
                return '<img src="' . $baseUrl . $imageUrl . '" height="18"/>';
            })
            ->addColumn('preview', function ($offer) {
                return '<a href="' . ($offer->preview_url ? $offer->preview_url : '#') . '" ' . ($offer->preview_url ? '' : 'onclick="alert(\'No Preview Found\')"') . '><button class="btn btn-warning d-flex"><i class="fas fa-eye m-1"></i>Preview Offer</button></a>';
            })
            ->addColumn('apply', function ($offer) {
                return '<a href="/request/offer/' . base64_encode($offer->id) . '" target="_blank"><button class="btn btn-warning">Request Offer</button></a>';
            })
            ->addColumn('locations', function ($offer) {
                $countries = 'ALL';
                if ($offer?->countries) {
                    $countries = $offer?->countries;
                }
                return $countries;
            })
            ->addColumn('payout', function ($offer) {
                if (is_numeric($offer->credit) && is_numeric($offer->rate->rate->network_rate)) {
                    $pay = ($offer->credit * $offer->rate->rate->network_rate) / 100;
                } else {
                    $pay = 0;
                }
                //  $pay=($offer?->credit*$offer?->rate?->rate?->network_rate)/100;
                $formattedValue = number_format($pay, 4);
                return $formattedValue;
            })
            ->addColumn('os', function ($offer) {
                if ($offer->web == 1 && $offer->mobile == 1) {
                    return 'Web & Mobile';
                } elseif ($offer->web == 1 && $offer->mobile == 0) {
                    return 'Web';
                } elseif ($offer->mobile == 1 && $offer->web == 0) {
                    return 'Mobile';
                }
            })
            ->rawColumns(['checkbox', 'icon', 'preview', 'apply', 'locations', 'payout'])
            ->make(true);
    }

    public function getOffersDataActive(Request $request)
    {
        // dd($request->user_id);
        $query = ActiveOffers::query()->where('user_id',$request->user_id)->where('approved_status',1)->with('offers');

        // dd($query->get()[0]);
        if ($request->category) {
            $query->whereHas('offers', function ($offer) use ($request) {
            $offer->where(function ($q) use ($request) {
                foreach ($request->category as $category) {
                $q->orWhere('categories', 'like', '%' . $category . '%');
                }
            });
            });
        }

        if ($request->target || $request->conversion_type || $request->traffic_types || $request->allowed_media) {
            $query->whereHas('offers', function ($offer) use ($request) {
                $offer->where(function ($q) use ($request) {
                    if ($request->target) {
                        foreach ($request->target as $target) {
                            $q->orWhere('targets', 'like', '%' . $target . '%');
                        }
                    }
                    if ($request->allowed_media) {
                        foreach ($request->allowed_media as $allowed_media) {
                            $q->orWhere('targets', 'like', '%' . $allowed_media . '%');
                        }
                    }
                    if ($request->conversion_type) {
                        foreach ($request->conversion_type as $conversion_type) {
                            $q->orWhere('targets', 'like', '%' . $conversion_type . '%');
                        }
                    }
                    if ($request->traffic_types) {
                        foreach ($request->traffic_types as $traffic_types) {
                            $q->orWhere('targets', 'like', '%' . $traffic_types . '%');
                        }
                    }
                });
            });
        }
        if ($request->countries) {
           $query->whereHas('offers', function ($offer) use ($request) {
                $offer->where(function($q) use ($request) {
                foreach ($request->countries as $country) {
                    $q->orWhere('countries', 'like', '%' . $country . '%');
                }
            });
            });
        }

        if ($request->os) {
           $query->whereHas('offers', function ($offer) use ($request) {
                $offer->where(function($q) use ($request) {
                if (in_array('web', $request->os)) {
                    $q->orWhere(function ($q) {
                        $q->where('web', 1)->where('mobile', 0);
                    });
                }

                if (in_array('mobile', $request->os)) {
                    $q->orWhere(function ($q) {
                        $q->where('mobile', 1)->where('web', 0);
                    });
                }

                if (in_array('web-and-mobile', $request->os)) {
                    $q->orWhere(function ($q) {
                        $q->where('web', 1)->where('mobile', 1);
                    });
                }
            });
        });
        }

        $query->orderBy('id', 'desc');
       

        return DataTables::of($query)
            ->addColumn('checkbox', function ($offer) {
                return '<input type="checkbox" class="form-check-input check-items" name="id[]" value="' . $offer?->offers?->id . '">';
            })
            ->addColumn('icon', function ($offer) {
                $baseUrl = env('APP_URL');

                // Check if image URL is '/img/reward.png'
                if ($offer->offers->image_url == '/img/reward.png') {
                    // Return the image URL as is
                    $imageUrl = $offer?->offers?->image_url;
                } else {
                    // Fallback to using the image based on the offer ID
                    $imageUrl = '/image/' . $offer->offers?->id;
                }

                // Return the HTML for the image
                return '<img src="' . $baseUrl . $imageUrl . '" height="18"/>';
            })
            ->addColumn('preview', function ($offer) {
                return '<a target="_blank" href="' . ($offer?->offers?->preview_url ? $offer?->offer?->preview_url : '#') . '" ' . ($offer?->offer?->preview_url ? '' : 'onclick="alert(\'No Preview Found\')"') . '><button class="btn btn-warning d-flex"><i class="fas fa-eye m-1"></i>Preview Offer</button></a>';
            })
            ->addColumn('offer_id', function ($offer) {
                return $offer?->offers?->id;
            })
            ->addColumn('locations', function ($offer) {
                // dd($offer);
                $countries = 'ALL';
                if ($offer?->offers->countries) {
                    $countries = $offer?->offers?->countries;
                }
                return $countries;
            })
            ->addColumn('name', function ($offer) {
                return $offer?->offers?->name;
            })
            ->addColumn('oid', function ($offer) {
                return $offer?->id;
            })
            ->addColumn('action', function ($offer) {
                return $offer?->id;
            })
            ->addColumn('categories', function ($offer) {
                return $offer?->offers?->categories;
            })
            ->addColumn('payout', function ($offer) {
                if (is_numeric($offer?->offer?->credit) && is_numeric($offer?->offer?->rate?->rate?->network_rate)) {
                    $pay = ($offer?->offer?->credit * $offer?->offer->rate?->rate?->network_rate) / 100;
                } else {
                    $pay = 0;
                }
                //  $pay=($offer?->credit*$offer?->rate?->rate?->network_rate)/100;
                $formattedValue = number_format($pay, 4);
                return $formattedValue;
            })
            ->addColumn('os', function ($offer) {
                if ($offer?->offer?->web == 1 && $offer?->offer?->mobile == 1) {
                    return 'Web & Mobile';
                } elseif ($offer?->offer?->web == 1 && $offer?->offer?->mobile == 0) {
                    return 'Web';
                } elseif ($offer?->offer?->mobile == 1 && $offer?->offer?->web == 0) {
                    return 'Mobile';
                }
            })
            ->rawColumns(['checkbox', 'icon', 'preview', 'apply', 'locations', 'payout'])
            ->make(true);
    }

    public function getOffersDataPending(Request $request)
    {
        $query = Offer::query();

        if ($request->category) {
            $query->where(function ($q) use ($request) {
                foreach ($request->category as $category) {
                    $q->orWhere('categories', 'like', '%' . $category . '%');
                }
            });
        }

        if ($request->target || $request->conversion_type || $request->traffic_types || $request->allowed_media) {
            $query->where(function ($q) use ($request) {
                if ($request->target) {
                    foreach ($request->target as $target) {
                        $q->orWhere('targets', 'like', '%' . $target . '%');
                    }
                }
                if ($request->allowed_media) {
                    foreach ($request->allowed_media as $allowed_media) {
                        $q->orWhere('targets', 'like', '%' . $allowed_media . '%');
                    }
                }
                if ($request->conversion_type) {
                    foreach ($request->conversion_type as $conversion_type) {
                        $q->orWhere('targets', 'like', '%' . $conversion_type . '%');
                    }
                }
                if ($request->traffic_types) {
                    foreach ($request->traffic_types as $traffic_types) {
                        $q->orWhere('targets', 'like', '%' . $traffic_types . '%');
                    }
                }
            });
        }
        if ($request->countries) {
            $query->where(function ($q) use ($request) {
                foreach ($request->countries as $country) {
                    $q->orWhere('countries', 'like', '%' . $country . '%');
                }
            });
        }

        if ($request->os) {
            $query->where(function ($q) use ($request) {
                if (in_array('web', $request->os)) {
                    $q->orWhere(function ($q) {
                        $q->where('web', 1)->where('mobile', 0);
                    });
                }

                if (in_array('mobile', $request->os)) {
                    $q->orWhere(function ($q) {
                        $q->where('mobile', 1)->where('web', 0);
                    });
                }

                if (in_array('web-and-mobile', $request->os)) {
                    $q->orWhere(function ($q) {
                        $q->where('web', 1)->where('mobile', 1);
                    });
                }
            });
        }

        $query->orderBy('id', 'desc');

        return DataTables::of($query)
            ->addColumn('checkbox', function ($offer) {
                return '<input type="checkbox" class="form-check-input check-items" name="id[]" value="' . $offer->id . '">';
            })
            ->addColumn('icon', function ($offer) {
                $baseUrl = env('APP_URL');

                // Check if image URL is '/img/reward.png'
                if ($offer->image_url == '/img/reward.png') {
                    // Return the image URL as is
                    $imageUrl = $offer->image_url;
                } else {
                    // Fallback to using the image based on the offer ID
                    $imageUrl = '/image/' . $offer->id;
                }

                // Return the HTML for the image
                return '<img src="' . $baseUrl . $imageUrl . '" height="18"/>';
            })
            ->addColumn('preview', function ($offer) {
                return '<a href="' . ($offer->preview_url ? $offer->preview_url : '#') . '" ' . ($offer->preview_url ? '' : 'onclick="alert(\'No Preview Found\')"') . '><button class="btn btn-warning d-flex"><i class="fas fa-eye m-1"></i>Preview Offer</button></a>';
            })
            ->addColumn('apply', function ($offer) {
                return '<a href="/request/offer/' . base64_encode($offer->id) . '" target="_blank"><button class="btn btn-warning">Request Offer</button></a>';
            })
            ->addColumn('locations', function ($offer) {
                $countries = 'ALL';
                if ($offer?->countries) {
                    $countries = $offer?->countries;
                }
                return $countries;
            })
            ->addColumn('payout', function ($offer) {
                if (is_numeric($offer->credit) && is_numeric($offer->rate->rate->network_rate)) {
                    $pay = ($offer->credit * $offer->rate->rate->network_rate) / 100;
                } else {
                    $pay = 0;
                }
                //  $pay=($offer?->credit*$offer?->rate?->rate?->network_rate)/100;
                $formattedValue = number_format($pay, 4);
                return $formattedValue;
            })
            ->addColumn('os', function ($offer) {
                if ($offer->web == 1 && $offer->mobile == 1) {
                    return 'Web & Mobile';
                } elseif ($offer->web == 1 && $offer->mobile == 0) {
                    return 'Web';
                } elseif ($offer->mobile == 1 && $offer->web == 0) {
                    return 'Mobile';
                }
            })
            ->rawColumns(['checkbox', 'icon', 'preview', 'apply', 'locations', 'payout'])
            ->make(true);
    }
}
