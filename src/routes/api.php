<?php

use App\Modules\Main\PopupPage\PopupApiController;
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

Route::post('/pop-up-post', [PopupApiController::class, 'post', 'as' => 'popup_api.post'])->name('popup_api.post');
Route::post('/pop-up/otp/resend', [PopupApiController::class, 'resendOtp', 'as' => 'popup_api.resendOtp'])->name('popup_api.resendOtp');
Route::post('/pop-up/otp/{uuid}', [PopupApiController::class, 'verifyOtp', 'as' => 'popup_api.verifyOtp'])->name('popup_api.verifyOtp');
