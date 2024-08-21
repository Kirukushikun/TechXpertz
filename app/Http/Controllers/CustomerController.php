<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Customer_Notifications;

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

class CustomerController extends Controller
{
    public function welcome(){

        $repairshopData = $this->getRepairShopSummary();

        if(Auth::check()){
            $customerNotifications = Customer_Notifications::forCustomer(Auth::user()->id)->get();

            return view('Customer.1 - Homepage', [
                'repairshops' => $repairshopData,
                'customerNotifications' => $customerNotifications,
            ]);
        }

        return view('Customer.1 - Homepage', [
            'repairshops' => $repairshopData,
        ]);
    }

    public function viewcategory($category){

        $repairshopData = $this->getRepairShopSummary($category);

        return view('Customer.2 - ViewCategory', [
            'category' => $category,
            'repairshops' => $repairshopData,
        ]);

    }

    public function viewshop($id){
        $repairshop = Technician::find($id);

        // Retrieve all services from a specific repairshop
        $services = Repairshop_Services::where('technician_ID', $id)->get();

        // Exporting ratings calculation
        $reviewData = $this->reviewSystem($id);

        // Get the detailed schedule
        $detailedSchedule = $this->getDetailedSchedule($id);

        return view('Customer.3 - ViewShop', [
            'repairshop' => $repairshop,
            'services' => $services,
            'reviewData' => $reviewData,
            'detailedSchedule' => $detailedSchedule
        ]);
    }

    public function viewAppointment()
    {
        $customerDetails = Auth::check() ? Customer::find(Auth::id()) : null;
    
        return view('Customer.4 - AppointmentBooking', [
            'customerDetails' => $customerDetails,
        ]);

    }

    public function bookappointment(Request $request){
        
        $validatedData = $request->validate([
            //Customer Details
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
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



    }
    


    // PRIVATE FUNCTIONS ---------

    private function getRepairShopSummary($category = null){

        if (empty($category)){
            $repairshops = Technician::where('profile_status', 'complete')->get();

            $repairshopData = []; // Initialize the array
    
            foreach($repairshops as $repairshop){
    
                // Get the formatted schedule
                $formattedDays = $this->getFormattedSchedule($repairshop->id);

                // Get review data of specific technician with needed variables
                $reviewData[$repairshop->id] = $this->reviewSystem($repairshop->id);
                $totalReviews = $reviewData[$repairshop->id]['totalReviews'];
                $averageRating = $reviewData[$repairshop->id]['averageRating'];
    
                $repairshopData[] = [
                    'repairshopID' => $repairshop->id,
                    'repairshopName' => $repairshop->repairshopCredentials->shop_name,
                    'repairshopContact' => $repairshop->repairshopCredentials->shop_contact,
                    'repairshopMMastery' => $repairshop->repairshopMastery->main_mastery,
                    'repairshopAddress' => $repairshop->repairshopCredentials->shop_address,
                    'repairshopProvince' => $repairshop->repairshopCredentials->shop_province,
                    'repairshopCity' => $repairshop->repairshopCredentials->shop_city,
                    'repairshopBarangay' => $repairshop->repairshopCredentials->shop_barangay,
    
                    'repairshopBadge1' => $repairshop->repairshopBadges->badge_1,
                    'repairshopBadge2' => $repairshop->repairshopBadges->badge_2,
                    'repairshopBadge3' => $repairshop->repairshopBadges->badge_3,
                    'repairshopBadge4' => $repairshop->repairshopBadges->badge_4,

                    'formattedDays' => $formattedDays,
                    'totalReviews' => $totalReviews,
                    'averageRating' => $averageRating,
                ];
            }
    
            return $repairshopData;
        } else {
            //Getting all the data that has the specific category (e.g., 'Smartphones')
            $repairshopCategory = RepairShop_Mastery::where('main_mastery', $category)->get();

            //Extracting all the technician IDs from the retrieved category
            $technicianIDs = $repairshopCategory->pluck('technician_id');

            // Getting all the technicians that match the IDs in the specified category
            $repairshops = Technician::whereIn('id', $technicianIDs)->get();

            $repairshopData = []; // Initialize the array
            foreach($repairshops as $repairshop){

                // Get the formatted schedule
                $formattedDays = $this->getFormattedSchedule($repairshop->id);

                // Get review data of specific technician with needed variables
                $reviewData[$repairshop->id] = $this->reviewSystem($repairshop->id);
                $totalReviews = $reviewData[$repairshop->id]['totalReviews'];
                $averageRating = $reviewData[$repairshop->id]['averageRating'];

                $repairshopData[] = [
                    'repairshopID' => $repairshop->id,
                    'repairshopName' => $repairshop->repairshopCredentials->shop_name,
                    'repairshopContact' => $repairshop->repairshopCredentials->shop_contact,
                    'repairshopMMastery' => $repairshop->repairshopMastery->main_mastery,
                    'repairshopAddress' => $repairshop->repairshopCredentials->shop_address,
                    'repairshopProvince' => $repairshop->repairshopCredentials->shop_province,
                    'repairshopCity' => $repairshop->repairshopCredentials->shop_city,
                    'repairshopBarangay' => $repairshop->repairshopCredentials->shop_barangay,
    
                    'repairshopBadge1' => $repairshop->repairshopBadges->badge_1,
                    'repairshopBadge2' => $repairshop->repairshopBadges->badge_2,
                    'repairshopBadge3' => $repairshop->repairshopBadges->badge_3,
                    'repairshopBadge4' => $repairshop->repairshopBadges->badge_4,

                    'formattedDays' => $formattedDays,
                    'totalReviews' => $totalReviews,
                    'averageRating' => $averageRating,
                ];
            }

            return $repairshopData;
        }

    }

    // FORMATED SCHEDULE FUNCTIONS ---------

    private function getFormattedSchedule($technicianID){

        // Retrieve the open days for the repair shop where status is 'open'
        $schedules = RepairShop_Schedules::where('technician_id', $technicianID)
            ->where('status', 'open')
            ->pluck('day')
            ->toArray();

        // Sort the days numerically
        sort($schedules);

        // Define day names corresponding to numbers
        $dayNames = [
            1 => 'Mon',
            2 => 'Tue',
            3 => 'Wed',
            4 => 'Thu',
            5 => 'Fri',
            6 => 'Sat',
            7 => 'Sun'
        ];

        // Convert numeric days to day names
        $openDays = array_map(function($day) use ($dayNames) {
            return $dayNames[$day];
        }, $schedules);

        // Format the open days
        $formattedDays = $this->formatDays($openDays);

        return $formattedDays;
    }
    
    private function formatDays($days) {
        $result = [];
        $rangeStart = null;
    
        foreach ($days as $index => $day) {
            // If it's the start of a new range
            if ($rangeStart === null) {
                $rangeStart = $day;
            }
    
            // Check if the next day is consecutive
            if (isset($days[$index + 1]) && $this->isNextDay($day, $days[$index + 1])) {
                continue;
            }
    
            // If not consecutive, close the range
            if ($rangeStart !== $day) {
                $result[] = $rangeStart . ' - ' . $day;
            } else {
                $result[] = $day;
            }
    
            // Reset the range start
            $rangeStart = null;
        }
    
        return implode(', ', $result);
    }
    
    private function isNextDay($currentDay, $nextDay) {
        $dayOrder = [
            'Mon' => 1,
            'Tue' => 2,
            'Wed' => 3,
            'Thu' => 4,
            'Fri' => 5,
            'Sat' => 6,
            'Sun' => 7,
        ];
    
        return $dayOrder[$nextDay] === $dayOrder[$currentDay] + 1;
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

    // DETAILED SCHEDULE FUNCTIONS ---------

    private function getDetailedSchedule($technicianID) {
        // Retrieve the schedules from the database
        $schedules = RepairShop_Schedules::where('technician_id', $technicianID)
            ->where('status', 'open')
            ->get()
            ->toArray();
    
        if (empty($schedules)) {
            return "No open schedules available.";
        }
    
        $groupedSchedules = [];
    
        foreach ($schedules as $schedule) {
            // Ensure opening_time and closing_time are DateTime objects
            $openingTime = new \DateTime($schedule['opening_time']);
            $closingTime = new \DateTime($schedule['closing_time']);
    
            $dayName = $this->getDayName($schedule['day']);
            $timeRange = $openingTime->format('g:i A') . ' - ' . $closingTime->format('g:i A');
    
            // Group days by time range
            if (!isset($groupedSchedules[$timeRange])) {
                $groupedSchedules[$timeRange] = [];
            }
            $groupedSchedules[$timeRange][] = $dayName;
        }
    
        // Process the grouped schedules with consecutive and non-consecutive day grouping
        $sortedSchedules = [];
        foreach ($groupedSchedules as $timeRange => $days) {
            $consecutiveDays = $this->groupConsecutiveDays($days);
            foreach ($consecutiveDays as $dayRange) {
                $sortedSchedules[] = $dayRange . ': ' . $timeRange;
            }
        }
    
        // Determine closed days and append them to the output
        $allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $openDays = array_merge(...array_values($groupedSchedules));
        $closedDays = array_diff($allDays, $openDays);
    
        if (!empty($closedDays)) {
            $sortedSchedules[] = 'Closed on ' . implode(', ', $closedDays);
        }
    
        return implode('<li>', $sortedSchedules);
    }
    
    private function getDayName($dayNumber) {
        $dayNames = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday'
        ];
    
        if (isset($dayNames[$dayNumber])) {
            return $dayNames[$dayNumber];
        }
    
        throw new \InvalidArgumentException("Invalid day number: $dayNumber");
    }
    
    private function groupConsecutiveDays($days) {
        $dayOrder = ['Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3, 'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6, 'Sunday' => 7];
        usort($days, fn($a, $b) => $dayOrder[$a] <=> $dayOrder[$b]);
    
        $result = [];
        $rangeStart = null;
        $previousDay = null;
    
        foreach ($days as $day) {
            if ($rangeStart === null) {
                $rangeStart = $day;
            } elseif ($dayOrder[$day] !== $dayOrder[$previousDay] + 1) {
                // If the day is not consecutive, close the previous range
                if ($rangeStart !== $previousDay) {
                    $result[] = $rangeStart . ' - ' . $previousDay;
                } else {
                    $result[] = $rangeStart;
                }
                // Start a new range
                $rangeStart = $day;
            }
    
            $previousDay = $day;
        }
    
        // Close the last range
        if ($rangeStart !== $previousDay) {
            $result[] = $rangeStart . ' - ' . $previousDay;
        } else {
            $result[] = $rangeStart;
        }
    
        return $result;
    }
}
