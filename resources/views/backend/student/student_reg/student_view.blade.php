@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<div class="container-full">

		<!-- Main content  -->
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="box bb-3 border-warning">
						<div class="box-header">
							<h4 class="box-title">Student <strong>Search</strong></h4>
						</div>
						<div class="box-body">
							<form method="GET" action="{{ route('student.year.class.wise')}}">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<h5>Year <span class="text-danger"> </span></h5>
											<div class="controls">
												<select name="year_id" id="" class="form-control">
													<option value="">Selectionner Year</option>
													@foreach($years as $year)
													<option value="{{ $year->id }}"
														{{ (@$year_id==$year->id) ?"selected" : ""}}>{{ $year->name }}
													</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<h5>Class <span class="text-danger"> </span></h5>
											<div class="controls">
												<select name="class_id" id="" class="form-control">
													<option value="">Selectionner</option>
													@foreach($classes as $class)
													<option value="{{ $class->id }}"
														{{ (@$class_id==$class->id) ? "selected" : "" }}>
														{{ $class->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-4" style="padding-top: 25px;">
										<input type="submit" class="btn btn-rounded btn-dark mb-5" name="search"
											value="Search">
									</div>
								</div>
						</div>
					</div>
				</div>
				<div class="col-12">

					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Student List</h3>
							<a href="{{route('student.reg.add')}}" class="btn btn-rounded btn-success mb-5"
								style="float:right;">Add User</a>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								@if(!@search)
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="5%">SL</th>
											<th>Name</th>
											<th>ID No</th>
											<th>Roll</th>
											<th>Year</th>
											<th>Class</th>
											<th>Image</th>
											@if(Auth::user()->role == "Admin")
											<th>Code</th>
											@endif

											<th width="25%">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($alldata as $k => $value)
										<tr>
											<td>{{ $k+1 }}</td>
											<td>{{$value['student']['name']}}</td>
											<td>{{$value['student']['id_no']}}</td>
											<td>{{$value->roll }}</td>
											<td>{{$value['student_year']['name']}}</td>
											<td>{{$value['student_classe']['name']}}</td>
											<td>
												<img src="{{ (!empty($value['student']['image']))? url('upload/student_images/'.$value['student']['image']):url('upload/no_image.jpg') }}"
													style="width: 60px; width: 60px;">
											</td>
											<td> {{ $value->year_id }}</td>
											<td>
												<a title="Edit" href="{{ route('student.reg.edit',$value->student_id)}}"
													class="btn btn-info"> <i class="fa fa-edit"></i> </a>
												<a title="Promotion"
													href="{{ route('student.reg.promotion',$value->student_id) }}"
													class="btn btn-primary"><i class="fa fa-check"></i></a>
												<a target="_blank" title="Details"
													href="{{ route('student.reg.details',$value->student_id) }}"
													class="btn btn-danger"><i class="fa fa-eye"></i></a>
											</td>
										</tr>

										@endforeach
									</tbody>
								</table>
								@else
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="5%">SL</th>
											<th>Name</th>
											<th>ID No</th>
											<th>Roll</th>
											<th>Year</th>
											<th>Class</th>
											<th>Image</th>
											@if(Auth::user()->role == "Admin")
											<th>Code</th>
											@endif

											<th width="25%">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($alldata as $k => $value)
										<tr>
											<td>{{ $k+1 }}</td>
											<td>{{$value['student']['name']}}</td>
											<td>{{$value['student']['id_no']}}</td>
											<td>{{$value->roll }}</td>
											<td>{{$value['student_year']['name']}}</td>
											<td>{{$value['student_classe']['name']}}</td>
											<td>
												<img src="{{ (!empty($value['student']['image']))? url('upload/student_image/'.$value['student']['image']):url('upload/no_image.jpg') }}"
													style="width: 60px; width: 60px;">
											</td>
											<td> {{ $value->year_id }}</td>
											<td>
												<a title="Edit"
													href="{{ route('student.reg.edit',$value->student_id) }}"
													class="btn btn-info"> <i class="fa fa-edit"></i> </a>
												<a title="Promotion"
													href="{{ route('student.reg.promotion',$value->student_id) }}"
													class="btn btn-primary"><i class="fa fa-check"></i></a>
												<a target="_blank" title="Details"
													href="{{ route('student.reg.details',$value->student_id) }}"
													class="btn btn-danger"><i class="fa fa-eye"></i></a>
											</td>
										</tr>

										@endforeach
									</tbody>
								</table>

								@endif

							</div>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->

	</div>
</div>
<!-- /.content-wrapper -->

@endsection