<?php

use App\Http\Controllers\api\auth\RegisterController;
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