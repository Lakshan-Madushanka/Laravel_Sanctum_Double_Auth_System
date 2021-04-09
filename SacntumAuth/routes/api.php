<?php

use App\Http\Controllers\ApiAuth\APiTokenController;
use App\Http\Controllers\ApiAuth\VerificationController;
use App\Http\Controllers\role\RoleController;
use App\Http\Controllers\user\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

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
//Auth routes
Auth::routes();
Route::get('sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);
Route::post('auth/token', [APiTokenController::class, 'IssueToken']);
Route::middleware('auth:sanctum')->get('/user',[UserController::class, 'showAuthUser']);

//Email routes
Route::group(['prefix' => 'email'], function () {
    Route::get('/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->name('verification.verify'); // Make sure to keep this as your route name
    Route::get('/resend', [VerificationController::class, 'resend'])
        ->name('verification.resend');
});

//user routes
Route::group(['prefix' => 'users'], function () {
    Route::post('register', [UserController::class, 'storeOrRegister']);
});

//role routes
Route::middleware('auth:sanctum')
    ->get('roles', [RoleController::class, 'index']);

