<?php

namespace App\Http\Controllers;

use App\Models\ActiveOffers;
use App\Models\Network;
use Exception;
use App\Models\Site;
use App\Models\Offer;
use App\Models\OfferProcess;
use App\Models\OfferwallUser;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Defuse\Crypto\Exception\CryptoException;
use Illuminate\Support\Facades\Http;
use Prophecy\Argument\Token\InArrayToken;

class OfferController extends Controller
{
    //
    public function offerwall()
    {
        if ($_SERVER['SERVER_NAME'] == 'offershowme.local') {
            $userIp = "45.249.85.179";
        } else {
            $userIp = $_SERVER['REMOTE_ADDR'];
        }

        if (isset($_GET['api_key'])) {
            $api_key = $_GET['api_key'];
            $api_secret = $_GET['api_secret'];
            $check = Site::where('api_key', $api_key)->where('secret_key', $api_secret)->first();
            if ($check) {
                    $offers = ActiveOffers::where('user_id',$check->user_id)->with('offers')->get()->toArray();  
                    // dd($offers);
                    $filteredOffers=[];
                    foreach($offers as $key => $offer){
                        $ofr=$offer['offers'];
                        if($ofr){
                            $single_offer=[];
                            $single_offer['id'] = @$ofr['id'];
                            $single_offer['name'] = @$ofr['name'];
                            $single_offer['description'] = @$ofr['description'];
                            $single_offer['credit'] = (@$ofr['credit']*@$ofr['rate']['rate']['network_rate'])/100;
                            $single_offer['limit'] = @$ofr['limit'];
                            $single_offer['network'] = "PepeLeads";
                            $single_offer['image_url'] =   env('APP_URL')."/image/" .@$ofr['id'];
                            $single_offer['hash_code'] = @$ofr['hash_code'];
                            $single_offer['preview_url'] = @$ofr['preview_url'];
                            $single_offer['target_url'] = env('APP_URL') . "/offer?oid=" . encode_data($offer['id']);
                            $single_offer['countries'] = @$ofr['countries'];
                            $single_offer['targets'] = @$ofr['targets'];
                            $single_offer['browser'] = @$ofr['browser'];
                            $single_offer['mobile'] = @$ofr['mobile'];
                            $single_offer['web'] = @$ofr['web'];
                            $single_offer['categories'] = @$ofr['categories'];
                            $single_offer['created_at'] = @$ofr['created_at'];
                            $filteredOffers[]=$single_offer;
                        }
                    }
                    return response()->json($filteredOffers);
            } else {
                return response()->view('errors.' . '404', [], 404);
            }
        } else {
            return response()->view('errors.' . '404', [], 404);
        }
    }



    public function uuid4()
    {
        /* 32 random HEX + space for 4 hyphens */
        $out = bin2hex(random_bytes(18));

        $out[8]  = "-";
        $out[13] = "-";
        $out[18] = "-";
        $out[23] = "-";

        /* UUID v4 */
        $out[14] = "4";

        /* variant 1 - 10xx */
        $out[19] = ["8", "9", "a", "b"][random_int(0, 3)];

        return $out;
    }


    public function offerredirect($encoded_string)
    {
        try {
            $val = Crypt::decryptString($encoded_string);
            $last_url = $_SERVER['HTTP_REFERER'];
            $arr = explode('&', $val);
            $decoded_array = [];
            foreach ($arr as $ar) {
                $ars = explode('=', $ar);
                $decoded_array[$ars[0]] = $ars[1];
            }

            $rand_key = $this->uuid4();
            // dd($rand_key);
            $user_key = $decoded_array['api_key'];

            $site = Site::with('user')->where('api_key', $user_key)->first();
            $campaign = Offer::where('id', $decoded_array['campaign_id'])->where('active', 1)->first();
            $network = Network::with('rate')->where('name', $campaign->network)->first();

            if ($campaign->network == 'Yuno') {
                $enc_user_id = $user_key;

                $target_url = $campaign->target_url . "&pparam_puuid=" . $rand_key . "&pparam_pupid=" . $enc_user_id;
                $redirect_url = str_replace('[transaction_id]', $rand_key, $target_url);


                if ($campaign->limit == 0) {
                    $adding = OfferProcess::create([
                        'campaign_id' => $campaign->campaign_id,
                        'user_id' => $site->user->id,
                        'offer_id' => $campaign->id,
                        'offer_name' => $campaign->name,
                        'hash_code' => $rand_key,
                        'status' => 'pending',
                        'start_ip' => $_SERVER['REMOTE_ADDR'],
                        'site_id' => $site->id,
                        'api_key' => $user_key,
                        'end_ip' => '',
                        'credit' => $campaign->credit,
                        'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                        'network' => $campaign->network,
                        'link_id' => $last_url,
                        'credit_mode' => "",
                        'source' => 'OfferWall',
                        'unique' => 1,
                        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                        'start_country' => "",
                        'end_country' => "",
                        'sid1' => @$decoded_array['sid1'],
                        'sid2' => @$decoded_array['sid2'],
                        'sid3' => @$decoded_array['sid3'],
                        'sid4' => @$decoded_array['sid4'],
                        'sid5' => @$decoded_array['sid5'],
                        'date' => Carbon::now()
                    ]);
                    $update = Offer::where('id', $decoded_array['campaign_id'])->update([
                        'hits' => $campaign->hits + 1,
                    ]);

                    return redirect($redirect_url);
                } else {
                    $limit = $campaign->limit;
                    $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();
                    if ($count < $limit) {
                        $adding = OfferProcess::create([
                            'campaign_id' => $campaign->campaign_id,
                            'user_id' => $site->user->id,
                            'offer_id' => $campaign->id,
                            'offer_name' => $campaign->name,
                            'hash_code' => $rand_key,
                            'status' => 'pending',
                            'start_ip' => $_SERVER['REMOTE_ADDR'],
                            'site_id' => $site->id,
                            'api_key' => $user_key,
                            'end_ip' => '',
                            'credit' => $campaign->credit,
                            'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                            'network' => $campaign->network,
                            'link_id' => $last_url,
                            'credit_mode' => "",
                            'source' => 'OfferWall',
                            'unique' => 1,
                            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                            'start_country' => "",
                            'end_country' => "",
                            'sid1' => @$decoded_array['sid1'],
                            'sid2' => @$decoded_array['sid2'],
                            'sid3' => @$decoded_array['sid3'],
                            'sid4' => @$decoded_array['sid4'],
                            'sid5' => @$decoded_array['sid5'],
                            'date' => Carbon::now()
                        ]);
                        $update = Offer::where('id', $decoded_array['campaign_id'])->update([
                            'hits' => $campaign->hits + 1,
                        ]);
                        return redirect($redirect_url);
                    } else {
                        abort(404);
                    }
                }
            } else if ($campaign->network == 'Lootably') {
                $enc_user_id = $user_key;

                $target_url = $campaign->target_url . "&sid2=" . $rand_key;
                $redirect_url = str_replace('{userID}', $rand_key, $target_url);


                if ($campaign->limit == 0) {
                    $adding = OfferProcess::create([
                        'campaign_id' => $campaign->campaign_id,
                        'user_id' => $site->user->id,
                        'offer_id' => $campaign->id,
                        'offer_name' => $campaign->name,
                        'hash_code' => $rand_key,
                        'status' => 'pending',
                        'start_ip' => $_SERVER['REMOTE_ADDR'],
                        'site_id' => $site->id,
                        'api_key' => $user_key,
                        'end_ip' => '',
                        'credit' => $campaign->credit,
                        'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                        'network' => $campaign->network,
                        'link_id' => $last_url,
                        'credit_mode' => "",
                        'source' => 'OfferWall',
                        'unique' => 1,
                        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                        'start_country' => "",
                        'end_country' => "",
                        'sid1' => @$decoded_array['sid1'],
                        'sid2' => @$decoded_array['sid2'],
                        'sid3' => @$decoded_array['sid3'],
                        'sid4' => @$decoded_array['sid4'],
                        'sid5' => @$decoded_array['sid5'],
                        'date' => Carbon::now()
                    ]);
                    $update = Offer::where('id', $decoded_array['campaign_id'])->update([
                        'hits' => $campaign->hits + 1,
                    ]);

                    return redirect($redirect_url);
                } else {
                    $limit = $campaign->limit;
                    $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();
                    if ($count < $limit) {
                        $adding = OfferProcess::create([
                            'campaign_id' => $campaign->campaign_id,
                            'user_id' => $site->user->id,
                            'offer_id' => $campaign->id,
                            'offer_name' => $campaign->name,
                            'hash_code' => $rand_key,
                            'status' => 'pending',
                            'start_ip' => $_SERVER['REMOTE_ADDR'],
                            'site_id' => $site->id,
                            'api_key' => $user_key,
                            'end_ip' => '',
                            'credit' => $campaign->credit,
                            'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                            'network' => $campaign->network,
                            'link_id' => $last_url,
                            'credit_mode' => "",
                            'source' => 'OfferWall',
                            'unique' => 1,
                            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                            'start_country' => "",
                            'end_country' => "",
                            'sid1' => @$decoded_array['sid1'],
                            'sid2' => @$decoded_array['sid2'],
                            'sid3' => @$decoded_array['sid3'],
                            'sid4' => @$decoded_array['sid4'],
                            'sid5' => @$decoded_array['sid5'],
                            'date' => Carbon::now()
                        ]);
                        $update = Offer::where('id', $decoded_array['campaign_id'])->update([
                            'hits' => $campaign->hits + 1,
                        ]);
                        return redirect($redirect_url);
                    } else {
                        abort(404);
                    }
                }
            } else {
                abort(404);
            }
        } catch (Exception $e) {
            abort(404);
        }
    }

    function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = '182.69.180.176';
        }
    
        return $ipaddress;
    }

    public function offerredirectGet(Request $request)
    {
        try {
            $inputs = $request->all();
            $oid = decode_data($inputs['oid']);
            $last_url = @$request['HTTP_REFERER'];
            $getOfferStatus = ActiveOffers::where([
                'id' => $oid,
                'approved_status' => 1
            ])->with('offers')->first();

            $campaign = $getOfferStatus->offers;
            if(isset($inputs['api_key'])){
                $api_key = $inputs['api_key'];
                $site = Site::where('api_key', $api_key)->where('status', 'approved')->first();
            }else{
                $site = Site::with('user')->where('user_id', $getOfferStatus->user_id)->first();
            }
            $network = $campaign->rate;
            $user_key = $site->api_key;
            $rand_key = $this->uuid4();
            $limit = $campaign->limit;
            $countries= ($campaign->countries) ? explode('|',$campaign->countries) : [];
           
            $PublicIP = $this->get_client_ip();
            if($PublicIP == '127.0.0.1' || $PublicIP == '::1'){
                $PublicIP = '182.69.180.176';
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://ipinfo.io/$PublicIP/geo");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($json, true);
            $country = @$json['country'];
   
            //if($countries){
                //if(!in_array($country,$countries) || !in_array('ALL',$countries)){
                    // abort(404);
                    //echo "This offer is not available in your country";
                    //die();
            //    }
            // }
        //$single_offer=Offer::where('id', $campaign['id'])->first();
            //if($single_offer->status == 0){
                //echo "This offer is not available";
                //die();
            //}

            if ($getOfferStatus->network == 'AdScendMedia') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
            
                $redirect_url = $campaign->target_url . "&sb1=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }
            else if ($getOfferStatus->network == 'Lootably') {
    

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
                // $enc_user_id = $user_key;

                $target_url = $campaign->target_url . "&sid2=" . $rand_key;
                $redirect_url = str_replace('{userID}', $rand_key, $target_url);
                // $redirect_url = $campaign->target_url . "&sb1=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }

            else if ($getOfferStatus->network == 'LeadsAds' || $getOfferStatus->network == 'CpaMerchant' || $getOfferStatus->network =='ChameleonAds') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
            
                $redirect_url = $campaign->target_url . "&aff_sub=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }

            else if ($getOfferStatus->network == 'DynuinMedia' || $getOfferStatus->network == 'DynuinMedia') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
            
                $redirect_url = $campaign->target_url . "&aff_sub=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }

            else if ($getOfferStatus->network == 'MaxPointMedia' || $getOfferStatus->network == 'WedeBeek' || $getOfferStatus->network == 'AdsNextGen') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
            
                $redirect_url = $campaign->target_url . "&sub1=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }

            else if ($getOfferStatus->network == 'LeadsAds') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
            
                $redirect_url = $campaign->target_url . "&aff_sub=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }
            else if ($getOfferStatus->network == 'OfferwallAds') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
            
                $redirect_url = $campaign->target_url . "&sid=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }
            else if ($getOfferStatus->network == 'IremgTech') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
            
                $redirect_url = $campaign->target_url . "&aff_sub1=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }
            else if ($getOfferStatus->network == 'ZimbleMedia') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
                $s1=@$inputs['sub1'];
            
                $redirect_url = $campaign->target_url ."&sub_affid=" . $rand_key."&s1=".$rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }
            else if ($getOfferStatus->network == 'MobPlus' || $getOfferStatus->network == 'TaskBuddyAi') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
                $s1=@$inputs['sub1'];
            
                $redirect_url = $campaign->target_url ."?click_id=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }
            else if ($getOfferStatus->network == 'Mathenix') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
            
                $redirect_url = $campaign->target_url . "&aff_click_id=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }
            else if ($getOfferStatus->network == 'ClickHunt') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
            
                $redirect_url = $campaign->target_url . "&sub1=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }
            else if ($getOfferStatus->network == 'EverFlow') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
            
                $redirect_url = $campaign->target_url . "?sub1=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }
            else if ($getOfferStatus->network == 'AdOn') {

                $limit = $campaign->limit;
                $count = OfferProcess::where('offer_id', $campaign->id)->get()->count();

                $adding = OfferProcess::create([
                    'campaign_id' => $campaign->campaign_id,
                    'user_id' => $site->user->id,
                    'offer_id' => $campaign->id,
                    'offer_name' => $campaign->name,
                    'hash_code' => $rand_key,
                    'status' => 'pending',
                    'start_ip' => $PublicIP,
                    'site_id' => $site->id,
                    'api_key' => $user_key,
                    'end_ip' => '',
                    'credit' => $campaign->credit,
                    'ref_credit' => roundoff(($network->rate->network_rate * $campaign->credit) / 100),
                    'network' => $campaign->network,
                    'link_id' => $last_url,
                    'credit_mode' => "",
                    'source' => 'OfferWall',
                    'unique' => 1,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'start_country' => $country,
                    'end_country' => "",
                    'sid1' => @$inputs['sub1'],
                    'sid2' => @$inputs['sub2'],
                    'sid3' => @$inputs['sub3'],
                    'sid4' => @$inputs['sub4'],
                    'sid5' => @$inputs['sub5'],
                    'unique1' => @$inputs['unique1'],
                    'unique2' => @$inputs['unique2'],
                    'unique3' => @$inputs['unique3'],
                    'unique4' => @$inputs['unique4'],
                    'click_id' => @$inputs['click_id'],
                    'date' => Carbon::now()
                ]);
                Offer::where('id', $campaign['id'])->update([
                    'hits' => $campaign->hits + 1,
                ]);
            
                $redirect_url = $campaign->target_url . "&sub1=" . $rand_key;
                // dd($redirect_url,$adding);
                if ($limit == 0) {
                    return redirect($redirect_url);
                } else if ($count < $limit) {
                    return redirect($redirect_url);
                } else {
                    abort(404);
                }
            }else{
                return abort(404);
            }
        } catch (Exception $e) {
            // dd($e);
            abort(404);
        }
    }

    public function serveImage($id)
    {
        // Get the encrypted path from the query parameter
        $offer = Offer::where('id',$id)->first();
        
        // Fetch the image data from the S3 URL
        try {
            $response = Http::get($offer->image_url);
            if ($response->failed()) {
                $response = Http::get(env('APP_URL').'/img/reward.png');
                $mimeType = $response->header('Content-Type');
                return response($response->body(), 200)->header('Content-Type', $mimeType);
                // return response('Image not found', 404);
            }
        } catch (\Exception $e) {
            $response = Http::get(env('APP_URL').'/img/reward.png');
            $mimeType = $response->header('Content-Type');
            return response($response->body(), 200)->header('Content-Type', $mimeType);
            // return response('Failed to fetch image', 500);
        }
    
        // Get the MIME type from the response headers
        $mimeType = $response->header('Content-Type');
    
        // Serve the image with the appropriate headers
        return response($response->body(), 200)->header('Content-Type', $mimeType);
    }

 
}
