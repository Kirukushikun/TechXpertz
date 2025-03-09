<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\TechnicianAuthController;
use App\Http\Controllers\TechnicianController;

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Livewire\Chat\Index;

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

Route::get('/customer/verify/email/{email}', [CustomerAuthController::class, 'verify'])->name('customer.verify');

Route::get('/customer/password/forgot', [CustomerAuthController::class, 'forgot'])->name('customer.forgot');
Route::post('/customer/password/email', [CustomerAuthController::class, 'sendResetLinkEmail'])->name('customer.sendResetLinkEmail');

//customer.reset
Route::get('/customer/password/reset/{token}', [CustomerAuthController::class, 'resetForm'])->name('customer.reset');
Route::post('/customer/password/reset', [CustomerAuthController::class, 'resetPassword'])->name('customer.reset.update');

//customer.verify
Route::get('/customer/verify-account-email', [CustomerAuthController::class, 'verifyAccountEmail'])->name('customer.verifyAccountEmail');
// ----------------------------------------------------------------------------

Route::get('/', [CustomerController::class, 'welcome'])->name('welcome');

Route::get('/repairshops/{category}', [CustomerController::class, 'viewcategory'])->name('viewcategory');

Route::get('/repairshop/{id}', [CustomerController::class, 'viewshop'])->name('viewshop');

Route::get('/bookappointment/{id}', [CustomerController::class, 'viewappointment'])->name('viewappointment');

Route::get('/search', [CustomerController::class, 'searchRepairShops'])->name('search');

Route::post('/contact', [CustomerController::class, 'submitInquiries'])->name('contact.submit');

Route::post('/customer/submit/report', [CustomerController::class, 'submitReport']);

Route::middleware('customer.auth')->group(function () {

    Route::post('/bookappointment/{id}', [CustomerController::class, 'bookappointment'])->name('bookappointment');

    Route::get('/customer/myaccount', [CustomerController::class, 'myaccount'])->name('myaccount');
    Route::patch('/customer/myaccount/{actionType}/{customerID}', [CustomerController::class, 'myaccountUpdate'])->name('customer.updateprofile');
    Route::patch('/customer/myaccount/notification/update/{notificationID}',  [CustomerController::class, 'notificationUpdate']);
    Route::patch('/customer/myaccount/{customerID}', [CustomerController::class, 'myaccountDelete'])->name('customer.deleteprofile');

    Route::patch('/bookappointment/cancel/{repairID}', [CustomerController::class, 'cancelAppointment']);

    Route::get('/repairlist', [CustomerController::class, 'viewrepairlist'])->name('viewrepairlist');

    Route::get('/repairstatus/{id}', [CustomerController::class, 'viewrepairstatus'])->name('viewrepairstatus');
    Route::post('/review/{technicianID}', [CustomerController::class, 'submitReview']);

    Route::get('/messages', [CustomerController::class, 'messages'])->name('customer.messages');
    Route::get('/message/repairshop/{repairshopID}', [CustomerController::class, 'messageRepairshop'])->name('customer.messageRepairshop');

    Route::get('/customer/favorites', [CustomerController::class, 'viewFavorites']);
    Route::post('/customer/favorites/{technicianID}', [CustomerController::class, 'favorites']);
});

Route::get('/customer/account/{status}', [CustomerController::class, 'disabledAccount'])->name('customer.accountDisabled');

Route::get('/about', function () {
    return view('Customer.10 - AboutUs');
});

Route::get('/contact-us', function () {
    return view('Customer.11 - ContactUs');
});

Route::get('/report', function () {
    return view('Customer.12 - ReportPage');
});

Route::get('/terms-of-service', function () {
    return view('Customer.13 - TermsAndCondition');
});


Route::get('/privacy-policy', function () {
    return view('Customer.14 - PrivacyAndPolicy');
});

Route::get('/become-technician', function (){
    return view('Customer.17 - BecomeTechnician');
});


// TECHNICIAN AUTH---------------------------------------------------------------

Route::get('/technician/login', [TechnicianAuthController::class, 'login'])->name('technician.login');
Route::post('/technician/login', [TechnicianAuthController::class, 'loginTechnician'])->name('technician.loginTechnician');
Route::get('/technician/logout', [TechnicianAuthController::class, 'logoutTechnician'])->name('technician.logoutTechnician');

Route::get('/technician/signup', [TechnicianAuthController::class, 'signup'])->name('technician.signup');
Route::post('/technician/signup', [TechnicianAuthController::class, 'signupTechnician'])->name('technician.signupTechnician');

//technician.reset
Route::get('/technician/password/forgot', [TechnicianAuthController::class, 'forgot'])->name('technician.forgot');
Route::post('/technician/password/email', [TechnicianAuthController::class, 'sendResetLinkEmail'])->name('technician.sendResetLinkEmail');

Route::get('/technician/password/reset/{token}', [TechnicianAuthController::class, 'resetForm'])->name('technician.reset');
Route::post('/technician/password/reset', [TechnicianAuthController::class, 'resetPassword'])->name('technician.reset.update');

//technician.verify
Route::get('/technician/verify/email/{email}', [TechnicianAuthController::class, 'verify'])->name('technician.verify');
Route::get('/technician/verify-account-email', [TechnicianAuthController::class, 'verifyAccountEmail'])->name('technician.verifyAccountEmail');

// -----------------------------------------------------------------------------

Route::middleware('technician.auth')->group(function() {

    // Technician Dashboard
    Route::get('/technician/dashboard', [TechnicianController::class, 'dashboard'])->name('technician.dashboard');
    
    // Appointments
    Route::prefix('technician/appointment')->group(function () {
        Route::get('/', [TechnicianController::class, 'appointment'])->name('technician.appointment');
        Route::post('/create/walk-ins', [TechnicianController::class, 'appointmentCreate']);
        Route::get('/details/{appointmentID}', [TechnicianController::class, 'appointmentDetails']);
        Route::patch('/{status}/{appointmentID}', [TechnicianController::class, 'appointmentUpdate']);
    });

    // Notifications
    Route::get('/technician/notifications', [TechnicianController::class, 'notifications'])->name('technician.notifications');
    Route::patch('/technician/notifications/update/{id}', [TechnicianController::class, 'isRead'])->name('notifications.isread');

    // Repair Status
    Route::prefix('technician/repairstatus')->group(function () {
        Route::get('/', [TechnicianController::class, 'repairstatus'])->name('technician.repairstatus');
        Route::post('/create/{appointmentID}', [TechnicianController::class, 'repairstatusCreate']);
        Route::post('/create/repair/walk-ins', [TechnicianController::class, 'repairstatusCreateWalkIn']);
        Route::get('/details/{repairID}', [TechnicianController::class, 'repairstatusDetails']);
        Route::patch('/update/{repairID}/{action}', [TechnicianController::class, 'repairstatusUpdate']);
    });

    // Messages
    Route::prefix('technician/messages')->group(function () {
        Route::get('/', [TechnicianController::class, 'messages'])->name('technician.messages');
        Route::get('/{customerID}', [TechnicianController::class, 'messageCustomer'])->name('messageCustomer');
    });

    // Shop Reviews
    Route::get('/technician/shopreviews', [TechnicianController::class, 'shopreviews'])->name('technician.shopreviews');

    // Technician Profile
    Route::prefix('technician/profile')->group(function () {
        Route::get('/', [TechnicianController::class, 'profile'])->name('technician.profile');
        Route::post('/', [TechnicianController::class, 'updateProfile'])->name('technician.updateProfile');
        Route::patch('/update/{technicianID}/{imageType}', [TechnicianController::class, 'updateImage']);
        Route::patch('/delete/{technicianID}/{imageType}', [TechnicianController::class, 'deleteImage']);
        Route::patch('/{technicianID}/social-link', [TechnicianController::class, 'updateLink']);
        Route::patch('/{technicianID}/social-link/remove/{social}', [TechnicianController::class, 'deleteLink']);
    });

    // Account Settings
    Route::prefix('technician/account')->group(function () {
        Route::get('/', [TechnicianController::class, 'accountSettings']);
        Route::patch('/update', [TechnicianController::class, 'accountUpdate']);
        Route::patch('/delete', [TechnicianController::class, 'accountDelete']);
        Route::patch('/password/change', [TechnicianController::class, 'accountPasswordChange']);
    });

    // Report Submission
    Route::post('/technician/submit/report', [TechnicianController::class, 'submitReport']);
});


Route::get('/technician/account/{status}', [TechnicianController::class, 'accountDisabled'])->name('technician.accountDisabled');
// ADMIN AUTH---------------------------------------------------------------

Route::middleware('admin.auth')->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/usermanagement', [AdminController::class, 'usermanagement'])->name('admin.usermanagement');
        Route::get('/admin/viewprofile/{userRole}/{userID}', [AdminController::class, 'viewprofile'])->name('admin.viewprofile');
        Route::put('/admin/viewprofile/technician/{userID}/{actionType}', [AdminController::class, 'technicianupdate'])->name('admin.technicianupdate');
        Route::put('/admin/viewprofile/customer/{userID}/{actionType}', [AdminController::class, 'customerupdate'])->name('admin.customerupdate');

    Route::get('/admin/notificationcenter', [AdminController::class, 'notificationcenter'])->name('admin.notificationcenter');
        Route::post('/admin/notificationcenter/{targetType}', [AdminController::class, 'notificationcreate']);
        Route::get('/admin/notificationcenter/details/{reportID}', [AdminController::class, 'reportdetails']);
        Route::patch('/admin/notificationcenter/update/{reportID}', [AdminController::class, 'reportupdate']);

    Route::get('/admin/reportmanagement', [AdminController::class, 'reportmanagement'])->name('admin.reportmanagement');

    Route::get('/admin/reviewsmanagement', [AdminController::class, 'reviewsmanagement'])->name('admin.reviewsmanagement');
    Route::patch('/admin/reviewsmanagement/{reviewID}', [AdminController::class, 'reviewupdate']);

    Route::put('/admin/viewprofile/discipline/{action}/{technicianID}', [AdminController::class, 'disciplinaryAction']);
    Route::get('/admin/viewprofile/fetch/discipline/record/{recordID}', [AdminController::class, 'fetchDisciplinaryRecord']);

});

Route::middleware('authorized.ip')->group(function(){
    Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'loginAdmin'])->name('admin.loginAdmin');
    Route::get('/admin/logout', [AdminAuthController::class, 'logoutAdmin'])->name('admin.logoutAdmin');

    Route::get('/admin/signup', [AdminAuthController::class, 'signup'])->name('admin.signup');
    Route::post('/admin/signup', [AdminAuthController::class, 'signupAdmin'])->name('admin.signupAdmin');
});


