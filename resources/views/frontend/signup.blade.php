@extends('layouts.master')
@section('title') Signup  @endsection
@section('csss') 
<style type="text/css">
	
</style>
 @endsection
@section('content') 


	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-sm-10 col-12 mx-auto">
				<div class="signupform card mt-5 mb-5">
					<div class="card-header bg-color">
						<h4 class="text-white font-weight-bold">Register Account</h4>
					</div>

					<div class="card-body">
						<form>
							<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control">
									</div>
								</div>

								<div class="col-lg-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Username</label>
										<input type="text" class="form-control">
									</div>
								</div>

								<div class="col-lg-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Password</label>
										<input type="password" class="form-control">
									</div>
								</div>

								<div class="col-lg-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Postal Code</label>
										<input type="text" class="form-control">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-12">
									<div class="d-flex">
										<button class="btn btn-info btn-sm">Express Signup</button>
										<button class="btn btn-info btn-sm">Advance Signup</button>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<button class="btn btn-info">Submit <i class="fa fa-chevron-right ml-2"></i></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	

	 @endsection
 @section('script')
	 
   <script>
   	$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
   </script>

    @endsection
  
</body>
</html>