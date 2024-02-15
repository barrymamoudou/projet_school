@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
    
        <section class="content">

        <div class="row">
            <div class="col-12">
                
            <div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
					  	<h3 class="widget-user-username">User Name : {{$user->name}} </h3>
					 	 <a href="{{route('profile.edit')}}" class="btn btn-rounded btn-success mb-5" style="float:right;"> Edit Profile</a>
					  	<h6 class="widget-user-desc">User Type : {{$user->usertype}}</h6>
					  	<h6 class="widget-user-desc">User Email : {{$user->email}}</h6>
					</div>
					<div class="widget-user-image">
					  <img class="rounded-circle" src="{{ (!empty($user->image))? url('upload/user_image/'.$user->image):url('upload/no_image.jpg') }}" alt="User Avatar">
					</div>
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Telephone</h5>
							<span class="description-text">{{ $user->mobile}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Adresse</h5>
							<span class="description-text">{{ $user->address}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Sexe</h5>
							<span class="description-text">{{ $user->gender}}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  <!-- /.row -->
					</div>
				  </div>
                    
            </div>   
        </div>
        </section>
    </div>
</div>
@endsection
