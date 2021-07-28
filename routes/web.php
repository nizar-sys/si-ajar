<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\AjarController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\guru\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\siswa\SiswaController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

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

// Auth
Route::get('/', function () {
    return view('auth.login');
});
Route::resource('register', RegisterController::class);

Route::resource('login', LoginController::class);

// jadwal ajar
Route::resource('jadwal-ajar', AjarController::class);

// dashboard admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('admin', AdminController::class);

    //crud guru    
    Route::get('/data-guru', [AdminController::class, 'dataGuru'])->name('data-guru');
    Route::post('/tambah-guru', [AdminController::class, 'tambahGuru'])->name('simpan-data-guru');
    Route::get('/update-guru/{nip}', [AdminController::class, 'edit'])->name('edit-guru');

    // crud siswa
    Route::resource('data-siswa', StudentController::class);

    // crud kelas
    Route::resource('data-kelas', KelasController::class);

    // crud mapel
    Route::resource('data-mapel', MapelController::class);
});

// dashboard guru
Route::middleware(['auth', 'isGuru'])->group(function () {
    Route::resource('guru', GuruController::class);

    Route::get('/daftar-guru', [AdminController::class, 'dataGuru'])->name('data-guru');
    Route::get('/daftar-kelas', [KelasController::class, 'index']);
    Route::get('/daftar-mapel', [MapelController::class, 'index']);

    Route::get('/data-absensi', [GuruController::class, 'dataAbsen']);
    Route::get('/data-absensi/{id}', [GuruController::class, 'dataAbsen']);

    Route::resource('daftar-siswa', StudentController::class);
});

// dashboard siswa
Route::middleware(['auth'])->group(function () {
    Route::resource('siswa', SiswaController::class);

    Route::get('/jadwal', [SiswaController::class, 'jadwal']);
    Route::resource('absensi', AbsensiController::class);
});



// logout
Route::middleware(['auth'])->group(function () {

    Route::resource('profile', ProfileController::class);
    Route::put('/changeprofile/{id}', [ProfileController::class, 'changeFoto'])->name('changeFoto');
    // logout
    Route::get('/logout', [LoginController::class, 'logout']);
});


// verifikasi akun
Route::get('/activation/{activationCode}', [RegisterController::class, 'verifikasi']);

Route::get('/update', [AjarController::class, 'updateStatus']);