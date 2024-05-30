<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [AuthController::class, 'home']);

// Route::get('/editprofile', function () {
//     return view('editProfile');
// });

Route::get('/daftarantrian', function () {
    return view('daftarAntrian');
});

Route::get('/downloadQR', function () {
    return view('downloadQrcode');
});

// Route::get('/InfoAntrian', function () {
//     return view('InfoAntrian');
// });

Route::get('/CekAntrian', function () {
     return view('CekAntrian');
 });

// Route::get('/setupAntrian', function () {
//     return view('setupAntrian');
// });

Route::get('/EditAntrian', function () {
    return view('EditAntrian');
});

// Route::get('/loginPage', function () {
//     return view('loginPage');
// });

// Route::get('/Register', function (){
//     return view('RegisPage');
// });

//authentication user
Route::get('/loginPage', [AuthController::class, 'signin']);
Route::post('/loginPage', [AuthController::class, 'login']);
Route::get('/Register', [AuthController::class, 'signup']);
Route::post('/Register', [AuthController::class, 'addUser']);
Route::get('/logout', [AuthController::class, 'logout']);


//user profile
Route::get('/editprofile/{id}', [UserController::class, 'profile']);
Route::put('/updateProfile/{id}', [UserController::class, 'updateProfile']);
Route::put('/updateProfileNamaUsaha/{id}', [UserController::class, 'updateProfileNamaUsaha']);

Route::get('/auth/redirect', [GoogleController::class, 'redirect']);
Route::get('auth/google/call-back', [GoogleController::class, 'callback']);

//antrian
Route::get('/setupAntrian/{id}', [AntrianController::class, 'antrian']);
Route::put('/addAntrian/{id}', [AntrianController::class, 'addAntrian']);


//route habis scan
// Route::get('/InfoAntrian', 'YourController@method')->name('Info.Antrian');
Route::get('/CekAntrian/{id}', [AntrianController::class, 'CekAntrian']);
Route::post('/CekAntrian/{id}', [AntrianController::class, 'addPesanan']);

Route::get('/InfoAntrian/{id}/{pesanan_id}', [AntrianController::class, 'InfoAntrian']);
Route::get('/daftarantrian/{id}', [AntrianController::class, 'daftarAntrian']);



// Route::get('/homePage', function () {
//     return view('homePage');
// })->middleware(['auth', 'verified'])->name('homePage');
