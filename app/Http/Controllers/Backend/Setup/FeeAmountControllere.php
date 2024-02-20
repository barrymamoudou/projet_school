<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;
use App\Models\FeeCategory;

class FeeAmountControllere extends Controller
{
    public function ViewFeeAmount(){
           $data['allData'] = FeeCategoryAmount::all();
        return view('backend.setup.fee_amounts.index',$data);
    }

    public function AddFeeAmount(){
        $fee_categories=FeeCategory::all();
        return view('backend.setup.fee_amounts.add',compact('fee_categories'));
    }

    public function StoreFeeAmount(){
        return view('amount');
    }

    public function EditFeeAmount(){
        return view('amount');
    }
    public function UpdateFeeAmount(){
        return view('amount');
    }

    public function DetailsFeeAmount(){
        return view('amount');
    }
   
}
