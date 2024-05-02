<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\ExamType;
use App\Models\FeeCategoryAmount;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Http\Controllers\Controller;
use DB;
use PDF;

class ExamFeeController extends Controller
{
    public function ExamFeeView(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.student.exam_fee.exam_fee_view',$data);
    }

    public function ExamFeeClassData(Request $request){
        $class_id = $request->class_id;
        $year_id = $request->year_id;
       if($class_id !=''){
        $where[]=['class_id','like',$class_id.'%'];
       }
       if($year_id !=''){
        $where[]=['year_id','like',$year_id.'%'];
       }
       $allStudent = AssignStudent::with(['discount'])->where($where)->get();
        $html['thsource']  = '<th>SL</th>';
    	$html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Exam Type Fee</th>';
        $html['thsource'] .= '<th>Discount </th>';
        $html['thsource'] .= '<th>Student Fee </th>';
        $html['thsource'] .= '<th>Action</th>';
            

        foreach($allStudent as $key => $v) { 
            $registrationfee =FeeCategoryAmount::where('fee_category_id','4')->where('class_id',$v->class_id)->first();
            $color="success";
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource']  .= '<td>'.$v['student']['id_no'].'</td>';
            $html[$key]['tdsource']  .= '<td>'.$v['student']['name'].'</td>';
            $html[$key]['tdsource']  .= '<td>'.$v->roll.'</td>';
            $html[$key]['tdsource']  .= '<td>'.$registrationfee->amount.'</td>';
            $html[$key]['tdsource']  .= '<td>'.$v['discount']['discount'].'</td>';
            $original=$registrationfee->amount;
            $discount=$v['discount']['discount'];
            //le calcul pour la reduction de la valeur payement net en pourcentage sur l'eleve
            $discounttable=$discount/100*$original;
            //avoir le montant final 
            $originalfinal=(float)$original- (float)$discounttable;  
            $html[$key]['tdsource'] .= '<td>'.$originalfinal .'$'.'</td>';
            $html[$key]['tdsource'] .='<td>';
    	 	$html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("student.exam.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&exam_type_id='.$request->exam_type_id.' ">Fee Slip</a>';
    	 	$html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    // public function ExaamFeeClassData(Request $request){
    //     $class_id = $request->class_id;
    //     $year_id = $request->year_id;
    //     $allStudent = AssignStudent::with(['discount'])->where(function($query) use ($class_id,$year_id){
    //         $query->when($class_id, function($q) use($class_id){
    //             $q->where('class_id', 'like',$class_id.'%');
    //         })->when($year_id, function($q) use($year_id){
    //             $q->where('year_id', 'like',$year_id.'%');
    //         });
    //     })->get();
    //     $html['tdsource'] = $allStudent->map(function ($student , $key) use ($request){
    //         $registrationFee= FeeCategoryAmount::where('fee_category_id','4')
    //                                             ->where('class_id',$student->class_id)
    //                                             ->first();
    //         $color = "success";                                    
    //         $original = $registrationFee->amount;
    //         $discount = $student['discount']['discount'];
    //         $discountTable = $discount / 100 * $original;
    //         $originalFinal = (float)$original - (float)$discountTable;
    //         return [
    //             'tdsource' => '<td>' . ($key + 1) . '</td>' .
    //                 '<td>' . $student['student']['id_no'] . '</td>' .
    //                 '<td>' . $student['student']['name'] . '</td>' .
    //                 '<td>' . $student->roll . '</td>' .
    //                 '<td>' . $registrationFee->amount . '</td>' .
    //                 '<td>' . $student['discount']['discount'] . '</td>' .
    //                 '<td>' . $originalFinal . '$' . '</td>' .
    //                 '<td>' .
    //                 '<a class="btn btn-sm btn-' . $color . '" title="PaySlip" target="_blanks" href="' . route("student.exam.fee.payslip") . '?class_id=' . $student->class_id . '&student_id=' . $student->student_id . '&exam_type_id=' . $request->exam_type_id . '">Fee Slip</a>' .
    //                 '</td>'
    //         ];
    //     })->toArray();
    //     return response()->json(@$html);

    // }
    public function ExamFeePayslip(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['exam_type']= ExamType::where('id',$request->exam_type_id)->first()['name'];

        $data['details']=AssignStudent::with(['student','discount'])->where('student_id',$student_id)
                                        ->where('class_id',$class_id)->first();
        $pdf = PDF::loadView('backend.student.exam_fee.exam_fee_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');


    }
}
