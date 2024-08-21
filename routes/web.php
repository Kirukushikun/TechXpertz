<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\TechnicianAuthController;
use App\Http\Controllers\TechnicianController;

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
Route::get('/customer/logout', [CustomerAuthController::class, 'logoutCustomer'])->name('customer.logoutCustomer');

Route::get('/customer/signup', [CustomerAuthController::class, 'signup'])->name('customer.signup');
Route::post('/customer/signup', [CustomerAuthController::class, 'signupCustomer'])->name('customer.signupCustomer');

// ----------------------------------------------------------------------------

Route::get('/', [CustomerController::class, 'welcome'])->name('welcome');

Route::get('/repairshops/{category}', [CustomerController::class, 'viewcategory'])->name('viewcategory');

Route::get('/repairshop/{id}', [CustomerController::class, 'viewshop'])->name('viewshop');

Route::get('/bookappointment/{$id}', [CustomerController::class, 'viewappointment'])->name('viewappointment');
Route::post('/bookappointment/{$id}', [CustomerController::class, 'bookappointment'])->name('bookappointment'); //Not done

Route::get('/5', function () {
    return view('Customer.5 - RepairStatus');
});

// TECHNICIAN AUTH---------------------------------------------------------------

Route::get('/technician/login', [TechnicianAuthController::class, 'login'])->name('technician.login');
Route::post('/technician/login', [TechnicianAuthController::class, 'loginTechnician'])->name('technician.loginTechnician');
Route::get('/technician/logout', [TechnicianAuthController::class, 'logoutTechnician'])->name('technician.logoutTechnician');

Route::get('/technician/signup', [TechnicianAuthController::class, 'signup'])->name('technician.signup');
Route::post('/technician/signup', [TechnicianAuthController::class, 'signupTechnician'])->name('technician.signupTechnician');

// -----------------------------------------------------------------------------
    


Route::middleware('technician.auth')->group(function(){

    Route::get('/technician/dashboard', [TechnicianController::class, 'dashboard'])->name('technician.dashboard');

    Route::get('/technician/notifications', [TechnicianController::class, 'notifications'])->name('technician.notifications');

    Route::get('/technician/appointment', [TechnicianController::class, 'appointment'])->name('technician.appointment');

    Route::get('/technician/repairstatus', [TechnicianController::class, 'repairstatus'])->name('technician.repairstatus');

    Route::get('/technician/messages', [TechnicianController::class, 'messages'])->name('technician.messages');

    Route::get('/technician/shopreviews', [TechnicianController::class, 'shopreviews'])->name('technician.shopreviews');

    Route::get('/technician/profile', [TechnicianController::class, 'profile'])->name('technician.profile');
});


