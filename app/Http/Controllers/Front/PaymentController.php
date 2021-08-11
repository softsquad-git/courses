<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function successPage()
    {
        return view('payment-success');
    }

    public function notification()
    {
        return view('payment-success');
    }
}
