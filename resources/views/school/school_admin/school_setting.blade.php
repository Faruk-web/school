@extends('layouts.master')
@section('title')CRM @endsection
@section('body_content')
<!-- Page Content -->
<style>
    .image_size{
        height: 95px;
         width: 100px;
    }
</style>
<div class="content">
    <!-- Overview -->
	        <div class="row">
					<div class="col-md-12 stretch-card">
						<div class="card shadow">
							<div class="card-body shadow">
                                <form action="{{route('admin.set.school_setting')}}" method="post" enctype="multipart/form-data" id="form_1">
                                   @csrf
                                   <h4>School Informaion</h4>
                                        <div class="row mt-2 shadow">
											<div class="col-sm-12">
												<div class="mb-3">
													<label class="form-label">Name</label>
													<input type="text" name="name" value="{{optional($school_info)->name}}" class="form-control" placeholder="Enter Name">
												</div>
											</div><!-- Col -->
											<div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Email</label>
													<input type="email" name="mail" value="{{optional($school_info)->mail}}" class="form-control" placeholder="Enter Email">
												</div>
											</div><!-- Col -->
											<div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Phone</label>
													<input type="number" name="phone" value="{{optional($school_info)->phone}}" class="form-control" placeholder="Enter Phone">
												</div>
											</div><!-- Col -->
                                            <div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Website</label>
													<input type="text" name="website" value="{{optional($school_info)->website}}" class="form-control" placeholder="Enter Website">
												</div>
											</div><!-- Col -->
                                            <div class="col-sm-12">
									
                                                <div class="mb-3">
                                                    
                                                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                                    
                                                    <textarea type="textarea" name="address" value="{{optional($school_info)->address}}" class="form-control" placeholder="Enter Address" class="form-control" id="exampleFormControlTextarea1" rows="5">{{optional($school_info)->address}}</textarea>
                                                </div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="mb-3">
													<label class="form-label">logo </label>
													<input type="file" name="logo" value="{{optional($school_info)->logo}}" class="form-control" placeholder="Enter logo">
                                                    <img class="card-img-top image_size" src="{{asset(optional($school_info)->logo)}}">
                                                </div>
											</div><!-- Col -->
											<div class="col-sm-6">
												<div class="mb-3">
													<label class="form-label">Fav Icon </label>
													<input type="file" name ="fav_icon" value="{{optional($school_info)->fav_icon}}" class="form-control" placeholder="Enter Fav Icon">
                                                    <img class="card-img-top image_size" src="{{asset(optional($school_info)->fav_icon)}}">
                                                </div>
											</div><!-- Col -->
										</div><!-- Row -->
                                        <h4 class="mt-5">Representative Informaion</h4>
                                        <div class="row mt-4 shadow">
											<div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Representative Name </label>
													<input type="text" name="representative_name" value="{{optional($school_info)->representative_name}}" class="form-control" placeholder="Enter Representative Name">
												</div>
											</div><!-- Col -->
											<div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Representative Phone </label>
													<input type="number" name="representative_phone" value="{{optional($school_info)->representative_phone}}" class="form-control" placeholder="Enter Representative Phone">
												</div>
											</div><!-- Col -->
                                            <div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Representative Email </label>
													<input type="email" name="representative_email" value="{{optional($school_info)->representative_email}}" class="form-control" placeholder="Enter Representative Email">
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
                                        <h4 class="mt-5">Principal Informaion</h4>
                                         <div class="row mt-4 shadow">
											<div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Principal Name </label>
													<input type="text" name="principal_name" value="{{optional($school_info)->principal_name}}" class="form-control" placeholder="Enter Principal Name">
												</div>
											</div><!-- Col -->
											<div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Principal Phone </label>
													<input type="number" name="principal_phone" value="{{optional($school_info)->principal_phone}}" class="form-control" placeholder="Enter Principal Phone">
												</div>
											</div><!-- Col -->
                                            <div class="col-sm-4">
                                            <div class="mb-3">
													<label class="form-label">Principal Email </label>
													<input type="email" name="principal_email" value="{{optional($school_info)->principal_email}}" class="form-control" placeholder="Enter Principal Email">
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
                                        <h4 class="mt-5">Default Branch</h4>
                                         <div class="row mt-4 shadow">
											<!-- <div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Registration Date </label>
													<input type="date" name="registration_date" value="{{optional($school_info)->registration_date}}" class="form-control" placeholder="Enter Registration Date">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="mb-3">
													<label class="form-label">Next Renew Date</label>
													<input type="date" name="next_renew_date" value="{{optional($school_info)->next_renew_date}}" class="form-control" placeholder="Enter Next Renew Date">
												</div>
											</div> -->
                                            <div class="col-sm-6">
												<div class="mb-3">
                                                <label for="example-text-input">Set Default Branch</label>
                                                    <select class="form-control" name="default_branch">
                                                        <option value="">Select Branch / Shop</option>
                                                        @foreach($branches as $branch)
                                                        <option @if($branch->id == optional($school_info)->default_branch_id_for_sell) selected class="bg-success" @endif value="{{$branch->id}}">{{$branch->name}} [{{$branch->address}}]</option>
                                                        @endforeach
                                                    </select>
												</div>
											</div><!-- Col -->
										</div><!-- Row -->
                                        <button type="submit" class="btn btn-primary submit mt-5">Update</button>
									</form>
							</div>
						</div>
					</div>
				</div>
    <!-- END Overview -->
</div>
<!-- END Page Content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    $('select.customer_points').on('change', function() {
        var value = this.value;
        if(value == 'no') {
            $("#customer_points_value_div").hide();
            $('#point_redeem_rate').prop('required', false);
            $('#point_earn_rate').prop('required', false);

        }
        else if(value == 'yes') {
            $("#customer_points_value_div").show();
            $('#point_redeem_rate').prop('required', true);
            $('#point_earn_rate').prop('required', true);
        }
    });
</script>


@endsection
