<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\TechnicianAuthController;

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

// CUSTOMER AUTH---------------------------------------------------------------

Route::get('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'loginCustomer'])->name('customer.loginCustomer');

Route::get('/customer/signup', [CustomerAuthController::class, 'signup'])->name('customer.signup');
Route::post('/customer/signup', [CustomerAuthController::class, 'signupCustomer'])->name('customer.signupCustomer');

// ----------------------------------------------------------------------------

Route::get('/', [CustomerController::class, 'welcome'])->name('welcome');

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

// TECHNICIAN AUTH---------------------------------------------------------------

Route::get('/technician/login', [TechnicianAuthController::class, 'login'])->name('technician.login');
Route::post('/technician/login', [TechnicianAuthController::class, 'loginTechnician'])->name('technician.loginTechnician');

Route::get('/technician/signup', [TechnicianAuthController::class, 'signup'])->name('technician.signup');
Route::post('/technician/signup', [TechnicianAuthController::class, 'signupTechnician'])->name('technician.signupTechnician');

// -----------------------------------------------------------------------------

Route::get('/6', function () {
    return view('Technician.1 - Dashboard');
});

Route::get('/7', function () {
    return view('Technician.2 - Appointment');
});

Route::get('/8', function () {
    return view('Technician.3 - RepairStatus');
});

Route::get('/9', function () {
    return view('Technician.4 - Messages');
});

Route::get('/10', function () {
    return view('Technician.5 - ShopReviews');
});

Route::get('/11', function () {
    return view('Technician.6 - ManageProfile');
});