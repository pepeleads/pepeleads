<?php

namespace App\Http\Controllers;

use App\Models\ActiveOffers;
use App\Models\Offer;
use App\Models\Site;
use App\Models\Notification;
use App\Models\OfferProcess;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stringable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->user_id == null) {
            $update = User::where('id', auth()->user()->id)->update([
                'user_id' => uuid4()
            ]);
        }
        if (auth()->user()->user_type == 'admin') {
            return redirect('admin/dashboard');
        }
        elseif (auth()->user()->user_type == 'subadmin') {
            return redirect('admin/dashboard');
        }
        $total_clicks = OfferProcess::where('user_id', auth()->user()->id)->count();
        $total_active_offers = ActiveOffers::where('user_id', auth()->user()->id)->whereHas('offers',function($query){
            $query->whereNull('deleted_at');
        })->with('offers')->count();
        $completed = OfferProcess::where('user_id', auth()->user()->id)->where('status', 'completed')->count();
        $reversed = OfferProcess::where('user_id', auth()->user()->id)->where('status', 'reversed')->count();

        $total_earning=OfferProcess::where('user_id',auth()->user()->id)->where('status','completed')->sum('ref_credit');
        $total_reverse=OfferProcess::where('user_id',auth()->user()->id)->where('status','reversed')->sum('ref_credit');

        $currentMonthReversed = OfferProcess::where('user_id', auth()->user()->id)
            ->where('status', 'reversed')
            ->whereMonth('created_at', now()->month)
            // ->count();
            ->sum('ref_credit');

        $lastMonthReversed = OfferProcess::where('user_id', auth()->user()->id)
            ->where('status', 'reversed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('ref_credit');
            // ->count();

        $totalLifetimeReversed = OfferProcess::where('user_id', auth()->user()->id)
            ->where('status', 'reversed')
            ->sum('ref_credit');
            // ->count();
        $notification = Notification::where('user_id', auth()->user()->id)->orWhere('notification_type', 'All')->orderBy('created_at','desc')->limit(5)->get();
        $latest_offers=Offer::where('active',1)->with('rate')->orderBy('created_at','desc')->limit(5)->get();

        $currentUsersOffers = OfferProcess::where('user_id', auth()->user()->id)->where('status', 'completed')
        ->select('start_country', DB::raw('SUM(ref_credit) as total'))
        ->groupBy('start_country')
        ->get();

        // dd($currentUsersOffers);

        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();


        $mapData=[];
        foreach ($currentUsersOffers as $key => $value) {
            if($value->start_country==null || $value->start_country==''){
                continue;
            }
            $mapData[$value->start_country]=['revenue'=>$value->total];
        }
        
        $graphData=json_encode($mapData);
        // dd($graphData);
        return view('dashboard.business.horizontal_dashboard',[
            'total_clicks'=>$total_clicks,
            'total_active_offers'=>$total_active_offers,
            'completed'=>$completed, 
            'total_earning'=>$total_earning,
            'notification'=>$notification,
            'latest_offers'=>$latest_offers, 
            'reversed'=>$total_reverse, 
            'currentMonthReversed'=>$currentMonthReversed, 
            'lastMonthReversed'=>$lastMonthReversed, 
            'totalLifetimeReversed'=>$totalLifetimeReversed,
            'graphData'=>$graphData,
            'sites'=>$sites
        ]);
    }

    public function sites()
    {
        $sites = Site::where('user_id', auth()->user()->id)->get();
        return view('pages.business.sites', ['sites' => $sites]);
    }
    public function site_add()
    {
        return view('pages.business.add_sites');
    }
    public function site_edit($id)
    {
        try {
            $decrypted = Crypt::decrypt($id);

            $site = Site::where(['id' => $decrypted, 'user_id' => auth()->user()->id])->first();

            return view('pages.business.edit_sites', ['site' => $site, 'id' => $id]);
        } catch (DecryptException $e) {
            abort(404);
        }
    }


    public function notifications()
    {
        $notifications = notification::where('user_id', auth()->user()->id)->orWhere('notification_type','All')->orderBy('created_at','desc')->get();
        return view('pages.business.notifications', ['notifications' => $notifications]);
    }
    public function notification_add()
    {
        return view('pages.admin.add_notifications');
    }
    public function notification_edit($id)
    {
        try {
            $decrypted = Crypt::decrypt($id);

            $notification = notification::where(['id' => $decrypted, 'user_id' => auth()->user()->id])->first();

            return view('pages.business.edit_notifications', ['notification' => $notification, 'id' => $id]);
        } catch (DecryptException $e) {
            abort(404);
        }
    }


    public function reports()
    {
        $listCompleted=OfferProcess::where('user_id',auth()->user()->id)->where('status','completed')->orWhere('status','reversed')->orderBy('created_at','desc')->get();
        // dd($listCompleted);
        
        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
        return view('pages.business.reports',['listCompleted'=>$listCompleted, 'sites'=>$sites]);
    }

    public function advertise()
    {
        
        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
        return view('pages.business.advertise');
    }

    public function finance()
    {
        $details = PaymentDetail::where('user_id', auth()->user()->id)->first();
        if ($details) {
            $status = 1;
        } else {
            $status = 0;
        }
        
        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
        return view('pages.business.finance', ['details' => $details, 'status' => $status]);
    }

    public function postback_integrations()
    {
        
        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
        return view('pages.business.postback_integrations');
    }

    public function api_integrations()
    {
        
        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
        return view('pages.business.api_integrations');
    }

    public function all_offers()
    {
        $offers = Offer::with('rate')->get();
        $categories = Offer::select('categories')->distinct()->pluck('categories')->toArray();
        $targets = Offer::select('targets')->distinct()->pluck('targets')->toArray();
        $isoCountries=DB::table('country_iso')->get();

        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
  
        return view('pages.business.all_offers', 
        ['offers' => $offers->toArray(), 
        'categories' => $categories, 
        'targets' => $targets,
        'isoCountries'=>$isoCountries,
        'sites'=>$sites]);
    }

    public function active_offers()
    {
        // $offers = ActiveOffers::where('user_id', auth()->user()->id)->where('approved_status',1)->with('offers')->get();
        // // dd($offers);
        $offers = Offer::with('rate')->get();
        $categories = Offer::select('categories')->distinct()->pluck('categories')->toArray();
        $targets = Offer::select('targets')->distinct()->pluck('targets')->toArray();
        $isoCountries=DB::table('country_iso')->get();
        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
        return view('pages.business.active_offers',  
        ['offers' => $offers->toArray(), 
        'categories' => $categories, 
        'targets' => $targets,
        'isoCountries'=>$isoCountries,
        'sites'=>$sites]);
    }

    public function pending_offers()
    {
        $offers = ActiveOffers::where('user_id', auth()->user()->id)->where('approved_status',0)->with('offers')->get();
        // dd(json_encode($offers->toArray()));
        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
        return view('pages.business.pending_offers', ['offers' => $offers->toArray(),
        'sites'=>$sites]);
    }

    public function offer_details($id)
    {

        $oid=base64_decode($id);
        // dd($oid);
        // $offer=Offer::where('id',$oid)->first();
        $check_Offer=ActiveOffers::where([
            'offer_id'=>$oid,
            'user_id'=>auth()->user()->id,
            'approved_status'=>1
            ])->with('offers')->first();
            
        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
        if(!$check_Offer){
            $offer=Offer::where('id',$oid)->first();
            // dd(!$offer);
            // return view('pages.business.offer_details_preview', ['offer' => $offer]);
            return view('pages.business.offer_details_preview', ['offer' => $offer, 'show_preview'=>true]);
        }
        return view('pages.business.offer_details', ['offer' => $check_Offer, 'show_preview'=>false]);
    }
    public function offer_apply($id)
    {
        $offer_id = base64_decode($id);

        $offer = Offer::where('id', $offer_id)->first();

        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
        if ($offer) {
            
            if(ActiveOffers::where('offer_id',$offer->id)->where('user_id',auth()->user()->id)->first()){
                return  "<html><script>alert('Offer already applied!'); window.location.href='/all_offers';</script></html>";
                return redirect()->back()->with('status', 'Offer already applied!');
            }
            $approveStatus=0;

            if(in_array('ALL',json_decode($offer->users))||in_array(auth()->user()->id,json_decode($offer->users))){
                $approveStatus=1;
            }
            $activeOffer = ActiveOffers::create([
                'user_id' => auth()->user()->id,
                'offer_id' => $offer->id,
                'camp_id' => $offer->campaign_id,
                'network' => $offer->network,
                'approved_status' => $approveStatus
            ]);
            Notification::create([
                'user_id' => auth()->user()->id,
                'notification_title' => 'Offer Applied',
                'notification_description' => 'Your offer has been applied',
                'seen_status' => 0,
                'notification_type' => 'User',
                'notification_link' => '/offer_details/'.base64_encode($offer->id),
                'notification_id' => uuid4(),
            ]);

            if($approveStatus==1){
                return redirect()->route('active_offers');
            }else{
                return redirect()->route('pending_offers');
            }

          
        } else {
            abort(404);
        }
    }

    public function offer_delete($id)
    {
        $offer_id = base64_decode($id);

        $offer = ActiveOffers::where('id', $offer_id)->first();

        if ($offer) {
             ActiveOffers::where('id', $offer->id)->delete();
             return redirect()->back();
        } else {
            abort(404);
        }
    }

    public function refer()
    {
        $ref_id = User::select('refer_id')->where('id', auth()->user()->id)->first();
        // dd($ref_id->refer_id);
        if ($ref_id->refer_id == null || $ref_id->refer_id == "") {
            $new_ref = uuid4();
            $update = User::where('id', auth()->user()->id)->update([
                'refer_id' => $new_ref
            ]);
            $ref_id = User::select('refer_id')->where('id', auth()->user()->id)->first();
        }
        $refs_list = User::select('email', 'name', 'created_at')->where('refer_by', $ref_id->refer_id)->get();
        return view('pages.business.refer', ['ref_id' => $ref_id->refer_id, 'refs' => $refs_list]);
    }

    public function sub_users()
    {
        $ref_id = User::select('refer_id')->where('id', auth()->user()->id)->first();
        // dd($ref_id->refer_id);
        if ($ref_id->refer_id == null || $ref_id->refer_id == "") {
            $new_ref = uuid4();
            $update = User::where('id', auth()->user()->id)->update([
                'refer_id' => $new_ref
            ]);
            $ref_id = User::select('refer_id')->where('id', auth()->user()->id)->first();
        }
        $refs_list = User::select('email', 'name', 'created_at')->where('refer_by', $ref_id->refer_id)->get();
        return view('pages.business.refer', ['ref_id' => $ref_id->refer_id, 'refs' => $refs_list]);
    }

    public function profile()
    {
        
        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
        return view('pages.business.profile');
    }

    public function gen_uid($l = 5)
    {
        return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 10, $l);
    }


    // Post Routes for Store Data
    public function add_site(Request $request)
    {
        $input = $request->all();

        $sites=Site::where('user_id',auth()->user()->id)->where('status',1)->get();
        Site::create([
            'user_id' => auth()->user()->id,
            'site_name' => $input['site_name'],
            'domain_name' => $input['domain_name'],
            'post_back' => $input['post_back_link'],
            'virtual_currency' => "$",
            'currency_value' => 100,
            'description' => $input['description'],
            'status' => 0,
            'api_key' => $this->gen_uid(20),
            'secret_key' => $this->gen_uid(35),

        ]);
        // Mail::to(env('ADMIN_EMAIL'))->send(new SiteAdded($input['site_name']));
        $recv_user=User::where('id',auth()->user()->id)->first();
        Notification::create([
            'user_id' => auth()->user()->id,
            'notification_title' => 'Site Approval Requested',
            'notification_description' => 'Site approval requested successfully',
            'seen_status' => 0,
            'notification_type' => 'User',
            'notification_link' => '/sites/',
            'notification_id' => uuid4(),
        ]);
        $body=' <table align="center" width="600" style="border-collapse: collapse; background-color: #ffffff; border: 1px solid #ddd; margin: 20px auto; padding: 20px;">
<!-- Logo Section -->
<tr>
    <td style="text-align: center; padding: 20px;">
        <img src="https://pepeleads.com/home/img/logo-white.png" alt="Company Logo" style="max-width: 20%; height: auto;">
    </td>
</tr>
<!-- Content Section -->
<tr>
    <td style="padding: 10px 20px; font-size: 16px; line-height: 1.5;">
        <p style="margin: 0;">Dear Admin,</p>
        <p style="margin: 10px 0;">
          '.auth()->user()->name.' requested for add site   
        Site Name: '.$input['site_name'].'<br>
        Domain: '.$input['domain_name'].'<br>
        Postback: '.$input['post_back_link'].'<br>
        Description: '.$input['description'].' <br>
        </p>
        <p style="margin: 10px 0;">
            Please do the needful.
        </p>
        
    </td>
</tr>
<tr>
    
</tr>
</table>';
        send_mail(env('ADMIN_EMAIL'), 'Request for Add Site',$body);
        send_mail('surveytitans1@gmail.com', 'Request for Add Site',$body);
       
        return  redirect('/sites')->with('status', 'Site added successfully!');
    }

    public function edit_site(Request $request)
    {
        $input = $request->all();

        try {

            $decrypted = Crypt::decrypt($input['id']);

            Site::where('id', $decrypted)->update([
                'user_id' => auth()->user()->id,
                'site_name' => $input['site_name'],
                'domain_name' => $input['domain_name'],
                'post_back' => $input['post_back_link'],
                'virtual_currency' => "$",
                'currency_value' => 100,
                'description' => $input['description'],
            ]);
            return  redirect('/sites')->with('status', 'Site updated successfully!');
        } catch (DecryptException $e) {
            abort(404);
        }
    }
    


    public function add_notifications(Request $request)
    {
        $input = $request->all();
        Notification::create([
            'user_id' => auth()->user()->id,
            'notification_id' => uuid4(),
            'notification_title' => $input['notification_title'],
            'notification_description' => $input['notification_description'],
            'notification_link' => $input['notification_link'],
            'notification_type' => $input['notification_type'],
            'seen_status' => 0,

        ]);
        return  redirect('/notifications')->with('status', 'notification added successfully!');
    }

    public function edit_notifications(Request $request)
    {
        $input = $request->all();
        try {
            $decrypted = Crypt::decrypt($input['id']);
            Notification::where('id', $decrypted)->update([
                'user_id' => auth()->user()->id,
                'notification_id' => $input['notification_id'],
                'notification_title' => $input['notification_title'],
                'notification_description' => $input['notification_description'],
                'notification_type' => $input['notification_type'],
                'seen_status' => 0,
            ]);
            return  redirect('/notifications')->with('status', 'notification updated successfully!');
        } catch (DecryptException $e) {
            abort(404);
        }
    }


    public function update_profile(Request $request)
    {
        $input = $request->all();

        // dd($input,$request->file('profile_photo'));

        if (!empty($request->profile_photo)) {

            $file = $request->file('profile_photo');
            $extension = $file->getClientOriginalExtension();
            if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $image = '/uploads/' . $filename;
            } else {
                return  redirect('/profile')->with('status', 'Invalid File Type! This File Type is not allowed');
                // $image=null;
            }
        } else {
            $image = auth()->user()->profile_picture;
        }

        User::where('id', auth()->user()->id)->update([
            'name' => $input['full_name'],
            'phone' => $input['phone'],
            'city' => $input['city'],
            'country' => $input['country'],
            'profile_picture' => $image,
            'address' => $input['address']
        ]);
        return  redirect('/profile')->with('status', 'Profile updated!');
    }

    public function add_payment_details(Request $request)
    {
        $input = $request->all();

        PaymentDetail::updateOrCreate([
            'user_id' => auth()->user()->id
        ], [
            'user_id' => auth()->user()->id,
            'payment_type' => $input['payment_type'],
            'details' => $input['payment_details']
        ]);

        return  redirect('/finance')->with('status', 'Payment Details Updated Successfully');
    }

    public function login_as_user($id)
{
    $user = User::find($id);

    if ($user && $user->user_type == 'user') {
        // Regular user login
        session(['adminLoggedIn' => true, 'admin_user_id' => auth()->user()->id]);
        auth()->login($user);
        return redirect('/dashboard'); // Redirect to user dashboard

    } elseif ($user && $user->user_type == 'admin') {
        // Admin user login
        if (session('adminLoggedIn') && session('admin_user_id')) {
            auth()->loginUsingId(session('admin_user_id'));
            session()->forget(['adminLoggedIn', 'admin_user_id']);
        }
        return redirect('/admin/list_users')->with('status', 'Back to Users'); // Redirect to admin list users page

    } elseif ($user && $user->user_type == 'subadmin') {
        // Subadmin user login
        if (session('adminLoggedIn') && session('admin_user_id')) {
            auth()->loginUsingId(session('admin_user_id'));
            session()->forget(['adminLoggedIn', 'admin_user_id']);
        }
        return redirect('/admin/list_users')->with('status', 'Back to Subadmin Portal'); // Redirect to subadmin portal
    }

    // Fallback if no user is found or if user_type is invalid
    return redirect()->back()->with('error', 'User not found or invalid user type.');
}

}