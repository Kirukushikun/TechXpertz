<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\Customer;
use App\Models\RepairShop_Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TechnicianAuthController extends Controller
{
    public function login(){
        return view('Technician.0 - Login');
    }

    public function loginTechnician(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::guard('technician')->attempt($credentials)){
            return redirect()->route('technician.dashboard');
        } else {
            return redirect()->route('technician.login')->with("error", "Invalid email or password. Please re-enter.");
        }
    }

    function logoutTechnician(){
        Session::flush();
        Auth::logout();
        return redirect()->intended(route('technician.login'));
    }

    public function signup(){
        return view('Technician.0 - Registration');
    }

    public function signupTechnician(Request $request){
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:technicians',
            'contact_no' => 'required|string|max:255',
            'educational_background' => 'required|string|max:255',
            'date_of_birth' => 'required|date',

            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            
            'username' => 'required|string|max:255|unique:technicians',
            'password' => 'required|string|min:8|confirmed',

            'shop_name' => 'required|string|max:255',
            'shop_email' => 'required|string|max:255',
            'shop_contact' => 'required|string|max:255',
            'shop_address' => 'required|string|max:255',
            'shop_province' => 'required|string|max:255',
            'shop_city' => 'required|string|max:255',
            'shop_barangay' => 'required|string|max:255',
            'shop_zip_code' => 'required|string|max:255',
        ]);

        $email = $validatedData['email'];
        $rehashed = Hash::make($validatedData['password']);

        // Check if the email exists in any of the user tables
        $existsInCustomer = Customer::where('email', $email)->exists();
        $existsInTechnician = Technician::where('email', $email)->exists();
        $existsInAdmin = Admin::where('email', $email)->exists();

        // If email is found in any table, return with an error
        // ($existsInCustomer || $existsInTechnician || $existsInAdmin)
        
        if ($existsInCustomer || $existsInTechnician || $existsInAdmin) {
            return redirect()->back()->withErrors(['email' => 'This email is already registered.']);
        }

        try {
            $technician = Technician::create([
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
                'username' => $validatedData['username'],
                'password' => $rehashed,
            ]);
            $repairshop = RepairShop_Credentials::create([
                'technician_id' => $technician->id,
                'shop_name' => $validatedData['shop_name'],
                'shop_email' => $validatedData['shop_email'],
                'shop_contact' => $validatedData['shop_contact'],
                'shop_address' => $validatedData['shop_address'],
                'shop_province' => $validatedData['shop_province'],
                'shop_city' => $validatedData['shop_city'],
                'shop_barangay' => $validatedData['shop_barangay'],
                'shop_zip_code' => $validatedData['shop_zip_code'],
            ]);
            return redirect()->route('technician.login');
        } catch (\Illuminate\Database\QueryException $exception) {
            if ($exception->errorInfo[1] === 1062) {
                return redirect()->route('technician.signup')->with("error", "Email or username already exists. Please use a different one.");
            }
            return redirect()->route('technician.signup')->with("error", "An error occurred. Please try again later.");
        }
    }   
}
