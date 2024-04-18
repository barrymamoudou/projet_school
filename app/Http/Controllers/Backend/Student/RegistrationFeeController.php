<?php

namespace App\Http\Controllers\Backend\Student;

use PDF;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;

class RegistrationFeeController extends Controller
{
    public function RegFeeView(){
        $data['years'] = StudentYear::all();
    	$data['classes'] = StudentClass::all();
    	return view('backend.student.registration_fee.registration_fee_view',$data);
    }

    public function RegFeeClassData(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($year_id !='') {
            $where[] = ['year_id','like',$year_id.'%'];
        }
        if ($class_id !='') {
            $where[] = ['class_id','like',$class_id.'%'];
        }
        $allStudent = AssignStudent::with(['discount'])->where($where)->get();
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Reg Fee</th>';
        $html['thsource'] .= '<th>Discount </th>';
        $html['thsource'] .= '<th>Student Fee </th>';
        $html['thsource'] .= '<th>Action</th>';
        foreach($allStudent as $key => $v){
            // $registre_fee=FeeCategoryAmount::where('student')->first();
            $registrationfee = FeeCategoryAmount::where('fee_category_id','2')->where('class_id',$v->class_id)->first();
            $colors='success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource']  .= '<td>'.$v['student']['id_no'].'</td>';
            $html[$key]['tdsource']  .= '<td>'.$v['student']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
            $html[$key]['tdsource']  .= '<td>'. $registrationfee->amount.'</td>';
            $html[$key]['tdsource']  .= '<td>'.$v['discount']['discount'].'%'.'</td>';
            
            $originalfee = $registrationfee->amount; //le montant a paie
            $discount=$v['discount']['discount'];  //on a le montant a remise
            $discountremise=$discount/100* $originalfee ; //le montant a remise
            
            $originalFinal=(float)$originalfee - (float)$discountremise; //le montant a remise
            $html[$key]['tdsource'] .='<td>'.$originalFinal.'$'.'</td>';
            $html[$key]['tdsource'] .='<td>';
            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$colors.'" title="PaySlip" target="_blanks" href="'.route("student.registration.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
       
    }
    public function RegFeePayslip(Request $request){
    	$student_id = $request->student_id;
    	$class_id = $request->class_id;

    	$allStudent['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->where('class_id',$class_id)->first();

    $pdf = PDF::loadView('backend.student.registration_fee.registration_fee_pdf', $allStudent);
	$pdf->SetProtection(['copy', 'print'], '', 'pass');
	return $pdf->stream('document.pdf');

    }
}
