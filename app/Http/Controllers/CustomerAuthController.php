<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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

    public function signup(){
        return view('Customer.0 - Registration');
    }
    public function signupCustomer(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        try {
            $customer = Customer::create([
                'firstname' => $validatedData['firstname'],
                'lastname' => $validatedData['lastname'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
            return redirect()->route('customer.login');
        } catch (\Illuminate\Database\QueryException $exception) {
            if ($exception->errorInfo[1] === 1062) {
                return redirect(route('customer.signup'))->with("error", "Email already exists. Please use a different email address.");
            }
            return redirect(route('customer.signup'))->with("error", "An error occurred. Please try again later.");
        }
    }


}
