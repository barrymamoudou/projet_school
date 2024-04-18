<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssignStudent;

class StudentRollController extends Controller
{
    public function StudentRollView(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        return view('Backend.Student.roll_generate.rollReg',$data);
    }

    //qui permet de recupere les donnes et verifier dans la base donne
    public function GetStudents(Request $request){
        //poour afficher la vu dans le tableau quand on fait la reachercher de donnes 
        $year_id=$request->year_id;
        $class_id=$request->class_id;
        $allData=AssignStudent::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
        return response()->json($allData);
    }
       
    
  
   
    public function StudentRollStore(Request $request){
        $year_id=$request->year_id;
        $class_id=$request->class_id;
        if($request->student_id !=null){
           for ($i=0; $i < count($request->student_id) ; $i++) { 
              AssignStudent::where('year_id',$year_id)
                            ->where('class_id',$class_id)
                            ->where('student_id',$request->student_id[$i])
                            ->update(['roll' => $request->roll[$i]]);
           } //end loup 
        }else {
                $notification = array( 'message' => 'Sorry there are no student','alert-type' => 'error');

                return redirect()->back()->with($notification);
        } //end 

        $notification = array(
    		'message' => 'Well Done Roll Generated Successfully',
    		'alert-type' => 'success'
    	);
        return redirect()->route('student.roll.view')->with($notification);
    }
}
