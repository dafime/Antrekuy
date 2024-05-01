<?php

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

Route::get('/login', function () {
    return view('loginPage');
});

Route::get('/register', function () {
    return view('regisPage');
});

Route::get('/home', function () {
    return view('homePage');
});

Route::get('/editprofile', function () {
    return view('editProfile');
});

Route::get('/daftarantrian', function () {
    return view('daftarAntrian');
});

Route::get('/downloadQR', function () {
    return view('downloadQrcode');
});

Route::get('/InfoAntrian', function () {
    return view('InfoAntrian');
});


Route::get('/CekAntrian', function () {
    return view('CekAntrian');
});

Route::get('/setupAntrian', function () {
    return view('setupAntrian');
});

Route::get('/EditAntrian', function () {
    return view('EditAntrian');
});

Route::get('/loginPage', function () {
    return view('loginPage');
});

Route::get('/Register', function (){
    return view('RegisPage');
});
