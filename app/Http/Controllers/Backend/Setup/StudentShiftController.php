<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentShiftController extends Controller
{
    
    public function ViewShift(){
        $data['allData'] = StudentShift::all();
    	return view('backend.setup.shift.index',$data);
    }

    public function StudentShiftAdd(){
        return view('backend.setup.shift.add');
    }

    public function StudentShiftStore(Request $request){
        $validatedData = $request->validate([
    		'name' => 'required|unique:student_shifts,name',
    		
    	]);

    	$data = new StudentShift();
    	$data->name = $request->name;
    	$data->save();

    	$notification = array(
    		'message' => 'Student Shift Inserted Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('student.shift.view')->with($notification);
    }

    public function StudentShiftEdit($id){
        $editData = StudentShift::find($id);
        return view('backend.setup.shift.edit',compact('editData')); 
    }

    public function StudentShiftUpdate(Request $request,$id){
        $data = StudentShift::find($id);
     
     	$validatedData = $request->validate([
    		'name' => 'required|unique:student_shifts,name,'.$data->id
    		
    	]);

    	
    	$data->name = $request->name;
    	$data->save();

    	$notification = array(
    		'message' => 'Student Shift Updated Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('student.shift.view')->with($notification);
    }

    public function StudentShiftDelete(Request $request,$id){
        $user = StudentShift::find($id);
	    	$user->delete();

	    	$notification = array(
	    		'message' => 'Student Shift Deleted Successfully',
	    		'alert-type' => 'info'
	    	);
	    return redirect()->route('student.shift.view')->with($notification);
    }

}
