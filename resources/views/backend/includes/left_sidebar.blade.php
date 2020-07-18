============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="@if(!empty(Auth::user()->profile_image)){{Auth::user()->profile_image}} @else {{ asset('assets/images/users/1.jpg') }} @endif" alt="user-img" class="img-circle"><span class="hide-menu">{{ Auth::user()->name }}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('/admin/profile') }}"><i class="ti-user"></i> My Profile</a></li>
                               <!--  <li><a href="javascript:void(0)"><i class="ti-wallet"></i> My Balance</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li> -->
                                <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                                <li><a href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                 document.getElementById('logout-form1').submit();"><i class="fa fa-power-off"></i> Logout</a></li>
                                 <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        <!-- <li class="nav-small-cap">--- PERSONAL</li> -->
                        <li> <a class="waves-effect waves-dark" href="{{ url('/admin/customers') }}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Customers <span class="badge badge-pill badge-cyan ml-auto"></span></span></a>

                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">Meal Plans</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ url('/admin/meals')}}">Meal Plas List</a></li>
                                <li><a href="{{ url('/admin/meals/create')}}">New Meal Plan</a></li> 
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Items</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="app-email.html">Item List</a></li>
                                <li><a href="app-email-detail.html">New Item</a></li> 
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Ingredients</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="app-email.html">Ingredients List</a></li>
                                <li><a href="app-email-detail.html">New Ingredients</a></li> 
                            </ul>
                        </li> 
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Ordes</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="app-email.html">Orders</a></li> 
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Settings</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="app-email.html">Postal Codes</a></li> 
                                <li><a href="app-email.html">How It Works</a></li> 
                                <li><a href="app-email.html">Faqs</a></li> 
                                <li><a href="app-email.html">Term & Condition</a></li> 
                                <li><a href="app-email.html">Privacy & Policy</a></li> 
                                <li><a href="app-email.html">Contact Us</a></li> 
                                <li><a href="app-email.html">Slider Setting</a></li> 
                            </ul>
                        </li> 
                        <li> <a class="waves-effect waves-dark" href="pages-faq.html" aria-expanded="false"><i class="far fa-circle text-info"></i><span class="hide-menu">FAQs</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ==============================================================