<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\MainController;
use App\Models\Blogs;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('coming_soon');
// });

Route::get('/test-db', function () {
    // try {
    //     DB::connection()->getPdo();
    //     return "Connected successfully to the database.";
    // } catch (\Exception $e) {
    //     return "Could not connect to the database. Please check your configuration. Error: " . $e->getMessage();
    // }
});
Route::get('/', [MainController::class,'index']);
Route::get('/home', [MainController::class,'index']);
Route::get('/terms-and-conditions', [MainController::class,'terms_and_condition']);
Route::get('/privacy-policies', [MainController::class,'privacy_policies']);
Route::get('/payment-policies', [MainController::class,'payment_policies']);
Route::get('/landing', [MainController::class,'home']);
Route::get('/complete', [MainController::class,'complete']);
Route::get('/nosurvey', [MainController::class,'nosurvey']);
Route::post('send-query',[MainController::class, 'send_query']);

Route::get('/blog', [MainController::class,'newblog'])->name('newblog');

//Route::get('/blog', [MainController::class,'blog']);
Route::get('/blog/{id}', [MainController::class,'blogdetail']);

Auth::routes();


//Sites Routes
Route::get('/sites', [App\Http\Controllers\HomeController::class, 'sites'])->name('sites');
Route::get('/refer', [App\Http\Controllers\HomeController::class, 'refer'])->name('refer_view');
Route::get('/sites/add', [App\Http\Controllers\HomeController::class, 'site_add'])->name('add_sites');
Route::get('/sites/edit/{id}', [App\Http\Controllers\HomeController::class, 'site_edit'])->name('edit_site');
Route::post('/add_site', [App\Http\Controllers\HomeController::class, 'add_site'])->name('add_site');
Route::post('/edit_site', [App\Http\Controllers\HomeController::class, 'edit_site'])->name('edit_sites');

Route::get('/notifications', [App\Http\Controllers\HomeController::class, 'notifications'])->name('notifications');

// Dashboard Routes
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/finance', [App\Http\Controllers\HomeController::class, 'finance'])->name('finance')->middleware('verified');
Route::get('/postback_integrations', [App\Http\Controllers\HomeController::class, 'postback_integrations'])->name('postback_integrations')->middleware('verified');
Route::get('/api_integrations', [App\Http\Controllers\HomeController::class, 'api_integrations'])->name('api_integrations')->middleware('verified');
Route::get('/all_offers', [App\Http\Controllers\HomeController::class, 'all_offers'])->name('all_offers')->middleware('verified');
Route::get('/active_offers', [App\Http\Controllers\HomeController::class, 'active_offers'])->name('active_offers')->middleware('verified');
Route::get('/pending_offers', [App\Http\Controllers\HomeController::class, 'pending_offers'])->name('pending_offers')->middleware('verified');
Route::get('/offer_details/{id}', [App\Http\Controllers\HomeController::class, 'offer_details'])->name('offer_details')->middleware('verified');
Route::get('/request/offer/{id}', [App\Http\Controllers\HomeController::class, 'offer_apply'])->name('offer_apply')->middleware('verified');
Route::get('/request/offer-delete/{id}', [App\Http\Controllers\HomeController::class, 'offer_delete'])->name('offer_delete')->middleware('verified');
Route::get('/reports', [App\Http\Controllers\HomeController::class, 'reports'])->name('reports')->middleware('verified');

// Advertise Routes
Route::get('/advertise', [App\Http\Controllers\HomeController::class, 'advertise'])->name('advertise')->middleware('verified');

// User Routes
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('verified');
Route::get('/add_sub_user', [App\Http\Controllers\HomeController::class, 'sub_users'])->name('sub_users')->middleware('verified');
Route::post('/update_profile', [App\Http\Controllers\HomeController::class, 'update_profile'])->middleware('verified');
Route::post('/add_payment_details', [App\Http\Controllers\HomeController::class, 'add_payment_details'])->middleware('verified');

// Admin Routes

Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index']);
Route::get('/admin/profile', [App\Http\Controllers\AdminController::class, 'profile_view']);
Route::get('/admin/user_login/{id}', [App\Http\Controllers\HomeController::class, 'login_as_user']);
Route::get('/admin/edituser/{id}', [App\Http\Controllers\AdminController::class, 'edituser']);
Route::post('/admin/updateuser', [App\Http\Controllers\AdminController::class, 'updateuser']);
Route::get('/admin/userrolls', [App\Http\Controllers\AdminController::class, 'userrolls']);
Route::get('/admin/addroll', [App\Http\Controllers\AdminController::class, 'addroll']);
Route::post('/admin/createuserrole', [App\Http\Controllers\AdminController::class, 'createuserrole']);
Route::get('/admin/editrole/{id}', [App\Http\Controllers\AdminController::class, 'editrole']);
Route::post('/admin/edituserrole', [App\Http\Controllers\AdminController::class, 'edituserrole']);
Route::get('/admin/list_users', [App\Http\Controllers\AdminController::class, 'list_users_view']);
Route::get('/admin/list_sites', [App\Http\Controllers\AdminController::class, 'list_sites_view']);
Route::get('/admin/site-status', [App\Http\Controllers\AdminController::class, 'site_status']);
Route::get('/admin/list_pending_offers', [App\Http\Controllers\AdminController::class, 'list_users_view']);
Route::get('/admin/add_user', [App\Http\Controllers\AdminController::class, 'add_users_view']);
Route::post('/admin/add_user', [App\Http\Controllers\AdminController::class, 'create_user']);
Route::get('/admin/users_view', [App\Http\Controllers\AdminController::class, 'usersview_view']);
Route::get('/admin/all_leads', [App\Http\Controllers\AdminController::class, 'all_leads_view']);

Route::post('/admin/reverse-leads', [App\Http\Controllers\AdminController::class, 'reverseLeads']);
Route::post('/admin/complete-leads', [App\Http\Controllers\AdminController::class, 'completeLeads']);

Route::get('/admin/completed_leads', [App\Http\Controllers\AdminController::class, 'completed_leads_view']);
Route::get('/admin/pending_leads', [App\Http\Controllers\AdminController::class, 'pending_leads_view']);
Route::post('/admin/offers/disapprove', [App\Http\Controllers\AdminController::class, 'delete_offer']);
Route::post('/admin/offers/delete', [App\Http\Controllers\AdminController::class, 'delete_offer_client']);
Route::post('/admin/offers/delete-approval', [App\Http\Controllers\AdminController::class, 'delete_approved_offer_client']);
Route::post('/admin/offers/approve', [App\Http\Controllers\AdminController::class, 'approve_bulk_offer']);

Route::get('/admin/list_offers', [App\Http\Controllers\AdminController::class, 'list_offers_view']);
Route::get('/admin/pending_approvals', [App\Http\Controllers\AdminController::class, 'offer_pending_requests']);
Route::get('/admin/completed_approvals', [App\Http\Controllers\AdminController::class, 'offer_approved_requests']);
Route::post('/admin/import_offers', [App\Http\Controllers\AdminController::class, 'ImportOffers']);

Route::get('/admin/offer_pending_requests', [App\Http\Controllers\AdminController::class, 'offer_pending_requests']);
Route::get('/admin/offer_approved_requests', [App\Http\Controllers\AdminController::class, 'offer_approved_requests']);
Route::get('/admin/add_offer', [App\Http\Controllers\AdminController::class, 'add_offer_view']);
Route::get('/admin/edit_offer/{id}', [App\Http\Controllers\AdminController::class, 'edit_offer_view']);
Route::post('/admin/add_network', [App\Http\Controllers\AdminController::class, 'add_network']);
Route::get('/admin/active_offers', [App\Http\Controllers\AdminController::class, 'active_offers_view']);
Route::get('/admin/banned_offers', [App\Http\Controllers\AdminController::class, 'banned_offers_view']);
Route::get('/admin/networks', [App\Http\Controllers\AdminController::class, 'networks_view']);
Route::get('/admin/add_network', [App\Http\Controllers\AdminController::class, 'add_network_view']);
Route::get('/admin/list_postback', [App\Http\Controllers\AdminController::class, 'list_postback_view']);
Route::get('/admin/add_postback', [App\Http\Controllers\AdminController::class, 'add_postback_view']);
Route::get('/admin/offer_fetch_apis', [App\Http\Controllers\AdminController::class, 'offer_fetch_apis_view']);
Route::post('/admin/offer_fetch_apis', [App\Http\Controllers\AdminController::class, 'offer_fetch_apis_add']);
Route::post('/admin/add-network_commission', [App\Http\Controllers\AdminController::class, 'add_network_commission']);
Route::post('/admin/add_offer', [App\Http\Controllers\AdminController::class, 'add_offer']);
Route::post('/admin/edit_offer', [App\Http\Controllers\AdminController::class, 'edit_offer']);

Route::get('/admin/allblogs', [App\Http\Controllers\AdminController::class, 'allblogs']);
Route::get('/admin/addblog', [App\Http\Controllers\AdminController::class, 'addblog']);
Route::post('/admin/createblogs', [App\Http\Controllers\AdminController::class, 'createblogs']);
Route::get('/admin/editblog/{id}', [App\Http\Controllers\AdminController::class, 'editblog']);
Route::post('/admin/updateblogs', [App\Http\Controllers\AdminController::class, 'updateblogs']);
Route::get('/admin/deleteblog/{id}', [App\Http\Controllers\AdminController::class, 'deleteblog']);


Route::get('/admin/fetch_offers', [App\Http\Controllers\AdminController::class, 'fetch_offers_view']);
Route::get('/admin/fetch_offers/{id}', [App\Http\Controllers\ApiProviderController::class, 'fetch_offers']);
Route::get('/admin/upload_files', [App\Http\Controllers\AdminController::class, 'upload_file_view']);
Route::post('/admin/upload_file', [App\Http\Controllers\AdminController::class, 'upload_file']);

Route::get('/uploads_remove_files', [App\Http\Controllers\AdminController::class, 'remove_upload_file']);

// Move to Admin Controller with functions
Route::get('/admin/notifications/add', [App\Http\Controllers\HomeController::class, 'notification_add'])->name('add_notifications');
Route::get('/admin/notifications/edit/{id}', [App\Http\Controllers\HomeController::class, 'notification_edit'])->name('edit_notifications');
Route::post('/admin/add_notifications', [App\Http\Controllers\HomeController::class, 'add_notifications'])->name('add_notifications');
Route::post('/admin/edit_notifications', [App\Http\Controllers\HomeController::class, 'edit_notifications'])->name('edit_notifications');
Route::get('/admin/notifications', [App\Http\Controllers\HomeController::class, 'notifications'])->name('notifications');



//Offer Wall
Route::get('/offer-api', [App\Http\Controllers\OfferController::class, 'offerwall']);
Route::get('/offer/{encoded_string}', [App\Http\Controllers\OfferController::class, 'offerredirect']);
Route::get('/offer', [App\Http\Controllers\OfferController::class, 'offerredirectGet']);
Route::get('/image/{id}', [App\Http\Controllers\OfferController::class, 'serveImage']);


Route::get('/admin/network_commission', [App\Http\Controllers\AdminController::class, 'network_commission_view']);
Route::get('/admin/global_commission', [App\Http\Controllers\AdminController::class, 'global_commission_view']);
Route::get('/admin/commission_rates', [App\Http\Controllers\AdminController::class, 'commission_rates_view']);
Route::get('/admin/whitelist_ip', [App\Http\Controllers\AdminController::class, 'whitelist_ip_view']);
Route::get('/admin/banned_ip', [App\Http\Controllers\AdminController::class, 'banned_ip_view']);
Route::get('/admin/payments', [App\Http\Controllers\AdminController::class, 'payments_view']);
Route::get('/admin/payment_gateway', [App\Http\Controllers\AdminController::class, 'payment_gateway_view']);
Route::get('/admin/payment_policy', [App\Http\Controllers\AdminController::class, 'payment_policy_view']);
Route::get('/admin/common_postback', [App\Http\Controllers\AdminController::class, 'common_postback_view']);
Route::get('/admin/import_offers', [App\Http\Controllers\AdminController::class, 'common_postback_view']);


// Route::get('/home/',function(){
//     dd("Hello");
//     if(auth()->user()->user_type=='admin'){
//         return redirect('/admin/dashboard');
//     }else{
//         echo "<script>window.location.href='/dashboard'</script>";
//         return redirect('/dashboard');
//     }
// })->middleware('verified');
// ;https://PepeLeads.local/admin/fetch_offers/3

// All Postbacks

Route::any('/yuno/postback', [App\Http\Controllers\PostbackController::class, 'yuno_postback']);
Route::any('/postback/pollfish', [App\Http\Controllers\PostbackController::class, 'pollfish_postback']);
Route::any('/postback/fusion', [App\Http\Controllers\PostbackController::class, 'pollfish_postback']);
Route::any('/postback/inbrain', [App\Http\Controllers\PostbackController::class, 'pollfish_postback']);
Route::any('/postback/theoremreach', [App\Http\Controllers\PostbackController::class, 'theoremreach_postback']);
Route::any('/postback/adscentmedia', [App\Http\Controllers\PostbackController::class, 'adsentmedia_postback']);
Route::any('/postback/pointclicktrack', [App\Http\Controllers\PostbackController::class, 'pointclicktrack_postback']);
Route::any('/postback/leadads', [App\Http\Controllers\PostbackController::class, 'leadads_postback']);
Route::any('/postback/ho-common', [App\Http\Controllers\PostbackController::class, 'leadads_postback']);
// https://pepeleads.com/postback/ho-common?sub1={aff_sub}&sts=credited
Route::any('/postback/chameleon-ads', [App\Http\Controllers\PostbackController::class, 'leadads_postback']);
// https://pepeleads.com/postback/chameleon-ads?sub1={aff_sub}&sts=credited
Route::any('/postback/wd-common', [App\Http\Controllers\PostbackController::class, 'wedebeek_postback']);
// https://pepeleads.com/postback/wd-common?sub1={aff_sub}&sts=credited
Route::any('/postback/ads-next-gen', [App\Http\Controllers\PostbackController::class, 'wedebeek_postback']);
// https://pepeleads.com/postback/ads-next-gen?sub1={aff_sub}&sts=credited
Route::any('/postback/lab-common', [App\Http\Controllers\PostbackController::class, 'lootably_postback']);
// https://pepeleads.com/postback/lab-common?sid1={sid1}&sts=credited
Route::any('/postback/owa-common', [App\Http\Controllers\PostbackController::class, 'offerwallads_postback']);
Route::any('/postback/offerlook', [App\Http\Controllers\PostbackController::class, 'iremgtech_postback']);
Route::any('/postback/offer18', [App\Http\Controllers\PostbackController::class, 'offer18_postback']);
Route::any('/postback/everflowclient', [App\Http\Controllers\PostbackController::class, 'everflowclient_postback']);
Route::any('/postback/zimblemedia', [App\Http\Controllers\PostbackController::class, 'zimblemedia_postback']);
// https://pepeleads.com/postback/zimblemedia?sts={c}&aff_sub1={affid}
Route::any('/postback/mobplus', [App\Http\Controllers\PostbackController::class, 'mobplus_postback']);
// https://pepeleads.com/postback/mobplus?sts={c}&aff_sub1={click_id}&source={source}
Route::any('/postback/taskbuddy', [App\Http\Controllers\PostbackController::class, 'taskbuddy_ai_postback']);
// https://pepeleads.com/postback/taskbuddy?sts=completed&aff_sub1={click_id}

// https://pepeleads.com/postback/owa-common?sid=%SID%&sts=%STATUS%
Route::any('/server-side/postback', [App\Http\Controllers\PostbackController::class, 'all_postback']);



Route::any('/postback/{network}', [App\Http\Controllers\PostbackController::class, 'common_postback']);
Route::get('/admin/offer/{type}/{id}', [App\Http\Controllers\AdminController::class, 'approve_offer']);
Route::get('/admin/approve_all_offers/{id}', [App\Http\Controllers\AdminController::class, 'approve_all_offer']);

// approve_all_offer
// postback/adscentmedia
// https://PepeLeads.com/postback/fusion?request_uuid=[SupplierSessionID]&reward=0.78&status=1

Route::get('/sitemap.xml', function(){
    $blogs = Blogs::all();

    // Create XML content
    $content = '<?xml version="1.0" encoding="UTF-8"?>';
    $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    $content .= '<url>';
    $content .= "<loc>".url("/")."</loc>";
    $content .= '<changefreq>daily</changefreq>';
    $content .= '<priority>1.0</priority>';
    $content .= '</url>';

    $content .= '<url>';
    $content .= "<loc>".url("/blog")."</loc>";
    $content .= '<changefreq>daily</changefreq>';
    $content .= '<priority>0.9</priority>';
    $content .= '</url>';
    $content .= '<url>';
    $content .= "<loc>".url("/login")."</loc>";
    $content .= '<changefreq>daily</changefreq>';
    $content .= '<priority>0.9</priority>';
    $content .= '</url>';
    $content .= '<url>';
    $content .= "<loc>".url("/register")."</loc>";
    $content .= '<changefreq>daily</changefreq>';
    $content .= '<priority>0.9</priority>';
    $content .= '</url>';

    $content .= '<url>';
    $content .= "<loc>".url("/terms-and-conditions")."</loc>";
    $content .= '<changefreq>daily</changefreq>';
    $content .= '<priority>0.9</priority>';
    $content .= '</url>';

    $content .= '<url>';
    $content .= "<loc>".url("/payment-policies")."</loc>";
    $content .= '<changefreq>daily</changefreq>';
    $content .= '<priority>0.9</priority>';
    $content .= '</url>';

    $content .= '<url>';
    $content .= "<loc>".url("/privacy-policies")."</loc>";
    $content .= '<changefreq>daily</changefreq>';
    $content .= '<priority>0.9</priority>';
    $content .= '</url>';
    

    foreach ($blogs as $blog) {
        $url = url('/blog/' . $blog->slug);
        $content .= '<url>';
        $content .= "<loc>{$url}</loc>";
        $content .= '<changefreq>daily</changefreq>';
        $content .= '<priority>0.9</priority>';
        $content .= '</url>';
    }

    $content .= '</urlset>';

    // Return response as XML
    return response($content, 200)->header('Content-Type', 'application/xml');
});

Route::get('/email/verify', function () {

    // return redirect('/dashboard');
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/clear', function(){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('migrate', ['--force' => true ]);
    session()->flash('message', "Success");
    return redirect('/');
});





