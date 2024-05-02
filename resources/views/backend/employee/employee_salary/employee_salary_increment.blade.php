@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
	<div class="container-full">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Salary Increment </h4>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                        <form action="{{ route('update.increment.store',$editData->id)}}" enctype="multipart/form-data" method="post" class="">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row"><!-- 4TH Row -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Salary Amount <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="increment_salary" class="form-control" required="" > 
                                                </div>
                                            </div>
                                        </div> <!-- End Col md 4 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5> Effected Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="effected_salary" class="form-control" required="" > 
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

@endsection
