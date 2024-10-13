<?php

namespace App\Http\Controllers;

use App\Models\Public_Notifications;

use App\Models\Customer;
use App\Models\Customer_RepairStatus;
use App\Models\Customer_Notifications;
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
        $customerCount = Customer::all()->count();
        $technicianCount = Technician::all()->count();
        $totalUsers = $customerCount + $technicianCount;

        //------------------------------------------------------------------------------------------------

        // Fetch current week's counts
        $technicianVerified = Technician::where('profile_status', 'complete')->count();
        $technicianPending = Technician::where('profile_status', 'pending')->count();
        $technicianRestricted = Technician::where('profile_status', 'restricted')->count();

            // Fetch last week's counts for comparison (assuming you have a 'created_at' or 'updated_at' field for this)
            $lastWeekVerified = Technician::where('profile_status', 'complete')
            ->whereBetween('created_at', [now()->subWeeks(2), now()->subWeek()]) // Get previous week's range
            ->count();

            $lastWeekPending = Technician::where('profile_status', 'pending')
            ->whereBetween('created_at', [now()->subWeeks(2), now()->subWeek()])
            ->count();

            $lastWeekRestricted = Technician::where('profile_status', 'restricted')
            ->whereBetween('created_at', [now()->subWeeks(2), now()->subWeek()])
            ->count();

            // Calculate percentage changes
            $verifiedChange = $this->calculatePercentageChange($technicianVerified, $lastWeekVerified);
            $pendingChange = $this->calculatePercentageChange($technicianPending, $lastWeekPending);
            $restrictedChange = $this->calculatePercentageChange($technicianRestricted, $lastWeekRestricted);

            //------------------------------------------------------------------------------------------------

        // Fetch customer and technician counts for the current week
        $currentWeekCustomerCount = Customer::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $currentWeekTechnicianCount = Technician::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        // Fetch customer and technician counts for the last week
        $lastWeekCustomerCount = Customer::whereBetween('created_at', [now()->subWeeks(1)->startOfWeek(), now()->subWeeks(1)->endOfWeek()])->count();
        $lastWeekTechnicianCount = Technician::whereBetween('created_at', [now()->subWeeks(1)->startOfWeek(), now()->subWeeks(1)->endOfWeek()])->count();

        // Calculate total users for the current and last week
        $currentWeekTotalUsers = $currentWeekCustomerCount + $currentWeekTechnicianCount;
        $lastWeekTotalUsers = $lastWeekCustomerCount + $lastWeekTechnicianCount;

        // Calculate the percentage change in total users
        $totalUsersPercentageChange = $this->calculatePercentageChange($currentWeekTotalUsers, $lastWeekTotalUsers);

        //------------------------------------------------------------------------------------------------
        

        return view('Admin.1 - Dashboard', [
            'totalUsers' => $totalUsers,
            'totalUsersPercentageChange' => $totalUsersPercentageChange,
            
            //Technician ----------
            'technicianVerified' => $technicianVerified,
            'technicianPending' => $technicianPending,
            'technicianRestricted' => $technicianRestricted,

            'verifiedChange' => $verifiedChange,
            'pendingChange' => $pendingChange,
            'restrictedChange' => $restrictedChange,
            //---------------------

        ]);
    }

    public function usermanagement(){
        $customer = Customer::all();
        $technician = Technician::all();
        $totalUsers = $customer->count() + $technician->count();

        return view('Admin.2 - UserManagement', [
            'customer' => $customer,
            'technician' => $technician,
            'totalUsers' => $totalUsers,
        ]);
    }

    public function viewprofile(){
        return view('Admin.6 - ViewProfile');
    }

    public function notificationcenter(){
        return view('Admin.3 - NotificationCenter');
    }

    public function notificationcreate(Request $request, $targetType){

        if($targetType == "Public"){
            Public_Notifications::create([
                'title' => $request->notification_title,
                'message' => $request->notification_message,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }elseif($targetType == "Technicians"){
            $targetUser = $request->target_user;
            if($targetUser == "All"){
                Technician_Notifications::create([
                    'target_type' => 'all',
                    'title' => $request->notification_title,
                    'message' => $request->notification_message,
                ]); 
            }else{
                $technicianExist = Technician::find($request->target_id);
                if(!$technicianExist){
                    return back()->with('error', 'Technician not found');
                }
                Technician_Notifications::create([
                    'target_type' => 'technician',
                    'target_id' => $request->target_id,
                    'title' => $request->notification_title,
                    'message' => $request->notification_message,
                ]); 
            }
        }elseif($targetType == "Customers"){
            $targetUser = $request->target_user;
            if($targetUser == "All"){
                Customer_Notifications::create([
                    'target_type' => 'all',
                    'title' => $request->notification_title,
                    'message' => $request->notification_message,
                ]); 
            }else{
                $customerExist = Customer::find($request->target_id);
                if(!$customerExist){
                    return back()->with('error', 'Technician not found');
                }
                Customer_Notifications::create([
                    'target_type' => 'customer',
                    'target_id' => $request->target_id,
                    'title' => $request->notification_title,
                    'message' => $request->notification_message,
                ]); 
            }
        }

        return back()->with('success', 'Notification sent successfully');
    }

    public function reportmanagement(){
        return view('Admin.4 - ReportManagement');
    }

    public function reviewsmanagement(){
        return view('Admin.5 - ReviewsManagement');
    }


    //EXTERNAL FUNCTIONS
    public function calculatePercentageChange($currentCount, $previousCount) {
        // Check if previous count is 0 to avoid division by zero
        if ($previousCount == 0) {
            // If no previous count, consider it as 100% increase if there is a current count
            return $currentCount > 0 ? 100 : 0;
        }
    
        // Calculate the percentage change
        $percentageChange = (($currentCount - $previousCount) / $previousCount) * 100;
    
        // Return the formatted percentage change (rounded)
        return round($percentageChange, 2); // e.g., "12.34"%
    }
}
