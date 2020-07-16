@extends('layouts.master')
@section('title') Login  @endsection
@section('csss') 
<style type="text/css">
	
</style>
 @endsection
@section('content') 


	<div class="signinpage">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 col-sm-6 col-12 ml-auto p-0">
					<div class="login-form shadow p-5 bg-white">
						<form>

							<h4 class="font-weight-bold text-color">Customer Login</h4>
							<div class="form-group">
								<label>Email ID <small class="text-color">Username</small></label>
								<input type="email" class="form-control">
							</div>

							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control">
								<p class="text-right"><a href="#" class="text-color">Forgot Password</a></p>
							</div>

							<div class="form-group">
								<button class="btn btn-info">Submit <i class="fa fa-chevron-right ml-2"></i></button>
							</div>

							<div class="form-group">
								<p>Don't have a account ? <a href="signup.html" class="text-color">Create Account</a></p>
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