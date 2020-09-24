@extends('backend.master')

@section('title') Admin | Dashboard @endsection

@section('style')
	<style type="text/css"></style>
@endsection
@section('content')
	<!-- Page wrapper  -->
	<!-- ============================================================== -->
	<div class="page-wrapper">
		<!-- ============================================================== -->
		<!-- Container fluid  -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Dashboard </h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
						<!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- End Bread crumb and right sidebar toggle -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- Info box -->
			<!-- ============================================================== -->
			<div class="card-group">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
										<!-- <h3><i class="ti-user text-primary"></i></h3> -->
										<img src="{{ asset('assets/images/1.jpg') }}">
										<p class="text-muted font-weight-bold">Customers</p>
									</div>
									<div class="ml-auto">
										<h2 class="counter text-primary">{{ $stats->customers }}</h2>
									</div>
								</div>
							</div>
							<!-- <div class="col-12">
								<div class="progress">
									<div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div> -->
						</div>
					</div>
				</div>
				<!-- Column -->
				<!-- Column -->
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
										<!-- <h3><i class="ti-server text-cyan"></i></h3> -->
										<img src="{{ asset('assets/images/2.jpg') }}">
										<p class="text-muted font-weight-bold">Daily Meals</p>
									</div>
									<div class="ml-auto">
										<h2 class="counter text-cyan">{{ $stats->dailyMeals }}</h2>
									</div>
								</div>
							</div>
							<!-- <div class="col-12">
								<div class="progress">
									<div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div> -->
						</div>
					</div>
				</div>
				<!-- Column -->
				<!-- Column -->
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
										<!-- <h3><i class="ti-layout-media-overlay text-purple"></i></h3> -->

										<img src="{{ asset('assets/images/3.jpg') }}">
										<p class="text-muted font-weight-bold">Meals</p>
									</div>
									<div class="ml-auto">
										<h2 class="counter text-purple">{{ $stats->meals }}</h2>
									</div>
								</div>
							</div>
							<!-- <div class="col-12">
								<div class="progress">
									<div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div> -->
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
										<!-- <h3><i class="ti-layout-menu-v text-success"></i></h3> -->
										<img src="{{ asset('assets/images/4.jpg') }}">
										<p class="text-muted font-weight-bold">Items</p>
									</div>
									<div class="ml-auto">
										<h2 class="counter text-success">{{$stats->items}}</h2>
									</div>
								</div>
							</div>
							<!-- <div class="col-12">
								<div class="progress">
									<div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div> -->
						</div>
					</div>
				</div>
			</div>
			<div class="card-group">
				<!-- Column -->
				<!-- Column -->

				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
										<!-- <h3><i class="ti-tag text-info"></i></h3> -->

										<img src="{{ asset('assets/images/5.jpg') }}">
										<p class="text-muted font-weight-bold">Coupons</p>
									</div>
									<div class="ml-auto">
										<h2 class="counter text-info">{{$stats->coupons}}</h2>
									</div>
								</div>
							</div>
							<!-- <div class="col-12">
								<div class="progress">
									<div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div> -->
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
										<!-- <h3><i class="ti-bolt-alt text-warning"></i></h3> -->
										<img src="{{ asset('assets/images/6.jpg') }}">
										<p class="text-muted font-weight-bold">Ingredients</p>
									</div>
									<div class="ml-auto">
										<h2 class="counter text-warning">{{$stats->ingredients}}</h2>
									</div>
								</div>
							</div>
							<!-- <div class="col-12">
								<div class="progress">
									<div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div> -->
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
										<!-- <h3><i class="ti-truck text-cyan"></i></h3> -->

										<img src="{{ asset('assets/images/7.jpg') }}">
										<p class="text-muted font-weight-bold">Order</p>
									</div>
									<div class="ml-auto">
										<h2 class="counter text-cyan">{{$stats->orders}}</h2>
									</div>
								</div>
							</div>
							<!-- <div class="col-12">
								<div class="progress">
									<div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div> -->
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
										<!-- <h3><i class="ti-fullscreen text-danger"></i></h3> -->

										<img src="{{ asset('assets/images/8.jpg') }}">
										<p class="text-muted font-weight-bold">Allergies</p>
									</div>
									<div class="ml-auto">
										<h2 class="counter text-danger">3</h2>
									</div>
								</div>
							</div>
							<!-- <div class="col-12">
								<div class="progress">
									<div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- End Info box -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Over Visitor, Our income , slaes different and  sales prediction -->
		<!-- ============================================================== -->
		<!-- <div class="row"> -->
		<!-- Column -->
		<!-- <div class="col-lg-8 col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex m-b-40 align-items-center no-block">
						<h5 class="card-title ">YEARLY SALES</h5>
						<div class="ml-auto">
							<ul class="list-inline font-12">
								<li><i class="fa fa-circle text-cyan"></i> Iphone</li>
								<li><i class="fa fa-circle text-primary"></i> Ipad</li>
								<li><i class="fa fa-circle text-purple"></i> Ipod</li>
							</ul>
						</div>
					</div>
					<div id="morris-area-chart" style="height: 340px;"></div>
				</div>
			</div>
		</div> -->
		<!-- Column -->
		<!-- <div class="col-lg-4 col-md-12">
			<div class="row"> -->
		<!-- Column -->
		<!-- <div class="col-md-12">
			<div class="card bg-cyan text-white">
				<div class="card-body ">
					<div class="row weather">
						<div class="col-6 m-t-40">
							<h3>&nbsp;</h3>
							<div class="display-4">73<sup>°F</sup></div>
							<p class="text-white">AHMEDABAD, INDIA</p>
						</div>
						<div class="col-6 text-right">
							<h1 class="m-b-"><i class="wi wi-day-cloudy-high"></i></h1>
							<b class="text-white">SUNNEY DAY</b>
							<p class="op-5">April 14</p>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- Column -->
		<!-- <div class="col-md-12">
			<div class="card bg-primary text-white">
				<div class="card-body">
					<div id="myCarouse2" class="carousel slide" data-ride="carousel"> -->
		<!-- Carousel items -->
	<!-- <div class="carousel-inner">
										<div class="carousel-item active">
											<h4 class="cmin-height">My Acting blown <span class="font-medium">Your Mind</span> and you also <br/>laugh at the moment</h4>
											<div class="d-flex no-block">
												<span><img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" width="50" class="img-circle"></span>
												<span class="m-l-10">
													<h4 class="text-white m-b-0">Govinda</h4>
													<p class="text-white">Actor</p>
												</span>
											</div>
										</div>
										<div class="carousel-item">
											<h4 class="cmin-height">My Acting blown <span class="font-medium">Your Mind</span> and you also <br/>laugh at the moment</h4>
											<div class="d-flex no-block">
												<span><img src="{{ asset('assets/images/users/2.jpg') }}" alt="user" width="50" class="img-circle"></span>
												<span class="m-l-10">
													<h4 class="text-white m-b-0">Govinda</h4>
													<p class="text-white">Actor</p>
												</span>
											</div>
										</div>
										<div class="carousel-item">
											<h4 class="cmin-height">My Acting blown <span class="font-medium">Your Mind</span> and you also <br/>laugh at the moment</h4>
											<div class="d-flex no-block">
												<span><img src="{{ asset('assets/images/users/3.jpg') }}" alt="user" width="50" class="img-circle"></span>
												<span class="m-l-10">
													<h4 class="text-white m-b-0">Govinda</h4>
													<p class="text-white">Actor</p>
												</span>
											</div>
										</div>
									</div> -->
		<!-- 	</div>
		</div>
	</div>
</div> -->
		<!-- Column -->
		<!-- </div>
	</div> -->
		<!-- </div> -->
		<!-- ============================================================== -->
		<!-- Comment - table -->
		<!-- ============================================================== -->
	<!-- <div class="row">
			  <div class="col-lg-6">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Recent Comments</h5>
					</div>
					 <div class="comment-widgets"> 
						<div class="d-flex no-block comment-row">
							<div class="p-2"><span class="round"><img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" width="50"></span></div>
							<div class="comment-text w-100">
								<h5 class="font-medium">James Anderson</h5>
								<p class="m-b-10 text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry.</p>
								<div class="comment-footer">
									<span class="text-muted pull-right">April 14, 2016</span> <span class="badge badge-pill badge-info">Pending</span> <span class="action-icons">
										<a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
										<a href="javascript:void(0)"><i class="ti-check"></i></a>
										<a href="javascript:void(0)"><i class="ti-heart"></i></a>    
									</span>
								</div>
							</div>
						</div>

						<div class="d-flex no-block comment-row border-top">
							<div class="p-2"><span class="round"><img src="{{ asset('assets/images/users/2.jpg') }}" alt="user" width="50"></span></div>
							<div class="comment-text active w-100">
								<h5 class="font-medium">Michael Jorden</h5>
								<p class="m-b-10 text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry..</p>
								<div class="comment-footer">
									<span class="text-muted pull-right">April 14, 2016</span>
									<span class="badge badge-pill badge-success">Approved</span>
									<span class="action-icons active">
										<a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
										<a href="javascript:void(0)"><i class="icon-close"></i></a>
										<a href="javascript:void(0)"><i class="ti-heart text-danger"></i></a>    
									</span>
								</div>
							</div>
						</div>

						<div class="d-flex no-block comment-row border-top">
							<div class="p-2"><span class="round"><img src="{{ asset('assets/images/users/3.jpg') }}" alt="user" width="50"></span></div>
							<div class="comment-text w-100">
								<h5 class="font-medium">Johnathan Doeting</h5>
								<p class="m-b-10 text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry.</p>
								<div class="comment-footer">
									<span class="text-muted pull-right">April 14, 2016</span>
									<span class="badge badge-pill badge-danger">Rejected</span>
									<span class="action-icons">
										<a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
										<a href="javascript:void(0)"><i class="ti-check"></i></a>
										<a href="javascript:void(0)"><i class="ti-heart"></i></a>    
									</span>
								</div>
							</div>
						</div> 
						<div class="d-flex no-block comment-row border-top">
							<div class="p-2"><span class="round"><img src="{{ asset('assets/images/users/4.jpg') }}" alt="user" width="50"></span></div>
							<div class="comment-text active w-100">
								<h5 class="font-medium">Genelia doe</h5>
								<p class="m-b-10 text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry..</p>
								<div class="comment-footer">
									<span class="text-muted pull-right">April 14, 2016</span>
									<span class="badge badge-pill badge-success">Approved</span>
									<span class="action-icons active">
										<a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
										<a href="javascript:void(0)"><i class="icon-close"></i></a>
										<a href="javascript:void(0)"><i class="ti-heart text-danger"></i></a>    
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> 
			<div class="col-lg-6">
				<div class="card">
					<div class="card-body">
						<div class="d-flex">
							<div>
								<h5 class="card-title">Sales Overview</h5>
								<h6 class="card-subtitle">Check the monthly sales </h6>
							</div>
							<div class="ml-auto">
								<select class="form-control b-0">
									<option>January</option>
									<option value="1">February</option>
									<option value="2" selected="">March</option>
									<option value="3">April</option>
								</select>
							</div>
						</div>
					</div>
					<div class="card-body bg-light">
						<div class="row">
							<div class="col-6">
								<h3>March 2017</h3>
								<h5 class="font-light m-t-0">Report for this month</h5></div>
								<div class="col-6 align-self-center display-6 text-right">
									<h2 class="text-success">$3,690</h2></div>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-hover no-wrap">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>NAME</th>
											<th>STATUS</th>
											<th>DATE</th>
											<th>PRICE</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td class="txt-oflo">Elite admin</td>
											<td><span class="badge badge-success badge-pill">sale</span> </td>
											<td class="txt-oflo">April 18, 2017</td>
											<td><span class="text-success">$24</span></td>
										</tr>
										<tr>
											<td class="text-center">2</td>
											<td class="txt-oflo">Real Homes</td>
											<td><span class="badge badge-info badge-pill">extended</span></td>
											<td class="txt-oflo">April 19, 2017</td>
											<td><span class="text-info">$1250</span></td>
										</tr>
										<tr>
											<td class="text-center">3</td>
											<td class="txt-oflo">Ample Admin</td>
											<td><span class="badge badge-info badge-pill">extended</span></td>
											<td class="txt-oflo">April 19, 2017</td>
											<td><span class="text-info">$1250</span></td>
										</tr>
										<tr>
											<td class="text-center">4</td>
											<td class="txt-oflo">Medical Pro</td>
											<td><span class="badge badge-danger badge-pill">tax</span></td>
											<td class="txt-oflo">April 20, 2017</td>
											<td><span class="text-danger">-$24</span></td>
										</tr>
										<tr>
											<td class="text-center">5</td>
											<td class="txt-oflo">Hosting press html</td>
											<td><span class="badge badge-success badge-pill">sale</span></td>
											<td class="txt-oflo">April 21, 2017</td>
											<td><span class="text-success">$24</span></td>
										</tr>
										<tr>
											<td class="text-center">6</td>
											<td class="txt-oflo">Digital Agency PSD</td>
											<td><span class="badge badge-success badge-pill">sale</span> </td>
											<td class="txt-oflo">April 23, 2017</td>
											<td><span class="text-danger">-$14</span></td>
										</tr>
										<tr>
											<td class="text-center">7</td>
											<td class="txt-oflo">Helping Hands</td>
											<td><span class="badge badge-warning badge-pill">member</span></td>
											<td class="txt-oflo">April 22, 2017</td>
											<td><span class="text-success">$64</span></td>
										</tr>
										<tr>
											<td class="text-center">8</td>
											<td class="txt-oflo">Ample Admin</td>
											<td><span class="badge badge-info badge-pill">extended</span></td>
											<td class="txt-oflo">April 19, 2017</td>
											<td><span class="text-info">$1250</span></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>-->
		<!-- ============================================================== -->
		<!-- End Comment - chats -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Over Visitor, Our income , slaes different and  sales prediction -->
		<!-- ============================================================== -->
		<!-- <div class="row"> -->
		<!-- Column -->
		<!-- <div class="col-lg-8 col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="d-flex m-b-40 align-items-center no-block">
						<h5 class="card-title ">SALES DIFFERENCE</h5>
						<div class="ml-auto">
							<ul class="list-inline font-12">
								<li><i class="fa fa-circle text-cyan"></i> SITE A</li>
								<li><i class="fa fa-circle text-primary"></i> SITE B</li>
							</ul>
						</div>
					</div>
					<div id="morris-area-chart2" style="height: 340px;"></div>
				</div>
			</div>
		</div> -->
		<!-- Column -->
		<!-- <div class="col-lg-4 col-md-12">
			<div class="row"> -->
		<!-- Column -->
		<!-- <div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">SALES DIFFERENCE</h5>
					<div class="row">
						<div class="col-6  m-t-30">
							<h1 class="text-info">$647</h1>
							<p class="text-muted">APRIL 2017</p>
							<b>(150 Sales)</b> </div>
							<div class="col-6">
								<div id="sparkline2dash" class="text-right"></div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		<!-- Column -->
		<!-- <div class="col-md-12">
			<div class="card bg-purple text-white">
				<div class="card-body">
					<h5 class="card-title">VISIT STATASTICS</h5>
					<div class="row">
						<div class="col-6  m-t-30">
							<h1 class="text-white">$347</h1>
							<p class="light_op_text">APRIL 2017</p>
							<b class="text-white">(150 Sales)</b> </div>
							<div class="col-6">
								<div id="sales1" class="text-right"></div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		<!-- Column -->
		<!-- </div>
		</div> -->
		<!-- </div> -->
		<!-- ============================================================== -->
		<!-- End Page Content -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Todo, chat, notification -->
		<!-- ============================================================== -->
		<!-- <div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body"> -->
		<!-- <div class="d-flex no-block align-items-center">
			<div>
				<h5 class="card-title m-b-0">TO DO LIST</h5>
			</div>
			<div class="ml-auto">
				<button class="pull-right btn btn-circle btn-success" data-toggle="modal" data-target="#myModal"><i class="ti-plus"></i></button>
			</div>
		</div> -->
		<!-- ============================================================== -->
		<!-- To do list widgets -->
		<!-- ============================================================== -->
		<!-- <div class="to-do-widget m-t-20" id="todo" style="height: 400px;position: relative;"> -->
		<!-- .modal for add task -->
		<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document"> -->
		<!-- <div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Task</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label>Task name</label>
						<input type="text" class="form-control" placeholder="Enter Task Name"> </div>
						<div class="form-group">
							<label>Assign to</label>
							<select class="custom-select form-control pull-right">
								<option selected="">Sachin</option>
								<option value="1">Sehwag</option>
								<option value="2">Pritam</option>
								<option value="3">Alia</option>
								<option value="4">Varun</option>
							</select>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
				</div>
			</div> -->
		<!-- /.modal-content -->
		<!-- </div> -->
		<!-- /.modal-dialog -->
		<!-- </div> -->
		<!-- /.modal -->
	<!-- <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
													<li class="list-group-item" data-role="task">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck">
															<label class="custom-control-label" for="customCheck">
																<span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</span> <span class="badge badge-pill badge-danger float-right">Today</span>
															</label>
														</div>
														<ul class="assignedto">
															<li><img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Steave"></li>
															<li><img src="{{ asset('assets/images/users/2.jpg') }}" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Jessica"></li>
															<li><img src="{{ asset('assets/images/users/3.jpg') }}" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
															<li><img src="{{ asset('assets/images/users/4.jpg') }}" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
														</ul>
													</li>
													<li class="list-group-item" data-role="task">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck1">
															<label class="custom-control-label" for="customCheck1">
																<span>Lorem Ipsum is simply dummy text of the printing</span><span class="badge badge-pill badge-primary float-right">1 week </span>
															</label>
														</div>
														<div class="item-date"> 26 jun 2017</div>
													</li>
													<li class="list-group-item" data-role="task">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck2">
															<label class="custom-control-label" for="customCheck2">
																<span>Give Purchase report to</span> <span class="badge badge-pill badge-info float-right">Yesterday</span>
															</label>
														</div>
														<ul class="assignedto">
															<li><img src="{{ asset('assets/images/users/3.jpg') }}" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
															<li><img src="{{ asset('assets/images/users/4.jpg') }}" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
														</ul>
													</li>
													<li class="list-group-item" data-role="task">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck3">
															<label class="custom-control-label" for="customCheck3">
																<span>Lorem Ipsum is simply dummy text of the printing </span> <span class="badge badge-pill badge-warning float-right">2 weeks</span>
															</label>
														</div>
														<div class="item-date"> 26 jun 2017</div>
													</li>
													<li class="list-group-item" data-role="task">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck4">
															<label class="custom-control-label" for="customCheck4">
																<span>Give Purchase report to</span> <span class="badge badge-pill badge-info float-right">Yesterday</span>
															</label>
														</div>
														<ul class="assignedto">
															<li><img src="{{ asset('assets/images/users/3.jpg') }}" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
															<li><img src="{{ asset('assets/images/users/4.jpg') }}" alt="user" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
														</ul>
													</li>
												</ul> -->
		<!-- </div>
	</div>
</div>
</div> -->
	<!-- <div class="col-md-4">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">YOU HAVE 5 NEW MESSAGES</h5>
											<div class="message-box" id="msg" style="height: 430px;position: relative;">
												<div class="message-widget message-scroll">
													 
													<a href="javascript:void(0)">
														<div class="user-img"> <img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
														<div class="mail-contnet">
															<h5>Pavan kumar</h5> <span class="mail-desc">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been.</span> <span class="time">9:30 AM</span> </div>
														</a>
														 
														<a href="javascript:void(0)">
															<div class="user-img"> <img src="{{ asset('assets/images/users/2.jpg') }}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
															<div class="mail-contnet">
																<h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
															</a>
														 
															<a href="javascript:void(0)">
																<div class="user-img"> <span class="round">A</span> <span class="profile-status away pull-right"></span> </div>
																<div class="mail-contnet">
																	<h5>Arijit Sinh</h5> <span class="mail-desc">Simply dummy text of the printing and typesetting industry.</span> <span class="time">9:08 AM</span> </div>
																</a>
																 
																<a href="javascript:void(0)">
																	<div class="user-img"> <img src="{{ asset('assets/images/users/4.jpg') }}" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
																	<div class="mail-contnet">
																		<h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
																	</a> 
																	<a href="javascript:void(0)">
																		<div class="user-img"> <img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
																		<div class="mail-contnet">
																			<h5>Pavan kumar</h5> <span class="mail-desc">Welcome to the Elite Admin</span> <span class="time">9:30 AM</span> </div>
																		</a> 
																		<a href="javascript:void(0)">
																			<div class="user-img"> <img src="{{ asset('assets/images/users/2.jpg') }}" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
																			<div class="mail-contnet">
																				<h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
																			</a>
																		</div>
																	</div>
																</div>
															</div>
														</div> -->
	<!-- <div class="col-md-4">
															<div class="card">
																<div class="card-body">
																	<h5 class="card-title">CHAT</h5>
																	<div class="chat-box" id="chat" style="height: 327px;position: relative;">
																		 
																		<ul class="chat-list">
																			 
																			<li>
																				<div class="chat-img"><img src="{{ asset('assets/images/users/1.jpg') }}" alt="user"></div>
																				<div class="chat-content">
																					<h5>James Anderson</h5>
																					<div class="box bg-light-info">Lorem Ipsum is simply dummy text of the printing &amp; type setting industry.</div>
																				</div>
																				<div class="chat-time">10:56 am</div>
																			</li>
																			 
																			<li>
																				<div class="chat-img"><img src="{{ asset('assets/images/users/2.jpg') }}" alt="user"></div>
																				<div class="chat-content">
																					<h5>Bianca Doe</h5>
																					<div class="box bg-light-info">It’s Great opportunity to work.</div>
																				</div>
																				<div class="chat-time">10:57 am</div>
																			</li> 
																			<li class="odd">
																				<div class="chat-content">
																					<div class="box bg-light-inverse">I would love to join the team.</div>
																					<br>
																				</div>
																				<div class="chat-time">10:58 am</div>
																			</li> 
																			<li class="odd">
																				<div class="chat-content">
																					<div class="box bg-light-inverse">Whats budget of the new project.</div>
																					<br>
																				</div>
																				<div class="chat-time">10:59 am</div>
																			</li> 
																			<li>
																				<div class="chat-img"><img src="{{ asset('assets/images/users/3.jpg') }}" alt="user"></div>
																				<div class="chat-content">
																					<h5>Angelina Rhodes</h5>
																					<div class="box bg-light-info">Well we have good budget for the project</div>
																				</div>
																				<div class="chat-time">11:00 am</div>
																			</li> 
																		</ul>
																	</div>
																</div>
																<div class="card-body border-top">
																	<div class="row">
																		<div class="col-8">
																			<textarea placeholder="Type your message here" class="form-control border-0"></textarea>
																		</div>
																		<div class="col-4 text-right">
																			<button type="button" class="btn btn-info btn-circle btn-lg"><i class="fas fa-paper-plane"></i> </button>
																		</div>
																	</div>
																</div>
															</div>
														</div> -->
	</div>
	<!-- ============================================================== -->
	<!-- End Page Content -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Right sidebar -->
	<!-- ============================================================== -->
	<!-- .right-sidebar -->
	<!-- <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('assets/images/users/1.jpg') }}" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('assets/images/users/2.jpg') }}" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('assets/images/users/3.jpg') }}" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('assets/images/users/4.jpg') }}" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('assets/images/users/5.jpg') }}" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('assets/images/users/6.jpg') }}" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('assets/images/users/7.jpg') }}" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="{{ asset('assets/images/users/8.jpg') }}" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            -->                <!-- ============================================================== -->
	<!-- End Right sidebar -->
	<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Container fluid  -->
	<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Page wrapper  -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->


@endsection

@section('script')
	<script type="text/javascript"></script>

@endsection
