@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
    
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                <h4 class="box-title">Edit User</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form  action="{{route('user.update',$dataEdit->id)}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Select Role <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="usertype" id="usertype"  class="form-control">
                                                                <option value="" selected="" disabled="">Select User</option>
                                                                <option value="admin" {{ $dataEdit->usertype =='admin' ? 'selected' : '' }}> Admin </option>
                                                                <option value="user" {{ $dataEdit-> usertype == 'user' ? 'selected' : '' }}>  User  </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> <!-- /.col-mb-6 -->

                                                <div class="col-md-6">
                                                    
                                                    <div class="form-group">
                                                        <h5>User Name <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" value="{{$dataEdit->name}}" class="form-control" required=""></div>
                                                        <div class="form-control-feedback"></div>
                                                    </div>
                                                    
                                                </div> <!-- /col-mb-6 -->
                                                
                                            </div> <!-- /.row -->


                                            <div class="row">
                                                <div class="col-md-6">
                                                    
                                                <div class="form-group">
                                                        <h5>User Email <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="email" name="email" value="{{ $dataEdit->email}}" class="form-control" required=""></div>
                                                        <div class="form-control-feedback"></div>
                                                    </div>
                                                </div> <!-- /.col-mb-6 -->

                                                <div class="col-md-6">
                                                    
                            
                                                    
                                                </div> <!-- /col-mb-6 -->
                                                
                                            </div> <!-- /.row -->
                                            
                                    </div>   
                                </div>
                                
                                <div class="text-xs-right">
                                    <input type="submit" value="Update" class="btn btn-round btn-info mb-5">
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
    </div>
</div>




@endsection