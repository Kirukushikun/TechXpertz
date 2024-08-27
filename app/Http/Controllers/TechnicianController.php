<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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

class TechnicianController extends Controller
{   
    public function notifications(){
        $technician = Auth::guard('technician')->user();

        // Combine both queries and sort in descending order
        $combinedNotifications = Technician_Notifications::where('target_id', $technician->id)
            ->orWhere('target_type', 'all')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Technician.7 - Notification', [
            'combinedNotifications' => $combinedNotifications,
        ]);
    }

    public function dashboard(){
        return view('Technician.1 - Dashboard');
    }

    public function appointment() {
        $technician = Auth::guard('technician')->user();
    
        // Fetch appointments by status using eager loading for performance
        $appointments = Repairshop_Appointments::where('technician_id', $technician->id)
            ->get();
    
        // Group appointments by status
        $confirmedAppointments = $appointments->where('status', 'confirmed');
        $requestedAppointments = $appointments->where('status', 'requested');
        $completedAppointments = $appointments->where('status', 'completed');
        $rejectedAppointments = $appointments->where('status', 'rejected');
    
        // Prepare data for requested, pending, rejected and completed appointments
        $requestedAppointmentsData = $requestedAppointments->map(function ($appointment) {
            return [
                'fullname' => $appointment->fullname,
                'email' => $appointment->email,
                'contact' => $appointment->contact_no,
                'appointment_date' => $appointment->appointment_date,
                'appointment_time' => $appointment->appointment_time,
            ];
        })->toArray();
    
        $confirmedAppointmentsData = $confirmedAppointments->map(function ($appointment) {
            return [
                'fullname' => $appointment->fullname,
                'email' => $appointment->email,
                'contact' => $appointment->contact_no,
                'appointment_date' => $appointment->appointment_date,
                'appointment_time' => $appointment->appointment_time,
            ];
        })->toArray();
    
        $completedAppointmentsData = $completedAppointments->map(function ($appointment) {
            return [
                'fullname' => $appointment->fullname,
                'email' => $appointment->email,
                'contact' => $appointment->contact_no,
                'appointment_date' => $appointment->appointment_date,
                'appointment_time' => $appointment->appointment_time,
            ];
        })->toArray();

        $rejectedAppointmentsData = $rejectedAppointments->map(function ($appointment) {
            return [
                'fullname' => $appointment->fullname,
                'email' => $appointment->email,
                'contact' => $appointment->contact_no,
                'appointment_date' => $appointment->appointment_date,
                'appointment_time' => $appointment->appointment_time,
            ];
        })->toArray();
    
        // Return view with requested, confirmed, and completed appointments data
        return view('Technician.2 - Appointment', [
            'requestedAppointments' => $requestedAppointmentsData,
            'confirmedAppointments' => $confirmedAppointmentsData,
            'completedAppointments' => $completedAppointmentsData,
            'rejectedAppointments' => $completedAppointmentsData,
        ]);
    }

    public function repairstatus(){
        $technician = Auth::guard('technician')->user();
        $repairStatus = RepairShop_RepairStatus::where('technician_id', $technician->id)->get();

        $repairStatusPending = $repairStatus->where('status', 'pending');
        $repairStatusCompleted = $repairStatus->where('status', 'completed');

        // Prepare data for requested, pending, and completed appointments
        $repairStatusPendingData = $repairStatusPending->map(function ($repairdata) {
            return [
                'repairID' => $repairdata->id,
                'customer_name' => $repairdata->customer_fullname,
                'revenue' => $repairdata->revenue,
                'expenses' => $repairdata->expenses,
                'paid_status' => $repairdata->paid_status,
                'repairstatus' => $repairdata->repairstatus,
                'repairstatus_conditional' => $repairdata->repairstatus_conditional,
                'repairstatus_message' => $repairdata->repairstatus_message,
            ];
        })->toArray();

        // Prepare data for requested, pending, and completed appointments
        $repairStatusCompletedData = $repairStatusCompleted->map(function ($repairdata) {
            return [
                'repairID' => $repairdata->id,
                'customer_name' => $repairdata->customer_fullname,
                'revenue' => $repairdata->revenue,
                'expenses' => $repairdata->expenses,
                'paid_status' => $repairdata->paid_status,
                'repairstatus' => $repairdata->repairstatus,
                'repairstatus_conditional' => $repairdata->repairstatus_conditional,
                'repairstatus_message' => $repairdata->repairstatus_message,
            ];
        })->toArray();

        return view('Technician.3 - RepairStatus', [
            'repairStatusPendingData' => $repairStatusPendingData,
            'repairStatusCompletedData' => $repairStatusCompletedData,
        ]);
    }

    public function messages(){
        return view('Technician.4 - Messages');
    }

    public function shopreviews(){

        $technician = Auth::guard('technician')->user();

        // Combine both queries and sort in descending order
        $reviewMessages = RepairShop_Reviews::where('technician_id', $technician->id)
            ->Where('approved', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // Exporting ratings calculation
        $reviewData = $this->reviewSystem($technician->id);

        return view('Technician.5 - ShopReviews', [
            'reviewData' => $reviewData,
            'reviewMessages' => $reviewMessages,
        ]);
    }

    public function profile(){
        $technician = Auth::guard('technician')->user();

        $technicianInfo = Technician::find($technician->id);
        $repairshopInfo = RepairShop_Credentials::find($technician->id);
        $technicianServices = RepairShop_Services::where('technician_id', $technician->id);
        $technicianBadges = RepairShop_Badges::find($technician->id);
        $technicianAbout = RepairShop_Profiles::find($technician->id);

        return view('Technician.6 - ManageProfile', [
            'technicianInfo' => $technicianInfo,
            'repairshopInfo' => $repairshopInfo,
            'technicianServices' => $technicianServices,
            'technicianBadges' => $technicianBadges,
            'technicianAbout' => $technicianAbout,
        ]);
    }

    // REVIEW SYSTEM FUNCTIONS ---------

    private function reviewSystem($id){
        $ratings = RepairShop_Reviews::where('technician_id', $id)->where('approved', 1)->pluck('rating')->toArray();

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
}
