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
        $technician = Auth::guard('technician')->user();
        $repairshop = Technician::find($technician->id);

        $appointments = Repairshop_Appointments::where('technician_id', $technician->id)->get();
        $upcomingAppointments = $appointments->where('status', 'confirmed');
        $requestedAppointments = $appointments->where('status', 'requested');

        $repairstatus = Repairshop_RepairStatus::where('technician_id', $technician->id)->get();
        $pendingStatus = $repairstatus->where('status', 'pending');
        $completedStatus = $repairstatus->where('repairstatus', 'Ready For Pickup');
        $revenue = $completedStatus->sum('revenue');

        $reviews = Repairshop_Reviews::where('technician_id', $technician->id)->get();
        $totalRepairs = $repairstatus->where('repairstatus', 'Device Collected');

        return view('Technician.1 - Dashboard', [
            'repairshop' => $repairshop,

            'upcomingAppointments' => $upcomingAppointments,
            'requestedAppointments' => $requestedAppointments,

            'pendingStatus' => $pendingStatus,
            'completedStatus' => $completedStatus,
            'revenue' => $revenue,

            'reviews' => $reviews,
            'totalRepairs' => $totalRepairs,
        ]);
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
        $repairshopInfo = $technicianInfo->repairshopCredentials;

        $technicianBadges = $technicianInfo->repairshopBadges;
        $technicianServices = $technicianInfo->repairshopServices;
        $technicianMastery = $technicianInfo->repairshopMastery;
        $technicianSchedules = $technicianInfo->repairshopSchedules;
        $technicianProfile = $technicianInfo->repairshopProfile;

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

    // POSTS AND UPDATE FUNCTIONS ---------------------------------------------------------------------------------------------------
    public function updateProfile(Request $request){
        $technician = Auth::guard('technician')->user();
        $technicianInfo = Technician::find($technician->id);

        //Shop Mastery
        $repairshopMastery = RepairShop_Mastery::firstOrNew(['technician_id' => $technician->id]);

        // Set the main mastery
        $repairshopMastery->main_mastery = 'Smartphone'; //Just default value for now

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
        foreach ($request->input('service') as $index => $service) {
            if (!empty($service)) {
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
        }

        // If there are fewer services in the request than in the database, remove the extra ones
        if ($existingServices->count() > count($request->input('service'))) {
            $excessServices = $existingServices->skip(count($request->input('service')));
            foreach ($excessServices as $excessService) {
                $excessService->delete();
            }
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

        //--------------------------------------------------------------------------

        $validatedAbout = $request->validate([
            'header' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $technician->repairshopProfile()->updateOrCreate([
            'header' => $validatedAbout['header'],
            'description' => $validatedAbout['description'],            
        ]);

        return redirect()->route('technician.profile')->with('success', 'Changes saved successfully');
    }

}
