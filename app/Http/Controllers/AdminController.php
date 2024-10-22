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

use App\Models\Admin_NotificationHistory;
use App\Models\Admin_ReportManagement;

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
        
        $customer = Customer::orderBy('created_at', 'desc')->get();
        $technician = Technician::orderBy('created_at', 'desc')->get();
        $allUsers = $customer->concat($technician);
        $totalUsers = $customer->count() + $technician->count();

        return view('Admin.2 - UserManagement', [
            'totalUsers' => $totalUsers,
            'allUsers' => $allUsers,
            'customer' => $customer,
            'technician' => $technician,
        ]);
    }

        public function viewprofile($userRole, $userID){
            if($userRole == 'Technician'){

                $technician = Technician::with('repairshopCredentials')
                    ->with('repairshopBadges')
                    ->with('repairshopMastery')
                    ->with('repairshopServices')
                    ->with('repairshopSchedules')
                    ->with('repairshopProfile')
                    ->with('repairshopRepairStatus')
                    ->with('repairshopAppointments')
                    ->find($userID);

                return view('Admin.6 - ViewProfile', [
                    'technician' => $technician,
                ]);

            }elseif($userRole == 'Customer'){
                return view('Admin.7 - ViewProfile');
            }
        }

        public function profileupdate($userType, $userID, $actionType){
            if($userType == "technician"){
                $technician = Technician::find($userID);

                if($actionType == "verify"){
                    $technician->update([
                        'profile_status' => 'complete',
                    ]);                    
                } elseif($actionType == "restrict"){
                    $technician->update([
                        'profile_status' => 'restricted',
                    ]);                    
                }

                return back()->with('success', 'User profile updated successfully');
            }
        }

    public function notificationcenter(){
        $notificationHistory = Admin_NotificationHistory::orderBy('created_at', 'desc')->get();
        return view('Admin.3 - NotificationCenter', [
            'notificationHistory' => $notificationHistory,
        ]);
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

            Admin_NotificationHistory::create([
                'target_type' => $targetType,
                'target_user' => $request->target_user ?? "all",
                'target_id' => $request->target_id,
                'title' => $request->notification_title,
                'message' => $request->notification_message,
            ]);

            return back()->with('success', 'Notification sent successfully');
        }

    public function reportmanagement(){
        $reports = Admin_ReportManagement::orderBy('created_at', 'asc')->get();
        $customerReports = $reports->where('user_role', 'customer');
        $technicianReports = $reports->where('user_role', 'technician');

        // $resolvedReports = $reports->where('report_status', 'resolved');
        // $pendingReports = $reports->where('report_status', 'pending');
        // $escalatedReports = $reports->where('report_status', 'escalated');

        return view('Admin.4 - ReportManagement', [
            'reports' => $reports,
            'customerReports' => $customerReports,
            'technicianReports' => $technicianReports,
        ]);
    }
        public function reportdetails($reportID){
            $reportdetails = Admin_ReportManagement::find($reportID);
            return response()->json([
                'ID' => $reportdetails->id,
                'user_id' => $reportdetails->user_id,
                'user_role' => $reportdetails->user_role,
                'user_name' => $reportdetails->user_name,
                'user_email' => $reportdetails->user_email,

                'report_status' => $reportdetails->report_status,
                'report_issue' => $reportdetails->report_issue,
                'report_description' => $reportdetails->report_description,
            ]);
        }
        public function reportupdate(Request $request, $reportID) {
            $report = Admin_ReportManagement::find($reportID);
        
            $report->update([
                'report_status' => $request->report_status,
            ]);

            return back()->with('success', 'Report Status Updated');
        }

    public function reviewsmanagement(){
        $reviewData = RepairShop_Reviews::orderBy('created_at', 'desc')
            ->with('customer')
            ->with('technician')
            ->get();

        $pendingReviews = $reviewData->where('status', 'Pending');
        $approvedReviews = $reviewData->where('status', 'Approved');
        $rejectedReviews = $reviewData->where('status', 'Rejected');


        return view('Admin.5 - ReviewsManagement', [
            'reviewData' => $reviewData,
            'pendingReviews' => $pendingReviews,
            'approvedReviews' => $approvedReviews,
            'rejectedReviews' => $rejectedReviews,
        ]);
    }
        public function reviewupdate(Request $request, $reviewID){
            $review = RepairShop_Reviews::find($reviewID);

            // if (!$review) {
            //     return response()->json(['message' => 'Review not found'], 404);
            // }

            $review->update([
                'status' => $request->input('status'), // Access 'status' from the request body
            ]);

            return response()->json(['message' => 'Review updated successfully'], 200);
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
