<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\TechnicianAuthController;
use App\Http\Controllers\TechnicianController;

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;

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

Route::get('/bookappointment/{id}', [CustomerController::class, 'viewappointment'])->name('viewappointment');
Route::post('/bookappointment/{id}', [CustomerController::class, 'bookappointment'])->name('bookappointment');

Route::get('customer/myaccount', [CustomerController::class, 'myaccount'])->name('myaccount');

Route::get('/repairlist', [CustomerController::class, 'viewrepairlist'])->name('viewrepairlist');

Route::get('/repairstatus/{id}', [CustomerController::class, 'viewrepairstatus'])->name('viewrepairstatus');

// TECHNICIAN AUTH---------------------------------------------------------------

Route::get('/technician/login', [TechnicianAuthController::class, 'login'])->name('technician.login');
Route::post('/technician/login', [TechnicianAuthController::class, 'loginTechnician'])->name('technician.loginTechnician');
Route::get('/technician/logout', [TechnicianAuthController::class, 'logoutTechnician'])->name('technician.logoutTechnician');

Route::get('/technician/signup', [TechnicianAuthController::class, 'signup'])->name('technician.signup');
Route::post('/technician/signup', [TechnicianAuthController::class, 'signupTechnician'])->name('technician.signupTechnician');

// -----------------------------------------------------------------------------

Route::middleware('technician.auth')->group(function(){

    Route::get('/technician/dashboard', [TechnicianController::class, 'dashboard'])->name('technician.dashboard');
        //What if the authenticated technician doesnt own the data that will be accessed? the end point must not be accessed if the data doesnt bellong to the authenticated user/technician
        Route::get('/technician/appointment/details/{appointmentID}', [TechnicianController::class, 'appointmentDetails']);        
        Route::patch('/technician/appointment/{status}/{appointmentID}', [TechnicianController::class, 'appointmentUpdate']);

    Route::get('/technician/notifications', [TechnicianController::class, 'notifications'])->name('technician.notifications');
        Route::patch('/technician/notifications/update/{id}', [TechnicianController::class, 'isRead'])->name('notifications.isread');   

    Route::get('/technician/appointment', [TechnicianController::class, 'appointment'])->name('technician.appointment');

    Route::get('/technician/repairstatus', [TechnicianController::class, 'repairstatus'])->name('technician.repairstatus');
        Route::delete('/technician/repairstatus/delete/{repairID}', [TechnicianController::class, 'repairstatusDelete']);
        Route::post('/technician/repairstatus/create/{appointmentID}/{customerID}', [TechnicianController::class, 'repairstatusCreate']);
        Route::get('/technician/repairstatus/details/{repairID}', [TechnicianController::class, 'repairstatusDetails']);
        Route::patch('/technician/repairstatus/update/{repairID}/{customerID}/{action}', [TechnicianController::class, 'repairstatusUpdate']);
        Route::post('/technician/repairstatus/create/walk-ins', [TechnicianController::class, 'repairstatusCreateWalkIn']);

    Route::get('/technician/messages', [TechnicianController::class, 'messages'])->name('technician.messages');

    Route::get('/technician/shopreviews', [TechnicianController::class, 'shopreviews'])->name('technician.shopreviews');

    Route::get('/technician/profile', [TechnicianController::class, 'profile'])->name('technician.profile');
    Route::post('/technician/profile', [TechnicianController::class, 'updateProfile'])->name('technician.updateProfile');
});


// ADMIN AUTH---------------------------------------------------------------

Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'loginAdmin'])->name('admin.loginAdmin');
Route::get('/admin/logout', [AdminAuthController::class, 'logoutAdmin'])->name('admin.logoutAdmin');

Route::get('/admin/signup', [AdminAuthController::class, 'signup'])->name('admin.signup');
Route::post('/admin/signup', [AdminAuthController::class, 'signupAdmin'])->name('admin.signupAdmin');

// -----------------------------------------------------------------------------

Route::middleware('admin.auth')->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/usermanagement', [AdminController::class, 'usermanagement'])->name('admin.usermanagement');
        Route::get('/admin/viewprofile/{userRole}/{userID}', [AdminController::class, 'viewprofile'])->name('admin.viewprofile');

    Route::get('/admin/notificationcenter', [AdminController::class, 'notificationcenter'])->name('admin.notificationcenter');
        Route::post('/admin/notificationcenter/{targetType}', [AdminController::class, 'notificationcreate']);
        Route::get('/admin/notificationcenter/details/{reportID}', [AdminController::class, 'reportdetails']);
        Route::patch('/admin/notificationcenter/update/{reportID}', [AdminController::class, 'reportupdate']);

    Route::get('/admin/reportmanagement', [AdminController::class, 'reportmanagement'])->name('admin.reportmanagement');

    Route::get('/admin/reviewsmanagement', [AdminController::class, 'reviewsmanagement'])->name('admin.reviewsmanagement');
    Route::patch('/admin/reviewsmanagement/{reviewID}', [AdminController::class, 'reviewupdate']);
    
});


