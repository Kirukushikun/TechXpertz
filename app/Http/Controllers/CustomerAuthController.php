<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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

        // Attempt to log in with the given credentials and remember option
        if (Auth::guard('web')->attempt($credentials, $remember)) {
            return redirect()->intended(route('welcome'));
        }

        // Authentication failed, redirect back with an error message
        return back()->with('error', 'Incorrect email or password.');
    }

    function logoutCustomer(){
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
        
                try {
                    $user = Customer::create($data);
                    return redirect()->intended(route('customer.login'))->with('success', 'Account created successfully.');
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

    public function verify(Request $request, $id, $hash)
    {
        $user = Customer::findOrFail($id);

        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return redirect('/')->withErrors(['error' => 'Invalid verification link.']);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/')->with('status', 'Email already verified.');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect('/')->with('status', 'Email verified!');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'Verification link sent!');
    }

}
