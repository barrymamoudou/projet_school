@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">

                    <h4 class="box-title">Add Fee Amount</h4>

                </div>

                <div class="box-body">
                 <div class="row">
                    <div class="col">
                     <form action="">
                     <div class="col-12">
						<div class="add_item">
                            <div class="form-group">
                             <h5>Fee Category<span class="text-danger">*</span></h5>
                             <div class="controls">
                                <select name="fee_category_id" required="" class="form-control">
                                    <option value="" selected="" disabled="">Select Fee Category</option>
                                    
                                </select>
                             </div>
                            </div> <!-- // end form group -->  

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <h5>Fee Category<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="class_id[]" required="" class="form-control">
                                                    <option value="" selected="" disabled="">Select Fee Category</option>
                                                    
                                                </select>
	                                        </div>
                                    </div> <!-- // end form group --> 
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                    <h5>Amount <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="amount[]" class="form-control" > 
                                        </div> <!-- // end form group -->    
                                </div>
                               
                               
                            </div>
                             <!-- // end row -->
                             
                             <div class="col-md-2" style="padding-top: 25px;">
                                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> </span>    		
                                </div>
                            
                            </div>
                      </div>  
                      <div class="text-xs-right">
  				        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
			          </div>    
                     </form>
                    </div>
                 </div>
                </div>    
            </div> 
        </section>
    </div>
</div>



@endsection
