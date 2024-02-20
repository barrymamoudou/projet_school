<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function StudentYearView(){
        $data['allData'] =StudentYear::all();
        return view('backend.setup.student_year.index',$data);
    }

    public function StudentYearAdd(){
        return view('backend.setup.student_year.add');
    }

    public function StudentYearStore(Request $request){
        $validatedData = $request->validate([
    		'name' => 'required|unique:student_years,name',
    		
    	]);

    	$data = new StudentYear();
    	$data->name = $request->name;
    	$data->save();

    	$notification = array(
    		'message' => 'Student Class Inserted Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('student.year.view')->with($notification);

    }

    public function StudentYearEdit($id){

       $editData =StudentYear::find($id);
        return view('backend.setup.student_year.edit',compact('editData'));
    }

    public function StudentYearUpdate(Request $request, $id){

        $data= StudentYear::find($id);
        $data->name = $request->name;
    	$data->save();

        $notification = array(
    		'message' => 'Student Class Updated Successfully',
    		'alert-type' => 'success'
    	);
        return redirect()->route('student.year.view')->with($notification);

    }

    public function StudentYearDelete($id){
        $data= StudentYear::find($id);
        $data->delete();

        $notification = array(
    		'message' => 'Student Class Delete Successfully',
    		'alert-type' => 'success'
    	);
        return redirect()->route('student.year.view')->with($notification);
    }

}
