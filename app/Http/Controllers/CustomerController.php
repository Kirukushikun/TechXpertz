<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function welcome(){
        return view('Customer.1 - Homepage');
    }
}
