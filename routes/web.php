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


//------------------------antrian---------------------------------------------------------------

//add dan update antrian
Route::get('/setupAntrian/{id}', [AntrianController::class, 'antrian']);
Route::put('/addAntrian/{id}', [AntrianController::class, 'addAntrian']);
Route::get('/EditAntrian/{id}', [AntrianController::class, 'editAntrian']);
Route::put('/editAntrian/{id}', [AntrianController::class, 'updateAntrian']);

//list antrian
Route::get('/daftarantrian/{id}', [AntrianController::class, 'daftarAntrian']);
Route::get('/panggilAntrian/{id}/{pesanan_id}', [AntrianController::class, 'panggilAntrian']);

//pause dan start antrian
Route::get('/pauseAntrian/{id}', [AntrianController::class, 'pauseAntrian']);
Route::get('/startAntrian/{id}', [AntrianController::class, 'startAntrian']);

//hapus pesanan dari user
Route::get('/delete/{id}',[AntrianController::class, 'deletePesanan']);
Route::get('/detailPesanan/{id}/{pesanan_id}',[AntrianController::class, 'detailPesanan']);


//-----------------------------------------Pembeli-------------------------------------------------------------------
//route habis scan (Pembeli)
Route::get('/CekAntrian/{id}', [AntrianController::class, 'CekAntrian']);
Route::post('/CekAntrian/{id}', [AntrianController::class, 'addPesanan']);

Route::get('/InfoAntrian/{id}/{pesanan_id}', [AntrianController::class, 'InfoAntrian']);

Route::get('/keluarAntrian/{id}/{pesanan_id}',[AntrianController::class, 'keluarAntrian']);


//----------------------------------------QRCode-----------------------------------------------------------------
Route::get('/downloadQR/{id}', [AntrianController::class, 'downloadQrcode']);
Route::get('/QRCode/{id}', [AntrianController::class, 'QRCode']);

//--------------------------------------Report Antrian-------------------------------------------------------------
Route::get('/laporan', [AntrianController::class, 'laporan']);
Route::get('/pdf/{id}/{tanggal}', [AntrianController::class, 'laporanAntrian']);