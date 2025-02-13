<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\ApiProvider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminCheck;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class ApiProviderController extends Controller
{
    function __construct()
    {
        $this->middleware(AdminCheck::class);
        $this->middleware('auth');
    }


    public function fetch_offers(Request $request, $id)
    {

        $provider = ApiProvider::where('id', $id)->first();

        $name = $provider->api_provider_name;


        if ($name == 'Yuno') {
            $url = $provider->api_endpoint;
            $client = new \GuzzleHttp\Client();
            // $request = $client->request('GET',$url);
            // $response = $request->send();
            // dd($request->getBody());

            // Send an asynchronous request.
            $req = new \GuzzleHttp\Psr7\Request('GET', $url);
            $promise = $client->sendAsync($req)->then(function ($resp)
            use ($name) {
                $body = $resp->getBody();
                $data = json_decode($body)->offers;
                foreach ($data as $d) {

                    $country = $d->target_groups;
                    $countries = "ALL";
                    foreach ($country as $c) {
                        if ($c->key == 'country_code') {
                            // dd($c);
                            $countries = implode(" | ", $c->values);
                        }
                    }
                    //  dd($d->uuid);
                    Offer::updateOrCreate([
                        'campaign_id' => $d->uuid,
                        'network' => $name,
                    ], [
                        'campaign_id' => $d->uuid,
                        'name' => $d->title,
                        'description' => $d->info_short,
                        'image_url' => $d->icon_1,
                        'hash_code' => Str::random(50),
                        'network' => $name,
                        'credit' => $d->reward_dollar,
                        'active' => 1,
                        'hits' => 0,
                        'limit' => 0,
                        'target_url' => $d->url,
                        'countries' => $countries,
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
                }
            });
            $promise->wait();
            return  redirect()->back();
            // dd($url);
        } else if ($name == 'MobSuccess') {
            $url = $provider->api_endpoint;
            $client = new \GuzzleHttp\Client();
            // $request = $client->request('GET',$url);
            // $response = $request->send();
            // dd($request->getBody());
            $apiKey = "uy]t((E?7;|<`DI# L:lRWy,_VoD!gV^_VnrG]X*M0rv!|-v2RWVOMf{{r:5;|s7cs";
            $pubid = "2845";
            $time = time();
            $hash = sha1($time . $apiKey);
            //  dd($hash);
            $url = $url . "?pubid=" . $pubid . "&timestamp=" . $time . "&hash=" . $hash;
            // Send an asynchronous request.
            return redirect($url);
            $req = new \GuzzleHttp\Psr7\Request('GET', $url . "");
            $promise = $client->sendAsync($req)->then(function ($resp) {
                $body = $resp->getBody();
                dd(json_decode($body));
            });
            $promise->wait();
        } else if ($name == 'InBrain') {
            // $url=$provider->api_endpoint."?userId=bba23648-8a40-4e9c-943f-6bf1411e79ef&ipAddress=".$_SERVER['REMOTE_ADDR'];
            // $url=$provider->api_endpoint."?ipAddress=".'203.81.240.255&placementId=7e870b16-3544-4ff8-98e5-c31c4a143855';
            // Send an asynchronous request.
            // $url=$provider->api_endpoint."?userId=vbnvbnvbnv&ipAddress=".'203.81.240.255&language=en-us';
            $ip = '202.142.121.180'; // IN
            // $ip='162.210.195.203'; US
            // $ip='185.107.70.56';
            $url = $provider->api_endpoint . "?userId=jhhhhdfgjsdgfjgdf&ipAddress=" . $ip . '&language=en-us';

            // dd($url);

            $client = new \GuzzleHttp\Client();

            $api_key = '81B7BF4F-0B08-4A91-ABC7-D6C975ECED0F';
            // Send an asynchronous request.
            // $client->prepareDefaults('headers', array('X-InBrain-Api-Key' => $api_key));
            // dd($api_key);
            $req = new \GuzzleHttp\Psr7\Request('GET', $url, ['X-InBrain-Api-Key' => $api_key]);
            $promise = $client->sendAsync($req)->then(function ($resp)
            use ($name) {
                $body = $resp->getBody();
                dd(json_decode($body));
                $data = json_decode($body)->offers;
                foreach ($data as $d) {

                    $country = $d->target_groups;
                    $countries = "ALL";
                    foreach ($country as $c) {
                        if ($c->key == 'country_code') {
                            // dd($c);
                            $countries = implode(" | ", $c->values);
                        }
                    }
                    //  dd($d->uuid);
                    Offer::updateOrCreate([
                        'campaign_id' => $d->uuid,
                        'network' => $name,
                    ], [
                        'campaign_id' => $d->uuid,
                        'name' => $d->title,
                        'description' => $d->info_short,
                        'image_url' => $d->icon_1,
                        'hash_code' => Str::random(50),
                        'network' => $name,
                        'credit' => $d->reward_dollar,
                        'active' => 1,
                        'hits' => 0,
                        'limit' => 0,
                        'target_url' => $d->url,
                        'countries' => $countries,
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
                }
            });
            $promise->wait();
            return  redirect()->back();
        } else if ($name == 'TheoremReach') {
            // $url=$provider->api_endpoint."?userId=bba23648-8a40-4e9c-943f-6bf1411e79ef&ipAddress=".$_SERVER['REMOTE_ADDR'];
            // $url=$provider->api_endpoint."?ipAddress=".'203.81.240.255&placementId=7e870b16-3544-4ff8-98e5-c31c4a143855';
            // Send an asynchronous request.
            // $url=$provider->api_endpoint."?userId=vbnvbnvbnv&ipAddress=".'203.81.240.255&language=en-us';
            $url = $provider->api_endpoint;
            $request_url = $provider->api_endpoint;
            $json_body = [];
            $secret_key = 'a33408e07d88a058a8414fa297b765820ba6d6e0';
            //  $secret_key='ddeabd4477894a03e602836b2c55cd3abd687e36'; 

            $secret_url = $request_url . json_encode($json_body) . $secret_key;
            $hash = hash('sha3-256', $secret_url);

            $hashed_url = $request_url . '?enc=' . $hash;

            // dd($hashed_url);
            $client = new \GuzzleHttp\Client();

            $api_key = '7a5791a846bf5be8912a51644bb5';
            // $api_key='4102392f0d35c5e0f0870eeb8571';
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $hashed_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'X-Api-Key: ' . base64_encode($api_key)
                ),
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",

            ));

            $response = curl_exec($curl);

            dd($response);
            curl_close($curl);
            // Send an asynchronous request.
            // $client->prepareDefaults('headers', array('X-InBrain-Api-Key' => $api_key));
            // dd($api_key);
            // $req = new \GuzzleHttp\Psr7\Request('GET', $url,[
            //     'Content-Type'=>'application/json',
            //     'X-Api-Key'=>  base64_encode($api_key)]);
            // $promise = $client->sendAsync($req)->then(function ($resp)
            // use ($name) {
            //    $body=$resp->getBody();
            //    dd(json_decode($body));
            //    $data=json_decode($body)->offers;
            //    foreach($data as $d){

            //     $country=$d->target_groups;
            //     $countries="ALL";
            //     foreach($country as $c){
            //         if($c->key=='country_code'){
            //             // dd($c);
            //             $countries=implode(" | ", $c->values);
            //         }
            //     }
            //     //  dd($d->uuid);
            //     Offer::updateOrCreate([
            //         'campaign_id'=>$d->uuid,
            //         'network'=>$name,
            //     ],[
            //         'campaign_id'=>$d->uuid,
            //         'name'=>$d->title,
            //         'description'=>$d->info_short,
            //         'image_url'=>$d->icon_1,
            //         'hash_code'=>Str::random(50),
            //         'network'=>$name,
            //         'credit'=>$d->reward_dollar,
            //         'active'=>1,
            //         'hits'=>0,
            //         'limit'=>0,
            //         'target_url'=>$d->url,
            //         'countries'=>$countries,
            //         'leads'=>0,
            //         'date'=>Carbon::now(),
            //         'epc'=>0,
            //         'mobile'=>1,
            //         'categories'=>'All Survey',
            //         'web'=>1,
            //         'cr'=>0,
            //         'browser'=>'All',
            //         'uid'=>0,
            //         'views'=>0,
            //         'convert'=>0
            //     ]);

            //    }

            // });
            // $promise->wait();
            return  redirect()->back();
        } else if ($name == 'Lootably') {
            $url = $provider->api_endpoint;
            $body = [
                "apiKey" => "0s894ydz8nk53qu3l78mv93u1fmesvw3r3zzn3oa9ias",
                "placementID" => "cm0cf86iq008a01ymcfbt4okf"
            ];
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($body)
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $data=json_decode($response)->data->offers;
            // dd($data[0]);
                foreach ($data as $d) {
                    $country = $d->countries;
                    $countries = "ALL";
                    if (count($country) > 0) {
                        $countries = implode(" | ", $country);
                    }
                    if(isset($d?->revenue)){
                        Offer::updateOrCreate([
                            'campaign_id' => $d->offerID,
                            'network' => $name,
                        ], [
                            'campaign_id' => $d->offerID,
                            'name' => $d->name,
                            'description' => $d->description,
                            'image_url' => $d->image,
                            'hash_code' => Str::random(50),
                            'network' => $name,
                            'credit' => $d->revenue,
                            'active' => 1,
                            'hits' => 0,
                            'limit' => 0,
                            'target_url' => $d->link,
                            'countries' => $countries,
                            'leads' => 0,
                            'date' => Carbon::now(),
                            'epc' => 0,
                            'mobile' => 1,
                            'categories' => $d->categories ? implode(' | ', $d->categories) : "All Surveys",
                            'web' => 1,
                            'cr' => 0,
                            'browser' => 'All',
                            'uid' => 0,
                            'views' => 0,
                            'convert' => 0
                        ]);
                    }
                }
            echo "done";
        } else if ($name == 'AdScendMedia') {

            $categories = [
                '17' => 'Free',
                '18' => 'Mobile Apps',
                '19' => 'Videos',
                '20' => 'Surveys',
                '21' => 'Shopping',
                '22' => 'Free Trials',
                '23' => 'Downloads',
                '24' => 'Sign-Ups',
                '25' => 'Mobile Subscriptions',
                '26' => 'Co-Registrations',
                '29' => 'Casino'
            ];

            $targets = [
                '0' => 'Any All',
                '31' => 'Any Desktop: All',
                '10' => 'Windows: All',
                '11' => 'Windows: IE',
                '12' => 'Windows: Firefox',
                '13' => 'Windows: Chrome',
                '18' => 'Windows: FF or Chrome',
                '19' => 'Windows: All But Chrome',
                '20' => 'Mac: All',
                '30' => 'Any Mobile: All',
                '40' => 'Android: All',
                '56' => 'Android: 5.0 and above',
                '50' => 'iOS: All',
                '51' => 'iOS: iPhone',
                '52' => 'iOS: iPad'
            ];
            $url = $provider->api_endpoint;
            $process = curl_init($url);
            curl_setopt($process, CURLOPT_USERPWD, "115665:1618998357");
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            // return ($return);
            $data = json_decode($return)->offers;
            foreach ($data as $d) {

                $country = $d->countries;
                $countries = "ALL";
                // foreach ($country as $c) {
                if (count($country) > 0) {
                    $countries = implode(" | ", $country);
                }
                // }

                $categoriesfinal = [];

                foreach ($d->category_id as $c) {
                    if (isset($categories[$c])) {
                        $categoriesfinal[] = $categories[$c];
                    }
                }
                if (count($categoriesfinal) == 0) {
                    $categoriesfinal = "All Surveys";
                } else {
                    $categoriesfinal = implode(" | ", $categoriesfinal);
                }

                $targetId = $d->target_system;
                $targetNames = 'All';

                if (isset($targets[$targetId])) {
                    $targetNames = $targets[$targetId];
                }




                //  dd($d->uuid);
                Offer::updateOrCreate([
                    'campaign_id' => $d->offer_id,
                    'network' => $name,
                ], [
                    'campaign_id' => $d->offer_id,
                    'name' => $d->name,
                    'description' => $d->description,
                    'image_url' => (count($d->creatives) > 0) ? $d->creatives[0]->url : '',
                    'hash_code' => Str::random(50),
                    'network' => $name,
                    'credit' => $d->payout,
                    'active' => 1,
                    'hits' => 0,
                    'limit' => 0,
                    'target_url' => $d->click_url,
                    'preview_url' => $d->preview_url,
                    'countries' => $countries,
                    'leads' => 0,
                    'date' => Carbon::now(),
                    'epc' => 0,
                    'mobile' => 1,
                    'categories' => $categoriesfinal,
                    'targets' => $targetNames,
                    'web' => 1,
                    'cr' => 0,
                    'browser' => 'All',
                    'uid' => 0,
                    'views' => 0,
                    'convert' => 0
                ]);
            }

            echo "Done";
        } else if ($name == 'PointClickTrack') {

            $categories = [
                '17' => 'Free',
                '18' => 'Mobile Apps',
                '19' => 'Videos',
                '20' => 'Surveys',
                '21' => 'Shopping',
                '22' => 'Free Trials',
                '23' => 'Downloads',
                '24' => 'Sign-Ups',
                '25' => 'Mobile Subscriptions',
                '26' => 'Co-Registrations',
                '29' => 'Casino'
            ];

            $targets = [
                '0' => 'Any All',
                '31' => 'Any Desktop: All',
                '10' => 'Windows: All',
                '11' => 'Windows: IE',
                '12' => 'Windows: Firefox',
                '13' => 'Windows: Chrome',
                '18' => 'Windows: FF or Chrome',
                '19' => 'Windows: All But Chrome',
                '20' => 'Mac: All',
                '30' => 'Any Mobile: All',
                '40' => 'Android: All',
                '56' => 'Android: 5.0 and above',
                '50' => 'iOS: All',
                '51' => 'iOS: iPhone',
                '52' => 'iOS: iPad'
            ];
            $url = $provider->api_endpoint;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                CURLOPT_POST => false
            ));

            $response = curl_exec($curl);
            // return ($return);
            $data = json_decode($response)->offers;
            foreach ($data as $d) {

                if (isset($d->creatives)) {
                    $country = $d->countries;
                    $countries = "ALL";
                    if (count($country) > 0) {
                        $countries = implode(" | ", $country);
                    }
                    $categoriesfinal = [];

                    if (isset($d->device_type)) {
                        $categoriesfinal = $d->device_type;
                    } else {
                        $categoriesfinal = "All Surveys";
                    }


                    $targetId = $d->device;


                    $target_url = '';
                    $image_url = $d->creatives[0]->image_url;
                    foreach ($d->creatives[0]->tracking_urls as $c) {
                        if ($c->site == 'pepeleads.com') {
                            $target_url = $c->url;
                        }
                    }

                    Offer::updateOrCreate([
                        'campaign_id' => $d->offer_id,
                        'network' => $name,
                    ], [
                        'campaign_id' => $d->offer_id,
                        'name' => $d->offer_name,
                        'description' => @$d->description . " | " . @$d->requirements,
                        'image_url' => $image_url,
                        'hash_code' => Str::random(50),
                        'network' => $name,
                        'credit' => $d->rate,
                        'active' => 1,
                        'hits' => 0,
                        'limit' => 0,
                        'target_url' => $target_url,
                        'preview_url' => $d->preview_url,
                        'countries' => $countries,
                        'leads' => 0,
                        'date' => Carbon::now(),
                        'epc' => $d->epc,
                        'mobile' => 1,
                        'categories' => $categoriesfinal,
                        'targets' => $targetId,
                        'web' => 1,
                        'cr' => 0,
                        'browser' => 'All',
                        'uid' => 0,
                        'views' => 0,
                        'convert' => 0
                    ]);
                }
            }

            echo "Done";
        } else if ($name == 'LeadsAds') {

            $apiKey = "36cb6d21fca690546369a169d3350c60bc5589a4255598b21bb286210264a81d";

            $categories = [
                '17' => 'Free',
                '18' => 'Mobile Apps',
                '19' => 'Videos',
                '20' => 'Surveys',
                '21' => 'Shopping',
                '22' => 'Free Trials',
                '23' => 'Downloads',
                '24' => 'Sign-Ups',
                '25' => 'Mobile Subscriptions',
                '26' => 'Co-Registrations',
                '29' => 'Casino'
            ];

            $targets = [
                '0' => 'Any All',
                '31' => 'Any Desktop: All',
                '10' => 'Windows: All',
                '11' => 'Windows: IE',
                '12' => 'Windows: Firefox',
                '13' => 'Windows: Chrome',
                '18' => 'Windows: FF or Chrome',
                '19' => 'Windows: All But Chrome',
                '20' => 'Mac: All',
                '30' => 'Any Mobile: All',
                '40' => 'Android: All',
                '56' => 'Android: 5.0 and above',
                '50' => 'iOS: All',
                '51' => 'iOS: iPhone',
                '52' => 'iOS: iPad'
            ];

            $deleteOldOffers=Offer::where('network',$name)->delete();
            

            $url = $provider->api_endpoint;
            $process = curl_init($url);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            $data = json_decode($return)->response->data;

            foreach ($data as  $key => $d) {
                if ($d->Offer->approval_status == 'approved') {
                    $checkCountryUrl = 'https://leadads.api.hasoffers.com/Apiv3/json?api_key=' . $apiKey . '&Target=Affiliate_Offer&Method=getGeoTargeting&id=' . $key;
                    $process = curl_init($checkCountryUrl);
                    curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
                    $return = curl_exec($process);
                    $data_c = json_decode($return);

                    $countries = "ALL";
                    $count = [];
                    foreach ($data_c->response->data as $c_data) {
                        $country = $c_data;
                        foreach ($country as  $k => $c) {
                            if(isset($c?->code)){
                                $count[] = $c?->code;
                            }
                        }
                        if (count($count) > 0) {
                            $countries = implode(" | ", $count);
                        }
                    }


                    $prev_url = 'https://leadads.go2jump.org/aff_c?offer_id=' . $key . '&aff_id=10833';

                    $categoriesfinal = [];

                    if (isset($d->Offer->device_type)) {
                        $categoriesfinal = $d->Offer->device_type;
                    } else {
                        $categoriesfinal = "All Surveys";
                    }


                    $targetId = 'All Devices';


                    $target_url = '';
                    $image_url = '/img/reward.png';

                    Offer::updateOrCreate([
                        'campaign_id' => $key,
                        'network' => $name,
                    ], [
                        'campaign_id' => $key,
                        'name' => $d->Offer->name,
                        'description' => @$d->Offer->description,
                        'image_url' => $image_url,
                        'hash_code' => Str::random(50),
                        'network' => $name,
                        'credit' => $d->Offer->default_payout,
                        'active' => 1,
                        'hits' => 0,
                        'limit' => 0,
                        'target_url' => $prev_url,
                        'preview_url' => $d->Offer->preview_url,
                        'countries' => $countries,
                        'leads' => 0,
                        'date' => Carbon::now(),
                        'epc' => $d->Offer->monthly_payout_cap,
                        'mobile' => 1,
                        'categories' => $categoriesfinal,
                        'targets' => $targetId,
                        'web' => 1,
                        'cr' => 0,
                        'browser' => 'All',
                        'uid' => 0,
                        'views' => 0,
                        'convert' => 0
                    ]);
                }
            }

            echo "Done";
            return  redirect()->back();
        }else if($name=='DynuinMedia'){

            $apiKey = "9fb50cb039df1c5229280530750f33d5adca8c12aa74a4019477fd3519321ee4";

            $categories = [
                '17' => 'Free',
                '18' => 'Mobile Apps',
                '19' => 'Videos',
                '20' => 'Surveys',
                '21' => 'Shopping',
                '22' => 'Free Trials',
                '23' => 'Downloads',
                '24' => 'Sign-Ups',
                '25' => 'Mobile Subscriptions',
                '26' => 'Co-Registrations',
                '29' => 'Casino'
            ];

            $targets = [
                '0' => 'Any All',
                '31' => 'Any Desktop: All',
                '10' => 'Windows: All',
                '11' => 'Windows: IE',
                '12' => 'Windows: Firefox',
                '13' => 'Windows: Chrome',
                '18' => 'Windows: FF or Chrome',
                '19' => 'Windows: All But Chrome',
                '20' => 'Mac: All',
                '30' => 'Any Mobile: All',
                '40' => 'Android: All',
                '56' => 'Android: 5.0 and above',
                '50' => 'iOS: All',
                '51' => 'iOS: iPhone',
                '52' => 'iOS: iPad'
            ];

            $deleteOldOffers=Offer::where('network',$name)->delete();
            

            $url = $provider->api_endpoint;
            $process = curl_init($url);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            $data = json_decode($return)->response->data;

            foreach ($data as  $key => $d) {
                if ($d->Offer->approval_status == 'approved') {
                    $checkCountryUrl = 'https://dynuinmedia.api.hasoffers.com/Apiv3/json?api_key=' . $apiKey . '&Target=Affiliate_Offer&Method=getGeoTargeting&id=' . $key;
                    $process = curl_init($checkCountryUrl);
                    curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
                    $return = curl_exec($process);
                    $data_c = json_decode($return);

                    $countries = "ALL";
                    $count = [];
                    foreach ($data_c->response->data as $c_data) {
                        $country = $c_data;
                        foreach ($country as  $k => $c) {
                            $count[] = $c->code;
                        }
                        if (count($count) > 0) {
                            $countries = implode(" | ", $count);
                        }
                    }


                    $prev_url = 'https://dynuinmedia.go2cloud.org/aff_c?offer_id=' . $key . '&aff_id=8116';

                    $categoriesfinal = [];

                    if (isset($d->Offer->device_type)) {
                        $categoriesfinal = $d->Offer->device_type;
                    } else {
                        $categoriesfinal = "All Surveys";
                    }


                    $targetId = 'All Devices';


                    $target_url = '';
                    $image_url = '/img/reward.png';

                    Offer::updateOrCreate([
                        'campaign_id' => $key,
                        'network' => $name,
                    ], [
                        'campaign_id' => $key,
                        'name' => $d->Offer->name,
                        'description' => @$d->Offer->description,
                        'image_url' => $image_url,
                        'hash_code' => Str::random(50),
                        'network' => $name,
                        'credit' => $d->Offer->default_payout,
                        'active' => 1,
                        'hits' => 0,
                        'limit' => 0,
                        'target_url' => $prev_url,
                        'preview_url' => $d->Offer->preview_url,
                        'countries' => $countries,
                        'leads' => 0,
                        'date' => Carbon::now(),
                        'epc' => $d->Offer->monthly_payout_cap,
                        'mobile' => 1,
                        'categories' => $categoriesfinal,
                        'targets' => $targetId,
                        'web' => 1,
                        'cr' => 0,
                        'browser' => 'All',
                        'uid' => 0,
                        'views' => 0,
                        'convert' => 0
                    ]);
                }
            }

            echo "Done";
            return  redirect()->back();
        }else if($name=='ChameleonAds'){

            $apiKey = "ede5b231d6a23954efcf5739ff52ebdae4ae903d0977dded6292962f10ea699a";

            $categories = [
                '17' => 'Free',
                '18' => 'Mobile Apps',
                '19' => 'Videos',
                '20' => 'Surveys',
                '21' => 'Shopping',
                '22' => 'Free Trials',
                '23' => 'Downloads',
                '24' => 'Sign-Ups',
                '25' => 'Mobile Subscriptions',
                '26' => 'Co-Registrations',
                '29' => 'Casino'
            ];

            $targets = [
                '0' => 'Any All',
                '31' => 'Any Desktop: All',
                '10' => 'Windows: All',
                '11' => 'Windows: IE',
                '12' => 'Windows: Firefox',
                '13' => 'Windows: Chrome',
                '18' => 'Windows: FF or Chrome',
                '19' => 'Windows: All But Chrome',
                '20' => 'Mac: All',
                '30' => 'Any Mobile: All',
                '40' => 'Android: All',
                '56' => 'Android: 5.0 and above',
                '50' => 'iOS: All',
                '51' => 'iOS: iPhone',
                '52' => 'iOS: iPad'
            ];

            $deleteOldOffers=Offer::where('network',$name)->delete();
            

            $url = $provider->api_endpoint;
            // $process = curl_init($url);
            // curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            // $return = curl_exec($process);
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                CURLOPT_POST => false,
                // CURLOPT_POSTFIELDS => json_encode($body)
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $data = json_decode($response)->response->data;

            foreach ($data as  $key => $d) {
                if ($d->Offer->approval_status == 'approved') {
                    $checkCountryUrl = 'https://chameleonads.api.hasoffers.com/Apiv3/json?api_key=' . $apiKey . '&Target=Affiliate_Offer&Method=getGeoTargeting&id=' . $key;
                    $process = curl_init($checkCountryUrl);
                    curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
                    $return = curl_exec($process);
                    $data_c = json_decode($return);

                    $countries = "ALL";
                    $count = [];
                    foreach ($data_c->response->data as $c_data) {
                        $country = $c_data;
                        foreach ($country as  $k => $c) {
                            $count[] = $c?->code;
                        }
                        if (count($count) > 0) {
                            $countries = implode(" | ", $count);
                        }
                    }


                    $prev_url = 'https://chameleonads.go2cloud.org/aff_c?offer_id=' . $key . '&aff_id=4677';

                    $categoriesfinal = [];

                    if (isset($d->Offer->device_type)) {
                        $categoriesfinal = $d->Offer->device_type;
                    } else {
                        $categoriesfinal = "All Surveys";
                    }


                    $targetId = 'All Devices';


                    $target_url = '';
                    $image_url = '/img/reward.png';

                    Offer::updateOrCreate([
                        'campaign_id' => $key,
                        'network' => $name,
                    ], [
                        'campaign_id' => $key,
                        'name' => $d->Offer->name,
                        'description' => @$d->Offer->description,
                        'image_url' => $image_url,
                        'hash_code' => Str::random(50),
                        'network' => $name,
                        'credit' => $d->Offer->default_payout,
                        'active' => 1,
                        'hits' => 0,
                        'limit' => 0,
                        'target_url' => $prev_url,
                        'preview_url' => $d->Offer->preview_url,
                        'countries' => $countries,
                        'leads' => 0,
                        'date' => Carbon::now(),
                        'epc' => $d->Offer->monthly_payout_cap,
                        'mobile' => 1,
                        'categories' => $categoriesfinal,
                        'targets' => $targetId,
                        'web' => 1,
                        'cr' => 0,
                        'browser' => 'All',
                        'uid' => 0,
                        'views' => 0,
                        'convert' => 0
                    ]);
                }
            }

            echo "Done";
            return  redirect()->back();
        }else if($name=='WedeBeek'){
            Offer::where('network',$name)->delete();
            $url = $provider->api_endpoint;
            $process = curl_init($url."&page=1&limit=20000");
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            $data = json_decode($return);
            // dd($data);
            foreach ($data->offers as  $key => $d) {
                    $countries = implode('|',$d->countries);
                    $prev_url = @$d->preview_url;

                    $payOutArray=$d->payments;

                    $title=$d->title;
                    
                    $pattern = '/\s?[-:]?\s?\$\d+(\.\d+)?%?|\d+%/';
                    
                    $cleanedTitle = preg_replace($pattern, '', $title);

                    

                    // $categoriesfinal = $d->traffic_source;

                    $targetId = @$d->traffic_source;

                    $target_url = @$d->link;
                    $image_url = (@$d->logo)?@$d->logo:'/img/reward.png';
                    $key=$d->offer_id;
                    $amt=0;
                    $type=0;
                    if(count($payOutArray)>0){
                        foreach($payOutArray as $p){
                            if($p->revenue > 60){
                                $type=1;
                                $amt=$p->revenue;
                            }else{
                                $type=0;
                                $amt=$p->revenue;
                            }
                            Offer::updateOrCreate([
                                'campaign_id' => $key."-".$p->countries[0],
                                'network' => $name,
                            ], [
                                'campaign_id' => $key."-".$p->countries[0],
                                'name' => $cleanedTitle,
                                'description' => @$d->description_lang->en,
                                'image_url' => $image_url,
                                'hash_code' => Str::random(50),
                                'network' => $name,
                                'credit' =>  $amt,
                                'active' => 1,
                                'hits' => 0,
                                'limit' => 0,
                                'target_url' => $target_url,
                                'preview_url' => $prev_url,
                                'countries' => $countries,
                                'leads' => 0,
                                'date' => Carbon::now(),
                                'epc' => '',
                                'mobile' => 1,
                                'categories' => implode('|',@$d->categories),
                                'targets' => @$d->traffic_source,
                                'web' => 1,
                                'cr' => 0,
                                'browser' => 'All',
                                'uid' => 0,
                                'views' => 0,
                                'convert' => 0,
                                'percentage'=>$type
                            ]);
                            }
                        }
                    }

            echo "Done";
            // return  redirect()->back();
        }else if($name=='MaxPointMedia'){
            Offer::where('network',$name)->delete();
            $url = $provider->api_endpoint;
            $process = curl_init($url."&page=1&limit=20000");
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            $data = json_decode($return);
            // dd($data);
            foreach ($data->offers as  $key => $d) {
                    $countries = implode('|',$d->countries);
                    $prev_url = @$d->preview_url;

                    $payOutArray=$d->payments;

                    $title=$d->title;
                    
                    $pattern = '/\s?[-:]?\s?\$\d+(\.\d+)?%?|\d+%/';
                    
                    $cleanedTitle = preg_replace($pattern, '', $title);

                    

                    // $categoriesfinal = $d->traffic_source;

                    $targetId = @$d->traffic_source;

                    $target_url = @$d->link;
                    $image_url = (@$d->logo)?@$d->logo:'/img/reward.png';
                    $key=$d->offer_id;
                    $amt=0;
                    $type=0;
                    if(count($payOutArray)>0){
                        foreach($payOutArray as $p){
                            if($p->revenue > 60){
                                $type=1;
                                $amt=$p->revenue;
                            }else{
                                $type=0;
                                $amt=$p->revenue;
                            }
                            Offer::updateOrCreate([
                                'campaign_id' => $key."-".$p->countries[0],
                                'network' => $name,
                            ], [
                                'campaign_id' => $key."-".$p->countries[0],
                                'name' => $cleanedTitle,
                                'description' => @$d->description_lang->en,
                                'image_url' => $image_url,
                                'hash_code' => Str::random(50),
                                'network' => $name,
                                'credit' =>  $amt,
                                'active' => 1,
                                'hits' => 0,
                                'limit' => 0,
                                'target_url' => $target_url,
                                'preview_url' => $prev_url,
                                'countries' => $countries,
                                'leads' => 0,
                                'date' => Carbon::now(),
                                'epc' => '',
                                'mobile' => 1,
                                'categories' => implode('|',@$d->categories),
                                'targets' => @$d->traffic_source,
                                'web' => 1,
                                'cr' => 0,
                                'browser' => 'All',
                                'uid' => 0,
                                'views' => 0,
                                'convert' => 0,
                                'percentage'=>$type
                            ]);
                            }
                        }
                    }

            echo "Done";
            // return  redirect()->back();
        }else if($name=='OfferwallAds'){
            Offer::where('network',$name)->delete();
            $url = $provider->api_endpoint;
            $process = curl_init($url);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            $xml = simplexml_load_string($return);
            $json = json_encode($xml);
            $data = json_decode($json, true);
            $offerList = $data['campaign'];
            foreach ($offerList as  $key => $d) {
                    $countries = $d['countries'];
                    $prev_url = '';

                    $amt = floatval(str_replace('$', '', $d['payout']));

                    $title=$d['campaign_name'];

                    $target_url = @$d['url'];
                    $image_url = '/img/reward.png';
                    $key=$d['campaign_id'];
                    $type=0;
                            Offer::updateOrCreate([
                                'campaign_id' => $key,
                                'network' => $name,
                            ], [
                                'campaign_id' => $key,
                                'name' => $title,
                                'description' => @$d['campaign_desc'],
                                'image_url' => $image_url,
                                'hash_code' => Str::random(50),
                                'network' => $name,
                                'credit' =>  $amt,
                                'active' => 1,
                                'hits' => 0,
                                'limit' => 0,
                                'target_url' => $target_url,
                                'preview_url' => $prev_url,
                                'countries' => $countries,
                                'leads' => 0,
                                'date' => Carbon::now(),
                                'epc' => '',
                                'mobile' => 1,
                                'categories' => 'All Surveys',
                                'targets' => 'All Devices',
                                'web' => 1,
                                'cr' => 0,
                                'browser' => 'All',
                                'uid' => 0,
                                'views' => 0,
                                'convert' => 0,
                                'percentage'=>$type
                            ]);
                  }

            echo "Done";
            // return  redirect()->back();
        }else if($name == 'CpaMerchant') {

            $apiKey = "3ed97ff77aad3d94395415cd41498c7a42e5d5e24db7b5383c4146c121fe0cb5";

            $categories = [
                '17' => 'Free',
                '18' => 'Mobile Apps',
                '19' => 'Videos',
                '20' => 'Surveys',
                '21' => 'Shopping',
                '22' => 'Free Trials',
                '23' => 'Downloads',
                '24' => 'Sign-Ups',
                '25' => 'Mobile Subscriptions',
                '26' => 'Co-Registrations',
                '29' => 'Casino'
            ];

            $targets = [
                '0' => 'Any All',
                '31' => 'Any Desktop: All',
                '10' => 'Windows: All',
                '11' => 'Windows: IE',
                '12' => 'Windows: Firefox',
                '13' => 'Windows: Chrome',
                '18' => 'Windows: FF or Chrome',
                '19' => 'Windows: All But Chrome',
                '20' => 'Mac: All',
                '30' => 'Any Mobile: All',
                '40' => 'Android: All',
                '56' => 'Android: 5.0 and above',
                '50' => 'iOS: All',
                '51' => 'iOS: iPhone',
                '52' => 'iOS: iPad'
            ];

            $deleteOldOffers=Offer::where('network',$name)->delete();
            

            $url = $provider->api_endpoint;
            $process = curl_init($url);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            $data = json_decode($return)->response->data;

            foreach ($data as  $key => $d) {
                if ($d->Offer->approval_status == 'approved') {
                    $checkCountryUrl = 'https://cpamerchant.api.hasoffers.com/Apiv3/json?api_key=' . $apiKey . '&Target=Affiliate_Offer&Method=getGeoTargeting&id=' . $key;
                    $process = curl_init($checkCountryUrl);
                    curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
                    $return = curl_exec($process);
                    $data_c = json_decode($return);

                    $countries = "ALL";
                    $count = [];
                    foreach ($data_c->response->data as $c_data) {
                        $country = $c_data;
                        foreach ($country as  $k => $c) {
                            if(isset($c?->code)){
                                $count[] = $c?->code;
                            }
                        }
                        if (count($count) > 0) {
                            $countries = implode(" | ", $count);
                        }
                    }


                    $prev_url = 'https://tracking.cpamerchant.com/aff_c?offer_id=' . $key . '&aff_id=3546';

                    $categoriesfinal = [];

                    if (isset($d->Offer->device_type)) {
                        $categoriesfinal = $d->Offer->device_type;
                    } else {
                        $categoriesfinal = "All Surveys";
                    }


                    $targetId = 'All Devices';


                    $target_url = '';
                    $image_url = '/img/reward.png';

                    Offer::updateOrCreate([
                        'campaign_id' => $key,
                        'network' => $name,
                    ], [
                        'campaign_id' => $key,
                        'name' => $d->Offer->name,
                        'description' => @$d->Offer->description,
                        'image_url' => $image_url,
                        'hash_code' => Str::random(50),
                        'network' => $name,
                        'credit' => $d->Offer->default_payout,
                        'active' => 1,
                        'hits' => 0,
                        'limit' => 0,
                        'target_url' => $prev_url,
                        'preview_url' => $d->Offer->preview_url,
                        'countries' => $countries,
                        'leads' => 0,
                        'date' => Carbon::now(),
                        'epc' => $d->Offer->monthly_payout_cap,
                        'mobile' => 1,
                        'categories' => $categoriesfinal,
                        'targets' => $targetId,
                        'web' => 1,
                        'cr' => 0,
                        'browser' => 'All',
                        'uid' => 0,
                        'views' => 0,
                        'convert' => 0
                    ]);
                }
            }

            echo "Done";
            return  redirect()->back();
        }else if($name == 'AdOn') {

           

            $deleteOldOffers=Offer::where('network',$name)->delete();
            

            $url = $provider->api_endpoint;
            $process = curl_init($url);
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($process);
            $data = json_decode($return)?->offers;

            foreach ($data as  $d) {
               
                    $countries = "ALL";
                    if($d?->targeting?->countries?->whitelist){
                        $count = [];
                        foreach($d?->targeting?->countries?->whitelist as $c){
                            $count[] = strtoupper($c?->code2);
                        }
                        $countries = implode('|',$count);
                    }
                    $key=$d->id;
                    $prev_url = @$d->click_url;
                    $targetId = 'All Devices';

                    $target_url = '';
                    $image_url = (@$d->icon)?@$d->icon:'/img/reward.png';

                    Offer::updateOrCreate([
                        'campaign_id' => $key,
                        'network' => $name,
                    ], [
                        'campaign_id' => $key,
                        'name' => @$d->name,
                        'description' => @$d->description,
                        'image_url' => $image_url,
                        'hash_code' => Str::random(50),
                        'network' => $name,
                        'credit' => @$d->payout,
                        'active' => 1,
                        'hits' => 0,
                        'limit' => 0,
                        'target_url' => @$prev_url,
                        'preview_url' => @$d->preview_url,
                        'countries' => @$countries,
                        'leads' => 0,
                        'date' => Carbon::now(),
                        'epc' => @$d->daily_conversion_cap,
                        'mobile' => 1,
                        'categories' => @$d->category || 'All Surveys',
                        'targets' => $targetId,
                        'web' => 1,
                        'cr' => 0,
                        'browser' => 'All',
                        'uid' => 0,
                        'views' => 0,
                        'convert' => 0
                    ]);
            }

            echo "Done";
            return  redirect()->back();
        }
        // else if($name=='MaxPointMedia'){
        //     Offer::where('network',$name)->delete();
        //     $url = $provider->api_endpoint;
        //     $process = curl_init($url."&page=1&limit=20000");
        //     curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        //     $return = curl_exec($process);
        //     $data = json_decode($return);
        //     // dd($data);
        //     foreach ($data->offers as  $key => $d) {
        //             $countries = implode('|',$d->countries);
        //             $prev_url = @$d->preview_url;

        //             $payOutArray=$d->payments;

        //             $title=$d->title;
                    
        //             $pattern = '/\s?[-:]?\s?\$\d+(\.\d+)?%?|\d+%/';
                    
        //             $cleanedTitle = preg_replace($pattern, '', $title);

                    

        //             // $categoriesfinal = $d->traffic_source;

        //             $targetId = @$d->traffic_source;

        //             $target_url = @$d->link;
        //             $image_url = (@$d->logo)?@$d->logo:'/img/reward.png';
        //             $key=$d->offer_id;
        //             $amt=0;
        //             $type=0;
        //             if(count($payOutArray)>0){
        //                 foreach($payOutArray as $p){
        //                     if($p->revenue > 60){
        //                         $type=1;
        //                         $amt=$p->revenue;
        //                     }else{
        //                         $type=0;
        //                         $amt=$p->revenue;
        //                     }
        //                     Offer::updateOrCreate([
        //                         'campaign_id' => $key."-".$p->countries[0],
        //                         'network' => $name,
        //                     ], [
        //                         'campaign_id' => $key."-".$p->countries[0],
        //                         'name' => $cleanedTitle,
        //                         'description' => @$d->description_lang->en,
        //                         'image_url' => $image_url,
        //                         'hash_code' => Str::random(50),
        //                         'network' => $name,
        //                         'credit' =>  $amt,
        //                         'active' => 1,
        //                         'hits' => 0,
        //                         'limit' => 0,
        //                         'target_url' => $target_url,
        //                         'preview_url' => $prev_url,
        //                         'countries' => $countries,
        //                         'leads' => 0,
        //                         'date' => Carbon::now(),
        //                         'epc' => '',
        //                         'mobile' => 1,
        //                         'categories' => implode('|',@$d->categories),
        //                         'targets' => @$d->traffic_source,
        //                         'web' => 1,
        //                         'cr' => 0,
        //                         'browser' => 'All',
        //                         'uid' => 0,
        //                         'views' => 0,
        //                         'convert' => 0,
        //                         'percentage'=>$type
        //                     ]);
        //                     }
        //                 }
        //             }

        //     echo "Done";
        //     // return  redirect()->back();
        // }
    }
}
