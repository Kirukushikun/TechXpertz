<?php

namespace App\Http\Controllers;

use App\Models\Admin;

use App\Models\Admin_ActivityLogs;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Collection;

use App\Models\Customer;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\Verified;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class CustomerAuthController extends Controller
{   
    public function login(){
        return view('Customer.0 - Login');
    }
    public function loginCustomer(Request $request){

        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember_me');

        // Fetch the user by email to check the account status
        $customer = Customer::where('email', $request->email)->first();

        // Check if the user exists
        if ($customer) {
            // Check the account status
            if ($customer->profile_status === 'pending') {
                return back()->with('error', 'Your account is not yet verified.');
            }

            // If the account is verified, attempt login
            if (Auth::guard('web')->attempt($credentials, $remember)) {
                $this->logActivity('Logged In', customerId: Auth::user()->id);
                return redirect()->intended(route('welcome'));
            }
        }

        // Authentication failed, redirect back with an error message
        return back()->with('error', 'Incorrect email or password.');
    }

    function logoutCustomer(){
        $this->logActivity('Logged Out', customerId: Auth::user()->id);
        Auth::logout();
        Session::flush();
        return redirect()->intended(route('customer.login'));
    }

    public function signup(){
        return view('Customer.0 - Registration');
    }

    function signupCustomer(Request $request){
        $email = $request->email;
        $password = $request->password;
        $confirm = $request->cpassword;

        $existsInCustomer = Customer::where('email', $email)->exists();
        $existsInTechnician = Technician::where('email', $email)->exists();
        $existsInAdmin = Admin::where('email', $email)->exists();
    
        if($password === $confirm){

            if($existsInCustomer || $existsInTechnician || $existsInAdmin){
                return redirect(route('customer.signup'))->with("error", "Email already exists. Please use a different email address.");
            }else{
                $data['firstname'] = $request->firstname;
                $data['lastname'] = $request->lastname;
                $data['email'] = $request->email;
                $data['password'] = Hash::make($request->cpassword);
                $data['contact'] = $request->contact;
                $data['province'] = $request->province;
                $data['city'] = $request->city_municipality;
                $data['barangay'] = $request->barangay;
        
                try {
                    $user = Customer::create([
                        'profile_status' => 'pending',
                        'firstname' => $data['firstname'],
                        'lastname' => $data['lastname'],

                        'email' => $data['email'],
                        'contact' => $data['contact'],

                        'province' => $data['province'],
                        'city' => $data['city'],
                        'barangay' => $data['barangay'],

                        'password' => $data['password'],
                    ]);


                    $this->logActivity('Account Created', customerId: $user->id);

                    return redirect()->route('customer.verify', [
                        'email' => $data['email']
                    ]);

                } catch (\Illuminate\Database\QueryException $exception) {
                    if ($exception->errorInfo[1] === 1062) {
                        return redirect(route('customer.signup'))->with("error", "Email already exists. Please use a different email address.");
                    }
                    return redirect(route('customer.signup'))->with("error", "An error occurred. Please try again later.");
                }                
            }

        } else {
            return redirect(route('customer.signup'))->with("error", "Passwords do not match. Please try again.");
        }
        
    }

    public function changePassword(Request $request){
        // Validation
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // 'confirmed' ensures password matches confirmation
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Get the currently authenticated customer
        $customer = Auth::guard('customer')->user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $customer->password)) {
            return back()->with('error', 'Your current password is incorrect.');
        }

        // Update password in a transaction for data integrity
        DB::transaction(function () use ($customer, $request) {
            $customer->password = Hash::make($request->new_password);
            $customer->save();
        });

        // Redirect with success message
        $this->logActivity('Password Changed', customerId: $customer->id);
        return back()->with('status', 'Password changed successfully.');
    }
    
    public function forgot(){
        return view('Customer.0 - Forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $email = $request->validate(['email' => 'required|email']);

        // Check if the email exists in the customers table
        $isEmailExist = Customer::where('email', $email['email'])->exists();
        if (!$isEmailExist) {
            return back()->with('error', 'Email not yet registered');
        }

        // Send the reset link to the given email
        $status = Password::broker('customers')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetForm(){
        return view('Customer.0 - ResetPassword');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $status = Password::broker('customers')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('customer.login')->with('success', __($status))
            : back()->withErrors(['error' => __($status)]);
    }

    public function verify($email)
    {   
        // Retrieve the customer using the email
        $customer = Customer::where('email', $email)->firstOrFail();

        if($customer->profile_status == 'verified'){

            // If the account is already verified, return the view with a status message
            return view('Customer.0 - Verify')->with([
                'email' => $email,
                'status' => 'Account already verified',
            ]);

        }else{

            // Generate a signed URL valid for 24 hours
            $verificationUrl = URL::signedRoute('customer.verifyAccountEmail', ['email' => $email]);
        
            // Send the verification email
            Mail::to($email)->send(new VerifyEmail($verificationUrl));
        
            return view('Customer.0 - Verify', ['email' => $email]);
        }


    }

    public function verifyAccountEmail(Request $request)
    {
        // Validate signed URL
        if (!$request->hasValidSignature()) {
            abort(403, 'Invalid or expired verification link.');
        }
    
        // Retrieve the customer using the email
        $customer = Customer::where('email', $request->email)->firstOrFail();
        
        // if($customer->email == "verified"){
        //     // Redirect to login with success message
        //     return redirect()->route('customer.login')->with('success', 'Account already verified.');
        // }

        // Update the profile status and email_verified_at
        $customer->update([
            'profile_status' => 'verified',
            'email_verified_at' => now(),
        ]);
    
        // Redirect to login with success message
        return redirect()->route('customer.login')->with('success', 'Account verified successfully.');
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
    

}
