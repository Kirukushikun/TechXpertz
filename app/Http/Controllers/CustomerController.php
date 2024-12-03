<?php

namespace App\Http\Controllers;

use App\Models\Admin_ActivityLogs;
use App\Models\Admin_ReportManagement;

use App\Models\Customer;
use App\Models\Customer_Notifications;
use App\Models\Customer_RepairStatus;
use App\Models\Customer_Favorite;

use App\Models\Technician;
use App\Models\RepairShop_Credentials;
use App\Models\RepairShop_Mastery;
use App\Models\RepairShop_Profiles;
use App\Models\RepairShop_Reviews;
use App\Models\RepairShop_Schedules;
use App\Models\RepairShop_Services;
use App\Models\RepairShop_Socials;
use App\Models\RepairShop_Images;

use App\Models\RepairShop_RepairStatus;
use App\Models\RepairShop_Appointments;

use App\Models\Public_Notifications;

use App\Models\Message;
use App\Models\Conversation;

use Illuminate\Support\Facades\File;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Collection;


class CustomerController extends Controller
{
    public function welcome(){  
        if(Auth::check()){
            switch (Auth::user()->profile_status) {
                case 'deleted':
                case 'restricted':
                    return redirect()->route('customer.accountDisabled', ['status' => Auth::user()->profile_status]);
                    break;
            }            
        }
        
        $repairshopData = $this->getRepairShopSummary();
        $topRatedData = $this->getMostReviewedShops();

        if(Auth::check()){
            $province = Auth::user()->province;
            $city = Auth::user()->city;
            $barangay = Auth::user()->barangay;
            $nearShopData = $this->getNearShops($province, $city, $barangay);
            return view('Customer.1 - Homepage', [
                'repairshops' => $repairshopData,
                'topRatedData' => $topRatedData,
                'nearShopData' => $nearShopData,
            ]);
        }

        return view('Customer.1 - Homepage', [
            'repairshops' => $repairshopData,
            'topRatedData' => $topRatedData,
        ]);

    }

    public function viewcategory($category){
        if(Auth::check()){
            switch (Auth::user()->profile_status) {
                case 'deleted':
                case 'restricted':
                    return redirect()->route('customer.accountDisabled', ['status' => Auth::user()->profile_status]);
                    break;
            }            
        }

        try {
            $repairshopData = $this->getRepairShopSummary($category);
            return view('Customer.2 - ViewCategory', [
                'category' => $category,
                'repairshops' => $repairshopData,
            ]);
    
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in someFunction:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return view('Customer.ErrorMessage');
        }

    }

    public function viewshop($id){

        if(Auth::check()){
            switch (Auth::user()->profile_status) {
                case 'deleted':
                case 'restricted':
                    return redirect()->route('customer.accountDisabled', ['status' => Auth::user()->profile_status]);
                    break;
            }            
        }

        try {
            $repairshop = Technician::findOrFail($id)
                ->with(['repairshopReviews' => function ($query) {
                    $query->orderBy('created_at', 'desc')->where('status', 'Approved');
                }])->find($id);

            if(!$repairshop){
                return view('Customer.ErrorMessage');
            }

            //Repair Counter   
            $repairCount = RepairShop_RepairStatus::where('status', 'completed')->where('repairstatus', 'Device Collected')->count();
            
            // View Counter
            $sessionKey = 'shop_' . $id . '_viewed';
            $shopCredentials = RepairShop_Credentials::where('technician_id', $id)->first();
            if (!session()->has($sessionKey)) {
                // Increment the views count
                $shopCredentials->increment('shop_views');
        
                // Store in session to prevent counting again during this session
                session([$sessionKey => true]);
            }

            $shopCredentials->shopviews = $this->formatNumber($shopCredentials->shop_views);
            $shopCredentials->repairCount = $this->formatNumber($repairCount);
            // ---------------------------------------------------------------------

            // Retrieve all services from a specific repairshop
            $services = Repairshop_Services::where('technician_ID', $id)->get();

            // Exporting ratings calculation
            $reviewData = $this->reviewSystem($id);

            // Get the detailed schedule
            $detailedSchedule = $this->getDetailedSchedule($id);

            $repairshopMastery = RepairShop_Mastery::where('technician_id', $repairshop->id)->first();
            $repairshopImages = RepairShop_Images::where('technician_id', $repairshop->id)->first();
            $repairshopSocials = Repairshop_Socials::where('technician_id', $repairshop->id)->first();

            return view('Customer.3 - ViewShop', [
                'repairshop' => $repairshop,
                'services' => $services,
                'reviewData' => $reviewData,
                'detailedSchedule' => $detailedSchedule,
                'repairshopMastery' => $repairshopMastery,
                'repairshopImages' => $repairshopImages,
                'shopCredentials' => $shopCredentials,
                'repairshopSocials' => $repairshopSocials,
            ]);
    
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in someFunction:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return view('Customer.ErrorMessage');
        }

    }

    public function viewappointment($id)
    {   
        if(Auth::check()){
            switch (Auth::user()->profile_status) {
                case 'deleted':
                case 'restricted':
                    return redirect()->route('customer.accountDisabled', ['status' => Auth::user()->profile_status]);
                    break;
            }            
        }

        try {

            $technicianExist = Technician::findOrFail($id);
            if(!$technicianExist){
                return view('Customer.ErrorMessage');
            }
    
            $customerDetails = Auth::check() ? Customer::find(Auth::id()) : null;
            $technicianID = $id;
        
            return view('Customer.4 - AppointmentBooking', [
                'customerDetails' => $customerDetails,
                'technicianID' => $technicianID,
            ]);
    
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in someFunction:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return view('Customer.ErrorMessage');
        }

    }

    public function bookappointment(Request $request, $id){
        
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
                'technician_id' => $id,
                'customer_id' => Auth::user()->id,
                'status' => 'requested',
    
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
                'technician_id' => $id,
                'customer_id' => Auth::user()->id,
                'appointment_id' => $repairshopAppointments->id,
                'customer_fullname' => $fullname,

                'status' => 'pending',
                'repairstatus' => 'Appointment Requested',

                'created_at' => now(),
                'updated_at' => now(),
            ]);


            Customer_RepairStatus::create([
                'technician_id' => $id,
                'customer_id' => Auth::user()->id,
                'repair_id' => $repairshopRepairstatus->id,

                'repairstatus' => 'Appointment Requested',
                'repairstatus_message' => 'Your appointment request has been successfully submitted! We’ve received all the necessary details about your device. Our team will review your request and get back to you shortly with a confirmation of your scheduled appointment. Thank you for choosing our service, and we look forward to assisting you.',

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->logActivity('Booked An Appointment', customerId: Auth::user()->id);
            return back()->with('success', 'Appointment Booked')->with('success_message', 'Success! Your appointment has been successfully booked.');
        } catch (\Exception $e) {
            // return back()->with('error', 'Failed to book appointment: ' . $e->getMessage());
            return back()->with('error', 'Booking Failled')->with('error_message', "Sorry, there was a problem booking your appointment. Please try again");
        }


    }

        //Needs Attention
        public function cancelAppointment($repairID){
            try {

                $repairstatus = RepairShop_RepairStatus::findOrFail($repairID);
                $appointment = RepairShop_Appointments::findOrFail($repairstatus->appointment_id);
    
                if(!$repairstatus || !$appointment){
                    return view('Customer.ErrorMessage');
                }
    
                Customer_RepairStatus::create([
                    'technician_id' => $repairstatus->technician_id,
                    'repair_id' => $repairstatus->id,
                    'customer_id' => Auth::user()->id,
                    'repairstatus' => 'Appointment Cancelled',
                    'repairstatus_message' => 'The appointment request has been successfully cancelled. The repair shop has been notified of the cancellation.'
                ]);
    
                $appointment->update([
                    'status' => 'cancelled',
                ]);
    
                $repairstatus->update([
                    'repairstatus' => 'Appointment Cancelled',
                ]);

                $this->logActivity('Canceled Request Appointment', customerId: Auth::user()->id);
                return back()->with('success', 'Request Cancelled')->with('success_message','You appointment request has been cancelled successfully');
            
        
            } catch (\Exception $e) {
                // Log the error for debugging
                Log::error('Error in someFunction:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
    
                return view('Customer.ErrorMessage');
            }
    
        }

    public function viewrepairlist(){
        try {

            // Fetch repair and appointment details for the logged-in customer
            $repairDetails = RepairShop_RepairStatus::where('customer_id', Auth::user()->id)
                                ->with(['technician.repairshopCredentials']) // Eager load technician and repair shop details
                                ->with(['technician.repairshopBadges'])
                                ->with(['technician.repairshopImages'])
                                ->orderBy('created_at', 'desc')
                                ->get();

            return view('Customer.7 - Repairlist', [
                'repairDetails' => $repairDetails,
            ]);
    
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in someFunction:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return view('Customer.ErrorMessage');
        }

    }

    public function viewrepairstatus($id){
        $repairstatusData = RepairShop_RepairStatus::find($id);

        if ($repairstatusData) {
            // Check if the repair status is associated with a customer and if that customer matches the Auth ID
            if ($repairstatusData->customer_id !== null && $repairstatusData->customer_id !== Auth::id()) {
                return back()->with('error', 'Access Denied')->with('error_message','You do not have permission to view this repair status.');
            }
        
            // Fetch repair status details
            $repairstatusDetails = Customer_RepairStatus::where('repair_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
        
            foreach ($repairstatusDetails as $repairstatusDetail) {
                $repairstatusDetail->formatted_date = Carbon::parse($repairstatusDetail->created_at)->format('l, d M Y');
                $repairstatusDetail->formatted_time = Carbon::parse($repairstatusDetail->created_at)->format('g:i A');
            }
        
            // Show the view with repair status data
            return view('Customer.5 - RepairStatus', [
                'repairstatusData' => $repairstatusData,
                'repairstatusDetails' => $repairstatusDetails,
            ]);
        }
        
        // If the repair status ID does not exist
        return back()->with('error', 'Invalid Repair ID')->with('The Repair ID you entered does not exist. Please double-check and try again.');
    }

        public function submitReview(Request $request, $technicianID){
            if(Auth::check()){
                $customer = Customer::find(Auth::user()->id);
                $validatedData = $request->validate([
                    'rating' => 'required|integer',
                    'comment' => 'nullable|string|max:255',
                    'repairID' => 'required|integer'
                ]);
                RepairShop_Reviews::create([
                    'customer_id' => $customer->id,
                    'technician_id' => $technicianID,
                    'customer_fullname' => $customer->firstname,
                    'rating' => $validatedData['rating'],
                    'review_comment' => $validatedData['comment'],
                ]);
                Customer_RepairStatus::create([
                    'technician_id' => $technicianID,
                    'repair_id' => $validatedData['repairID'],
                    'customer_id' => $customer->id,
                    'repairstatus' => 'Review Submitted',
                    'repairstatus_message' => 'Thank you for taking the time to rate and review the repair shop! Your feedback helps both the shop and future customers. We truly appreciate your input and support!',
                ]);
                $this->logActivity('Review Submitted', customerId: Auth::user()->id);
                return back()->with('success', 'Review submmited successfully')->with('success_message', 'Thank you for taking the time to rate and review the repair shop!');
            }

            return redirect()->route('customer.loginCustomer');

        }

        public function submitReport(Request $request){
            Admin_ReportManagement::create([
                'user_id' => Auth::user()->id,
                'user_role' => 'Customer',
                'user_name' => $request->firstname . ' ' . $request->lastname,
                'user_email' => $request->email,
                'report_status' => 'Pending',
                'category' => $request->category,
                'sub_category' => $request->sub_category,
                'description' => $request->description
            ]);

            $this->logActivity('Report Submitted', customerId: Auth::user()->id);
            return back()->with('success', 'Report Submitted')->with('success_message', 'Your report has been submitted successfully.');
        }

    public function myaccount(){
        try {

            $customerData = Customer::find(Auth::user()->id);
            $customerNotification = Customer_Notifications::where('target_id', Auth::user()->id)
                ->orWhere('target_type', 'all')
                ->orderBy('created_at', 'desc')
                ->get();
        
            $publicNotification = Public_Notifications::all();
            
            // Merge collections
            $allNotifications = $customerNotification->concat($publicNotification);
            
            // Optionally, sort by created_at if you want a unified order:
            $allNotifications = $allNotifications->sortByDesc('created_at');

            // Check if there are any unread notifications
            $hasUnreadNotifications = $customerNotification->contains('is_read', false);

            return view('Customer.6 - Account', [
                'customerData' => $customerData,
                'allNotifications' => $allNotifications,
                'hasUnreadNotifications' => $hasUnreadNotifications,
            ]);
    
            return redirect()->route('customer.loginCustomer');;
    
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in someFunction:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return view('Customer.ErrorMessage');
        }

    }

        public function myaccountUpdate(Request $request, $actionType, $customerID){
            
            $customer = Customer::findOrFail($customerID);

            if(!$customer){
                return view('Customer.ErrorMessage');
            }

            if($actionType == 'upload'){
                $request->validate([
                    'image' => 'required|mimes:png,jpg,jpeg,webp'
                ]);
                
                if($request->hasFile('image')) {  // Check if a new image is uploaded
                    // Get the new file and extension
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension(); 
                    
                    // Define the new filename and path
                    $filename = time() . '.' . $extension;  
                    $path = 'uploads/customer/';
                    
                    // Check if the customer has an existing image and delete it
                    if($customer->image_profile) {
                        $oldImagePath = public_path($customer->image_profile);
                        
                        if(File::exists($oldImagePath)) {
                            File::delete($oldImagePath); // Delete the old image
                        }
                    }
                    
                    // Move the new file to the directory and append filename to the path
                    $file->move($path, $filename);
                    
                    // Full path to be stored in the database
                    $imagePath = $path . $filename;
                
                    // Update the customer's profile with the new image
                    $customer->update([
                        'image_profile' => $imagePath,
                    ]);
                }
            }elseif($actionType == 'delete'){
                    // Check if the customer has an existing image and delete it
                    if($customer->image_profile) {
                        $oldImagePath = public_path($customer->image_profile);
                        
                        if(File::exists($oldImagePath)) {
                            File::delete($oldImagePath); // Delete the old image
                        }
                    }

                    // Update the customer's profile with the new image
                    $customer->update([
                        'image_profile' => null,
                    ]);
            }elseif($actionType == 'update'){

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
                    if (!Hash::check($request->current_password, $customer->password)) {
                        return back()->with('error', 'Password Change Failed')->with('error_message', 'The current password you entered is incorrect. Please try again.');
                    }

                    // Ensure the new password is different from the current password
                    if (Hash::check($request->new_password, $customer->password)) {
                        return back()->with('error', 'Password Change Failed')->with('error_message', 'The new password cannot be the same as the current password.');
                    }

                    // Update password in a transaction for data integrity
                    DB::transaction(function () use ($customer, $request) {
                        $customer->password = Hash::make($request->new_password);
                        $customer->save();
                    });

                    // Redirect with success message
                    $this->logActivity('Password Changed', customerId: Auth::user()->id);
                    return back()->with('success', 'Password Changed')->with('success_message', 'Your password has been changed successfully.');

                }

                // If confirm and new password has value but the current password do not. Return error
                if($request->new_password || $request->new_password_confirmation && $request->current_password == null){
                    return back()->with('error', 'Password Change Failed')->with('error_message', 'Please ensure you entered your current password.');
                }

                $validatedData = $request->validate([
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                ]);

                $customer->update([
                    'firstname' => $validatedData['first_name'],
                    'lastname' => $validatedData['last_name'],
                    'email' => $validatedData['email']
                ]);

            }

            $this->logActivity('Profile Updated', customerId: Auth::user()->id);
            return back()->with('success', 'Profile Updated')->with('success_message', 'Your profile information has been successfully updated.');

        }

        public function myaccountDelete($customerID){
            $customer = Customer::findOrFail($customerID);

            if(!$customer){
                return back()->with('error', 'Deletion Failed')
                ->with('error_message', 'Unable to delete the account. Customer account not found.');
            }
            
            $repairExist = RepairShop_RepairStatus::where('customer_id', $customer->id)
                ->where('status', 'in progress')
                ->exists();
            $appointmentExist = RepairShop_Appointments::where('customer_id', $customer->id)
                ->whereIn('status', ['requested', 'confirmed'])
                ->exists();

            if($repairExist || $appointmentExist){
                $this->logActivity('Account Deletion Requested', customerId: Auth::user()->id);
                return back()->with('error', 'Deletion Failed')->with('error_message', 'Your account cannot be deleted at this time due to pending appointments or ongoing repairs. Please complete or cancel any active engagements before proceeding with account deletion.');
            }

            $customer->update([
                'profile_status' => 'deleted',
            ]);
            
            $this->logActivity('Account Deleted', customerId: Auth::user()->id);
            return redirect()->route('customer.accountDisabled', ['status' => 'deleted'])->with("message", "Your account has been successfully deleted. We're sorry to see you go and hope to serve you again in the future.");
        }

    public function notificationUpdate($notificationID){
        $notification = Customer_Notifications::find($notificationID);
        $repairstatus =
        $notification->update([
            'is_read' => true,
        ]);
        return response()->json(['message' => 'Notification updated successfully'], 200);
    }

    public function messages(){
        return view('Customer.8 - Messages');
    }

    public function messageRepairshop($repairshopID){
        if(Auth::check()){
            $conversation = Conversation::where('receiver_id', $repairshopID)
            ->where('sender_id', Auth::user()->id)
            ->first();

            if ($conversation) {
                $conversation->touch();
            } else {
                Conversation::create([
                    'sender_id' => Auth::user()->id,
                    'sender_type' => 'customer',
                    'receiver_id' => $repairshopID,
                    'receiver_type' => 'technician'
                ]); 
                $this->logActivity('Initialized A Conversation', customerId: Auth::user()->id);
            }
            return view('Customer.8 - Messages');
            
        }
        return redirect()->route('customer.loginCustomer');
    }

    public function disabledAccount($status){
        if(Auth::check()){
            Auth::logout();
            return view('Customer.9 - DisabledAccount', [
                'status' => $status
            ]);            
        }
        return redirect()->route('customer.loginCustomer');
    }

    public function viewFavorites(){
        $repairshopData = $this->getFavoriteShops(Auth::user()->id);
        return view('Customer.15 - ViewFavorites', [
            'repairshops' => $repairshopData,
        ]);
    }

    public function favorites($technicianID){

        try {
            $favorite = Customer_Favorite::where('customer_id', Auth::user()->id)
            ->where('technician_id', $technicianID)
            ->first();
        
            if ($favorite) {
                // If the favorite exists, delete it (remove from favorites)
                $favorite->delete();
                return response()->json(['message' => 'Repairshop removed from favorites'], 200);
            } else {
                // If the favorite does not exist, create it (add to favorites)
                Customer_Favorite::create([
                    'customer_id' => Auth::user()->id,
                    'technician_id' => $technicianID
                ]);
                return response()->json(['message' => 'Repairshop added to favorites'], 200);
            }

            return redirect()->route('customer.loginCustomer');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function submitInquiries(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $emailBody = "You have received a new inquiry:\n\n" .
                     "Name: {$request->firstname} {$request->lastname}\n" .
                     "Email: {$request->email}\n" .
                     "Message:\n{$request->message}";


        // Send email
        Mail::raw($emailBody, function ($message) use ($request) {
            $message->to('techxpertz.tech@gmail.com')
                    ->subject('New Inquiry from ' . $request->firstname . $request->lastname);
        });

        return back()->with('success', 'Inquiry sent successfully!')->with('success_message', 'Your inquiry has been successfully sent. We will get back to you soon.');
    }
    
    // PRIVATE FUNCTIONS ---------

    private function getRepairShopSummary($category = null){

        if (empty($category) || $category == "All"){
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

                    'repairshopMastery' => $repairshop->repairshopMastery->main_mastery,

                    'repairshopImage' => $repairshop->repairshopImages->image_profile,

                    'formattedDays' => $formattedDays,
                    'totalReviews' => $totalReviews,
                    'averageRating' => $averageRating,
                ];
            }
    
            return $repairshopData;
        } else {

            foreach(['Smartphone', 'Tablet', 'Desktop', 'Laptop', 'Smartwatch', 'Camera', 'Printer', 'Speaker', 'All-In-One'] as $existingCategory) {
                if (!RepairShop_Mastery::where($category, $existingCategory)->exists()) {
                    return view('Customer.ErrorMessage');
                }
            }

            //Getting all the data that has the specific category (e.g., 'Smartphones')
            $repairshopCategory = RepairShop_Mastery::where('main_mastery', $category)->get();

            //Extracting all the technician IDs from the retrieved category
            $technicianIDs = $repairshopCategory->pluck('technician_id');

            // Getting all the technicians that match the IDs in the specified category
            $repairshops = Technician::whereIn('id', $technicianIDs)
                ->where('profile_status', 'complete')
                ->get();

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

                    'repairshopMastery' => $repairshop->repairshopMastery->main_mastery,

                    'repairshopImage' => $repairshop->repairshopImages->image_profile,

                    'formattedDays' => $formattedDays,
                    'totalReviews' => $totalReviews,
                    'averageRating' => $averageRating,
                ];
            }

            return $repairshopData;
        }

    }

    private function getFavoriteShops($customerID){
        // Fetch favorite technician IDs for the customer
        $favoriteTechnicianIds = Customer_Favorite::where('customer_id', $customerID)
            ->pluck('technician_id');
    
        // Fetch all favorite technicians with their related data in one query
        $technicians = Technician::with([
            'repairshopCredentials',
            'repairshopMastery',
            'repairshopBadges',
            'repairshopImages',
        ])->whereIn('id', $favoriteTechnicianIds)->get();
    
        $repairshopData = [];
        foreach ($technicians as $repairshop) {
            // Get the formatted schedule
            $formattedDays = $this->getFormattedSchedule($repairshop->id);
    
            // Get review data for the specific technician
            $reviewData = $this->reviewSystem($repairshop->id);
            $totalReviews = $reviewData['totalReviews'];
            $averageRating = $reviewData['averageRating'];
    
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
    
                'repairshopMastery' => $repairshop->repairshopMastery->main_mastery,
    
                'repairshopImage' => $repairshop->repairshopImages->image_profile,
    
                'formattedDays' => $formattedDays,
                'totalReviews' => $totalReviews,
                'averageRating' => $averageRating,
            ];
        }
    
        return $repairshopData;
    }
    

    private function getMostReviewedShops(){
        // Fetch unique technician IDs from the reviews table
        $reviewedTechnicians = DB::table('repairshop_reviews')
            ->select('technician_id')
            ->distinct()
            ->get();
    
        $repairshopData = [];
        foreach ($reviewedTechnicians as $reviewedTechnician) {
            // Fetch the technician details
            $technician = Technician::find($reviewedTechnician->technician_id);
    
            if (!$technician) {
                continue; // Skip if technician not found
            }
    
            // Get the formatted schedule
            $formattedDays = $this->getFormattedSchedule($technician->id);
    
            // Get review data of specific technician using reviewSystem()
            $reviewData = $this->reviewSystem($technician->id);
            $totalReviews = $reviewData['totalReviews'];
            $averageRating = $reviewData['averageRating'];
    
            // Define criteria for being "top-rated"
            $isTopRated = $averageRating >= 4.5 && $totalReviews > 10;
    
            $repairshopData[] = [
                'repairshopID' => $technician->id,
                'repairshopName' => $technician->repairshopCredentials->shop_name,
                'repairshopContact' => $technician->repairshopCredentials->shop_contact,
                'repairshopMMastery' => $technician->repairshopMastery->main_mastery,
                'repairshopAddress' => $technician->repairshopCredentials->shop_address,
                'repairshopProvince' => $technician->repairshopCredentials->shop_province,
                'repairshopCity' => $technician->repairshopCredentials->shop_city,
                'repairshopBarangay' => $technician->repairshopCredentials->shop_barangay,
    
                'repairshopBadge1' => $technician->repairshopBadges->badge_1,
                'repairshopBadge2' => $technician->repairshopBadges->badge_2,
                'repairshopBadge3' => $technician->repairshopBadges->badge_3,
                'repairshopBadge4' => $technician->repairshopBadges->badge_4,
    
                'repairshopMastery' => $technician->repairshopMastery->main_mastery,
                'repairshopImage' => $technician->repairshopImages->image_profile,
    
                'formattedDays' => $formattedDays,
                'totalReviews' => $totalReviews,
                'averageRating' => $averageRating,
                'isTopRated' => $isTopRated, // New flag for "top-rated"
            ];
        }
    
        // Sort repairshops by totalReviews in descending order
        usort($repairshopData, function ($a, $b) {
            return $b['totalReviews'] - $a['totalReviews'];
        });
    
        return $repairshopData;
    }
    
    private function getNearShops($province, $city, $barangay){
        // Fetch all repair shop credentials matching the given location
        $nearShops = RepairShop_Credentials::where('shop_province', $province)
            ->orWhere('shop_city', $city)
            ->orWhere('shop_barangay', $barangay)
            ->get();
    
        // Fetch related technicians in one go
        $technicianIds = $nearShops->pluck('technician_id');
        $technicians = Technician::with([
            'repairshopCredentials',
            'repairshopMastery',
            'repairshopBadges',
            'repairshopImages',
        ])->whereIn('id', $technicianIds)->get();
    
        $repairshopData = [];
        foreach ($technicians as $repairshop) {
            // Get the formatted schedule
            $formattedDays = $this->getFormattedSchedule($repairshop->id);
    
            // Get review data of specific technician with needed variables
            $reviewData = $this->reviewSystem($repairshop->id);
            $totalReviews = $reviewData['totalReviews'];
            $averageRating = $reviewData['averageRating'];
    
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
    
                'repairshopMastery' => $repairshop->repairshopMastery->main_mastery,
    
                'repairshopImage' => $repairshop->repairshopImages->image_profile,
    
                'formattedDays' => $formattedDays,
                'totalReviews' => $totalReviews,
                'averageRating' => $averageRating,
            ];
        }
    
        return $repairshopData;
    }

    public function searchRepairShops(Request $request){
        $query = $request->input('query');
        $repairshopData = [];

        if($query){
            
            $technicians = Technician::whereHas('repairshopCredentials', function ($q) use ($query) {
                $q->where('shop_name', 'LIKE', "%$query%")
                  ->orWhere('shop_address', 'LIKE', "%$query%")
                  ->orWhere('shop_province', 'LIKE', "%$query%")
                  ->orWhere('shop_city', 'LIKE', "%$query%")
                  ->orWhere('shop_barangay', 'LIKE', "%$query%");
            })
            ->orWhereHas('repairshopBadges', function ($q) use ($query) {
                $q->where('badge_1', 'LIKE', "%$query%")
                  ->orWhere('badge_2', 'LIKE', "%$query%")
                  ->orWhere('badge_3', 'LIKE', "%$query%")
                  ->orWhere('badge_4', 'LIKE', "%$query%");
            })
            ->orWhereHas('repairshopMastery', function ($q) use ($query) {
                $q->where('main_mastery', 'LIKE', "%$query%");
            })

            ->with(['repairshopCredentials', 'repairshopBadges', 'repairshopMastery', 'repairshopImages'])
            ->get();

            foreach ($technicians as $repairshop) {
                // Get formatted schedule data (reusing your method)
                $formattedDays = $this->getFormattedSchedule($repairshop->id);

                // Get review data
                $reviewData = $this->reviewSystem($repairshop->id);
                $totalReviews = $reviewData['totalReviews'];
                $averageRating = $reviewData['averageRating'];

                // Build the data array
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

                    'repairshopMastery' => $repairshop->repairshopMastery->main_mastery,

                    'repairshopImage' => $repairshop->repairshopImages->image_profile,

                    'formattedDays' => $formattedDays,
                    'totalReviews' => $totalReviews,
                    'averageRating' => $averageRating,
                ];
            }
        }

        return view('Customer.16 - SearchResult', [
            'repairshops' => $repairshopData,
        ]);
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
        $ratings = RepairShop_Reviews::where('technician_id', $id)->where('Status', 'Approved')->pluck('rating')->toArray();

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

    function logActivity($action, $customerId = null, $status = 'success')
    {
        // Define a collection of actions and their descriptions
        $actions = collect([
            'Account Created' => 'Customer successfully created a new account.',
            'Logged In' => 'Customer logged into their account.',
            'Logged Out' => 'Customer logged out of their account.',
            'Password Changed' => 'Customer updated their account password.',
            'Reset Password' => 'Customer reset their account password.',
            'Profile Updated' => 'Customer updated their profile information.',
            'Account Deletion Requested' => 'Customer initiated a request to delete their account.',
            'Account Deleted' => 'Customer\'s account was permanently deleted.',
            'Booked An Appointment' => 'Customer booked a new appointment.',
            'Cancelled Request Appointment' => 'Customer canceled an appointment request.',
            'Cancelled Scheduled Appointment' => 'Customer canceled an existing appointment.',
            'Review Submitted' => 'Customer submitted a review for a repair shop.',
            'Report Submitted' => ' Customer reported an issue.',
            'Initialized A Conversation' => 'Customer started a new conversation with a repair shop.',
        ]);

        // Retrieve the description based on the action
        $description = $actions->get($action, 'Unknown action');

        // Create a new activity log entry
        Admin_ActivityLogs::create([
            'customer_id' => $customerId,
            'action' => $action,
            'description' => $description,
            'status' => $status,
            'ip_address' => RequestFacade::ip(),
        ]);
    }

    public function formatNumber($number){
        if ($number >= 1000) {
            // Convert number to K notation
            $formatted = number_format($number / 1000, ($number % 1000 === 0 ? 0 : 1)) . 'k';
        } else {
            // If number is below 1000, just return the number as it is
            $formatted = $number;
        }
        
        return $formatted;
    }

}
