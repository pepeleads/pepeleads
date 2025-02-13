<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use App\Models\Network;
use App\Models\ApiProvider;
use Illuminate\Support\Str;
use App\Models\OfferProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\roles;
use App\Models\NetworkComission;
use App\Http\Middleware\AdminCheck;
use App\Models\ActiveOffers;
use App\Models\Site;
use App\Models\Blogs;
use App\Models\Image;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{

    function __construct()
    {
        $this->middleware(AdminCheck::class);
        $this->middleware('auth');
    }
    public function index()
    {
        return view('pages.admin.dashboard');
    }
    public function profile_view()
    {
        return view('pages.admin.profile');
    }
    
    public function upload_file_view()
    {

        $images = Image::get();
        return view('pages.admin.upload_file_view', ['images' => $images]);
    }

    public function upload_file(Request $request)
    {
        $input = $request->all();

        if (!empty($request->image)) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg') {
                $filename = time() . "-" . rand(1000000, 9999999) . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $image = '/uploads/' . $filename;

                $create = Image::create([
                    'name' => $filename,
                    'uploaded_date' => Carbon::now()
                ]);
                return  redirect('/admin/upload_files')->with('status', 'File Uploaded Successfully');
            } else {
                return  redirect('/admin/upload_files')->with('status', 'Invalid File Type! This File Type is not allowed');
            }
        } else {
            return  redirect('/admin/upload_files')->with('status', 'Invalid File Type! This File Type is not allowed');
        }
    }

    public function remove_upload_file(Request $request)
    {
        $id = $request->get('id');

        if (isset($id)) {
            $find = Image::where([
                'id' => $id
            ])->first();

            if ($find) {

                $find->delete();
                return  redirect('/admin/upload_files')->with('status', 'File Removed Successfully');
            } else {
                return  redirect('/admin/upload_files')->with('status', 'Invalid File Type! This File Type is not allowed');
            }
        } else {
            return  redirect('/admin/upload_files')->with('status', 'Invalid File Type! This File Type is not allowed');
        }
    }
    public function list_users_view()
    {

        $users = User::where('user_type', 'user') ->orWhere('user_type', 'subadmin') ->orderBy('created_at', 'DESC') ->get();
        // dd($users);
        return view('pages.admin.userslist', ['users' => $users]);
    }
    public function edituser($id)
    {
        $users = User::where('id', $id)->first();
        $managers=User::where('role_id',1)->get();

        return view('pages.admin.edituser', ['users' => $users,'managers'=>$managers]);
    }
    public function updateuser(Request $request)
    {
        $input = $request->all();

        // Check if profile photo is provided
        if (!empty($request->profile_photo)) {
            $file = $request->file('profile_photo');
            $extension = $file->getClientOriginalExtension();

            // Validate file extension
            if (in_array($extension, ['png', 'jpg', 'jpeg'])) {
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $image = '/uploads/' . $filename;
            } else {
                return redirect('/profile')->with('status', 'Invalid File Type! This File Type is not allowed');
            }
        } else {
            $image = null; // Set to null if no profile photo is uploaded
        }

        // Find the user by email or another unique identifier (e.g., id)
        $usr = User::where('email', $input['email'])->first();

        if ($usr) {
            // Update the user details
            $usr->name = $input['full_name'];
            $usr->phone = $input['phone'];
            $usr->city = $input['city'];
            $usr->country = $input['country'];
            $usr->address = $input['address'];
            $usr->role_id = $input['role_id'];
            $usr->user_type = $input['user_type'];
            $usr->skype = $input['skype'];
            $usr->assign_manager_id = $input['assign_manager_id'];

            // Update the profile picture if a new one is uploaded
            if ($image) {
                $usr->profile_picture = $image;
            }

            // Save the updated user data
            $usr->save();

            return redirect('/admin/list_users')->with('status', 'User Updated Successfully.');
        } else {
            return redirect('/admin/list_users')->with('status', 'User Not Found.');
        }
    }

    public function addroll()
    {
        return view('pages.admin.addroll');
    }
    public function createuserrole(Request $request)
    {
        $rule = new roles();
        $rule->name = $request->name;
        $rule->description = $request->description;
        $rule->permissions = json_encode($request->permissions);
        $rule->user_id = $request->user_id;
        $rule->save();
        return redirect()->back()->with('status', 'User Role created successfully!');
    }
    public function userrolls()
    {

        $users = roles::orderBy('id','ASC')->get();
        // dd($users);
        return view('pages.admin.userrolls', ['users' => $users]);
    }
    public function editrole($id)
    {
        $data = roles::findOrFail($id);
        $permissions = json_decode($data->permissions, true);
        return view('pages.admin.editrole')->with(array('data' => $data, 'permissions' => $permissions));
    }
    public function edituserrole(Request $request)
    {
        $rule = roles::find($request->id);
        $rule->name = $request->name;
        $rule->description = $request->description;
        $rule->permissions = json_encode($request->permissions);
        $rule->user_id = $request->user_id;
        $rule->save();
        return redirect()->back()->with('status', 'User Role Update successfully!');
    }
    public function list_sites_view()
    {

        $users = User::orderBy('id', 'DESC')->where('user_type', 'user')->get();
        $sites=Site::with('user')->orderBy('created_at','DESC')->get();
        // dd($sites);
        return view('pages.admin.siteslist', ['users' => $users,'sites'=>$sites]);
    }

    public function site_status(Request $request)
    {
        $input = $request->all();
        $site = Site::where('id', $input['id'])->with('user')->first();
        if ($site) {
            if ($site->status == 1) {
                $site->status = 0;
            } else {

                $site->status = 1;
            
                $recv_user=User::where('id',$site->user_id)->first();
                Notification::create([
                    'user_id' => $recv_user->id,
                    'notification_title' => 'Site Approved',
                    'notification_description' => 'Your Site has been Approved',
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
                <p style="margin: 0;">Dear '.$site->user->name.',</p>
                <p style="margin: 10px 0;">
                    I\'m pleased to inform you that your site has been approved! We\'re excited to have you onboard and look forward to a successful collaboration.
                </p>
                <p style="margin: 10px 0;">
                    Feel free to reach out if you have any questions or need assistance.
                </p>
                <p style="margin: 20px 0;">
                    <strong>Skype:</strong> live:cid.1543b72eb8c89c26<br>
                    <strong>Email:</strong> <a href="mailto:anej.gliha@pepeleads.com" style="color: #007bff; text-decoration: none;">anej.gliha@pepeleads.com</a><br>
                    <strong>Website:</strong> <a href="https://pepeleads.com" style="color: #007bff; text-decoration: none;">https://pepeleads.com</a>
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px 20px; text-align: center; font-size: 14px; color: #666;">
                <p style="margin: 0;">Looking forward to your reply.</p>
            </td>
        </tr>
    </table>';
                send_mail($recv_user->email, 'Your site has been approved!',$body);
               
            }
            $site->save();
            return redirect('/admin/list_sites')->with('status', 'Site Status Updated Successfully');
        } else {
            return redirect('/admin/list_sites')->with('status', 'Failed to Update Site Status');
        }
    }
  
    public function add_users_view()
    {
        return view('pages.admin.adduser');
    }
    public function usersview_view()
    {
        return view('pages.admin.usersview');
    }
    public function all_leads_view()
    {
        $process = OfferProcess::with('offer')->orderBy('id', 'DESC')->get();
        return view('pages.admin.all_leads', ['offers' => $process]);
    }
    public function completed_leads_view()
    {
        $process = OfferProcess::with('offer')->where('status','completed')->orderBy('id', 'DESC')->get();
        return view('pages.admin.completed_leads',['offers' => $process]);
    }
    public function pending_leads_view()
    {
        $leads_enquiry= DB::table('contect_queries')->orderBy('created_at','asc')->get();
        // dd($leads_enquiry);
        return view('pages.admin.pending_leads',['leads'=>$leads_enquiry]);
    }
    public function list_offers_view()
    {
      
        $offers = Offer::with('rate')->orderBy('id', 'DESC')->get();
        // dd($offers);
        return view('pages.admin.list_offers', ['offers' => $offers]);
    }
    public function offer_pending_requests()
    {

        $offers = Offer::orderBy('id', 'DESC')->get();
        return view('pages.admin.pending_request_offers', ['offers' => $offers]);
    }
    public function offer_approved_requests()
    {

        $offers = Offer::orderBy('id', 'DESC')->get();
        return view('pages.admin.approved_request_offers', ['offers' => $offers]);
    }

    public function reverseLeads(Request $request)
    {
        if (!$request->has('leads')) {
            return response()->json(['success' => false]);
        }

        try {
            $leads = $request->leads;
            
            // Update status to reversed for selected leads
            // Get the leads with their amounts before updating
            $leadsToReverse = OfferProcess::whereIn('id', $leads)
                ->where('status', 'completed')
                ->get();

            // Subtract amounts from user balances
            foreach ($leadsToReverse as $lead) {
                $user = User::find($lead->user_id);
                if ($user) {
                    $user->balance = $user->balance - $lead->ref_credit;
                    $user->save();
                }
            }

            // Update status to reversed
            OfferProcess::whereIn('id', $leads)
                ->where('status', 'completed')
                ->update(['status' => 'reversed']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
    public function completeLeads(Request $request)
    {
        if (!$request->has('leads')) {
            return response()->json(['success' => false]);
        }

        try {
            $leads = $request->leads;
            
            // Update status to reversed for selected leads
            // Get the leads with their amounts before updating
            $leadsToReverse = OfferProcess::whereIn('id', $leads)
                ->where('status', 'pending')->orWhere('status', 'reversed')
                ->get();

            // Subtract amounts from user balances
            foreach ($leadsToReverse as $lead) {
                $user = User::find($lead->user_id);
                if ($user) {
                    $user->balance = $user->balance + $lead->ref_credit;
                    $user->save();
                }
            }

            // Update status to reversed
            OfferProcess::whereIn('id', $leads)
                ->where('status', 'pending')->orWhere('status', 'reversed')
                ->update(['status' => 'completed']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    public function add_offer_view()
    {

        $networks = Network::orderBy('id', 'DESC')->get();
        $countries=DB::table('country_iso')->get();
        $users=User::where('user_type','user')->get();
        // dd($countries);
        return view('pages.admin.add_offer', ['networks' => $networks,'countries'=>$countries,'users'=>$users]);
    }

    public function edit_offer_view($id)
    {
        $offer = Offer::where('id', $id)->first();
        // dd($offer);
        if($offer){
            $networks = Network::orderBy('id', 'DESC')->get();
            $countries=DB::table('country_iso')->get();
            $users=User::where('user_type','user')->get();
            return view('pages.admin.edit_offer', ['networks' => $networks,'countries'=>$countries,'offer'=>$offer,'users'=>$users]);
        }else{
            return redirect('/admin/list_offers')->with('status', 'Offer Not Found');
        }
        // $networks = Network::orderBy('id', 'DESC')->get();
        // $countries=DB::table('country_iso')->get();
        // // dd($countries);
        // return view('pages.admin.add_offer', ['networks' => $networks,'countries'=>$countries]);
    }
    public function active_offers_view()
    {
        $offers = Offer::orderBy('id', 'DESC')->where('active', 1)->get();
        return view('pages.admin.active_offers', ['offers' => $offers]);
    }
    public function banned_offers_view()
    {
        $offers = Offer::orderBy('id', 'DESC')->where('active', 0)->get();

        return view('pages.admin.banned_offers', ['offers' => $offers]);
    }
    public function networks_view()
    {

        $networks = Network::get();

        return view('pages.admin.networks', ['networks' => $networks]);
    }
    public function add_network_view()
    {
        return view('pages.admin.addnetwork');
    }
    public function list_postback_view()
    {
        return view('pages.admin.list_postback');
    }
    public function add_postback_view()
    {
        return view('pages.admin.add_postback');
    }


    // Action Function (Intract with Database)

    public function add_network(Request $request)
    {
        $input = $request->all();


        $create_network = Network::updateOrCreate([
            'name' => $input['network_name']
        ], [
            'name' => $input['network_name'],
            'description' => $input['network_description'],
            'key'=>$input['network_key'],
            'status' => $input['network_status']
        ]);
        if ($create_network) {
            return redirect('/admin/networks')->with(['status' => 'Network Created Successfully']);
        } else {
            return redirect('/admin/networks')->with(['status' => 'Something went wrong!']);
        }
    }


    public function create_user(Request $request)
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
            $image = null;
        }

        $usr = User::where('email', $input['email'])->first();

        if ($usr) {
        } else {
            $rand = str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
            $pass = substr_count($rand, 0, 20);
            User::create([
                'user_type' => $input['user_type'],
                'role_id' => $input['role_id'],
                'name' => $input['full_name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'city' => $input['city'],
                'country' => $input['country'],
                'password' => bcrypt($pass),
                'profile_picture' => $image,
                'address' => $input['address']
            ]);

            // Mail::send('OK')  Mail send krna h password
        }

        return  redirect('/admin/list_users')->with('status', 'User Created Successfully.');
    }

    public function delete_offer(Request $request)
    {
        $input = $request->all();
        $ids=explode(',',$input['delete-ids'][0]);
        // dd($input['delete-ids'],$ids);
        foreach($ids as $id){
            $delete_approved=ActiveOffers::where('id',$id)->with('offer')->first();
            // print_r($delete_approved);
            if($delete_approved){
                Notification::create([
                    'user_id' => $delete_approved->user_id,
                    'notification_title' => 'Offer request rejected',
                    'notification_description' => 'Your offer has been Rejected',
                    'seen_status' => 0,
                    'notification_type' => 'User',
                    'notification_link' => '/offer_details/'.base64_encode($delete_approved->offer_id),
                    'notification_id' => uuid4(),
                ]);
                $recv_user=User::where('id',$delete_approved->user_id)->first();
                $body='<table align="center" width="600" style="border-collapse: collapse; background-color: #ffffff; border: 1px solid #ddd; margin: 20px auto; padding: 20px;"><tr><td style="text-align: center; padding: 20px;"><h1 style="margin: 0; font-size: 24px; color: #333;">We regret to inform you that after careful review, your '.$delete_approved?->offer?->name.' has been rejected!</h1></td></tr><tr><td style="padding: 10px 20px; font-size: 16px; line-height: 1.5;"><p style="margin: 0;">Hi '.$recv_user?->name.',</p><p style="margin: 10px 0;">We regret to inform you that after careful review, your <strong>'.$delete_approved?->offer?->name.'</strong> application has been denied. We appreciate your understanding and thank you for your interest.</p><p style="margin: 10px 0;"></p><p style="margin: 20px 0; text-align: center;">   </p></td></tr><tr></tr></table>';
                send_mail($recv_user?->email, 'Your application on '.$delete_approved?->offer?->name.' has been Rejected!',$body);
                $delete_offer=ActiveOffers::where('id',$id)->delete();
                // dd($input, $delete_approved,$recv_user,$delete_offer);
            }
        }
            return redirect('/admin/pending_approvals')->with('status', 'Offer request rejected Successfully');
    }

    public function delete_offer_client(Request $request)
    {
        $input = $request->all();
        $ids=explode(',',$input['delete-ids'][0]);
        // dd($input['delete-ids'],$ids);
        foreach($ids as $id){
            $delete_offer=Offer::where('id',$id)->delete();
            if($delete_offer){
              $delete_active_offer=ActiveOffers::where('offer_id',$id)->delete();
            }
        }
            return redirect('/admin/list_offers')->with('status', 'Offer deleted Successfully');
    }


    public function delete_approved_offer_client(Request $request)
    {
        $input = $request->all();
        $ids=explode(',',$input['delete-ids'][0]);
        // dd($input['delete-ids'],$ids);
        foreach($ids as $id){
              $delete_active_offer=ActiveOffers::where('id',$id)->delete();
        }
            return redirect('/admin/completed_approvals')->with('status', 'Offer deleted Successfully');
    }
    public function approve_bulk_offer(Request $request)
    {
        $input = $request->all();
        if($input['approve-ids'][0]){
            $ids=explode(',',$input['approve-ids'][0]);
            // dd($ids);
            foreach($ids as $id){
                // $offer = Offer::where('id', $id)->first();
                // if ($offer) {
                   $getOffer=ActiveOffers::where('id',$id)->with('offer')->first();
                    $approve_approved=ActiveOffers::where('id',$id)->update(['approved_status'=>1]);
                    Notification::create([
                        'user_id' => $getOffer->user_id,
                        'notification_title' => 'Offer request approved',
                        'notification_description' => 'Your offer has been Approved',
                        'seen_status' => 0,
                        'notification_type' => 'User',
                        'notification_link' => '/offer_details/'.base64_encode($getOffer->offer_id),
                        'notification_id' => uuid4(),
                    ]);
                    $recv_user=User::where('id',$getOffer->user_id)->first();
                    $body='<table align="center" width="600" style="border-collapse: collapse; background-color: #ffffff; border: 1px solid #ddd; margin: 20px auto; padding: 20px;"><tr><td style="text-align: center; padding: 20px;"><h1 style="margin: 0; font-size: 24px; color: #333;">Your application on '.$getOffer->offer->name.' has been approved!</h1></td></tr><tr><td style="padding: 10px 20px; font-size: 16px; line-height: 1.5;"><p style="margin: 0;">Hi '.$recv_user->name.',</p><p style="margin: 10px 0;">Your application for <strong>'.$getOffer->offer->name.'</strong> was approved!</p><p style="margin: 10px 0;">You can view the offer details by clicking on the link below:</p><p style="margin: 20px 0; text-align: center;">    <a href="https://pepeleads.com/offer_details/'.base64_encode($getOffer->offer_id).'" target="_blank" style="display: inline-block; background-color: #007bff; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 16px;">View Offer Details</a></p></td></tr><tr></tr></table>';
                    send_mail($recv_user->email, 'Your application on '.$getOffer->offer->name.' has been approved!',$body);
                // }
            }
            return redirect('/admin/pending_approvals')->with('status', 'Offer Approved Successfully');
        }else{
            return redirect('/admin/pending_approvals')->with('status', 'Failed to Approve Offer');
        }
    }


    public function offer_fetch_apis_add(Request $request)
    {
        $input = $request->all();

        $add = ApiProvider::updateOrCreate([
            'api_provider_name' => $input['api_name'],
        ], [
            'api_provider_name' => $input['api_name'],
            'method' => $input['method'],
            'api_endpoint' => $input['api_endpoint'],
            'status' => 1,
        ]);

        if ($add) {
            return  redirect('/admin/offer_fetch_apis')->with('status', 'API added Successfully.');
        } else {

            return  redirect('/admin/offer_fetch_apis')->with('status', 'Failed to add API');
        }
    }

    public function add_network_commission(Request $request)
    {
        $input = $request->all();

        $add = NetworkComission::updateOrCreate([
            'network_id' => $input['network_id'],
        ], [
            'network_id' => $input['network_id'],
            'network_rate' => $input['network_rate'],
        ]);

        if ($add) {
            return  redirect('/admin/network_commission')->with('status', 'Network commission added Successfully.');
        } else {

            return  redirect('/admin/network_commission')->with('status', 'Failed to add Commission');
        }
    }


    public function add_offer(Request $request)
    {
        $input = $request->all();
        // dd($input);

       $add= Offer::updateOrCreate([
            'campaign_id' => $input['uuid'],
            'network' => $input['network'],
        ], [
            'campaign_id' => $input['uuid'],
            'name' => $input['offer_name'],
            'description' => $input['offer_description'],
            'image_url' => $input['image_url'],
            'hash_code' => Str::random(50),
            'network' => $input['network'],
            'credit' => $input['credit'],
            'active' => $input['offer_status'],
            'hits' => 0,
            'limit' => 0,
            'target_url' => $input['target_url'],
            'countries' => implode('|',$input['countries']),
            'users' => json_encode($input['users']),
            'leads' => 0,
            'date' => Carbon::now(),
            'epc' => 0,
            'mobile' => 1,
            'categories' => 'All Survey',
            'web' => 1,
            'cr' => 0,
            'browser' => 'All',
            'uid' => 0,
            'views' => 0,
            'convert' => 0
        ]);

        if ($add) {
            return  redirect('/admin/list_offers')->with('status', 'Offer added Successfully.');
        } else {

            return  redirect('/admin/list_offers')->with('status', 'Failed to add Offer');
        }
    }

    public function edit_offer(Request $request)
    {
        $input = $request->all();

        // dd($input);
        // array:16 [▼
//   "_token" => "jM18XsXDXvm6qbSfLiljQcYNULehtwwwMbbvRsYi"
//   "hash_code" => "GHi4bG2kdVDJbkqo1UJd2AOrzwGe02FqOILAT0tteiaGMQJe3b"
//   "description" => "CAMPAIGN TYPE: Consumer surveys. Desktop and Mobile traffic are OK.CONVERSION POINT:Pixel fires after successful survey completion (CPL First Survey Complete).A ▶"
//   "offer_status" => "1"
//   "countries" => array:1 [▶]
//   "image_url" => "/img/reward.png"
//   "hits" => "0"
//   "limit" => "0"
//   "target_url" => "https://chameleonads.go2cloud.org/aff_c?offer_id=5042&aff_id=4677"
//   "preview_url" => "https://edgesurvey.innovatemr.net/#/survey/age?survNum=YOyXnDyP&supCode=95&PID=1"
//   "date" => "2024-08-28 16:55:22"
//   "mobile" => "yes"
//   "web" => "yes"
//   "name" => "DynamiteCash (Surveys)_CPL_DE_Incent Allowed"
//   "credit" => "0.64000"
//   "network" => "ChameleonAds"
// ]

// dd(json_encode($input['users']));
    $add= Offer::updateOrCreate([
         'id' => $input['uuid'],
     ], [
         'name' => $input['name'],
         'description' => $input['description'],
         'image_url' => $input['image_url'],
         'hash_code' => $input['hash_code'],
         'network' => $input['network'],
         'credit' => $input['credit'],
         'active' => $input['offer_status'],
         'hits' => $input['hits'],
         'limit' => $input['limit'],
         'target_url' => $input['target_url'],
         'countries' => implode('|',$input['countries']),
         'users' => json_encode($input['users']),
         'leads' => 0,
         'date' => $input['date'],
         'epc' => 0,
         'preview_url' => $input['preview_url'],
         'mobile' => $input['mobile'] == 'yes' ? 1 : 0,
         'categories' => $input['category'],
         'web' => $input['web'] == 'yes' ? 1 : 0,
         'cr' => 0,
         'browser' => 'All',
         'uid' => 0,
         'views' => 0,
         'convert' => 0
     ]);

        if ($add) {
            return  redirect('/admin/list_offers')->with('status', 'Offer Edit Successfully.');
        } else {

            return  redirect('/admin/list_offers')->with('status', 'Failed to add Offer');
        }
    }

    public function approve_offer(Request $request,$type, $id){
        if($type=='approve'){
            $offer = ActiveOffers::where('id', $id)->with('offer')->first();
            if ($offer) {
                $offer->approved_status = 1;
                $offer->save();
                Notification::create([
                    'user_id' => $offer->user_id,
                    'notification_title' => 'Offer Approved',
                    'notification_description' => 'Your offer has been approved',
                    'seen_status' => 0,
                    'notification_type' => 'User',
                    'notification_link' => '/offer_details/'.base64_encode($offer->offer_id),
                    'notification_id' => uuid4(),
                ]);
                $recv_user=User::where('id',$offer->user_id)->first();
                $body='<table align="center" width="600" style="border-collapse: collapse; background-color: #ffffff; border: 1px solid #ddd; margin: 20px auto; padding: 20px;"><tr><td style="text-align: center; padding: 20px;"><h1 style="margin: 0; font-size: 24px; color: #333;">Your application on '.$offer->offer->name.' has been approved!</h1></td></tr><tr><td style="padding: 10px 20px; font-size: 16px; line-height: 1.5;"><p style="margin: 0;">Hi '.$recv_user->name.',</p><p style="margin: 10px 0;">Your application for <strong>'.$offer->offer->name.'</strong> was approved!</p><p style="margin: 10px 0;">You can view the offer details by clicking on the link below:</p><p style="margin: 20px 0; text-align: center;">    <a href="https://pepeleads.com/offer_details/'.base64_encode($offer->offer_id).'" target="_blank" style="display: inline-block; background-color: #007bff; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 16px;">View Offer Details</a></p></td></tr><tr></tr></table>';
                send_mail($recv_user->email, 'Your application on '.$offer->offer->name.' has been approved!',$body);
                return redirect('/admin/pending_approvals')->with('status', 'Offer Approved Successfully');
            } else {
                return redirect('/admin/pending_approvals')->with('status', 'Failed to Approve Offer');
            }
        }else{
            $offer = ActiveOffers::where('id', $id)->first();
            if ($offer) {
                $offer->approved_status = 0;
                $offer->save();
                return redirect('/admin/completed_approvals')->with('status', 'Offer Banned Successfully');
            } else {
                return redirect('/admin/completed_approvals')->with('status', 'Failed to Ban Offer');
            }
        }
        // dd($id,$type);
    }

    public function approve_all_offer(Request $request, $id){
        $getOffers=Offer::get();
        foreach($getOffers as $offer){
            $add= ActiveOffers::updateOrCreate([
                'offer_id' => $offer->id,
                'user_id' => $id,
            ], [
                'offer_id' => $offer->id,
                'approved_status' => 1,
                'user_id' => $id,
                'camp_id' => $offer->campaign_id,
                'network' => $offer->network,
            ]);
            // $offer = ActiveOffers::where('id', $id)->first();
            // if ($offer) {
            //     $offer->approved_status = 1;
            //     $offer->save();
            //     return redirect('/admin/pending_approvals')->with('status', 'Offer Approved Successfully');
            // } else {
            //     return redirect('/admin/pending_approvals')->with('status', 'Failed to Approve Offer');
            // }
        }
      
        // dd($id,$type);
    }

    public function offer_fetch_apis_view()
    {

        $networks = Network::orderBy('id', 'DESC')->get();
        $providers = ApiProvider::orderBy('id', 'DESC')->get();
        return view('pages.admin.offer_fetch_apis', ['networks' => $networks, 'providers' => $providers]);
    }
    public function fetch_offers_view()
    {
        $all_network = ApiProvider::orderBy('id', 'DESC')->get();
        return view('pages.admin.fetch_offers', ['data' => $all_network]);
    }
    public function network_commission_view()
    {
        $networks = Network::orderBy('id', 'DESC')->where('status', 1)->get();
        $commission = NetworkComission::orderBy('id', 'DESC')->with('network')->get();
        return view('pages.admin.network_commission', ['networks' => $networks, 'commissions' => $commission]);
    }
    public function global_commission_view()
    {
        return view('pages.admin.global_commission');
    }
    public function commission_rates_view()
    {
        return view('pages.admin.commission_rates');
    }
    public function whitelist_ip_view()
    {
        return view('pages.admin.whitelist_ip');
    }
    public function banned_ip_view()
    {
        return view('pages.admin.banned_ip');
    }
    public function payments_view()
    {
        return view('pages.admin.payments');
    }
    public function payment_gateway_view()
    {
        return view('pages.admin.payment_gateway');
    }
    public function payment_policy_view()
    {
        return view('pages.admin.payment_policy');
    }
    public function common_postback_view()
    {
        return view('pages.admin.common_postback');
    }
    public function ImportOffers(Request $request)
    {
            $request->validate([
                'file' => 'required|mimes:csv,txt,xlsx|max:2048000',
            ]);

            // Store the uploaded file in the storage/app directory
            $path = $request->file('file')->store('uploads');
            // You can also get the full path using Storage facade
            $fullPath = storage_path('app/' . $path);
            // Get the file name
            $fileName = $request->file('file')->getClientOriginalName();
            // Load the Excel file
            $data = Excel::toArray([], $fullPath);

            // Access the data
            $sheetData = $data[0];
            // Get the sheet name
            $full_array=[];
            // dd($sheetData, $fileName); 

    
            if(isset($sheetData) && count($sheetData) > 0){
                for($i=0; $i<count($sheetData); $i++){
                    if($i>0){
                       Offer::updateOrCreate([
                            'campaign_id' => $sheetData[$i][0],
                            'network' => $sheetData[$i][4],
                            'name'=>$sheetData[$i][1],
                        ], [

                            'campaign_id'=>$sheetData[$i][0],
                            'name'=>$sheetData[$i][1],
                            'description'=>$sheetData[$i][2],
                            'image_url'=>$sheetData[$i][3],
                            'network'=>$sheetData[$i][4],
                            'credit'=>$sheetData[$i][5],
                            'active'=>$sheetData[$i][6],
                            'target_url'=>$sheetData[$i][7],
                            'preview_url'=>$sheetData[$i][8],
                            'targets'=>$sheetData[$i][9],
                            'countries'=>$sheetData[$i][10],
                            'date'=>$sheetData[$i][11],
                            'mobile'=>$sheetData[$i][12],
                            'categories'=>$sheetData[$i][13],
                            'web'=>$sheetData[$i][14],
                            'browser'=>$sheetData[$i][15],


                            // 'campaign_id' => $sheetData[$i][0],
                            // 'name' => $sheetData[$i][2],
                            // 'description' => $sheetData[$i][3],
                            // 'image_url' => $sheetData[$i][4],
                            // 'hash_code' => Str::random(50),
                            // 'network' => $sheetData[$i][1],
                            // 'credit' => $sheetData[$i][5],
                            // 'active' => $sheetData[$i][6],
                            // 'hits' => $sheetData[$i][7],
                            // 'limit' => $sheetData[$i][8],
                            // 'target_url' => $sheetData[$i][9],
                            // 'countries' => $sheetData[$i][10],

                            'hash_code' => Str::random(50),
                            'percentage'=>0,
                            'hits'=>0,
                            'limit'=>0,
                            'leads'=>0,
                            'epc'=>0,
                            'cr'=>0,
                            'uid'=>0,
                            'views'=>0,
                            'convert'=>0,

                            // 'leads' => 0,
                            // 'date' => Carbon::now(),
                            // 'epc' => 0,
                            // 'mobile' => 1,
                            // 'categories' => 'All Survey',
                            // 'web' => 1,
                            // 'cr' => 0,
                            // 'browser' => 'All',
                            // 'uid' => 0,
                            // 'views' => 0,
                            // 'convert' => 0
                        ]);
                    }
                }
            }
 
    
            return redirect('/admin/list_offers')->with('success', 'Data imported successfully.');

    }
    public function allblogs()
    {
        $data = Blogs::where('status' , 1)->get();
        return view('pages.admin.allblogs')->with(array('data' => $data));
    }
    public function addblog()
    {
        return view('pages.admin.addblog');
    }
    public function createblogs(Request $request)
    {
        if (!empty($request->image)) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'gif') {
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $image = '/uploads/' . $filename;
            } else {
                return  redirect()->back()->with('status', 'Invalid File Type! This File Type is not allowed');
                // $image=null;
            }
        } else {
            $image = null;
        }
        if (!empty($request->blogbanner)) {

            $banner = $request->file('blogbanner');
            $extensiosn = $banner->getClientOriginalExtension();
            if ($extensiosn == 'png' || $extensiosn == 'jpg' || $extensiosn == 'jpeg' || $extension == 'gif') {
                $filesname = time() . '.' . $extensiosn;
                $banner->move(public_path('uploads/'), $filesname);
                $banners = '/uploads/' . $filesname;
            } else {
                return  redirect()->back()->with('status', 'Invalid File Type! This File Type is not allowed');
                // $image=null;
            }
        } else {
            $banners = null;
        }

        if (!empty($request->og_image)) {

            $og_image = $request->file('og_image');
            $extensiosn = $og_image->getClientOriginalExtension();
            if ($extensiosn == 'png' || $extensiosn == 'jpg' || $extensiosn == 'jpeg' || $extension == 'gif') {
                $filesname = time() . '.' . $extensiosn;
                $og_image->move(public_path('uploads/'), $filesname);
                $og_images = '/uploads/' . $filesname;
            } else {
                return  redirect()->back()->with('status', 'Invalid File Type! This File Type is not allowed');
                // $image=null;
            }
        } else {
            $og_images = null;
        }

        $add = new blogs();
        $add->name  = $request->name;
        $add->slug  = $request->slug;
        $add->meta_title  = $request?->meta_title;
        $add->meta_description  = $request?->meta_description;
        $add->og_title  = $request?->meta_title;
        $add->og_description  = $request?->meta_description;
        $add->meta_keywords  = $request?->meta_keywords;
        $add->meta_schema  = $request?->meta_schema;
        $add->canonical_url  = $request?->canonical;
        $add->custom_css  = $request?->custom_css;
        $add->custom_js  = $request?->custom_js;
        $add->no_index  = $request?->no_index;
        $add->shareable  = $request?->featured;
        $add->share_count  = 0;
        $add->twitter_title=$request?->meta_title;
        $add->twitter_description  = $request?->meta_description;
        $add->no_index  = $request?->no_index;
        $add->no_follow  = 0;
        $add->image  = $image;
        $add->og_image  = $og_images;
        $add->twitter_image  = $og_images;
        $add->breadcrumb_title=$request->breadcrumb;
        $add->og_type='website';
        $add->meta_author=$request->author;
        $add->meta_publisher  = 'PepeLeads';
        $add->description  = $request->description_content;
        $add->status  = 1;
        $add->save();
        return  redirect()->back()->with('status', 'Blogs Added Successfully');
    }
    public function editblog($id)
    {
        $data = Blogs::where('id' , $id)->first();
        return view('pages.admin.editblog')->with(array('data' => $data));
    }
    public function updateblogs(Request $request)
    {
        // Find the blog entry
        $blog = Blogs::findOrFail($request->id);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif'])) {

                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/'), $filename);
                $image = '/uploads/' . $filename;
            } else {
                return redirect()->back()->with('status', 'Invalid File Type! This File Type is not allowed');
            }
        } else {
            // If no new image is uploaded, keep the old image
            $image = $blog->image;
        }

        // Handle blog banner upload
        if ($request->hasFile('blogbanner')) {
            $banner = $request->file('blogbanner');
            $extension = $banner->getClientOriginalExtension();
            if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif'])) {

                $filename = time() . '.' . $extension;
                $banner->move(public_path('uploads/'), $filename);
                $banners = '/uploads/' . $filename;
            } else {
                return redirect()->back()->with('status', 'Invalid File Type! This File Type is not allowed');
            }
        } else {
            // If no new banner is uploaded, keep the old banner
            $banners = $blog->blogbanner;
        }

        if ($request->hasFile('og_image')) {
            $og_image = $request->file('og_image');
            $extension = $og_image->getClientOriginalExtension();
            if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif'])) {

                $filename = time() . '.' . $extension;
                $og_image->move(public_path('uploads/'), $filename);
                $og_images = '/uploads/' . $filename;
            } else {
                return redirect()->back()->with('status', 'Invalid File Type! This File Type is not allowed');
            }
        } else {
            // If no new banner is uploaded, keep the old banner
            $og_images = $blog->og_image;
        }

        // Update the blog entry with new values or existing values
        $blog->name = $request->name;
        $blog->image = $image;
        $blog->blogbanner = $banners;
        $blog->description = $request->description;
        $blog->slug  = $request->slug;
        $blog->meta_title  = $request?->meta_title;
        $blog->meta_description  = $request?->meta_description;
        $blog->og_title  = $request?->meta_title;
        $blog->og_description  = $request?->meta_description;
        $blog->meta_keywords  = $request?->meta_keywords;
        $blog->meta_schema  = $request?->meta_schema;
        $blog->canonical_url  = $request?->canonical;
        $blog->custom_css  = $request?->custom_css;
        $blog->custom_js  = $request?->custom_js;
        $blog->no_index  = $request?->no_index;
        $blog->shareable  = $request?->featured;
        $blog->share_count  = 0;
        $blog->twitter_title=$request?->meta_title;
        $blog->twitter_description  = $request?->meta_description;
        $blog->no_index  = $request?->no_index;
        $blog->no_follow  = 0;
        $blog->image  = $image;
        $blog->og_image  = $og_images;
        $blog->twitter_image  = $og_images;
        $blog->breadcrumb_title=$request->breadcrumb;
        $blog->og_type='website';
        $blog->meta_author=$request->author;
        $blog->meta_publisher  = 'PepeLeads';
        $blog->status  = 1;
        $blog->save();

        return redirect()->back()->with('status', 'Blogs Updated Successfully');
    }
    public function deleteblog($id)
    {
        $blog = Blogs::where('id' , $id)->delete();
        return redirect()->back()->with('status', 'Blogs Deleted Successfully');

    }
}
