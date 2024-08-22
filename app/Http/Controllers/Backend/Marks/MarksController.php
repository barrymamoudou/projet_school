<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Models\ExamType;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarksController extends Controller
{
    public function MarksAdd(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.marks.marks_add',$data);
    }

    public function MarksStore(Request $request){
        //on faire les enregistrements dans la base de donnees mais on recupere les etudiants concerne et les compte 
        $studentcount=$request->student_id;
            //on verifi si on va trouver l'etudiant dans la base de donnees pour faire le compte
        if($studentcount){
            // on parcoure l'etudiant
            for ($i=0; $i <$studentcount; $i++) { 
            $marks=new StudentMarks();
            $marks->year_id=$request->year_id;
            $marks->class_id=$request->class_id;
            $marks->assign_subject_id=$request->assign_subject_id;
            $marks->exam_type_id=$request->exam_type_id;
            $marks->student_id=$request->student_id[$i];
            $marks->id_no=$request->id_no[$i];
            $marks->marks=$request->marks[$i];
            $marks->save();
            
            }
        }
        $notification = array(
    		'message' => 'Student Marks Inserted Successfully',
    		'alert-type' => 'success');

    	return redirect()->back()->with($notification);
    }

    public function MarksEdit(){
        $data['years'] = StudentYear::all();
    	$data['classes'] = StudentClass::all();
    	$data['exam_types'] = ExamType::all();

        return view('backend.marks.marks_edit',$data);
    }
    public function MarksEditGetStudents(Request $request){
        // On faire des conditions pour faire la modification des donnees
        $year_id = $request->year_id;
    	$class_id = $request->class_id;
    	$assign_subject_id = $request->assign_subject_id;
    	$exam_type_id = $request->exam_type_id;
        $getStudent=StudentMarks::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)
                                        ->where('assign_subject_id',$assign_subject_id)->where('exam_type_id',$exam_type_id);
        return response()->json($getStudent);

    }
    public function MarksUpdate(Request $request){
    //ici il faut que je supprimer les valeurs sur les quel je fait pas la modification
        StudentMarks::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('exam_type_id',$request->exam_type_id)
                ->where('assign_subject_id',$request->assign_subject_id)->delete();
                $studentcount = $request->student_id;
                if ($studentcount) {
                    for ($i=0; $i <count($request->student_id) ; $i++) { 
                    $data = New StudentMarks();
                    $data->year_id = $request->year_id;
                    $data->class_id = $request->class_id;
                    $data->assign_subject_id = $request->assign_subject_id;
                    $data->exam_type_id = $request->exam_type_id;
                    $data->student_id = $request->student_id[$i];
                    $data->id_no = $request->id_no[$i];
                    $data->marks = $request->marks[$i];
                    $data->save();
        
                    } // end for loop
                }// end if conditon
        
                    $notification = array(
                    'message' => 'Student Marks Updated Successfully',
                    'alert-type' => 'success'
                );
        
                return redirect()->back()->with($notification);
    }


}
