<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\StudentClass;

class FeeAmountControllere extends Controller
{
    public function ViewFeeAmount(){
           $data['allData'] = FeeCategoryAmount::all();
        return view('backend.setup.fee_amounts.index',$data);
    }

    public function AddFeeAmount(){
        $fee_categories=FeeCategory::all();
        $classes=StudentClass::all();
        return view('backend.setup.fee_amounts.add',compact('fee_categories','classes'));
    }
    public function StoreFeeAmount(Request $request){
        $countClasss=count($request->class_id);
        if($countClasss !=Null){
            for($i=0; $i<$countClasss; $i++){
                 $fee_amount=new FeeCategoryAmount();
                 $fee_amount->fee_category_id =$request->fee_category_id;
                 $fee_amount->class_id        =$request->class_id[$i];
                 $fee_amount->amount          =$request->amount[$i];
                $fee_amount->save();
            } //end for
        } //end if
        $notification = array(
            'message' => 'Data Amount Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('fee.amount.view')->with($notification);
    }
    public function EditFeeAmount($fee_category_id){
        $data['editData']=FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        $data['fee_categories']=FeeCategory::all();
        $data['classes']=StudentClass::all();
        return view('backend.setup.fee_amounts.edit',$data);
    }
    public function UpdateFeeAmount(Request $request, $fee_category_id){
        //ici on verifier si on selectionner l'element de sinon on est redirige vers la page d'edition mais il fois que se selectionner on passe a edition
        if($request->class_id ==Null){
            $notification = array(
                'message' => 'Désolé Vous ne sélectionnez aucun montant de cours',
                'alert-type' => 'error'
            );
    
            return redirect()->route('fee.amount.edit',$fee_category_id)->with($notification);
            
        }else{
            $countClass = count($request->class_id);
	        FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete(); 
    		for ($i=0; $i <$countClass ; $i++) { 
    			$fee_amount = new FeeCategoryAmount();
    			$fee_amount->fee_category_id = $request->fee_category_id;
    			$fee_amount->class_id = $request->class_id[$i];
    			$fee_amount->amount = $request->amount[$i];
    			$fee_amount->save();

    		} 	 
    	}

        $notification = array(
    		'message' => 'Data Updated Successfully',
    		'alert-type' => 'success'
    	);
        return redirect()->route('fee.amount.view')->with($notification);
    }

    public function DetailsFeeAmount($fee_category_id){
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
        return view('backend.setup.fee_amounts.details_fee_amount',$data);
    }
   
}
