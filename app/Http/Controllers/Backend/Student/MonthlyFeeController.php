<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MonthlyFeeController extends Controller
{
    public function MonthlyFeeView(){
        return view('backend.student.monthly_fee.monthly_fee_view');
    }
}
