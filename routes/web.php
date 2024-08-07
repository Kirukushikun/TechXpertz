<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// CUSTOMER ---------------------------------------------------------------
Route::get('/', function () {
    return view('Customer.1 - Homepage');
});

Route::get('/2', function () {
    return view('Customer.2 - ViewCategory');
});

Route::get('/3', function () {
    return view('Customer.3 - ViewShop');
});

Route::get('/4', function () {
    return view('Customer.4 - AppointmentBooking');
});

Route::get('/5', function () {
    return view('Customer.5 - RepairStatus');
});

// TECHNICIAN ---------------------------------------------------------------