<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>@yield('title')</title>
	<meta name="description" content="">
  	<meta name="keywords" content="">
  	<link rel="icon" type="image/png" href="image/favicon-icon.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/mdb.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,800;1,900&display=swap" rel="stylesheet">
	@yield('css')
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark shadow">
		<div class="container">
			<a class="navbar-brand" href="{{ url('') }}"><img src="{{ asset('uploads/image/logo.png') }}"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#activebistronavbar" aria-controls="activebistronavbar" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fa fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="activebistronavbar">
				<ul class="navbar-nav mx-auto">
				    <li class="nav-item">
					    <a class="nav-link" href="{{ url('ourmenu') }}">Our Menu</a>
				    </li>

				    <li class="nav-item">
					    <a class="nav-link" href="#">How it Works</a>
				    </li>

				    <li class="nav-item">
					    <span class="border p-2 rounded header-time-slot nav-link text-color"><b>Delivery Deadline:</b> 1 Hour 30 Minutes</span>
				    </li>

				</ul>
				<ul class="navbar-nav ml-auto">
				    <li class="nav-item">
					    <a class="nav-link" href="{{ url('login') }}">Login</a>
				    </li>

				    <li class="nav-item">
					    <a class="nav-link" href="{{ url('signup') }}">Signup</a>
				    </li>
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')


	<div class="footer pt-5 pb-5 bg-color">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-sm-4 col-12">
					<div class="footer-left">
						<ul>
							<li><a href="#"><i class="fa fa-facebook facebook-icon"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter twitter-icon"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram insta-icon"></i></a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-4 col-sm-4 col-12">
					<div class="footer-middel">
						<h4 class="text-white">Quick Link</h4>
						<hr>
						<ul>
							<li><a href="#"><i class="fa fa-chevron-right mr-2"></i>Contact Us</a></li>
							<li><a href="#"><i class="fa fa-chevron-right mr-2"></i>Faqs</a></li>
							<li><a href="#"><i class="fa fa-chevron-right mr-2"></i>Privacy & Policy</a></li>
							<li><a href="#"><i class="fa fa-chevron-right mr-2"></i>Term & Use</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-4 col-sm-4 col-12">
					<div class="footer-right text-right">
						<img src="{{ asset('uploads/image/payment-img.png') }}">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-copy bg-color pt-2 pb-2">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<p class="mb-0 text-right">Copyright <i class="fa fa-copyright"></i> by <a href="{{ url('') }}" class="text-white">ACTIVE BISTRO</a></p>
				</div>
			</div>
		</div>
	</div>

	
	<script type="text/javascript" src="{{ asset('assets/js/jquery-3.4.1.min.js') }} "></script>
  <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }} "></script>
  <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }} "></script>
   <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }} "></script>

   
  @yield('script')
</body>
</html>