<?php

namespace App\Http\Controllers\customer\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerAuth extends Controller
{
    public function login()
    {
        return view('customer.login');
    }
}
