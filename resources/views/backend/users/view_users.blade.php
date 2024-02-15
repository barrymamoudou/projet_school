@extends('admin.admin_master')
@section('admin')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
	  <div class="container-full">
		
		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">User List</h3>
                    <a href="{{route('users.add')}}" class="btn btn-rounded btn-success mb-5" style="float:right;">Add User</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Nom</th>
								<th>Role Utilisateur</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($alldata as $user)
                            <tr>
								<td>{{$user->name}}</td>
								<td>{{$user->usertype}}</td>
								<td>{{$user->email}}</td>
								<td>
                                    <a href="{{route('user.edit',$user->id)}}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('user.delete',$user->id)}}" class="btn btn-danger" id="delet">Delete</a>
                                </td>
							</tr>

                            @endforeach
						</tbody>
					  </table>
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