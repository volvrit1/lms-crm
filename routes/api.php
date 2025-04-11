<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('contact-us',[ApiController::class,'contactus']);
Route::post('mrlogin',[ApiController::class,'login']);
Route::post('books',[ApiController::class,'getbooks']);
Route::post('getinnerpages',[ApiController::class,'getinnerpages']);


Route::post('/forgot-password',[ApiController::class,'forgotPassword']);
Route::post('/logout',[ApiController::class,'logout']);
Route::post('/otp-verify',[ApiController::class,'otpVerify']);
Route::post('/new-password',[ApiController::class,'newpassword']);
Route::post('/changecurrentpassword',[ApiController::class,'changecurrentpassword']);
Route::post('/ispaused',[ApiController::class,'ispaused']);
Route::post('/mrnotifyvalue',[ApiController::class,'mrnotifyvalue']);
Route::post('/updatenotifyvalue',[ApiController::class,'updatenotifyvalue']);

Route::get('/doctorlist',[ApiController::class,'doctorlist']);
Route::post('/doctor_report',[ApiController::class,'doctor_report']); 