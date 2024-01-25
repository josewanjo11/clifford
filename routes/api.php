<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\AuthController;
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

Route::get('getAccommodations', [GeneralController::class, 'getAccommodations']);
Route::get('getContracts', [GeneralController::class, 'getContracts']);
Route::get('getBookings/{agent}', [GeneralController::class, 'getBookings']);
Route::get('getContractRates/{accomodation_id}/{agent_id}', [GeneralController::class, 'getContractRates']);
Route::get('getAgents', [GeneralController::class, 'getAgents']);
Route::post('addAgent', [AuthController::class, 'addAgent']);
Route::post('addAdmin', [AuthController::class, 'addAdmin']);
Route::post('loginAgent', [AuthController::class, 'loginAgent']);
Route::post('loginAdmin', [AuthController::class, 'loginAdmin']);
Route::post('storeAccommodation', [GeneralController::class, 'storeAccommodation']);
Route::post('updateAccommodation/{id}', [GeneralController::class, 'updateAccommodation']);
Route::post('deleteAccommodation/{id}', [GeneralController::class, 'deleteAccommodation']);

Route::post('storeContract', [GeneralController::class, 'storeContract']);
Route::post('updateContract/{id}', [GeneralController::class, 'updateContract']);
Route::post('deleteContract/{id}', [GeneralController::class, 'deleteContract']);

Route::post('storeBookings', [GeneralController::class, 'storeBooking']);
Route::post('cancelBooking/{id}', [GeneralController::class, 'cancelBooking']);
Route::post('updateBooking/{id}', [GeneralController::class, 'updateBooking']);

Route::post('getLoginSession',[AuthController::class, 'getLoginSession']);
