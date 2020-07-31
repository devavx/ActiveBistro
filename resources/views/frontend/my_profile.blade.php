<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Active Bistro</title>
	<meta name="description" content="">
  	<meta name="keywords" content="">
  	<link rel="icon" type="image/png" href="image/favicon-icon.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/mdb.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark shadow">
		<div class="container">
			<a class="navbar-brand" href="index.html"><img src="image/logo.png"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#activebistronavbar" aria-controls="activebistronavbar" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fa fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="activebistronavbar">
				<ul class="navbar-nav mx-auto">
				    <li class="nav-item">
					    <a class="nav-link" href="order-now.html">Order Now</a>
				    </li>

				    <li class="nav-item">
					    <a class="nav-link" href="howitwork.html">How it Works</a>
				    </li>

				    <li class="nav-item">
					    <span class="border p-2 rounded header-time-slot nav-link text-color"><b>Delivery Deadline:</b> 1 Hour 30 Minutes</span>
				    </li>

				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
					    <a class="nav-link text-color" href="#"> <img src="image/agent.jpg" class="rounded-circle userprofile-img"><span class="ml-2">Mark Jaimes</span></a>
				    </li>
				    <li class="nav-item dropdown mt-2">
				        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
				          aria-haspopup="true" aria-expanded="false">My Account</a>
				        <div class="dropdown-menu dropdown-primary pt-0 pb-0" aria-labelledby="navbarDropdownMenuLink">
				          <a class="dropdown-item" href="my-order.html">My Order</a>
				          <a class="dropdown-item" href="my-profile.html">My Profile</a>
				          <a class="dropdown-item" href="index.html">Log Out</a>
				        </div>
				    </li>
				</ul>
			</div>
		</div>
	</nav>
	

	<div class="container mt-3 mb-5">
		<div class="row">
			<div class="col-lg-8 col-sm-8 col-12">
				<div class="myprofiledetail mt-3 shadow p-3">

					<h5 class="font-weight-bold text-color">Personal Detail</h5>
					<hr>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-12">
							<label>First Name</label>
							<p class="text-color">Ravi</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Last Name</label>
							<p class="text-color">Kant</p>
						</div>
						<div class="col-lg-6 col-sm-6 col-12">
							<label>Email Address</label>
							<p class="text-color">hannagover@gmail.com</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Phone</label>
							<p class="text-color">+91 654 784 547</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Address</label>
							<p class="text-color">71 Pilgrim Avenue Chevy Chase, MD 20815</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Shipping Address</label>
							<p class="text-color">71 Pilgrim Avenue Chevy Chase, MD 20815</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Height</label>
							<p class="text-color">5.5 M</p>
						</div>

						<div class="col-lg-6 col-sm-6 col-12">
							<label>Weight</label>
							<p class="text-color">150 Kg</p>
						</div>


						<div class="col-lg-6 col-sm-6 col-12">
							<h6 class="text-color font-weight-bold">Recommended</h6>
							<table class="table table-striped table-bordered">
						        <tr class="text-center">
						        	<th class="p-2 w-50">Calories</th>
						        	<td class="p-2 w-50" colspan="2">3400 kcal</td>
						        </tr>

						        <tr class="text-center">
						        	<td class="p-2">180 g</td>
						        	<td class="p-2">90 g</td>
						        	<td class="p-2">364 g</td>
						        </tr>

						        <tr class="text-center">
						        	<th class="p-2">Protein</th>
						        	<th class="p-2">Fat</th>
						        	<th class="p-2">Carbohydrate</th>
						        </tr>
						    </table>
						</div>
					</div>

					<button class="btn btn-info ml-0" data-toggle="modal" data-target="#changedetail">Change Information</button>
				</div>
			</div>

			<div class="col-lg-4 col-sm-4 col-12">
				<div class="change-password p-3 shadow mt-3">
					<h5 class="font-weight-bold text-color">Change Password</h5>
					<hr>

					<form>
						<div class="form-group">
							<label>Enter old password</label>
							<input type="password" class="form-control">
						</div>

						<div class="form-group">
							<label>Enter new password</label>
							<input type="password" class="form-control">
						</div>

						<div class="form-group">
							<label>Confirm password</label>
							<input type="password" class="form-control">
						</div>

						<div class="form-group">
							<button class="btn btn-info ml-0">Change</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<div class="footer pt-3 pb-0 bg-color">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-sm-4 col-12">
					<div class="footer-left mt-2">
						<ul>
							<li><a href="#"><i class="fa fa-facebook facebook-icon"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter twitter-icon"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram insta-icon"></i></a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-4 col-sm-4 col-12">
					<div class="footer-middel mt-2">
						<h4 class="text-white mb-0">Quick Link</h4>
						<hr class="mt-1 mb-1">
						<ul>
							<li><a href="aboutus.html"><i class="fa fa-chevron-right mr-2"></i>About Us</a></li>
							<li><a href="contactus.html"><i class="fa fa-chevron-right mr-2"></i>Contact Us</a></li>
							<li><a href="privacy-policy.html"><i class="fa fa-chevron-right mr-2"></i>Privacy & Policy</a></li>
							<li><a href="faqs.html"><i class="fa fa-chevron-right mr-2"></i>Faqs</a></li>
							<li><a href="term-use.html"><i class="fa fa-chevron-right mr-2"></i>Term & Use</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-4 col-sm-4 col-12">
					<div class="footer-right text-right mt-2">
						<img src="image/payment-img.png">
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="footer-copy bg-color pt-2 pb-2">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<p class="mb-0 text-right">Copyright <i class="fa fa-copyright"></i> by <a href="index.html" class="text-white">ACTIVE BISTRO</a></p>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade right shadow" id="changedetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  		<div class="modal-dialog  modal-full-height modal-right" role="document">


    		<div class="modal-content">
     			<div class="modal-header bg-color ">
        			<h5 class="modal-title w-100 text-white">Change Persnal Detail</h5>
        			<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true" class="text-white">&times;</span>
        			</button>
      			</div>
	      		<div class="modal-body">
	      			<form>
	      				<div class="form-group">
	      					<label>Email Address</label>
	      					<input type="text" class="form-control">
	      				</div>

	      				<div class="form-group">
	      					<label>Phone</label>
	      					<input type="text" class="form-control">
	      				</div>

	      				<div class="form-group">
	      					<label>Address</label>
	      					<textarea class="form-control" rows="3"></textarea>
	      				</div>

	      				<div class="form-group">
	      					<label>Shipping Address</label>
	      					<textarea class="form-control" rows="3"></textarea>
	      				</div>

	      				<div class="form-group">
	      					<label>Height</label>
	      					<input type="text" class="form-control">
	      				</div>

	      				<div class="form-group">
	      					<label>Weight</label>
	      					<input type="text" class="form-control">
	      				</div>

	      				<div class="form-group">
	      					<a href="reset-password.html" class="btn btn-info">Submit <i class="fa fa-chevron-right ml-2"></i></a>
	      				</div>
	      			</form>
	       			 
	      		</div>
	    	</div>
  		</div>
	</div>

	
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
   <script type="text/javascript" src="js/mdb.min.js"></script>

   <script>
   	$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
   </script>
  
</body>
</html>