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
use App\Models\Admin_Disciplinary;
use App\Models\Admin_ActivityLogs;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as RequestFacade;

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
                    ->with(['repairshopRepairStatus' => function($query) {
                        $query->where('status', 'in progress');
                    }])
                    ->with('repairshopAppointments')
                    ->with('repairshopImages')
                    ->find($userID);
                
                $disciplinaryRecords = Admin_Disciplinary::where('technician_id', $userID)->get();

                $activityLogs = Admin_ActivityLogs::where('technician_id', $userID)->orderBy('created_at', 'desc')->get();

                return view('Admin.6 - ViewProfile', [
                    'technician' => $technician,
                    'disciplinaryRecords' => $disciplinaryRecords,
                    'activityLogs' => $activityLogs,
                ]);

            }elseif($userRole == 'Customer'){
                $customer = Customer::find($userID);
                $appointments = RepairShop_Appointments::where('customer_id', $userID)->get();
                $repairs = RepairShop_RepairStatus::where('customer_id', $userID)->get();
                $reviews = RepairShop_Reviews::where('customer_id', $userID)->get();
                $activityLogs = Admin_ActivityLogs::where('customer_id', $userID)->get();

                return view('Admin.7 - ViewProfile', [
                    'customer' => $customer,
                    'appointments' => $appointments,
                    'reviews' => $reviews,
                    'repairs' => $repairs,
                    'activityLogs' => $activityLogs
                ]);
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

        // Get all technicians and map them to a standardized structure
        $technicians = Technician::all()->map(function ($technician) {
            return [
                'id' => $technician->id,
                'fullname' => $technician->firstname . ' ' . $technician->lastname,
                'email' => $technician->email,
                'role' => 'Technician',
            ];
        });

        // Get all customers and map them to the same standardized structure
        $customers = Customer::all()->map(function ($customer) {
            return [
                'id' => $customer->id,
                'fullname' => $customer->firstname . ' ' . $customer->lastname,
                'email' => $customer->email,
                'role' => 'Customer',
            ];
        });

        // Merge both collections
        $allUsers = $technicians->merge($customers);

        // Sort the merged collection by creation date
        $allUsers = $allUsers->sortBy('created_at')->values();

        return view('Admin.3 - NotificationCenter', [
            'notificationHistory' => $notificationHistory,
            'allUsers' => $allUsers,
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

                'category' => $reportdetails->category,
                'sub_category' => $reportdetails->sub_category,
                'description' => $reportdetails->description,
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
            ->get()
            ->take(200);

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

            $review->update([
                'status' => $request->input('status'), // Access 'status' from the request body
            ]); 

            return response()->json(['message' => 'Review updated successfully'], 200);
        }   

        public function disciplinaryAction(Request $request, $action, $technicianID){
            if ($action == "submit") {
                $request->validate([
                    'violation_header' => 'required',
                    'violation_level' => 'required',
                    'violation_status' => 'required',
                    'violation_description' => 'required',
                    'date_of_incident' => 'required|date',
                ]);
        
                Admin_Disciplinary::create([
                    'technician_id' => $technicianID,
                    'violation_level' => $request->violation_level,
                    'status' => $request->violation_status,
                    'violation_header' => $request->violation_header,
                    'violation_description' => $request->violation_description,
                    'date_of_incident' => $request->date_of_incident,
                ]);
        
                return back()->with('success', 'Disciplinary Submitted');
            } elseif ($action == "update") {
                try {
                    $recordID = $request->record_id;
                    $disciplinaryRecord = Admin_Disciplinary::findOrFail($recordID);
                    $disciplinaryRecord->update([
                        'technician_id' => $technicianID,
                        'violation_level' => $request->violation_level,
                        'status' => $request->violation_status,
                        'violation_header' => $request->violation_header,
                        'violation_offense' => $request->offense_number,
                        'violation_description' => $request->violation_description,
                        'date_of_incident' => $request->date_of_incident,
                    ]);
        
                    return back()->with('success', 'Disciplinary Updated');
                } catch (\Exception $err) {
                    return back()->with('error', 'Disciplinary Unsuccessful');
                }
            } elseif ($action == "resolved") {
                $recordID = $request->record_id;
                $disciplinaryRecord = Admin_Disciplinary::find($recordID);
                
                if ($disciplinaryRecord) {
                    $disciplinaryRecord->update([
                        'action_taken' => $request->action_taken,
                        'resolution_date' => $request->resolution_date,
                        'status' => 'Solved'
                    ]);
        
                    return back()->with('success', 'Disciplinary Resolved');
                } else {
                    return back()->with('error', 'Record not found');
                }
            }
        }
        

    public function fetchDisciplinaryRecord($recordID){
        $disciplinaryRecord = Admin_Disciplinary::findOrFail($recordID);
        $formatedDate = $disciplinaryRecord->date_of_incident->format('Y-m-d');

        return response()->json([
            'technician_id' => $disciplinaryRecord->technician_id,
            'violation_level' => $disciplinaryRecord->violation_level,
            'violation_status' => $disciplinaryRecord->status,
            'date_of_incident' => $formatedDate,
            'violation_header' => $disciplinaryRecord->violation_header,
            'violation_offense' => $disciplinaryRecord->violation_offense,
            'violation_description' => $disciplinaryRecord->violation_description,            
        ]);
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
