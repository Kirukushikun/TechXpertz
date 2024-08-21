<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerAuthController extends Controller
{   
    public function login(){
        return view('Customer.0 - Login');
    }
    public function loginCustomer(Request $request){
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->route('welcome');
        }else{
            return redirect(route('customer.login'))->with("error", "Invalid email or password. Please re-enter");
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
    public function signupCustomer(Request $request){
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = $validatedData['email'];

        // Check if the email exists in any of the user tables
        $existsInCustomer = Customer::where('email', $email)->exists();
        $existsInTechnician = Technician::where('email', $email)->exists();
        // $existsInAdmin = Admin::where('email', $email)->exists();

        // If email is found in any table, return with an error
        // ($existsInCustomer || $existsInTechnician || $existsInAdmin)

        if ($existsInCustomer || $existsInTechnician) {
            return redirect()->back()->withErrors(['email' => 'This email is already registered.']);
        }

        try {
            // Create the new customer
            $customer = Customer::create([
                'firstname' => $validatedData['firstname'],
                'lastname' => $validatedData['lastname'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Redirect to the login page after successful signup
            return redirect()->route('customer.login');
        } catch (\Illuminate\Database\QueryException $exception) {
            // Handle duplicate entry error
            if ($exception->errorInfo[1] === 1062) {
                return redirect(route('customer.signup'))->with("error", "Email already exists. Please use a different email address.");
            }

            // Handle any other errors
            return redirect(route('customer.signup'))->with("error", "An error occurred. Please try again later.");
        }
    }

}
