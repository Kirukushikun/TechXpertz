<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Admin_ReportManagement;
use App\Models\Admin_ActivityLogs;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Collection;

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
use App\Models\RepairShop_Images;
use Carbon\Carbon;

use App\Models\Message;
use App\Models\Conversation;
use App\Models\Public_Notifications;

use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TechnicianController extends Controller
{   
    public function notifications(){
        $technician = Auth::guard('technician')->user();

        // Combine both queries and sort in descending order
        $technicianNotification = Technician_Notifications::where('target_id', $technician->id)
            ->orWhere('target_type', 'all')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $publicNotification = Public_Notifications::all();

        // Merge collections
        $allNotifications = $technicianNotification->concat($publicNotification);

        // Optionally, sort by created_at if you want a unified order:
        $allNotifications = $allNotifications->sortByDesc('created_at');

        // Check if there are any unread notifications
        $hasUnreadNotifications = $technicianNotification->contains('is_read', false);

        return view('Technician.7 - Notification', [
            'allNotifications' => $allNotifications,
        ]);
    }
        public function isRead($id){
            $notification = Technician_Notifications::find($id);

            if($notification){
                $notification->markAsRead();
            }

            return redirect()->route('technician.notifications');
        }

    public function dashboard(){
        $technician = Auth::guard('technician')->user();
        $repairshop = Technician::find($technician->id);

        $appointments = Repairshop_Appointments::where('technician_id', $technician->id)->get();
        $upcomingAppointments = $appointments->where('status', 'confirmed')
            ->sortBy('created_at')  // Use sortBy on collections
            ->take(10);
        $upcomingAppointmentsCount = $appointments->where('status', 'confirmed')->count();

        $requestedAppointments = $appointments->where('status', 'requested')
            ->sortBy('created_at')  // Use sortBy on collections
            ->take(4);
        $requestedAppointmentsCount = $appointments->where('status', 'requested')->count();

        // Format the date for each appointments
        foreach ($appointments as $appointment) {
            $appointment->formatted_date = Carbon::parse($appointment->appointment_date)->format('M d, Y');
            $appointment->formatted_time = Carbon::parse($appointment->appointment_time)->format('g:i A');
        }

        $repairstatus = Repairshop_RepairStatus::where('technician_id', $technician->id)->get();
        $pendingStatus = $repairstatus->where('status', 'in progress');
        $completedStatus = $repairstatus->where('repairstatus', 'Ready For Pickup');

        $reviews = Repairshop_Reviews::where('technician_id', $technician->id)
            ->where('status', 'Approved')
            ->get();
        $totalRepairs = $repairstatus->where('repairstatus', 'Device Collected');
        $revenue = $this->formatMoney($totalRepairs->sum('revenue'));

        //------------------------------------------------------------------------------------------------
        // Calculate the revenue percentage change
        $currentRevenueCount = $repairstatus->where('repairstatus', 'Device Collected')
        ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('revenue');

        $previousRevenueCount = $repairstatus->where('repairstatus', 'Device Collected')
        ->whereBetween('created_at', [now()->subWeeks(1)->startOfWeek(), now()->subWeeks(1)->endOfWeek()])->sum('revenue');

        $revenuePercentage = $this->calculatePercentageChange($currentRevenueCount, $previousRevenueCount);

        // Calculate the total repairs percentage change
        $currentRepairedCount = $totalRepairs->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $previousRepairedCount = $totalRepairs->whereBetween('created_at', [now()->subWeeks(1)->startOfWeek(), now()->subWeeks(1)->endOfWeek()])->count();

        $repairedPercentage = $this->calculatePercentageChange($currentRepairedCount, $previousRepairedCount);

        // Calculate the review percentage change
        $currentReviewCount = $reviews->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $previousReviewCount = $reviews->whereBetween('created_at', [now()->subWeeks(1)->startOfWeek(), now()->subWeeks(1)->endOfWeek()])->count();

        $reviewPercentage = $this->calculatePercentageChange($currentReviewCount, $previousReviewCount);

        //------------------------------------------------------------------------------------------------

        $repairshopCredentials = RepairShop_Credentials::where('technician_id', $technician->id)->first();

        //-----------------------------------------------------------------------------------------------

        return view('Technician.1 - Dashboard', [
            'repairshop' => $repairshop,
            'repairshopCredentials' => $repairshopCredentials,

            'upcomingAppointments' => $upcomingAppointments,
            'upcomingAppointmentsCount' => $upcomingAppointmentsCount,
            
            'requestedAppointments' => $requestedAppointments,
            'requestedAppointmentsCount' => $requestedAppointmentsCount,

            'pendingStatus' => $pendingStatus,
            'completedStatus' => $completedStatus,
            'revenue' => $revenue,

            'reviews' => $reviews,
            'totalRepairs' => $totalRepairs,

            'revenuePercentage' => $revenuePercentage,
            'repairedPercentage' => $repairedPercentage,
            'reviewPercentage' => $reviewPercentage,
        ]);
    }

    public function appointment() {
        $technician = Auth::guard('technician')->user();
    
        // Fetch appointments by status using eager loading for performance
        $appointments = Repairshop_Appointments::where('technician_id', $technician->id)
            ->get();

        // Format the date for each appointments
        foreach ($appointments as $appointment) {
            $appointment->formatted_date = Carbon::parse($appointment->appointment_date)->format('D, M d, Y');
            $appointment->formatted_time = Carbon::parse($appointment->appointment_time)->format('g:i A');

            $appointment->updated_date = Carbon::parse($appointment->updated_at)->format('M d, Y');
            $appointment->updated_time = Carbon::parse($appointment->updated_at)->format('g:i A');

            $appointment->js_month = Carbon::parse($appointment->appointment_date)->format('Y-m');
            $appointment->js_day = Carbon::parse($appointment->appointment_date)->format('Y-m-d');
            $appointment->js_time = Carbon::parse($appointment->appointment_time)->format('H:i');
        }
    
        // Group appointments by status
        $confirmedAppointments = $appointments->where('status', 'confirmed');
        $requestedAppointments = $appointments->where('status', 'requested');
        $completedAppointments = $appointments->where('status', 'completed');
        $rejectedAppointments = $appointments->where('status', 'rejected');
    
        // Prepare data for requested, pending, rejected and completed appointments
        $requestedAppointmentsData = $requestedAppointments->map(function ($appointment) {
            return [
                'ID' => $appointment->id,
                'customer_id' => $appointment->customer_id,
                'fullname' => $appointment->fullname,
                'email' => $appointment->email,
                'contact' => $appointment->contact_no,
                'formatted_date' => $appointment->formatted_date,
                'formatted_time' => $appointment->formatted_time,
                
                'js_month' => $appointment->js_month,
                'js_day' => $appointment->js_day,
                'js_time' => $appointment->js_time,
            ];
        })->toArray();
    
        $confirmedAppointmentsData = $confirmedAppointments->map(function ($appointment) {
            return [
                'ID' => $appointment->id,
                'customer_id' => $appointment->customer_id,
                'fullname' => $appointment->fullname,
                'email' => $appointment->email,
                'contact' => $appointment->contact_no,
                'formatted_date' => $appointment->formatted_date,
                'formatted_time' => $appointment->formatted_time,

                'js_month' => $appointment->js_month,
                'js_day' => $appointment->js_day,
                'js_time' => $appointment->js_time,
            ];
        })->toArray();
    
        $completedAppointmentsData = $completedAppointments->map(function ($appointment) {
            return [
                'ID' => $appointment->id,
                'customer_id' => $appointment->customer_id,
                'fullname' => $appointment->fullname,
                'email' => $appointment->email,
                'contact' => $appointment->contact_no,
                'formatted_date' => $appointment->formatted_date,
                'formatted_time' => $appointment->formatted_time,

                'js_month' => $appointment->js_month,
                'js_day' => $appointment->js_day,
                'js_time' => $appointment->js_time,
            ];
        })->toArray();

        $rejectedAppointmentsData = $rejectedAppointments->map(function ($appointment) {
            return [
                'ID' => $appointment->id,
                'customer_id' => $appointment->customer_id,
                'fullname' => $appointment->fullname,
                'email' => $appointment->email,
                'contact' => $appointment->contact_no,
                'formatted_date' => $appointment->updated_date,
                'formatted_time' => $appointment->updated_time,

                'js_month' => $appointment->js_month,
                'js_day' => $appointment->js_day,
                'js_time' => $appointment->js_time,
            ];
        })->toArray();
    
        // Return view with requested, confirmed, and completed appointments data
        return view('Technician.2 - Appointment', [
            'requestedAppointments' => $requestedAppointmentsData,
            'confirmedAppointments' => $confirmedAppointmentsData,
            'completedAppointments' => $completedAppointmentsData,
            'rejectedAppointments' => $rejectedAppointmentsData,
        ]);
    }

        public function appointmentDetails($appointmentID){
            $technician = Auth::guard('technician')->user();
            if (!$technician) {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }

            $appointmentDetails = Repairshop_Appointments::find($appointmentID);
            if (!$appointmentDetails) {
                return response()->json(['error' => 'Repair not found'], 404);
            }

                $appointmentDetails->formatted_date = Carbon::parse($appointmentDetails->appointment_date)->format('M d, Y');
                $appointmentDetails->formatted_time = Carbon::parse($appointmentDetails->appointment_time)->format('g:i A');

            return response()->json([
                'ID' => $appointmentDetails->id,
                'fullname' => $appointmentDetails->fullname,
                'email' => $appointmentDetails->email,
                'contact' => $appointmentDetails->contact_no,

                'device_type' => $appointmentDetails->device_type,
                'device_brand' => $appointmentDetails->device_brand,
                'device_model' => $appointmentDetails->device_model,
                'device_serial' => $appointmentDetails->device_serial ?? '',

                'issue_description' => $appointmentDetails->issue_descriptions ?? '',
                'error_message' => $appointmentDetails->error_message ?? '',
                'repair_attempts' => $appointmentDetails->repair_attempts ?? '',
                'recent_events' => $appointmentDetails->recent_events ?? '',
                'prepared_parts' => $appointmentDetails->prepared_parts ?? '',

                'formatted_date' => $appointmentDetails->formatted_date,
                'formatted_time' => $appointmentDetails->formatted_time,
                'appointment_urgency' => $appointmentDetails->appointment_urgency ?? '',
            ]);
        }

        public function appointmentUpdate($appointmentSTATUS, $appointmentID){
            $technician = Auth::guard('technician')->user();
            $appointment = RepairShop_Appointments::find($appointmentID);
            $repairstatus = RepairShop_RepairStatus::where('appointment_id', $appointmentID)->first();
            
            if($appointmentSTATUS === "confirm"){
                $appointment->update([
                    'status' => 'confirmed'
                ]);

                Customer_RepairStatus::create([
                    'technician_id' => $technician->id,
                    'repair_id' => $repairstatus->id,
                    'customer_id' => $appointment->customer_id,
                    'repairstatus' => 'Appointment Confirmed',
                    'repairstatus_message' => 'Your appointment has been confirmed! Please drop off your device at the scheduled time.',

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $repairstatus->update([
                    'repairstatus' => 'Appointment Confirmed',
                ]);

                $this->logActivity('Appointment Accepted', technicianId: Auth::guard('technician')->user()->id);
                return back()->with('success', 'Appointment Confirmed')->with('success_message', 'Appointment confirmed successfully. The customer has been notified.');

            } elseif( $appointmentSTATUS === "reject"){
                $appointment->update([
                    'status' => 'rejected'
                ]);

                $this->logActivity('Rejected Request Appointment', technicianId: Auth::guard('technician')->user()->id);
                return back()->with('success', 'Appointment Rejected')->with('success_message', 'Appointment request rejected. The customer has been informed.');
            } elseif($appointmentSTATUS === "cancel"){
                $appointment->update([
                    'status' => 'rejected'
                ]);

                $this->logActivity('Cancelled Scheduled Appointment', technicianId: Auth::guard('technician')->user()->id);
                return back()->with('success', 'Appointment Canceled')->with('success_message', 'Appointment canceled. The customer will be notified.');
            }
        }

        public function appointmentCreate(Request $request){
            $technician = Auth::guard('technician')->user();
            try {
                $validatedData = $request->validate([
                    //Customer Details
                    'firstname' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'contact_no' => 'required|string|max:255',
        
                    //Device Information
                    'device_type' => 'required|string|max:255',
                    'device_brand' => 'required|string|max:255',
                    'device_model' => 'required|string|max:255',
                    'device_serial' => 'nullable|string|max:255',
        
                    //Device Issue
                    'issue_descriptions' => 'nullable|string|max:255',
                    'error_messages' => 'nullable|string|max:255',
                    'repair_attempts' => 'nullable|string|max:255',
                    'recent_events' => 'nullable|string|max:255',
                    'prepared_parts' => 'nullable|string|max:255',   
                    
                    //Appointment Schedule
                    'appointment_date' => 'required|date',
                    'appointment_time' => 'required|date_format:H:i',
                    'appointment_urgency' => 'nullable|string|max:255',
                ]);
        
                // Concatenate the first name and last name to create the fullname
                $fullname = $validatedData['firstname'] . " " . $validatedData['lastname'];
        
                // Create a new appointment request
                $repairshopAppointments = RepairShop_Appointments::create([
                    'technician_id' => $technician->id,
                    'status' => 'confirmed',
        
                    // Customer Details
                    'fullname' => $fullname,
                    'email' => $validatedData['email'],
                    'contact_no' => $validatedData['contact_no'],
        
                    // Device Information
                    'device_type' => $validatedData['device_type'],
                    'device_brand' => $validatedData['device_brand'],
                    'device_model' => $validatedData['device_model'],
                    'device_serial' => $validatedData['device_serial'],
        
                    // Device Issue
                    'issue_descriptions' => $validatedData['issue_descriptions'],
                    'error_message' => $validatedData['error_messages'],
                    'repair_attempts' => $validatedData['repair_attempts'],
                    'recent_events' => $validatedData['recent_events'],
                    'prepared_parts' => $validatedData['prepared_parts'],   
        
                    // Appointment Schedule
                    'appointment_date' => $validatedData['appointment_date'],
                    'appointment_time' => $validatedData['appointment_time'],
                    'appointment_urgency' => $validatedData['appointment_urgency'],
                ]);
    
                $repairshopRepairstatus = RepairShop_RepairStatus::create([
                    'technician_id' => $technician->id,
                    'appointment_id' => $repairshopAppointments->id,
                    'customer_fullname' => $fullname,
    
                    'status' => 'pending',
                    'repairstatus' => 'Appointment Confirmed',
    
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    
                Customer_RepairStatus::create([
                    'technician_id' => $technician->id,
                    'repair_id' => $repairshopRepairstatus->id,
    
                    'repairstatus' => 'Appointment Settled',
                    'repairstatus_message' => 'Your appointment has been settled! Please drop off your device at the scheduled time.',
    
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    
                $this->logActivity('Created An Appointment', technicianId: Auth::guard('technician')->user()->id);
                return back()->with('success', 'Success! Your appointment has been successfully booked.');
            } catch (\Exception $e) {
                return back()->with('error', 'Failed to book appointment: ' . $e->getMessage());
                // return back()->with('error', 'Failed to book appointment. Please try again.');
            }

        }


    public function repairstatus(){
        $technician = Auth::guard('technician')->user();
        $repairStatus = RepairShop_RepairStatus::where('technician_id', $technician->id)->get();

        $repairStatusPending = $repairStatus->where('status', 'in progress');
        
        $repairStatusCompleted = $repairStatus->where('status', 'completed');

        $repairstatusTerminated = $repairStatus->where('status', 'terminated');

        // Prepare data for requested, pending, and completed appointments
        $repairStatusPendingData = $repairStatusPending->map(function ($repairdata) {
            $formatedRevenue = $this->formatMoney($repairdata->revenue);
            $formatedExpense = $this->formatMoney($repairdata->expenses);

            return [
                'repairID' => $repairdata->id,
                'customerID' => $repairdata->customer_id,
                'appointment_id' => $repairdata->appointment_id,
                'customer_name' => $repairdata->customer_fullname,
                'revenue' => $formatedRevenue,
                'expenses' => $formatedExpense,
                'paid_status' => $repairdata->paid_status,
                'repairstatus' => $repairdata->repairstatus,
                'repairstatus_conditional' => $repairdata->repairstatus_conditional,
                'repairstatus_message' => $repairdata->repairstatus_message,
            ];
        })->toArray();

        // Prepare data for requested, pending, and completed appointments
        $repairStatusCompletedData = $repairStatusCompleted->map(function ($repairdata) {
            $formatedRevenue = $this->formatMoney($repairdata->revenue);
            $formatedExpense = $this->formatMoney($repairdata->expenses);

            $repairdata->formatted_date = Carbon::parse($repairdata->updated_at)->format('M d, Y');
            $repairdata->formatted_time = Carbon::parse($repairdata->updated_at)->format('g:i A');

            $repairdata->js_month = Carbon::parse($repairdata->updated_at)->format('Y-m');
            $repairdata->js_day = Carbon::parse($repairdata->updated_at)->format('Y-m-d');
            $repairdata->js_time = Carbon::parse($repairdata->updated_at)->format('H:i');

            return [
                'repairID' => $repairdata->id,
                'customerID' => $repairdata->customer_id,
                'appointment_id' => $repairdata->appointment_id,
                'customer_name' => $repairdata->customer_fullname,
                'revenue' => $formatedRevenue,
                'expenses' => $formatedExpense,
                'date' => $repairdata->formatted_date,
                'time' => $repairdata->formatted_time,

                'js_month' => $repairdata->js_month,
                'js_day' => $repairdata->js_day,
                'js_time' => $repairdata->js_time,
            ];
        })->toArray();

        // Prepare data for requested, pending, and completed appointments
        $repairStatusTerminatedData = $repairstatusTerminated->map(function ($repairdata) {
            $formatedRevenue = $this->formatMoney($repairdata->revenue);
            $formatedExpense = $this->formatMoney($repairdata->expenses);

            $repairdata->formatted_date = Carbon::parse($repairdata->updated_at)->format('M d, Y');
            $repairdata->formatted_time = Carbon::parse($repairdata->updated_at)->format('g:i A');

            $repairdata->js_month = Carbon::parse($repairdata->updated_at)->format('Y-m');
            $repairdata->js_day = Carbon::parse($repairdata->updated_at)->format('Y-m-d');
            $repairdata->js_time = Carbon::parse($repairdata->updated_at)->format('H:i');

            return [
                'repairID' => $repairdata->id,
                'customerID' => $repairdata->customer_id,
                'appointment_id' => $repairdata->appointment_id,
                'customer_name' => $repairdata->customer_fullname,
                'revenue' => $formatedRevenue,
                'expenses' => $formatedExpense,
                'date' => $repairdata->formatted_date,
                'time' => $repairdata->formatted_time,

                'js_month' => $repairdata->js_month,
                'js_day' => $repairdata->js_day,
                'js_time' => $repairdata->js_time,
            ];
        })->toArray();

        return view('Technician.3 - RepairStatus', [
            'repairStatusPendingData' => $repairStatusPendingData,
            'repairStatusCompletedData' => $repairStatusCompletedData,
            'repairStatusTerminatedData' => $repairStatusTerminatedData,
        ]);
    }   
        public function repairstatusDetails($repairID){
            $technician = Auth::guard('technician')->user();
            if (!$technician) {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
            $repairDetails = Repairshop_RepairStatus::find($repairID);
            if (!$repairDetails) {
                return response()->json(['error' => 'Repair not found'], 404);
            }

            return response()->json([
                'repairID' => $repairDetails->id,

                'paid_status' => $repairDetails->paid_status,
                'revenue' => $repairDetails->revenue,
                'expenses' => $repairDetails->expenses,

                'repairstatus' => $repairDetails->repairstatus,
                'repairstatus_conditional' => $repairDetails->repairstatus_conditional ?? '',
                'repairstatus_message' => $repairDetails->repairstatus_message,
            ]);
        }   

        public function repairstatusCreate(Request $request, $appointmentID){
            $technician = Auth::guard('technician')->user();
            $appointment = RepairShop_Appointments::find($appointmentID);
            $repairstatus = RepairShop_RepairStatus::where('appointment_id', $appointmentID)->first();

            $additionalDetails = $request->validate([
                'paid_status' => 'required|string|max:255',
                'revenue' => 'nullable|integer',
                'expenses' => 'nullable|integer',
            ]);
    
            $repairstatus->update([
                'status' => 'in progress',
                'repairstatus' => 'Device Dropped Off',
                'paid_status' => $additionalDetails['paid_status'],
                'revenue' => $additionalDetails['revenue'] ?? 0,
                'expenses' => $additionalDetails['expenses'] ?? 0,
            ]);

            $appointment->update([
                'status' => 'completed',
            ]);

            Customer_RepairStatus::create([
                'technician_id' => $technician->id,
                'repair_id' => $repairstatus->id,
                'customer_id' => $repairstatus->customer_id ?? null,
                'repairstatus' => 'Device Dropped Off',
                'repairstatus_message' => 'We’ve received your device at our repair shop. We are now preparing to begin the diagnostic process to determine the necessary repairs.',

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->logActivity('Started A Repair', technicianId: Auth::guard('technician')->user()->id);
            return back()->with('success', 'Repair Started')->with('success_message', 'Repair process started. The customer has been notified that the device is being repaired.');
        }

        public function repairstatusUpdate(Request $request, $repairID, $action){
            $technician = Auth::guard('technician')->user();
            $repairstatus = Repairshop_RepairStatus::find($repairID);

            if($action === 'Terminate'){
                $repairstatus->update([
                    'repairstatus' => 'Repair Terminated',
                    'repairstatus_message' => $request->terminate_message,
                    'status' => 'terminated'
                ]);

                Customer_RepairStatus::create([
                    'technician_id' => $technician->id,
                    'repair_id' => $repairID,
                    'customer_id' => $repairstatus->customer_id ?? null,

                    'repairstatus' => 'Repair Terminated',
                    'repairstatus_message' => $request->terminate_message,    

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->logActivity('Repair terminated', technicianId: Auth::guard('technician')->user()->id);
                return back()->with('success', 'Repair Terminated')->with('success_message', 'Repair terminated successfully. The customer has been notified of the termination.');
                
            }elseif($action === 'Update'){
                if($request->repair_status === 'Device Collected'){
                    $repairstatus->update([
                        'status' => 'completed',
                        'updated_at' => now(),
                    ]);
                }
                $repairstatus->update([
                    'paid_status' => $request->paid_status,
                    'expenses' => $request->expenses,
                    'revenue' => $request->revenue,

                    'repairstatus' => $request->repair_status,
                    'repairstatus_conditional' => $request->repair_status_conditional,
                    'repairstatus_message' => $request->repairstatus_message,
                    'updated_at' => now(),
                ]);

                //If repairstatus conditional has value, it will be the one stored else the main repairstatus
                $repairStatus = $request->repair_status_conditional ?? $request->repair_status;

                Customer_RepairStatus::create([
                    'technician_id' => $technician->id,
                    'repair_id' => $repairID,
                    'customer_id' => $repairstatus->customer_id,

                    'repairstatus' => $repairStatus,
                    'repairstatus_message' => $request->repairstatus_message,    

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Customer_Notifications::create([
                    'target_type' => 'customer',
                    'target_id' => $repairstatus->customer_id,
                    'title' => 'Repair Status Updated',
                    'message' => 'Your device repair status has been updated. Please check your device repair status section for the latest details on the progress of your repair.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->logActivity('Repair Updated', technicianId: Auth::guard('technician')->user()->id);
                return back()->with('success', 'Repair Status Updated')->with('success_message', 'Repair status updated successfully. The customer has been notified of the progress.');
                
            }

            
        }

        public function repairstatusCreateWalkIn(Request $request)
        {
            try {
                $technician = Auth::guard('technician')->user();

                $validatedData = $request->validate([
                    'fullname' => 'required|string|max:255',
                    'email' => 'required|string|max:255',
                    'contact' => 'required|string|max:255',

                    'device_type' => 'string|max:255',
                    'device_brand' => 'string|max:255',
                    'device_model' => 'string|max:255',
                    'serial_number' => 'nullable|string|max:255',

                    'revenue' => 'nullable|integer',
                    'expenses' => 'nullable|integer',
                    'payment_status' => 'string|max:255',

                    'issue_description' => 'nullable|string|max:255',
                    'error_message' => 'nullable|string|max:255',
                    'previous_steps' => 'nullable|string|max:255',
                    'recent_events' => 'nullable|string|max:255',
                    'prepared_parts' => 'nullable|string|max:255',
                ]);

                $appointment = Repairshop_Appointments::create([
                    'technician_id' => $technician->id,
                    'status' => 'completed',

                    'fullname' => $validatedData['fullname'],
                    'email' => $validatedData['email'],
                    'contact_no' => $validatedData['contact'],

                    'device_type' => $validatedData['device_type'],
                    'device_brand' => $validatedData['device_brand'],
                    'device_model' => $validatedData['device_model'],
                    'device_serial' => $validatedData['serial_number'],

                    'issue_descriptions' => $validatedData['issue_description'],
                    'error_message' => $validatedData['error_message'],
                    'repair_attempts' => $validatedData['previous_steps'],
                    'recent_events' => $validatedData['recent_events'],
                    'prepared_parts' => $validatedData['prepared_parts'],

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $repairstatus = Repairshop_RepairStatus::create([
                    'technician_id' => $technician->id,
                    'customer_fullname' => $validatedData['fullname'],
                    'appointment_id' => $appointment->id,
                    'status' => 'in progress',

                    'paid_status' => $validatedData['payment_status'],
                    'revenue' => $validatedData['revenue'],
                    'expenses' => $validatedData['expenses'],
                    'repairstatus' => 'Device Dropped Off',

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Customer_RepairStatus::create([
                    'technician_id' => $technician->id,
                    'repair_id' => $repairstatus->id,
                    'repairstatus' => 'Device Dropped Off',
                    'repairstatus_message' => 'We have successfully received your device at our repair shop. Our technician is now preparing to begin the diagnostic process. You’ll be kept informed as we progress through the repair stages. Thank you for trusting us with your device!',
                ]);

                $this->logActivity('Repair Created', technicianId: Auth::guard('technician')->user()->id);
                return back()->with('success', 'Repair Walk-In Added')->with('success_message', 'The repair request has been successfully recorded. The repair status timeline has been started, and the repair process can now begin.');
            } catch (\Exception $e) {
                // Log the error message for debugging
                \Log::error('Error in repairstatusCreateWalkIn: ' . $e->getMessage());

                // Return with an error message
                return back()->withErrors(['error' => 'There was an issue creating the repair. Please try again later.']);
            }
        }


    public function messages(){
        return view('Technician.4 - Messages');
    }
        public function messageCustomer($customerID){
            $conversation = Conversation::where('sender_id', $customerID)
                ->where('receiver_id', Auth::guard('technician')->user()->id)
                ->first();

            if($conversation){
                $conversation->touch();
            }else{
                Conversation::create([
                    'sender_id' => $customerID,
                    'sender_type' => 'customer',
                    'receiver_id' => Auth::guard('technician')->user()->id,
                    'receiver_type' => 'technician'
                ]); 
                $this->logActivity('Initialized A Conversation', technicianId: Auth::guard('technician')->user()->id);
            }
            return view('Technician.4 - Messages');
        }

    public function shopreviews(){

        $technician = Auth::guard('technician')->user();

        // Combine both queries and sort in descending order
        $reviewMessages = RepairShop_Reviews::where('technician_id', $technician->id)
            ->Where('status', 'Approved')
            ->orderBy('created_at', 'desc')
            ->get();

        // Exporting ratings calculation
        $reviewData = $this->reviewSystem($technician->id);

        // Format the date for each appointments
        foreach ($reviewMessages as $reviews) {
            $reviews->formatted_date = Carbon::parse($reviews->created_at)->format('M d, Y');
            $reviews->formatted_time = Carbon::parse($reviews->created_at)->format('g:i A');
        }

        return view('Technician.5 - ShopReviews', [
            'reviewData' => $reviewData,
            'reviewMessages' => $reviewMessages,
        ]);
    }

    public function profile(){
        $technician = Auth::guard('technician')->user();

        $technicianInfo = Technician::find($technician->id);
        $repairshopInfo = $technicianInfo->repairshopCredentials;

        $technicianBadges = $technicianInfo->repairshopBadges;
        $technicianServices = $technicianInfo->repairshopServices;
        $technicianMastery = $technicianInfo->repairshopMastery;
        $technicianSchedules = $technicianInfo->repairshopSchedules;
        $technicianProfile = $technicianInfo->repairshopProfile;
        $technicianImages = $technicianInfo->repairshopImages;
        $technicianSocials = $technicianInfo->repairshopSocials;

        $daysOfWeek = [
            1 => 'monday',
            2 => 'tuesday',
            3 => 'wednesday',
            4 => 'thursday',
            5 => 'friday',
            6 => 'saturday',
            7 => 'sunday',
        ];
    
        $formattedTimes = [];
        foreach($technicianSchedules as $schedule) {
            $dayName = $daysOfWeek[$schedule->day];
    
            // Check if opening and closing times are not null
            if ($schedule->opening_time && $schedule->closing_time) {
                $openingTime = new \DateTime($schedule->opening_time);
                $closingTime = new \DateTime($schedule->closing_time);
    
                $formatedOpening = $openingTime->format('H:i');
                $formatedClosing = $closingTime->format('H:i');
            } else {
                // If the times are null, set default or blank values
                $formatedOpening = '';
                $formatedClosing = '';
            }
    
            $formattedTimes[$dayName] = [
                'open' => $formatedOpening,
                'close' => $formatedClosing,
            ];
        }

        
    
        // // Check the array content
        // dd($formattedTimes);

        return view('Technician.6 - ManageProfile', [
            'technicianInfo' => $technicianInfo,
            'repairshopInfo' => $repairshopInfo,
            'technicianBadges' => $technicianBadges,
            'technicianServices' => $technicianServices,
            'technicianMastery' => $technicianMastery,
            'technicianSchedules' => $technicianSchedules,
            'formattedTimes' => $formattedTimes,
            'technicianProfile' => $technicianProfile,
            'technicianImages' => $technicianImages,
            'technicianSocials' => $technicianSocials,
        ]);
    }

        public function updateProfile(Request $request){
            $technician = Auth::guard('technician')->user();
            $technicianInfo = Technician::find($technician->id);

            //Shop Mastery
            $repairshopMastery = RepairShop_Mastery::firstOrNew(['technician_id' => $technician->id]);

            // Set the main mastery
            $repairshopMastery->main_mastery = $request->mastery ?? 'Smartphone'; //Just default value for now

            // List of specializations
            $specializations = ['Smartphone', 'Tablet', 'Desktop', 'Laptop', 'Smartwatch', 'Camera', 'Printer', 'Speaker', 'Drone', 'All-In-One'];

            // Loop through each specialization and set the boolean values
            foreach ($specializations as $specialization) {
                // If the checkbox is present in the request, set it to true, otherwise false
                $repairshopMastery->{$specialization} = $request->has($specialization);
            }

            // Save the record to the database
            $repairshopMastery->save();

            //--------------------------------------------------------------------------

            //RepairShop Credentials
            $validatedCredentials = $request->validate([
                'shop_name' => 'required|string|max:255',
                'shop_contact' => 'required|string|max:255',
                'shop_email' => 'required|string|max:255',

                'shop_province' => 'required|string|max:255',
                'shop_city' => 'required|string|max:255',
                'shop_barangay' => 'required|string|max:255',
                'shop_address' => 'required|string|max:255',
            ]);

            $existsInCustomer = Customer::where('email', $validatedCredentials['shop_email'])->exists();
            $existsInTechnician = Technician::where('email', $validatedCredentials['shop_email'])->exists();
            $existsInAdmin = Admin::where('email', $validatedCredentials['shop_email'])->exists();
            
            if($existsInCustomer || $existsInTechnician || $existsInAdmin){
                return back()->with('error', 'Error Profile Update')->with('error_message', 'The email entered is already in use.');
            }

            $technician->repairshopCredentials()->update([
                'shop_name' => $validatedCredentials['shop_name'],
                'shop_contact' => $validatedCredentials['shop_contact'],
                'shop_email' => $validatedCredentials['shop_email'],

                'shop_province' => $validatedCredentials['shop_province'],
                'shop_city' => $validatedCredentials['shop_city'],
                'shop_barangay' => $validatedCredentials['shop_barangay'],
                'shop_address' => $validatedCredentials['shop_address'],
            ]);

            //Shop Badges // Update or create the repairshopBadges record for the technician
            $validatedBadges = $request->validate([
                'badge_1' => 'required|string|max:255',
                'badge_2' => 'required|string|max:255',
                'badge_3' => 'required|string|max:255',
                'badge_4' => 'required|string|max:255',
            ]);
            $technician->repairshopBadges()->updateOrCreate(
                ['technician_id' => $technician->id], // The condition to match (ensure only one record per technician)
                $validatedBadges // The fields to update
            );

            //--------------------------------------------------------------------------

            // Validate the request to ensure 'service' is an array of strings
            $request->validate([
                'service' => 'array',
                'service.*' => 'string|max:255',
            ]);

            // Get all existing services for the technician
            $existingServices = RepairShop_Services::where('technician_id', $technician->id)->get();
            
            // Iterate over the provided services
            if($request->input('service')){
                foreach ($request->input('service') as $index => $service) {
                    // Check if the service is empty, if so return an error
                    if (!$service) {
                        return back()->with('error', 'Profile Update Unsuccessful')->with('error_message', 'Shop service is missing a value.');
                    }

                    // Check if the service already exists (based on ID or any other unique attribute)
                    $existingService = $existingServices->get($index);

                    // Update the existing service or create a new one
                    RepairShop_Services::updateOrCreate(
                        [
                            'id' => $existingService->id ?? null, // Use the existing ID if available
                            'technician_id' => $technician->id,
                        ],
                        [
                            'service' => $service,
                        ]
                    );
                }

                // If there are fewer services in the request than in the database, remove the extra ones
                if ($existingServices->count() > count($request->input('service'))) {
                    $excessServices = $existingServices->skip(count($request->input('service')));
                    foreach ($excessServices as $excessService) {
                        $excessService->delete();
                    }
                }
            }

            // // --------------------------------------------------------------------------

            // Profile Validation
            $validatedAbout = $request->validate([
                'header' => 'nullable|string|max:255',
                'description' => 'nullable|string',
            ]);

            if (!RepairShop_Profiles::updateOrCreate(
                ['technician_id' => $technician->id],
                ['header' => $validatedAbout['header'], 'description' => $validatedAbout['description']]
            )) {
                return back()->withErrors(['error' => 'Failed to update or create profile details.']);
            }

        
            //--------------------------------------------------------------------------

            // Define the days of the week in numeric form
            $daysOfWeek = [
                'monday' => 1,
                'tuesday' => 2,
                'wednesday' => 3,
                'thursday' => 4,
                'friday' => 5,
                'saturday' => 6,
                'sunday' => 7,
            ];

            // Loop through each day and save or update the schedule
            foreach ($daysOfWeek as $day => $dayNumber) {
                // Get the status (open or closed) for the day
                $status = $request->input("{$day}-status") === 'on' ? 'open' : 'closed';

                // Get the opening and closing times if the day is open
                $openingTime = $status === 'open' ? $request->input("{$day}-open-time") : null;
                $closingTime = $status === 'open' ? $request->input("{$day}-close-time") : null;
                
                
                if($status === 'open'){
                    if(!$openingTime || !$closingTime){
                        return back()->with('error', 'Error Profile Update')->with('error_message', 'You must specify your opening time and closing time');
                    }else{
                        // Update or create the schedule for this day
                        RepairShop_Schedules::updateOrCreate(
                            [
                                'technician_id' => $technician->id,
                                'day' => $dayNumber,
                            ],
                            [
                                'status' => $status,
                                'opening_time' => $openingTime,
                                'closing_time' => $closingTime,
                            ]
                        );
                    }
                }       
            }

            $this->logActivity('Repairshop Profile Updated', technicianId: Auth::guard('technician')->user()->id);
            return back()->with('success', 'Saved successfully')->with('success_message', 'Changes to the profile has been saved successfully.');
        }

        public function updateImage(Request $request, $technicianID, $imageType) {
            $technician = RepairShop_Images::find($technicianID);
        
            // Define valid image types
            $validImageTypes = ['image_profile', 'image_2', 'image_3', 'image_4', 'image_5'];

            // Normalize the case of the image type to ensure case-insensitive matching
            $imageType = strtolower($imageType);

            // Validate the image type
            if (!in_array($imageType, $validImageTypes)) {
                // Log the error for debugging
                \Log::error("Invalid image type: $imageType");

                return back()->with('error', 'Upload Error')
                            ->with('error_message', 'The selected file is not a supported image type. Please upload a valid image format (e.g., JPG, PNG, or WEBP).');
            }
        
            $request->validate([
                'image' => 'required|mimes:png,jpg,jpeg,webp'
            ]);
        
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'uploads/technician/';
        
                // Check if the specific image type exists and delete it
                if ($technician->$imageType) {
                    $oldImagePath = public_path($technician->$imageType);
        
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath); // Delete the old image
                    }
                }
        
                // Move the file to the directory and set the new image path
                $file->move($path, $filename);
        
                // Full path to be stored in the database
                $imagePath = $path . $filename;
        
                // Update the specific image type with the new image path
                $technician->update([
                    $imageType => $imagePath,
                ]);
            }
        
            $this->logActivity('Repairshop Profile Updated', technicianId: Auth::guard('technician')->user()->id);
            return back()->with('success', 'Profile Updated')->with('success_message', 'Your profile has been updated successfully.');
        }

        public function deleteImage($technicianID, $imageType){
            $technician = RepairShop_Images::where('technician_id', $technicianID)->first();
            $technician->update([
                $imageType => null
            ]);
            $this->logActivity('Repairshop Profile Updated', technicianId: Auth::guard('technician')->user()->id);
            return back()->with('success', 'Deletion Successful')->with('success_message', 'The image has been successfully deleted from your profile.');
        }

        public function updateLink(Request $request, $technicianID){
            // Validate the request data
            $request->validate([
                'link' => 'required|url',
            ]);

            // Determine the selected platform
            $platform = null;
            if ($request->has('youtube')) {
                $platform = 'youtube';
            } elseif ($request->has('linkedin')) {
                $platform = 'linkedin';
            } elseif ($request->has('twitter')) {
                $platform = 'twitter';
            } elseif ($request->has('facebook')) {
                $platform = 'facebook';
            } elseif ($request->has('telegram')) {
                $platform = 'telegram';
            }

            // Ensure a platform is selected
            if (!$platform) {
                return redirect()->back()->withErrors(['platform' => 'Please select a social media platform.']);
            }

            // Use updateOrCreate to set the link for the selected platform
            RepairShop_Socials::updateOrCreate(
                ['technician_id' => $technicianID],  // Find by technician_id
                [
                    'technician_id' => $technicianID, // Ensure technician_id is set
                    $platform => $request->input('link'), // Update the selected platform with the new link
                ]
            );

            $this->logActivity('Repairshop Profile Updated', technicianId: Auth::guard('technician')->user()->id);
            return back()->with('success', 'Saved successfully')->with('success_message', 'Changes to the profile has been saved successfully.');
        }

        public function deleteLink($technicianID, $social){
            $technicianSocials = RepairShop_Socials::where('technician_id', $technicianID)->first();

            $technicianSocials->update([
                $social => null,
            ]);

            $this->logActivity('Repairshop Profile Updated', technicianId: Auth::guard('technician')->user()->id);
            return response()->json(['message' => 'Link deleted successfully'], 200);
        }
    
    public function accountSettings(){
        $technicianID = Auth::guard('technician')->user()->id;
        $activityLogs = Admin_ActivityLogs::where('technician_id', $technicianID)->orderBy('created_at', 'desc')->get();
        return view('Technician.8 - AccountSettings', [
            'activityLogs' => $activityLogs,
        ]);
    }
        public function accountUpdate(Request $request){
            $validatedData = $request->validate([
                //Customer Details
                'firstname' => 'required|string|max:255',
                'middlename' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'contact_no' => 'required|string|max:255',
                'educational_background' => 'required|string|max:255',

                //Device Information
                'province' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'barangay' => 'required|string|max:255',
                'zip_code' => 'nullable|string|max:255',  
                
                //Appointment Schedule
                'date_of_birth' => 'required|date',
            ]);

            $technician = Technician::find(Auth::guard('technician')->user()->id);
            $technician->update([
                'firstname' => $validatedData['firstname'],
                'middlename' => $validatedData['middlename'],
                'lastname' => $validatedData['lastname'],
                'email' => $validatedData['email'],
                'contact_no' => $validatedData['contact_no'],
                'educational_background' => $validatedData['educational_background'],

                'province' => $validatedData['province'],

                'city' => $validatedData['city'],
                'barangay' => $validatedData['barangay'],
                'zip_code' => $validatedData['zip_code'],
                'date_of_birth' => $validatedData['date_of_birth'],
            ]);

            $this->logActivity('Account Information Updated', technicianId: Auth::guard('technician')->user()->id);
            return back()->with('success', 'Account Updated')->with('success_message', 'Account updated successfully');

        }

        public function accountDelete(){

            $technicianID = Auth::guard('technician')->user()->id;
            $technician = Technician::findOrFail($technicianID);

            $repairExist = RepairShop_RepairStatus::where('technician_id', $technicianID)
                ->where('status', 'in progress')
                ->exists();
            $appointmentExist = RepairShop_Appointments::where('technician_id', $technicianID)
                ->where('status', 'confirmed')
                ->exists();

            if($repairExist || $appointmentExist){
                $this->logActivity('Account Deletion Requested', technicianId: $technicianID);
                return back()->with('error', 'Deletion Failed')->with('error_message', 'Your account cannot be deleted at this time due to pending appointments or ongoing repairs. Please complete or cancel any active engagements before proceeding with account deletion.');
            }

            $technician->update([
                'profile_status' => 'deleted',
            ]);
            
            $this->logActivity('Account Deleted', technicianId: $technicianID);
            return redirect()->route('technician.accountDisabled', ['status' => 'deleted'])->with("message", "Your account has been successfully deleted. We're sorry to see you go and hope to serve you again in the future.");

        }

        public function accountDisabled($status){
            if(Auth::guard('technician')->check()){
                Auth::guard('technician')->logout();
                return view('Technician.9 - DisabledAccount', [
                    'status' => $status,
                ]);                
            }
            return redirect()->route('technician.loginTechnician');
        }

        public function accountPasswordChange(Request $request){
            $technician = Technician::findOrFail(Auth::guard('technician')->user()->id);
            
            if($request->current_password){
                // Custom validation messages
                $messages = [
                    'new_password.required' => 'Please enter a new password.',
                    'new_password.min' => 'The new password must be at least 8 characters long.',
                    'new_password.confirmed' => 'The new password and confirmation password do not match.',
                    'current_password.required' => 'Please enter your current password.',
                ];

                // Validation with custom messages
                $validator = Validator::make($request->all(), [
                    'current_password' => 'required',
                    'new_password' => 'required|min:8|confirmed', // confirmed ensures the password confirmation matches
                ], $messages);

                // Check if validation fails
                if ($validator->fails()) {
                    return back()->with('error', 'Password Change Failed')
                                ->with('error_message', $validator->errors()->first()); // Send the first validation error
                }

                // Check if the current password is correct
                if (!Hash::check($request->current_password, $technician->password)) {
                    return back()->with('error', 'Password Change Failed')->with('error_message', 'The current password you entered is incorrect. Please try again.');
                }

                // Ensure the new password is different from the current password
                if (Hash::check($request->new_password, $technician->password)) {
                    return back()->with('error', 'Password Change Failed')->with('error_message', 'The new password cannot be the same as the current password.');
                }

                // Update password in a transaction for data integrity
                DB::transaction(function () use ($technician, $request) {
                    $technician->password = Hash::make($request->new_password);
                    $technician->save();
                });

                // Redirect with success message
                $this->logActivity('Password Changed', technicianId: Auth::guard('technician')->user()->id);
                return back()->with('success', 'Password Changed')->with('success_message', 'Your password has been changed successfully.');
            }
        }

        public function submitReport(Request $request){
            Admin_ReportManagement::create([
                'user_id' => Auth::guard('technician')->user()->id,
                'user_role' => 'Technician',
                'user_name' => $request->firstname . ' ' . $request->lastname,
                'user_email' => $request->email,
                'report_status' => 'Pending',
                'category' => $request->category,
                'sub_category' => $request->sub_category,
                'description' => $request->description
            ]);

            $this->logActivity('Submitted A Report', technicianId: Auth::guard('technician')->user()->id);
            return back()->with('success', 'Report Submitted')->with('success_message', 'Your report has been submitted successfully.');
        }

        private function reviewSystem($id){
            $ratings = RepairShop_Reviews::where('technician_id', $id)->where('status', 'Approved')->pluck('rating')->toArray();

            // Calculate total number of reviews
            $totalReviews = count($ratings);

            // Calculate the average rating
            $averageRating = $totalReviews > 0 ? round(array_sum($ratings) / $totalReviews, 1) : 0;

            // Count the number of each rating (1-5 stars)
            $ratingCounts = array_count_values($ratings);

            // Ensure all star levels (1 to 5) are accounted for, even if they have 0 ratings
            for ($i = 1; $i <= 5; $i++) {
                if (!isset($ratingCounts[$i])) {
                    $ratingCounts[$i] = 0;
                }
            }

            // Calculate the percentage for each rating
            $ratingPercentages = [];
            foreach ($ratingCounts as $stars => $count) {
                $ratingPercentages[$stars] = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
            }

            // Return the calculated data as an associative array
            return [
                'totalReviews' => $totalReviews,
                'averageRating' => $averageRating,
                'ratingCounts' => $ratingCounts,
                'ratingPercentages' => $ratingPercentages,
            ];

        }

        public function formatMoney($number){
            if ($number >= 1000) {
                // Convert number to K notation
                $formatted = number_format($number / 1000, ($number % 1000 === 0 ? 0 : 1)) . 'k';
            } else {
                // If number is below 1000, just return the number as it is
                $formatted = $number;
            }
            
            return $formatted;
        }

        function logActivity($action, $technicianId = null, $status = 'success'){
            // Define a collection of actions and their descriptions for technicians
            $actions = collect([
                'Account Created' => 'Technician successfully created a new account.',
                'Logged In' => 'Technician logged into their account.',
                'Logged Out' => 'Technician logged out of their account.',
                'Password Changed' => 'Technician updated their account password.',
                'Reset Password' => 'Technician reset their password.',
    
                'Repairshop Profile Updated' => 'Technician updated their repair shop profile.',
                'Account Information Updated' => 'Technician updated account information.',
    
                'Created An Appointment' => 'Technician created a new appointment.',
                'Appointment Accepted' => 'Technician accepted a customer\'s service request.',
                'Rejected Request Appointment' => 'Technician rejected a request appointment.',
                'Cancelled Scheduled Appointment' => 'Technician canceled a scheduled appointment.',
                'Completed An Appointment' => 'Technician completed an appointment.',
    
                'Started A Repair' => 'Technician began a repair.',
                'Repair Created' => 'Technician created a new repair',
                'Repair Updated' => 'Technician updated the repair status.',
                'Repair Terminated' => 'Technician terminated a repair.',
                'Repair Completed' => 'Technician completed a repair.',
    
                'Initialized A Conversation' => 'Technician started a new conversation with a customer.',
                'Submitted A Report' => 'Technician reported an issue.'
            ]);
    
            // Retrieve the description based on the action
            $description = $actions->get($action, 'Unknown action');
    
            // Create a new activity log entry
            Admin_ActivityLogs::create([
                'technician_id' => $technicianId,
                'action' => $action,
                'description' => $description,
                'status' => $status,
                'ip_address' => RequestFacade::ip(),
            ]);
        }

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
