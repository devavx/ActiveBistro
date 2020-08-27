<?php
$uri1 = Request::segment(1);
$uri2 = Request::segment(2);
?>
<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
			{{--				<li class="user-pro">--}}
			{{--					<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="@if(!empty(Auth::user()->profile_image)){{Auth::user()->profile_image}} @else {{ asset('assets/images/users/1.jpg') }} @endif" alt="user-img" class="img-circle"><span class="hide-menu">{{ Auth::user()->name }}</span></a>--}}
			{{--					<ul aria-expanded="false" class="collapse">--}}
			{{--						<li><a href="{{ url('/admin/profile') }}"><i class="ti-user"></i> My Profile</a></li>--}}
			{{--						<!--  <li><a href="javascript:void(0)"><i class="ti-wallet"></i> My Balance</a></li>--}}
			{{--						 <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li> -->--}}
			{{--						<!-- <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li> -->--}}
			{{--						<li><a href="{{ route('logout') }}"--}}
			{{--						       onclick="event.preventDefault();--}}
			{{--                                 document.getElementById('logout-form1').submit();"><i class="fa fa-power-off"></i>--}}
			{{--								Logout</a></li>--}}
			{{--						<form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
			{{--							@csrf--}}
			{{--						</form>--}}
			{{--					</ul>--}}
			{{--				</li>--}}
			<!-- <li class="nav-small-cap">--- PERSONAL</li> -->
				<li>
					<a class="waves-effect waves-dark" href="{{ url('/admin/customers') }}" aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">Customers <span class="badge badge-pill badge-cyan ml-auto"></span></span></a>

				</li>
				<li>
					<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-list"></i><span class="hide-menu">Category</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="{{ url('/admin/category')}}">Category List</a></li>
						<li><a href="{{ url('/admin/category/create')}}">New Category</a></li>
					</ul>
				</li>
				<li>
					<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Daily Meals</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="{{ url('/admin/daily-meals')}}">Daily Meals</a></li>
						<li><a href="{{ url('/admin/daily-meals/create')}}">Create New</a></li>
					</ul>
				</li>
				<li>
					<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Meals</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="{{ url('/admin/meals')}}">Meals</a></li>
						<li><a href="{{ url('/admin/meals/create')}}">Create New</a></li>
					</ul>
				</li>
				<li>
					<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-list"></i><span class="hide-menu">Items</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="{{ url('/admin/items') }}">Item List</a></li>
						<li><a href="{{ url('/admin/items/create') }}">New Item</a></li>
					</ul>
				</li>
				<li>
					<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-list"></i><span class="hide-menu">Item Type</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="{{ url('/admin/item_type') }}">Item Type List</a></li>
						<li><a href="{{ url('/admin/item_type/create') }}">New Item Type</a></li>
					</ul>
				</li>
				<li>
					<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-list"></i><span class="hide-menu">Ingredients</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="{{ url('/admin/ingredient') }}">Ingredients List</a></li>
						<li><a href="{{ url('/admin/ingredient/create') }}">New Ingredients</a></li>
					</ul>
				</li>
				<li>
					<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-list"></i><span class="hide-menu">Orders</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="{{ url('/admin/orders') }}">Orders</a></li>
					</ul>
				</li>
				<li>
					<a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Settings</span></a>
					<ul aria-expanded="false" class="collapse @if($uri2=='faqs' || $uri2 == 'postal_codes' || $uri2 == 'how_it_works' || $uri2 == 'term_conditions' || $uri2 == 'privacy_policy' || $uri2 == 'contact_us' || $uri2 == 'sliders')in @endif" style="margin-bottom: 45px;">
						<li class="@if($uri2 =='postal_codes')active @endif">
							<a href="{{ url('/admin/postal_codes') }}" class="@if($uri2 =='postal_codes')active @endif">Postal
								Codes</a></li>

						<li class="@if($uri2 =='how_it_works')active @endif">
							<a class="@if($uri2 =='how_it_works')active @endif" href="{{ url('/admin/how_it_works') }}">How
								It Works</a></li>

						<li class="@if($uri2 =='faqs')active @endif">
							<a class="@if($uri2 =='faqs')active @endif" href="{{ url('/admin/faqs') }}">FAQ's</a></li>

						<li class="@if($uri2 =='term_conditions')active @endif">
							<a class="@if($uri2 =='term_conditions')active @endif" href="{{ url('/admin/term_conditions') }}">Terms
								& Condition</a></li>

						<li class="@if($uri2 =='privacy_policy')active @endif">
							<a class="@if($uri2 =='privacy_policy')active @endif" href="{{ url('/admin/privacy_policy') }}">Privacy
								& Policy</a></li>

						<li class="@if($uri2 =='contact_us')active @endif">
							<a class="@if($uri2 =='contact_us')active @endif" href="{{ url('/admin/contact_us') }}">Contact
								Us</a></li>

						<li class="@if($uri2 =='sliders')active @endif">
							<a class="@if($uri2 =='sliders')active @endif" href="{{ url('/admin/sliders') }}">Slider
								Setting</a></li>
						<li class="@if($uri2 =='home_setting')active @endif">
							<a class="@if($uri2 =='home_setting')active @endif" href="{{ url('/admin/home_setting') }}">Home
								Setting</a></li>
						<li class="@if($uri2 =='social_medial')active @endif">
							<a class="@if($uri2 =='social_medial')active @endif" href="{{ url('/admin/social_medial') }}">Footer
								Social Media</a></li>
					</ul>
				</li>
				<!-- <li> <a class="waves-effect waves-dark" href="pages-faq.html" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">FAQs</span></a></li> -->
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
         