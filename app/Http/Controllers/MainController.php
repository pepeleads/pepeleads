<?php

namespace App\Http\Controllers;

use App\Models\ContectQuery;
use App\Models\User;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index()
    {
        if(isset($_GET['ref_id'])){

            $ref_id=$_GET['ref_id'];
            $check_ref=User::where('refer_id',$ref_id)->get()->toArray();
            if(count($check_ref)>0){
                $is_ref=true;
                Session::put('ref_id',$ref_id);
            }else{
                $is_ref=false;
                Session::forget('ref_id');
                $ref_id='';
            }
        }else{

            $is_ref=false;
            $ref_id='';
            Session::forget('ref_id');
        }
        return view('pages.landing.new_landing',['is_ref'=>$is_ref,'ref_id'=>$ref_id]);
    }
    
    public function terms_and_condition(){
        return view('pages.landing.terms-conditions');

    }
    public function privacy_policies(){
        return view('pages.landing.privacy-policies');

    }

    public function payment_policies(){
        return view('pages.landing.payment_policies');

    }
    

    public function home()
    {
        return view('pages.landing.new_landing');
    }


    public function complete()
    {
        return view('pages.landing.complete');
    }

    public function nosurvey()
    {
        return view('pages.landing.nosurvey');
    }


    public function send_query(Request $request)
    {
        // Validate reCAPTCHA
        $recaptcha = $request->get('g-recaptcha-response');
        $secret = env('RECAPTCHA_SECRET_V2');
        
        $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha}");
        $captcha_success = json_decode($verify);

        if (!$captcha_success->success) {
            Session::flash('error', 'Please verify that you are not a robot.');
            return redirect()->back();
        }

        $inputs = $request->all();
        $inputs['ip'] = $_SERVER['REMOTE_ADDR'];
        
        $create = ContectQuery::create($inputs);
        if($create) {
            Session::flash('success', 'Thank You for contact us. We will contact you shortly');
            return redirect('/');
        } else {
            Session::flash('error', 'Thank You for contact us. We will contact you shortly');
            return redirect('/');
        }
    }
    public function newblog()
    {
        $data = Blogs::where('status' , 1)->orderBy('created_at','desc')->get();
        $featureddata = Blogs::where('status' , 1)->where('shareable',1)->orderBy('created_at','desc')->first();
        return view('pages.landing.blogs')->with(array('data' => $data,'featured'=>$featureddata));
    }
    public function blogdetail($id)
    {
        $data = Blogs::where('slug' , $id)->first();
        if($data){
            return view('pages.landing.blogdetail')->with(array('data' => $data));
        }else{
            return abort(404);
        }
    }
}
