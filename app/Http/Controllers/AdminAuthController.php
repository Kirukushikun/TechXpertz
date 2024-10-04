<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Technician;
use App\Models\Customer;
use App\Models\RepairShop_Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function login(){
        return view('Admin.0 - Login');
    }

    public function loginAdmin(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credentials)){
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with("error", "Invalid email or password. Please re-enter.");
        }
    }

    public function signup(){
        return view('Admin.0 - Registration');
    }

    public function signupAdmin(Request $request){
        $email = $request->email;
        $password = $request->password;
        $confirm = $request->cpassword;

        $existsInCustomer = Customer::where('email', $email)->exists();
        $existsInTechnician = Technician::where('email', $email)->exists();
        $existsInAdmin = Admin::where('email', $email)->exists();
    
        if($password === $confirm){

            if($existsInCustomer || $existsInTechnician || $existsInAdmin){
                return redirect()->back()->with("error", "Email already exists. Please use a different email address.");
            }else{
                $data['firstname'] = $request->firstname;
                $data['lastname'] = $request->lastname;
                $data['email'] = $request->email;
                $data['password'] = Hash::make($request->cpassword);
        
                try {
                    $user = Admin::create($data);
                    return redirect()->intended(route('admin.login'))->with('success', 'Account created successfully.');
                } catch (\Illuminate\Database\QueryException $exception) {
                    if ($exception->errorInfo[1] === 1062) {
                        return redirect()->back()->with("error", "Email already exists. Please use a different email address.");
                    }
                    return redirect()->back()->with("error", "An error occurred. Please try again later.");
                }                
            }

        } else {
            return rredirect()->back()->with("error", "Passwords do not match. Please try again.");
        }
    }
}
