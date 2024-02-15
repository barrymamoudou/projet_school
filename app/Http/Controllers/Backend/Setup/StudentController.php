<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function StudentClassView(){
        $data['allData'] =StudentClass::all();
        return view('backend.setup.student_class.index',$data);
    }

    public function StudentClassAdd(){
        return view('backend.setup.student_class.add');
    }

    public function StudentClassStore(Request $request){
        $validatedData = $request->validate([
    		'name' => 'required|unique:student_classes,name',
    		
    	]);

    	$data = new StudentClass();
    	$data->name = $request->name;
    	$data->save();

    	$notification = array(
    		'message' => 'Student Class Inserted Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('student.class.view')->with($notification);

    }

    public function StudentClassEdit($id){
       $editData =StudentClass::find($id);
        return view('backend.setup.student_class.edit',compact('editData'));
    }

    public function StudentClassUpdate(Request $request, $id){

        $data= StudentClass::find($id);
        $data->name = $request->name;
    	$data->save();

        $notification = array(
    		'message' => 'Student Class Updated Successfully',
    		'alert-type' => 'success'
    	);
        return redirect()->route('student.class.view')->with($notification);

    }

    public function StudentClassDelete($id){
        $data= StudentClass::find($id);
        $data->delete();

        $notification = array(
    		'message' => 'Student Class Delete Successfully',
    		'alert-type' => 'success'
    	);
        return redirect()->route('student.class.view')->with($notification);

    }


}
