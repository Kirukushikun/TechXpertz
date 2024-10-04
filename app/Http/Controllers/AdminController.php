<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Customer_RepairStatus;
use App\Models\Technician;
use App\Models\Technician_Notifications;

use App\Models\RepairShop_Credentials;
use App\Models\RepairShop_Mastery;
use App\Models\RepairShop_Profiles;
use App\Models\RepairShop_Reviews;
use App\Models\RepairShop_Schedules;
use App\Models\RepairShop_Services;
use App\Models\RepairShop_Socials;
use App\Models\RepairShop_Appointments;
use App\Models\RepairShop_RepairStatus;
use App\Models\RepairShop_Badges;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function dashboard(){
        return view('Admin.1 - Dashboard');
    }

    public function usermanagement(){
        return view('Admin.2 - UserManagement');
    }

    public function notificationcenter(){
        return view('Admin.3 - NotificationCenter');
    }

    public function reviewsmanagement(){
        return view('Admin.5 - ReviewsManagement');
    }
}
