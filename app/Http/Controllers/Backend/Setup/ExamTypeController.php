<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\ExamType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamTypeController extends Controller
{
    public function ViewExamType(){
        $data['allData'] = ExamType::all();
    	return view('backend.setup.exam_type.index',$data);
    }

    public function ExamTypeAdd(){
        return view('backend.setup.exam_type.add');
    }

    public function ExamTypeStore(Request $request){
        $validatedData = $request->validate([
    		'name' => 'required|unique:exam_types,name',
    		
    	]);

    	$data = new ExamType();
    	$data->name = $request->name;
    	$data->save();

    	$notification = array(
    		'message' => 'Exam type Inserted Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('exam.type.view')->with($notification);
    }

    public function ExamTypeEdit($id){
        $editData = ExamType::find($id);
        return view('backend.setup.exam_type.edit',compact('editData')); 
    }

    public function ExamTypeUpdate(Request $request,$id){
        $data = ExamType::find($id);
     
     	$validatedData = $request->validate([
    		'name' => 'required|unique:student_shifts,name,'.$data->id
    		
    	]);

    	
    	$data->name = $request->name;
    	$data->save();

    	$notification = array(
    		'message' => 'Exam type Updated Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('exam.type.view')->with($notification);
    }

    public function ExamTypeDelete(Request $request,$id){
        $user = ExamType::find($id);
	    	$user->delete();

	    	$notification = array(
	    		'message' => 'Exam type Deleted Successfully',
	    		'alert-type' => 'info'
	    	);
	    return redirect()->route('exam.type.view')->with($notification);
    }

}
