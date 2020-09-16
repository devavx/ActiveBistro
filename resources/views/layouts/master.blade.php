<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>@yield('title')</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="icon" type="image/png" href="{{ asset('uploads/image/favicon-white.png') }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/mdb.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,800;1,900&display=swap" rel="stylesheet">
	@yield('css')
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="mdblock">
				<li class="nav-item">
					<span class="header-time-slot nav-link text-color text-center"><b>Delivery Deadline:</b> 1 Hour 30 Minutes</span>
				</li>
			</div>
		</div>
	</div>
</div>

<hr class="mt-1 mb-0 mdblock">

<nav class="navbar navbar-expand-lg navbar-dark shadow">
	<div class="container">
		<a class="navbar-brand" href="{{ url('') }}"><img src="{{ asset('uploads/image/logo.png') }}"></a>

	<!-- <ul class="navbar-nav mdblock mx-auto">
			<li class="nav-item dropdown text-dark mt-2">
			    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
			    aria-haspopup="true" aria-expanded="false">Login</a>
			    <div class="dropdown-menu dropdown-primary pt-0 pb-0" aria-labelledby="navbarDropdownMenuLink">
			    <a class="dropdown-item" href="{{ url('/sign-in') }}">Log in</a>
			    <a class="dropdown-item" href="{{ url('/sign-up') }}">Sign Up</a>
			    </div>
			</li>
		</ul> -->


		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#activebistronavbar" aria-controls="activebistronavbar" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fa fa-bars"></i>
		</button>
		<div class="collapse navbar-collapse" id="activebistronavbar">
			<ul class="navbar-nav mx-auto">
				<div class="offcanvas-header mt-3">

					<button class="btn p-2 btn-close float-right"><i class="fa fa-times"></i></button>

					<h5 class="py-2 text-white"><img src="{{ asset('uploads/image/logo.png') }}" class="toggle-brand">
					</h5>
				</div>
				<li class="nav-item mdblock">
					<a class="nav-link" href="{{ url('/sign-in') }}">Log in</a>
				</li>
				<li class="nav-item mdblock">
					<a class="nav-link" href="{{ url('/sign-up') }}">Sign up</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ url('ourmenu') }}">Order Now</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="{{ url('/how_it_work') }}">How it Works</a>
				</li>

				<li class="nav-item">
					<span class="border p-2 rounded md-none header-time-slot nav-link text-color"><b>Delivery Deadline:</b> 1 Hour 30 Minutes</span>
				</li>

			</ul>
			<ul class="navbar-nav ml-auto">
				@guest
					<li class="nav-item md-none">
						<a class="nav-link" href="{{ url('/sign-in') }}">Log in</a>
					</li>

					<li class="nav-item md-none">
						<a class="nav-link headersignupbtn" href="{{ url('/sign-up') }}" style="color: #fff !important;">Sign up</a>
					</li>
				@else
					<li class="nav-item">
						<a class="nav-link text-color" href="@if(Auth::user()->role->name =='admin'){{ url('/admin') }} @else {{ url('/home') }} @endif">
							<img src="@if(!empty(Auth::user()->profile_image)){{Auth::user()->profile_image}} @else {{ asset('uploads/image/agent.jpg') }} @endif" class="rounded-circle userprofile-img"><span class="ml-2">{{ Auth::user()->name }}</span></a>
					</li>
					<li class="nav-item dropdown mt-2">
						<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">My Account</a>
						<div class="dropdown-menu dropdown-primary pt-0 pb-0" aria-labelledby="navbarDropdownMenuLink">
							@if(Auth::user()->role->name=='admin')
								<a class="dropdown-item" href="{{ url('admin') }}">My Admin</a>
							@else
								<a class="dropdown-item" href="{{ url('my_order') }}">My Order</a>
								<a class="dropdown-item" href="{{ url('/home') }}">My Profile</a>
							@endif
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form1').submit();">Log Out</a>
							<form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>

@yield('content')


<div class="footer pt-5 pb-5 bg-color">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-sm-3 col-12">
				<div class="footer-left">
					<ul>
						<li><a href="#"><i class="fa fa-facebook facebook-icon"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter twitter-icon"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram insta-icon"></i></a></li>
					</ul>
				</div>
			</div>

			<div class="col-lg-6 col-sm-6 col-12">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-12">
						<div class="footer-middel">
							<h5 class="text-white mb-0">Company</h5>
							<hr>
							<ul>
								<li><a href="{{ url('/about') }}"><i class="fa fa-chevron-right mr-2"></i>About Us</a>
								</li>

								<li>
									<a href="{{ url('/privacy_policy') }}"><i class="fa fa-chevron-right mr-2"></i>Privacy &
										Policy</a></li>
								<li>
									<a href="{{ url('/term_condition') }}"><i class="fa fa-chevron-right mr-2"></i>Term &
										Use</a></li>
							</ul>
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-12">
						<div class="footer-middel">
							<h5 class="text-white mb-0">Support</h5>
							<hr>
							<ul>

								<li>
									<a href="{{ url('/contact') }}"><i class="fa fa-chevron-right mr-2"></i>Contact Us</a>
								</li>
								<li><a href="{{ url('/faq') }}"><i class="fa fa-chevron-right mr-2"></i>Faqs</a></li>

							</ul>
						</div>
					</div>
				</div>

			</div>

			<div class="col-lg-3 col-sm-3 col-12">
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
				<p class="mb-0 text-right">Copyright <i class="fa fa-copyright"></i> by
					<a href="{{ url('') }}" class="text-white">ACTIVE BISTRO</a></p>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="{{ asset('assets/js/jquery-3.4.1.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('assets/js/custom.js') }} "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
@include('backend.fragments.scripts')
@yield('script')
</body>
</html>