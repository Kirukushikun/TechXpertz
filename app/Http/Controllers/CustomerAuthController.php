<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CustomerAuthController extends Controller
{   
    public function login(){
        return view('Customer.0 - Login');
    }
    public function loginCustomer(Request $request){
        // $credentials = $request->only('email', 'password');
        // if(Auth::attempt($credentials)){
        //     return redirect()->route('welcome');
        // }else{
        //     return redirect(route('customer.login'))->with("error", "Incorrect email or password.");
        // }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember_me'); // Check if 'Remember Me' is checked

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended(route('welcome'));
        } else {
            // Authentication failed, redirect back with an error message
            return back()->with('error', 'Incorrect email or password.');
        }
    }
    function logoutCustomer(){
        Session::flush();
        Auth::logout();
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
    

}
