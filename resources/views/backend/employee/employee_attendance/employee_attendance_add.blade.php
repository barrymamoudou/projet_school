@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
	<div class="container-full">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add Employee </h4>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                        <form action="{{ route('store.employee.attendance')}}" enctype="multipart/form-data" method="post" class="">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Attendance Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="date" id="date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-bordered table-striped" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" class="text-center" style="vertical-align: middle;"></th>
                                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee List</th>
                                                        <th colspan="3" class="text-center" style="vertical-align: middle; width: 30%"> Attendance Status</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center btn present_all" style="display: table-cell; background-color: #000000">Present</th>
                                                            <th class="text-center btn leave_all" style="display: table-cell; background-color: #000000">Leave</th>
                                                            <th class="text-center btn absent_all" style="display: table-cell; background-color: #000000">Absent</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($employees as $key => $employee)
                                                    <tr id="div{{$employee->id}}" class="text-center">
                                                        <td>{{ $key+1  }}</td>
                                                        <td>{{ $employee->name }}</td>
                                                        <td colspan="3">
                                                            <input type="hidden" name="employee_id[]" value="{{ $employee->id }}">
                                                            <div class="switch-toggle switch-3 switch-candy">
                                                                <input type="radio" name="attend_status{{$key}}" type="radio" value="Present" id="present{{$key}}" checked="checked">
                                                                <label for="present{{$key}}">Present</label>
                                                                <input type="radio" name="attend_status{{$key}}" value="Leave" type="radio" id="leave{{$key}}" >
                                                                <label for="leave{{$key}}">Leave</label>
                                                                <input type="radio" name="attend_status{{$key}}" value="Absent"  type="radio" id="absent{{$key}}">
                                                                <label for="absent{{$key}}">Absent</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>  <!-- /.box -->        
        </section> 
	</div>
</div>

@endsection
