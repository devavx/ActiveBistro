<!DOCTYPE html>
<html lang="en">
{{--This is a comment!--}}
{{--This is a new comment!--}}
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/image/favicon-icon.png') }}">
	<meta name="csrf_token" content="{{ csrf_token() }}"/>
	<title>@yield('title')</title>
	<!-- This page CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- chartist CSS -->
	<link href="{{ asset('assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
	<!--Toaster Popup message CSS -->
	<link href="{{ asset('assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="{{ asset('assets/dist/css/style.min.css') }}" rel="stylesheet">
	<!-- Dashboard 1 Page CSS -->
	<link href="{{ asset('assets/dist/css/pages/dashboard1.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/node_modules/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,800;1,900&display=swap" rel="stylesheet">

	@yield('style')
	
</head>

<body class="skin-blue fixed-layout">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
	<div class="loader">
		{{--		<div class="loader__figure"></div>--}}
		<p class="loader__label"><i class="fa fa-spinner fa-spin" style="font-size: 48px; color: #03a9f3;"></i></p>
	</div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
	<!-- ============================================================== -->
	<!-- Topbar header - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<header class="topbar">
		<nav class="navbar top-navbar navbar-expand-md navbar-dark">
			<!-- ============================================================== -->
			<!-- Logo -->
			<!-- ============================================================== -->
			<div class="navbar-header">
				<a class="navbar-brand" href="{{ url('/admin') }}">
					<!-- Logo icon --><b>
						<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
						<!-- Dark Logo icon -->
					<!-- <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" /> -->
						<!-- Light Logo icon -->
					<!-- <img src="{{ asset('assets/images/logo-light-icon.png') }}" alt="homepage" class="light-logo" /> -->
					</b>
					<!--End Logo icon -->
					<!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <!-- <img src="{{ asset('assets/images/logo-text.png') }}" alt="homepage" class="dark-logo" /> -->
						<!-- Light Logo text -->
                         <img src="{{ asset('uploads/image/logo.png') }}" class="light-logo" alt="homepage" style="height: 45px;width: 200px;"/></span>
				</a>
			</div>
			<!-- ============================================================== -->
			<!-- End Logo -->
			<!-- ============================================================== -->
			<div class="navbar-collapse">
				<!-- ============================================================== -->
				<!-- toggle and nav items -->
				<!-- ============================================================== -->
				<ul class="navbar-nav mr-auto">
					<!-- This is  -->
					<li class="nav-item">
						<a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a>
					</li>
					<li class="nav-item">
						<a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a>
					</li>
					<!-- ============================================================== -->
					<!-- Search -->
					<!-- ============================================================== -->
					<!-- <li class="nav-item">
						<form class="app-search d-none d-md-block d-lg-block">
							<input type="text" class="form-control" placeholder="Search & enter">
						</form>
					</li> -->
				</ul>
				<!-- ============================================================== -->
				<!-- User profile and search -->
				<!-- ============================================================== -->
				<ul class="navbar-nav my-lg-0">
					<!-- User Profile -->
					<!-- ============================================================== -->
					<li class="nav-item dropdown u-pro">
						<a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="@if(!empty(Auth::user()->profile_image)){{Auth::user()->profile_image}} @else {{ asset('assets/images/users/1.jpg') }} @endif" alt="user" class="">
							<span class="hidden-md-down">{{ Auth::user()->name }} &nbsp;<i class="fa fa-angle-down"></i></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right animated flipInY">
							<!-- text-->
							<a href="{{ url('/admin/profile') }}" class="dropdown-item"><i class="ti-user"></i> My
								Profile</a>
							<!-- text-->
							<div class="dropdown-divider"></div>
							<!-- text-->
							<a href="{{ route('logout') }}"
							   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-power-off"></i>
								Logout</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
							<!-- text-->
						</div>
					</li>
					<!-- ============================================================== -->
					<!-- End User Profile -->

				</ul>
			</div>
		</nav>
	</header>
@include('backend.includes.left_sidebar')
@yield('content')
<!-- footer -->
	<!-- ============================================================== -->
	<footer class="footer">
		Copyright © {{date('Y')}} Active Bistro Ltd.
	</footer>
	<!-- ============================================================== -->
	<!-- End footer -->
	<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{ asset('assets/node_modules/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('assets/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
<!--Wave Effects -->
<!-- <script src="{{ asset('assets/dist/js/waves.js') }}"></script> -->
<!--Menu sidebar -->
<script src="{{ asset('assets/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('assets/dist/js/custom.min.js') }}"></script>
{{--<!-- ============================================================== -->--}}
<!-- This page plugins -->
<!-- ============================================================== -->
<!--morris JavaScript -->
{{--<!-- <script src="{{ asset('assets/node_modules/raphael/raphael-min.js') }}"></script> -->--}}
{{--<!-- <script src="{{ asset('assets/node_modules/morrisjs/morris.min.js') }}"></script> -->--}}
{{--<script src="{{ asset('assets/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>--}}
<!-- Popup message jquery -->
{{--<script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>--}}
<!-- Chart JS -->
{{--<script src="{{ asset('assets/dist/js/dashboard1.js') }}"></script>--}}
{{--<script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>--}}
<script src="{{ asset('assets/node_modules/dropify/dist/js/dropify.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
@include('backend.fragments.scripts')
<script src="{{ asset('js/custom.js') }}"></script>
@yield('script')
</body>

</html>