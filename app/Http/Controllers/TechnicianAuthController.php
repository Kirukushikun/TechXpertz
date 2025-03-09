<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Technician;
use App\Models\Customer;
use App\Models\RepairShop_Credentials;
use App\Models\RepairShop_Schedules;
use App\Models\RepairShop_Images;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\Verified;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Admin_ActivityLogs;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Mail\VerifyEmailTechnician;

class TechnicianAuthController extends Controller
{
    public function login(){
        return view('Technician.0 - Login');
    }

    public function loginTechnician(Request $request){
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember_me');


        if(Auth::guard('technician')->attempt($credentials, $remember)){
            $this->logActivity('Logged In', technicianId: Auth::guard('technician')->user()->id);
            return redirect()->route('technician.dashboard');
        } else {
            return redirect()->route('technician.login')->with("error", "Invalid email or password. Please re-enter.");
        }
    }

    function logoutTechnician(){
        $this->logActivity('Logged Out', technicianId: Auth::guard('technician')->user()->id);
        Session::flush();
        Auth::guard('technician')->logout();
        return redirect()->route('technician.login');
    }

    public function signup(){
        return view('Technician.0 - Registration');
    }

    public function signupTechnician(Request $request){
        try {
            // Validate the input data
            $validatedData = $request->validate([
                'firstname' => 'required|string|max:255',
                'middlename' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'contact_no' => 'required|string|max:255',
                'educational_background' => 'required|string|max:255',
                'date_of_birth' => 'required|date',

                'province' => 'required|string|max:255',
                'city_municipality' => 'required|string|max:255',
                'barangay' => 'required|string|max:255',
                'zip_code' => 'required|string|max:255',
                
                'password' => 'required|string|min:8|confirmed',

                'shop_name' => 'required|string|max:255',
                'shop_email' => 'required|string|email|max:255',
                'shop_contact' => 'required|string|max:255',
                'shop_address' => 'required|string|max:255',
                'shop_province' => 'required|string|max:255',
                'shop_city' => 'required|string|max:255',
                'shop_barangay' => 'required|string|max:255',
                'shop_zip_code' => 'required|string|max:255',
            ]);

            $email = $validatedData['email'];
            $shopEmail = $validatedData['shop_email'];
            $rehashedPassword = Hash::make($validatedData['password']);

            // Check if the email exists in any of the user tables
            $existsInCustomer = Customer::where('email', $email)->exists();
            $existsInTechnician = Technician::where('email', $email)->exists();
            $existsInAdmin = Admin::where('email', $email)->exists();

            if ($existsInCustomer || $existsInTechnician || $existsInAdmin) {
                return redirect()->back()->with("error", "Registration Error")
                    ->with('error_message', 'The email address you entered is already registered. Please use a different email.');
            }

            // Check for duplicate shop email
            $shopEmailExists = RepairShop_Credentials::where('shop_email', $shopEmail)->exists();
            if ($shopEmailExists) {
                return redirect()->back()->with("error", "Registration Error")
                    ->with('error_message', 'The shop email address is already registered. Please use a different email.');
            }

            // Create the technician record
            $technician = Technician::create([
                'profile_status' => 'incomplete',
                'firstname' => $validatedData['firstname'],
                'middlename' => $validatedData['middlename'],
                'lastname' => $validatedData['lastname'],
                'email' => $email,
                'contact_no' => $validatedData['contact_no'],
                'educational_background' => $validatedData['educational_background'],
                'province' => $validatedData['province'],
                'city' => $validatedData['city_municipality'],
                'barangay' => $validatedData['barangay'],
                'zip_code' => $validatedData['zip_code'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'password' => $rehashedPassword,
            ]);

            // Create repair shop credentials
            RepairShop_Credentials::create([
                'technician_id' => $technician->id,
                'shop_name' => $validatedData['shop_name'],
                'shop_email' => $shopEmail,
                'shop_contact' => $validatedData['shop_contact'],
                'shop_address' => $validatedData['shop_address'],
                'shop_province' => $validatedData['shop_province'],
                'shop_city' => $validatedData['shop_city'],
                'shop_barangay' => $validatedData['shop_barangay'],
                'shop_zip_code' => $validatedData['shop_zip_code'],
            ]);

            // Create repair shop schedules
            foreach ([1, 2, 3, 4, 5, 6, 7] as $day) {
                RepairShop_Schedules::create([
                    'technician_id' => $technician->id,
                    'day' => $day,
                ]);
            }

            // Create repair shop images
            RepairShop_Images::create([
                'technician_id' => $technician->id,
                'gallery_status' => 'Active',
                'image_profile' => null,
                'image_2' => null,
                'image_3' => null,
                'image_4' => null,
                'image_5' => null,
            ]);

            // Log activity
            $this->logActivity('Account Created', technicianId: $technician->id);

            return redirect()->route('technician.verify', [
                'email' => $email
            ]);

        } catch (\Illuminate\Database\QueryException $exception) {
            return redirect()->route('technician.signup')->with("error", "Error Occurred")->with('error_message', 'An error occurred while processing your request. Please try again');
        }
    }   


    public function forgot(){
        return view('Technician.0 - Forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $email = $request->validate(['email' => 'required|email']);

        // Check if the email exists in the customers table
        $isEmailExist = Technician::where('email', $email['email'])->exists();
        if (!$isEmailExist) {
            return back()->with('error', 'Email not yet registered');
        }

        // Send the reset link to the given email
        $status = Password::broker('technicians')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetForm(){
        return view('Technician.0 - ResetPassword');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $status = Password::broker('technicians')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        // if($status === Password::PASSWORD_RESET){
        //     $technician = Technician::where('email', $request->email)->firstOrFail();
        //     $this->logActivity('Reset Password', technicianId: $technician->id);
        // }
        
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('technician.login')->with('success', __($status))
            : back()->withErrors(['error' => __($status)]);
            
    }

    public function verify($email)
    {   
        // Retrieve the customer using the email
        $technician = Technician::where('email', $email)->firstOrFail();

        if($technician->email_verified_at != null){

            // If the account is already verified, return the view with a status message
            return view('Technician.0 - Verify')->with([
                'email' => $email,
                'status' => 'Account already verified',
            ]);

        }else{

            // Generate a signed URL valid for 24 hours
            $verificationUrl = URL::signedRoute('technician.verifyAccountEmail', ['email' => $email]);
        
            // Send the verification email
            Mail::to($email)->send(new VerifyEmailTechnician($verificationUrl));
        
            return view('Technician.0 - Verify', ['email' => $email]);
        }

    }

    public function verifyAccountEmail(Request $request)
    {
        // Validate signed URL
        if (!$request->hasValidSignature()) {
            abort(403, 'Invalid or expired verification link.');
        }
    
        // Retrieve the technician using the email
        $technician = Technician::where('email', $request->email)->firstOrFail();
        
        if($technician->email == "verified"){
            // Redirect to login with success message
            return redirect()->route('technician.login')->with('success', 'Account already verified.');
        }

        // Update the email_verified_at
        $technician->update([
            'email_verified_at' => now(),
        ]);
    
        // Redirect to login with success message
        return redirect()->route('technician.login')->with('success', 'Account verified successfully.');
    }


    function logActivity($action, $technicianId = null, $status = 'success')
    {
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
            'Cancelled Requested Appointment' => 'Technician canceled a requested appointment.',
            'Cancelled Scheduled Appointment' => 'Technician canceled a scheduled appointment.',
            'Completed An Appointment' => 'Technician completed an appointment.',

            'Started A Repair' => 'Technician began a repair.',
            'Repair Updated' => 'Technician updated the repair status.',
            'Repair Terminated' => 'Technician terminated a repair.',
            'Repair Completed' => 'Technician completed a repair.',

            'Initialized A Conversation' => 'Technician started a new conversation with a customer.',
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



}
