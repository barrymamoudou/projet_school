<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Models\SchoolSubject;
use App\Http\Controllers\Controller;

class SchoolSubjectController extends Controller
{
    public function ViewSubject(){
        $data['allData'] = SchoolSubject::all();
    	return view('backend.setup.school_subject.index',$data);
    }

    public function SubjectAdd(){
        return view('backend.setup.school_subject.add');
    }

    public function SubjectStore(Request $request){
        $validatedData = $request->validate([
    		'name' => 'required|unique:school_subjects,name',
    		
    	]);

    	$data = new SchoolSubject();
    	$data->name = $request->name;
    	$data->save();

    	$notification = array(
    		'message' => 'SchoolSubject Inserted Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('school.subject.view')->with($notification);
    }

    public function SubjectEdit($id){
        $editData = SchoolSubject::find($id);
        return view('backend.setup.school_subject.edit',compact('editData')); 
    }

    public function SubjectUpdate(Request $request,$id){
        $data = SchoolSubject::find($id);
     
     	$validatedData = $request->validate([
    		'name' => 'required|unique:school_subjects,name,'.$data->id
    	]);

    	
    	$data->name = $request->name;
    	$data->save();
        
    	$notification = array(
    		'message' => 'SchoolSubject Updated Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('school.subject.view')->with($notification);
    }

    public function SubjectDelete(Request $request,$id){
        $user = SchoolSubject::find($id);
	    	$user->delete();

	    	$notification = array(
	    		'message' => 'SchoolSubject Deleted Successfully',
	    		'alert-type' => 'info'
	    	);
	    return redirect()->route('school.subject.view')->with($notification);
    }
}
