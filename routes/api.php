<?php

use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\auth\RegisterController;
use App\Http\Controllers\api\UsersDataController;
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

Route::get('/home', function () {
    return response()->json([
        'success' => true,
        'message' => 'Selamat datang di Sistem Aplikasi Belajar'
    ]);
});

Route::resource('register', RegisterController::class);

Route::resource('login', LoginController::class);

// reset password
Route::post('/reset-password', [LoginController::class, 'resetPassword']);

// put reset password
Route::post('/preset-password', [LoginController::class, 'putResetPassword']);

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('apiIsActive')->group(function () {

        // is admin middleware
        Route::middleware('apiIsAdmin')->group(function () {
            // crud users
            Route::resource('user', UsersDataController::class);
        });

        Route::get('/me', function (Request $request) {
            return response()->json([
                'userData' => $request->user(),
            ]);
        });
    });


    // activate account
    Route::get('/activation/{code_verification}', [RegisterController::class, 'verifikasi']);

    Route::post('/logout', [LoginController::class, 'logout']);
});
