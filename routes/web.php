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
    return view('InfoAntrian');
});


Route::get('/CekAntrian', function () {
    return view('CekAntrian');
});

Route::get('/DownloadQR', function () {
    return view('DownloadQR');
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
