<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Technician;
use App\Models\RepairShop_Credentials;
use App\Models\RepairShop_Mastery;
use App\Models\RepairShop_Profiles;
use App\Models\RepairShop_Reviews;
use App\Models\RepairShop_Schedules;
use App\Models\RepairShop_Services;
use App\Models\RepairShop_Socials;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{   
    public function notifications(){
        return view('Technician.7 - Notification');
    }

    public function dashboard(){
        return view('Technician.1 - Dashboard');
    }

    public function appointment(){
        return view('Technician.2 - Appointment');
    }

    public function repairstatus(){
        return view('Technician.3 - RepairStatus');
    }

    public function messages(){
        return view('Technician.4 - Messages');
    }

    public function shopreviews(){
        return view('Technician.5 - ShopReviews');
    }

    public function profile(){
        return view('Technician.6 - ManageProfile');
    }
}
