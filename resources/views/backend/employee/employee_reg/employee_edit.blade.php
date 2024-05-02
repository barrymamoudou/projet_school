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
                        <form action="{{ route('update.employee.registration',$editData->id)}}" enctype="multipart/form-data" method="post" class="">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row"> <!-- 1st Row -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Nom Employee <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="name" value="{{$editData->name}}" class="form-control" required="" > 
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Père Employee <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="fname" value="{{$editData->fname}}" class="form-control" required="" > 
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Mère Employee <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="mname" value="{{$editData->mname}}" class="form-control" required="" > 
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                    </div>

                                    <div class="row">  <!-- 2nd Row -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Mobile Number <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                <input type="text" name="mobile" value="{{$editData->mobile}}" class="form-control" required="" > 
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Adress Employee  <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="address" value="{{$editData->address}}" class="form-control" required="" > 
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Sexe Employee <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                <select name="gender" id="gender" required="" class="form-control">
                                                    <option value="" selected="" disabled="">Select Gender</option>
                                                    <option value="Male" {{($editData->gender=="Male")? 'selected' : ''}} >Male</option>
                                                    <option value="Female" {{($editData->gender=="Female")? 'selected' : ''}}>Female</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                    </div>
                                    <div class="row"> <!-- 3rd Row -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Religion  Employee <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="religion" id="religion" required="" class="form-control">
                                                        <option value="" selected="" disabled="">Select Religion</option>
                                                        <option value="Islam" {{($editData->religion=="Islam")? 'selected' : ''}} >Islam</option>
                                                        <option value="Hindu" {{($editData->religion=="Hindu")? 'selected' : ''}}>Hindu</option>
                                                        <option value="Christan" {{($editData->religion=="Christan")? 'selected' : ''}}>Christan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Date de naissance <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="dob" value="{{$editData->dob}}" class="form-control" required="" >
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Designation (Nom des Prof) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="designation_id" required="" class="form-control">
                                                        <option value="" selected="" disabled="">Select Designation</option>
                                                        @foreach($designation as $desi)
                                                        <option value="{{ $desi->id }}" {{($editData->designation_id==$desi->id)? 'selected':''}}>{{ $desi->name }}</option>
                                                        @endforeach
                                                    </select> 
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                    </div>
                                    <div class="row"><!-- 4TH Row -->
                                    @if(!@editData)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Salary Employee <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="salary" value="{{ $editData->salary}}" class="form-control" required="" > 
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 3 -->
                                    @endif
                                    @if(!@editData)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Date d’adhésion (Joining Date ) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="join_date" class="form-control" required="" value="{{ $editData->join_date }}"> 
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 3 -->
                                    @endif    
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Profile Image  <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="image" class="form-control" id="image" > 
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 3 -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="controls">
                                                <img id="showImage" src="{{ (!empty($editData->image))? url('upload/employee_images/'.$editData->image):url('upload/no_image.jpg') }}" style="width: 100px; width: 100px; border: 1px solid #000000;"> 
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 3 -->
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>
@endsection
