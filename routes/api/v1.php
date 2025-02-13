<?php

use App\Http\Controllers\APIs\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',[ApiController::class,'index']);
Route::get('/list-report',[ApiController::class,'listReport']);
Route::get('/list-offers',[ApiController::class,'list_offers']);
Route::get('/list-offers-client',[ApiController::class,'list_pending_offers']);
Route::get('/list-pending-offers',[ApiController::class,'list_pending_offers']);
Route::get('/list-approved-offers',[ApiController::class,'list_approved_offers']);
Route::get('/offers/data', [ApiController::class, 'getOffersData'])->name('offers.data');
Route::get('/offers/data-active', [ApiController::class, 'getOffersDataActive'])->name('offers.data_active');


Route::post('/',[ApiController::class,'add_user']);
