@extends('layouts.master')
@section('title') Active Bistro | SignUp @endsection
@section('css') 
<!-- Date picker plugins css -->
<!--  <link href="{{ asset('assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" type="text/css" />  -->
 <link href="{{ asset('assets/node_modules/bootstrap-material-datetimepicker/css/jquery-ui.css') }}" rel="stylesheet" type="text/css" /> 
<style type="text/css">
	.invalid-feedback{
		display: block !important;
	}
	.error{
		color: red;
	}
	
	.ti-angle-right:before {
	    content: "<";
	}
	.ti-angle-left:before {
	    content: ">";
	}
</style>
@endsection
@section('content') 
	 
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-sm-10 col-12 mx-auto">
				<form id="msform" class="shadow p-3 mt-5 mb-5" method="POST" action="{{ route('register') }}">
					 @csrf
			        <ul id="progressbar">
					    <li class="active" id="account"><strong>Welcome</strong></li>
						<li id="personal"><strong>Tailor Plan</strong></li>
					    <li id="payment-status"><strong>Choose Meals</strong></li>
					    <li id="payment"><strong>Checkout</strong></li>
					</ul>
			        <fieldset class="paddingrl">

			        	<div class="row">
			        		<div class="col-lg-6 col-sm-6 col-12">
			        			<div class="form-group">
					        		<label>First Name</label>
					        		<input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
					        	</div>
					        	@error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
			        		</div>
			        		 	

			        		<div class="col-lg-6 col-sm-6 col-12">
			        			<div class="form-group">
					        		<label>Last Name</label>
					        		<input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" >
					        	</div>
					        	@error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
			        		</div>

			        		<div class="col-lg-6 col-sm-6 col-12">
			        			<div class="form-group">
					        		<label>Phone</label>
					        		<input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" required autocomplete="phone">
					        	</div>
					        	@error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
			        		</div>

			        		<div class="col-lg-6 col-sm-6 col-12">
			        			<div class="form-group">
					        		<label>Password</label>
					        		<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}" required autocomplete="password">
					        	</div>
					        	@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
			        		</div>
				        </div>
				        <div class="form-group">
					        <div class="row">
						        <div class="col-lg-6 col-sm-6 col-12">
							        <label>Sex
								        <span class="text-color sex-icon ml-2 " data-toggle="tooltip" title="Refers to your gender."><i class="fa fa-question-circle"></i></span></label>
						        </div>

						        <div class="col-lg-6 col-sm-6 col-12">
							        <span class="float-right"><a href="javascript:void(0);" id="addGenderInfo" class="text-color" data-toggle="collapse" data-target="#genderInfo" data-text-alt="- Hide gender information">+ Add gender information</a></span>
						        </div>
					        </div>

					        <div class="custom-control custom-radio custom-control-inline">
						        <input type="radio" value="male" class="custom-control-input" id="male" name="gender" checked>
						        <label class="custom-control-label" for="male">Male</label>
					        </div>

					        <!-- Default inline 2-->
					        <div class="custom-control custom-radio custom-control-inline">
						        <input type="radio" value="female" class="custom-control-input" id="female" name="gender">
						        <label class="custom-control-label" for="female">Female</label>
					        </div>
					        @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
			        	</div>

			        	<div class="form-group collapse" id="genderInfo">
			        		<label class="d-block">Gender information <small>(Optional)</small></label>
			        		<textarea class="form-control" rows="3" name="gender_info" id="gender_info">{{ old('password') }}</textarea>
			        	</div>

			        	<div class="form-group">
			        		<label>Date of Birth</label>
			        		<input type="text" class="form-control" name="dob" id="datepicker" value="{{ old('dob') }}" placeholder="Enter Date Of Birth..">
			        			@error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
			        	</div>
				        <div class="form-group">
					        <label class="mb-0 text-color font-weight-bold">25% Discounts to Student/Staff or NHS Employee</label>
					        <div class="custom-control custom-checkbox ">
						        <input type="checkbox" class="custom-control-input" id="click_to_verify" name="click_to_verify">
						        <label class="custom-control-label" for="click_to_verify">Click to verify</label>
					        </div>
				        </div>

				        <div class="form-group row">
					        <label class="col-lg-2 col-sm-3 col-12">Email ID </label>
					        <div class="col-lg-10 col-sm-9 col-12">
						        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
			        		</div>
			        		@error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
			        	</div> 
			        	<div class="form-group">
			        		<a href="{{ url('/sign-in') }}" class="btn btn-dark rounded btn-md"><i class="fa fa-chevron-left mr-2"></i>Login</a>
			        		<button type="submit" id="register_btn" class="btn btn-info float-right rounded btn-md">Next <i class="fa fa-chevron-right ml-2"></i></button>
			        		<!-- <a href="process2.html" class="btn btn-info float-right rounded btn-md">Next <i class="fa fa-chevron-right ml-2"></i></a> -->
			        	</div>
			        	
			        </fieldset>
			    </form>
			</div>
		</div>
	</div>

@endsection
@section('script')
<script src="{{ asset('assets/node_modules/moment/moment.js') }}"></script>
<!-- <script src="{{ asset('assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script> -->
<script src="{{ asset('assets/node_modules/bootstrap-material-datetimepicker/js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
   <script>

   	$( "#datepicker" ).datepicker({
		changeMonth: true,
      	changeYear: true,
      	minDate: 0,
      	dateFormat: "yy-m-dd"
	});

   	// $('#dob').bootstrapMaterialDatePicker({ format: 'YYYY-MM-DD',time:false, maxDate: new Date() });
   	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
	// $(document).on('click','#addGenderInfo', function(){
	// 	$('#genderInfo').toggle();
	// });

		jQuery(function($){
		    $('#addGenderInfo[data-toggle="collapse"]').on('click', function(){ 
		    $(this)
		    .data('text-original', $(this).text())
		    .text($(this).data('text-alt') )
		    .data('text-alt', $(this).data('text-original'));
		  });
		});
    $(document).ready(function () {
	    $("#msform").on("submit", function () {
		    if ($("#click_to_verify").prop('checked') == true) {
			    str = $('#email').val();
			    str = str.split('.').slice(1);
			    var allowedDomains = ['nhs', 'ac'];
			    if ($.inArray(str[0], allowedDomains) !== -1) {
				    return true;  // FAIL validation when REGEX matches
			    } else {
				    $('#email').after('<span class="error">Not eligible for special discount!.</span><br>');
				    return false;   // PASS validation otherwise
			    }
			    ;
		    }
		    return true;
	    })


	    $('#msform').validate({ // initialize the plugin
		    rules: {
			    first_name: {
				    required: true,
				    minlength: 4
			    },
                    last_name: { required: true, },
                    phone: { required: true,number: true,minlength:8,maxlength:13,},
                    gender: { required: true,},
                    email: { required: true, email: true, },
                    dob: { required: true,}, 
                    password: {required: true,minlength:8, }, 
                    click_to_verify:true,            
                },   
            });

            $(document).on('click', '#register_btn', function(){
                if (!$("#msform").valid()) { // Not Valid
                    return false;
                } else {
                    
                }
            }); 
        }); 
   </script>
@endsection