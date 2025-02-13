<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Network;
use App\Models\OfferProcess;
use App\Models\Postback;
use App\Models\PostbackHits;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;

class PostbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Postback  $c
     * @return \Illuminate\Http\Response
     */
    public function show(Postback $postback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Postback  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(Postback $postback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postback  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postback $postback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Postback  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postback $postback)
    {
        //
    }

    function add_balance($user_id,$amount, $tran_id, $offer){
        $user=User::find($user_id);
        $user->balance+=$amount;
        $user->save();
        if($user->refer_by != null){
            $refer_user=User::where('refer_id',$user->refer_by)->first();
            $refer_user->balance+=($amount*0.15);
            $refer_user->save();
            $check=Lead::updateOrCreate([
                'ad_id'=>$tran_id,
            ],[
                'campaign_id'=>$offer->campaign_id,
                'user_id'=>$refer_user->user_id,
                'aff_sub_1'=>$offer->sid1,
                'aff_sub_2'=>$offer->sid2,
                'aff_sub_3'=>$offer->sid3,
                'aff_sub_4'=>$offer->sid4,
                'offer_id'=>$offer->offer_id,
                'ad_id'=>$tran_id,
                'conversion_status'=>'completed',
                'commission'=>$amount*0.15,
                'user_commission'=>$amount*0.15
               ]);
        }
    }


    // https://offershowme.com/postback/pollfish?device_id=[[device_id]]&cpa=[[cpa]]&request_uuid=[[request_uuid]]&timestamp=[[timestamp]]&tx_id=[[tx_id]]&signature=[[signature]]&reward_name=[[reward_name]]&reward_value=[[reward_value]]&click_id=[[click_id]]
    // https://offershowme.com/postback/pollfish?device_id=[[device_id]]&cpa=[[cpa]]&request_uuid=[[request_uuid]]&timestamp=[[timestamp]]&tx_id=[[tx_id]]&signature=[[signature]]&reward_name=[[reward_name]]&reward_value=[[reward_value]]&click_id=[[click_id]]
    public function pollfish_postback(Request $request)
    {

        $input=$request->all();

        if(isset($input['request_uuid'])){
           
            $tran_id=$input['request_uuid'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $v_currency=$site->virtual_currency;
                $c_value=$site->currency_value;
                $postback=$site->post_back;
                // dd($offer);
                $reward=($offer->ref_credit*$c_value)/100;
                
                $str1=str_replace('[status]',1,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',1,$str2);
                $str4=str_replace('[currency]',1,$str3);
                $str5=str_replace('[sid1]',$offer->sid1,$str4);
                $str6=str_replace('[sid2]',$offer->sid2,$str5);
                $str7=str_replace('[sid3]',$offer->sid3,$str6);
                $str8=str_replace('[sid4]',$offer->sid4,$str7);
                $str9=str_replace('[sid4]',$offer->sid4,$str8);
                $url=str_replace('[api_key]',$offer->api_key,$str9);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                $check=Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>'completed',
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>'completed'
                   ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    

    public function theoremreach_postback(Request $request)
    {

        $input=$request->all();

        if(isset($input['transaction_id'])){
           
            $tran_id=$input['transaction_id'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $v_currency=$site->virtual_currency;
                $c_value=$site->currency_value;
                $postback=$site->post_back;
                // dd($offer);
                $reward=($offer->ref_credit*$c_value)/100;
                $this->add_balance($offer->user_id,$reward, $tran_id, $offer);
                $str1=str_replace('[status]',1,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',1,$str2);
                $str4=str_replace('[currency]',1,$str3);
                $str5=str_replace('[sid1]',$offer->sid1,$str4);
                $str6=str_replace('[sid2]',$offer->sid2,$str5);
                $str7=str_replace('[sid3]',$offer->sid3,$str6);
                $str8=str_replace('[sid4]',$offer->sid4,$str7);
                $str9=str_replace('[sid4]',$offer->sid4,$str8);
                $url=str_replace('[api_key]',$offer->api_key,$str9);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                $check=Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>'completed',
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>'completed'
                   ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function adsentmedia_postback(Request $request)
    {
        $input=$request->all();
        // dd($input);
        PostbackHits::create([
            'transaction_id'=>@$input['sb1'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['sb1']) && isset($input['sts'])){
            $tran_id=$input['sb1'];
            $status=$input['sts'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                if($status==1){
                    $rewards=$offer->ref_credit;
                }else if($status==2){
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $rewards=0;
                }
                // sts = Status
                // 1 for payable
                // 2 for reversed, [PAY] and [CUR] will be negative.
                // 3 is used for the reversal of an already-paid lead, typically for your information only, 
                //   as it does not affect your balance (in severe cases we reserve the right to deduct paid reversals from a future payment).
                //   When status is 3, [PAY] and [CUR] will be 0.
                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);
                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                $conversion="pending";
                if($status==1){
                    $conversion="completed";
                }else if($status==2){
                    $conversion="reversed";
                }else if($status==3){
                    $conversion="reversed";
                }
                $check=Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }


    public function pointclicktrack_postback(Request $request)
    {
        $input=$request->all();
        // dd($input);
        PostbackHits::create([
            'transaction_id'=>@$input['sub1'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['sub1']) && isset($input['sts'])){
            $tran_id=$input['sub1'];
            $status=$input['sts'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                $conversion="pending";
                if($status=='credited'){
                    $conversion="completed";
                    $rewards=$offer->ref_credit;
                }else if($status=='reversed'){
                    $conversion="reversed";
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $conversion="reversed";
                    $rewards=0;
                }

                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);

                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function leadads_postback(Request $request)
    {
        $input=$request->all();
        // dd($input);

        // /postback/leadads/sub1={aff_sub}&sts=credited
        PostbackHits::create([
            'transaction_id'=>@$input['sub1'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['sub1']) && isset($input['sts'])){
            $tran_id=$input['sub1'];
            $status=$input['sts'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                $conversion="pending";
                if($status=='credited'){
                    $conversion="completed";
                    $rewards=$offer->ref_credit;
                }else if($status=='reversed'){
                    $conversion="reversed";
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $conversion="reversed";
                    $rewards=0;
                }

                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);

                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }


    public function wedebeek_postback(Request $request)
    {
        $input=$request->all();
      

        PostbackHits::create([
            'transaction_id'=>@$input['sub1'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['sub1']) && isset($input['sts'])){
            $tran_id=$input['sub1'];
            $status=$input['sts'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                $conversion="pending";
                if($status=='credited'){
                    $conversion="completed";
                    $rewards=$offer->ref_credit;
                }else if($status=='reversed'){
                    $conversion="reversed";
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $conversion="reversed";
                    $rewards=0;
                }

                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);

                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }


    public function lootably_postback(Request $request)
    {
        $input=$request->all();
      

        PostbackHits::create([
            'transaction_id'=>@$input['sid2'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['sid2']) && isset($input['sts'])){
            $tran_id=$input['sid2'];
            $status=$input['sts'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                $conversion="pending";
                if($status=='credited'){
                    $conversion="completed";
                    $rewards=$offer->ref_credit;
                }else if($status=='reversed'){
                    $conversion="reversed";
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $conversion="reversed";
                    $rewards=0;
                }

                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);

                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }
    public function offerwallads_postback(Request $request)
    {
        $input=$request->all();
      

        PostbackHits::create([
            'transaction_id'=>@$input['sid'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['sid']) && isset($input['sts'])){
            $tran_id=$input['sid'];
            $status=$input['sts'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                $conversion="pending";
                if($status=='completed'){
                    $conversion="completed";
                    $rewards=$offer->ref_credit;
                }else if($status=='reversed'){
                    $conversion="reversed";
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $conversion="reversed";
                    $rewards=0;
                }

                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);

                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function iremgtech_postback(Request $request)
    {
        $input=$request->all();
      

        PostbackHits::create([
            'transaction_id'=>@$input['aff_sub1'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['aff_sub1']) && isset($input['sts'])){
            $tran_id=$input['aff_sub1'];
            $status=$input['sts'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                $conversion="pending";
                if($status=='completed'){
                    $conversion="completed";
                    $rewards=$offer->ref_credit;
                }else if($status=='reversed'){
                    $conversion="reversed";
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $conversion="reversed";
                    $rewards=0;
                }

                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);

                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    
    public function offer18_postback(Request $request)
    {
        $input=$request->all();
      

        PostbackHits::create([
            'transaction_id'=>@$input['aff_click_id'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['aff_click_id']) && isset($input['sts'])){
            $tran_id=$input['aff_click_id'];
            $status=$input['sts'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                $conversion="pending";
                if($status=='completed'){
                    $conversion="completed";
                    $rewards=$offer->ref_credit;
                }else if($status=='reversed'){
                    $conversion="reversed";
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $conversion="reversed";
                    $rewards=0;
                }

                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);

                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function everflowclient_postback(Request $request)
    {
        $input=$request->all();
      

        PostbackHits::create([
            'transaction_id'=>@$input['eventid'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['eventid']) && isset($input['sts'])){
            $tran_id=$input['eventid'];
            $status=$input['sts'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                $conversion="pending";
                if($status=='completed'){
                    $conversion="completed";
                    $rewards=$offer->ref_credit;
                }else if($status=='reversed'){
                    $conversion="reversed";
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $conversion="reversed";
                    $rewards=0;
                }

                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);

                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function zimblemedia_postback(Request $request)
    {
        $input=$request->all();
      

        PostbackHits::create([
            'transaction_id'=>@$input['aff_sub1'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['aff_sub1']) && isset($input['sts'])){
            $tran_id=$input['aff_sub1'];
            $status='completed';
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                $conversion="pending";
                if($status=='completed'){
                    $conversion="completed";
                    $rewards=$offer->ref_credit;
                }else if($status=='reversed'){
                    $conversion="reversed";
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $conversion="reversed";
                    $rewards=0;
                }

                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);

                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function mobplus_postback(Request $request)
    {
        $input=$request->all();
      

        PostbackHits::create([
            'transaction_id'=>@$input['aff_sub1'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['aff_sub1']) && isset($input['sts'])){
            $tran_id=$input['aff_sub1'];
            $status='completed';
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                $conversion="pending";
                if($status=='completed'){
                    $conversion="completed";
                    $rewards=$offer->ref_credit;
                }else if($status=='reversed'){
                    $conversion="reversed";
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $conversion="reversed";
                    $rewards=0;
                }

                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);

                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function taskbuddy_ai_postback(Request $request)
    {
        $input=$request->all();
      

        PostbackHits::create([
            'transaction_id'=>@$input['aff_sub1'],
            'status'=>@$input['sts'],
            'payload'=>json_encode(@$input)
        ]);
        if(isset($input['aff_sub1']) && isset($input['sts'])){
            $tran_id=$input['aff_sub1'];
            $status='completed';
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $postback=$site->post_back;
                $rewards=0;
                $conversion="pending";
                if($status=='completed'){
                    $conversion="completed";
                    $rewards=$offer->ref_credit;
                }else if($status=='reversed'){
                    $conversion="reversed";
                    $rewards=-$offer->ref_credit;
                }else if($status==3){
                    $conversion="reversed";
                    $rewards=0;
                }

                $this->add_balance($offer->user_id,$rewards, $tran_id, $offer);

                $str1=str_replace('[status]',$status,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$rewards,$str2);
                $str4=str_replace('[currency]','usd',$str3);
                $str5=str_replace('[sub1]',$offer->sid1,$str4);
                $str6=str_replace('[sub2]',$offer->sid2,$str5);
                $str7=str_replace('[sub3]',$offer->sid3,$str6);
                $str8=str_replace('[sub4]',$offer->sid4,$str7);
                $str9=str_replace('[source]',$offer->source,$str8);
                $str10=str_replace('[click_id]',$offer->click_id,$str9);
                $str11=str_replace('[unique1]',$offer->unique1,$str10);
                $str12=str_replace('[unique2]',$offer->unique2,$str11);
                $str13=str_replace('[unique3]',$offer->unique3,$str12);
                $str14=str_replace('[unique4]',$offer->unique4,$str13);
                $url=str_replace('[api_key]',$offer->api_key,$str14);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>$conversion,
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>$conversion
                ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }
    
    public function all_postback(Request $request)
    {

        $input=$request->all();

        if(isset($input['transaction_id'])){
           
            $tran_id=$input['transaction_id'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $v_currency=$site->virtual_currency;
                $c_value=$site->currency_value;
                $postback=$site->post_back;
                // dd($offer);
                $reward=($offer->ref_credit*$c_value)/100;
                $this->add_balance($offer->user_id,$reward, $tran_id, $offer);
                $str1=str_replace('[status]',1,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',$reward,$str2);
                $str4=str_replace('[currency]',1,$str3);
                $str5=str_replace('[sid1]',$offer->sid1,$str4);
                $str6=str_replace('[sid2]',$offer->sid2,$str5);
                $str7=str_replace('[sid3]',$offer->sid3,$str6);
                $str8=str_replace('[sid4]',$offer->sid4,$str7);
                $str9=str_replace('[sid4]',$offer->sid4,$str8);
                $url=str_replace('[api_key]',$offer->api_key,$str9);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                $check=Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>'completed',
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>'completed'
                   ]);


                   return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
            }else{
                return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                abort(404);
            }
        }else{
            abort(404);
        }
    }


    public function common_postback(Request $request,$network)
    {

        $nt=Network::where('name',$network)->first();
        $input=$request->all();

        if($nt && $nt->key!=null){
            if(isset($input[$nt->key])){
            
                $tran_id=$input[$nt->key];
                $offer=OfferProcess::where('hash_code',$tran_id)->first();
                if($offer){
                    
                    $site=Site::where('api_key',$offer->api_key)->first();
                    $v_currency=$site->virtual_currency;
                    $c_value=$site->currency_value;
                    $postback=$site->post_back;
                    // dd($offer);
                    $reward=($offer->ref_credit*$c_value)/100;
                    $this->add_balance($offer->user_id,$reward, $tran_id, $offer);
                    $str1=str_replace('[status]',1,$postback);
                    $str2=str_replace('[transaction_id]',$tran_id,$str1);
                    $str3=str_replace('[reward]',1,$str2);
                    $str4=str_replace('[currency]',1,$str3);
                    $str5=str_replace('[sid1]',$offer->sid1,$str4);
                    $str6=str_replace('[sid2]',$offer->sid2,$str5);
                    $str7=str_replace('[sid3]',$offer->sid3,$str6);
                    $str8=str_replace('[sid4]',$offer->sid4,$str7);
                    $str9=str_replace('[sid4]',$offer->sid4,$str8);
                    $url=str_replace('[api_key]',$offer->api_key,$str9);

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    $result = json_decode($response);
                    curl_close($ch);
                    
                    $check=Lead::updateOrCreate([
                        'ad_id'=>$tran_id,
                    ],[
                        'campaign_id'=>$offer->campaign_id,
                        'user_id'=>$offer->user_id,
                        'aff_sub_1'=>$offer->sid1,
                        'aff_sub_2'=>$offer->sid2,
                        'aff_sub_3'=>$offer->sid3,
                        'aff_sub_4'=>$offer->sid4,
                        'offer_id'=>$offer->offer_id,
                        'ad_id'=>$tran_id,
                        'conversion_status'=>'completed',
                        'commission'=>$offer->credit - $offer->ref_credit,
                        'user_commission'=>$offer->ref_credit
                    ]);
                
                    
                    $update=OfferProcess::where('hash_code',$tran_id)->update([
                        'status'=>'completed'
                    ]);


                    return response()->json(['code'=>200,'status'=>'success','id'=>$tran_id]);
                }else{
                    return response()->json(['code'=>201,'status'=>'failed','message'=>'Invalid Transaction ID','id'=>$tran_id]);
                    abort(404);
                }
            }else{
                abort(404);
            }
        }
    }
    
    public function yuno_postback(Request $request)
    {

        $input=$request->all();

        if(isset($input['transaction_id'])){
           
            $tran_id=$input['transaction_id'];
            $offer=OfferProcess::where('hash_code',$tran_id)->first();
            if($offer){
                
                $site=Site::where('api_key',$offer->api_key)->first();
                $v_currency=$site->virtual_currency;
                $c_value=$site->currency_value;
                $postback=$site->post_back;
                // dd($offer);
                $reward=($offer->ref_credit*$c_value)/100;
                $this->add_balance($offer->user_id,$reward, $tran_id, $offer);
                $str1=str_replace('[status]',1,$postback);
                $str2=str_replace('[transaction_id]',$tran_id,$str1);
                $str3=str_replace('[reward]',1,$str2);
                $str4=str_replace('[currency]',1,$str3);
                $str5=str_replace('[sid1]',$offer->sid1,$str4);
                $str6=str_replace('[sid2]',$offer->sid2,$str5);
                $str7=str_replace('[sid3]',$offer->sid3,$str6);
                $str8=str_replace('[sid4]',$offer->sid4,$str7);
                $str9=str_replace('[sid4]',$offer->sid4,$str8);
                $url=str_replace('[api_key]',$offer->api_key,$str9);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $result = json_decode($response);
                curl_close($ch);
                
                $check=Lead::updateOrCreate([
                    'ad_id'=>$tran_id,
                ],[
                    'campaign_id'=>$offer->campaign_id,
                    'user_id'=>$offer->user_id,
                    'aff_sub_1'=>$offer->sid1,
                    'aff_sub_2'=>$offer->sid2,
                    'aff_sub_3'=>$offer->sid3,
                    'aff_sub_4'=>$offer->sid4,
                    'offer_id'=>$offer->offer_id,
                    'ad_id'=>$tran_id,
                    'conversion_status'=>'completed',
                    'commission'=>$offer->credit - $offer->ref_credit,
                    'user_commission'=>$offer->ref_credit
                   ]);
               
                
                $update=OfferProcess::where('hash_code',$tran_id)->update([
                      'status'=>'completed'
                   ]);


                   echo "status=true";
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }
}
