<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;

class EmployeeAttendanceController extends Controller
{
    public function AttendanceView(){
        // $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','DESC')->get();
    	 $data['allData'] = EmployeeAttendance::orderBy('id','DESC')->get();
    	return view('backend.employee.employee_attendance.employee_attendance_view',$data);
        
    }
    public function AttendanceAdd(){
        $data['employees'] = User::where('usertype','employee')->get();
    	return view('backend.employee.employee_attendance.employee_attendance_add',$data);
        
    }
    public function AttendanceStore(Request $request){
       
        EmployeeAttendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();
        $countemployees=count($request->employee_id);
        for($i=0;$i<$countemployees;$i++){
            $attend_status = 'attend_status'.$i;
            $attend= new EmployeeAttendance();
            $attend->date=date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status=$request->$attend_status;
            $attend->save();
        }
    	
    	$notification = array(
    		'message' => 'Employee Attendace Data Update Successfully',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('employee.attendance.view')->with($notification);
        
    }
    public function AttendanceEdit($date){
        $data['employees'] = User::where('usertype','employee')->get();
        $data['editData'] = EmployeeAttendance::where('date',$date)->get();
    	
    	return view('backend.employee.employee_attendance.employee_attendance_edit',$data);
        
    }
    public function AttendanceDetails($date){
        $data['details'] = EmployeeAttendance::where('date',$date)->get();
    	return view('backend.employee.employee_attendance.employee_attendance_details',$data);
        
    }
   




}
