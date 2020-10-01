@extends('backend.master')

@section('title') Admin | Sliders @endsection

@section('style')
	<link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}"/>

	<link rel="stylesheet" href="{{ asset('css/Lobibox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/loader_spin.css') }}">
	<style type="text/css">


	</style>
@endsection
@section('content')
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Sliders List</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
							<li class="breadcrumb-item active">Sliders</li>
						</ol>
						<a href="{{ url('/admin/sliders/create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
									class="fa fa-plus-circle"></i> Create New</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Sliders</h4>
							<div class="text-right">
								<button type="button" onclick="confirmDeleteBulk();" class="btn btn-primary mr-4">
									<i class="fa fa-trash mr-2"></i>Delete
								</button>
							</div>
							@if($message=Session::get('success'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<strong> {{$message}}</strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							@endif

							@if($errormessage=Session::get('errormsg'))
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<strong> {{$errormessage}}</strong>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							@endif
							<div class="table-responsive m-t-40">
								<table id="example23"
										class="display nowrap table table-hover table-striped table-bordered"
										cellspacing="0" width="100%">
									<thead>
									<tr>
										<th scope="col" class="border">
											<label><input type="checkbox" data-tablesaw-checkall id="check_all"><span class="sr-only"> Check All</span></label>
										</th>
										<th>#</th>
										<th>Images</th>
										<th>Status</th>
										<th>Created At</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									@if(!empty($listData))
										@foreach($listData as $rows)
											<tr>
												<td>
													<label><input type="checkbox" name="delete_target" value="{{$rows->id}}"><span class="sr-only"> Select Row </span></label>
												</td>
												<td>{{$loop->index+1}}</td>

												<td>
													@if($rows->thumbnail_type == 'video/mp4')
														<video class="video-fluid" width="150" loop muted>
															<source src="{{ $rows->thumbnail }}" type="video/mp4"/>
														</video>
													@else
														<img src="{{ $rows->thumbnail }}" class="img-responsive" width="150">
													@endif
												</td>
												@if($rows->active)
													<td>
														<button type="button" class="btn btn-success change_status" id="{{ $rows->id }}" data-id="{{ $rows->active }}">Active</button>
													</td>
												@else
													<td>
														<button type="button" class="btn btn-danger change_status" id="{{ $rows->id }}" data-id="{{ $rows->active }}">Inactive</button>
													</td>
												@endif
												<td>{{ changeDateFormat($rows->created_at,'M-d-Y') }}</td>
												<td>
													<a class="remove" href="javascript:void(0)" onclick="confirmDelete({{ $rows->id }})" title="Remove"><i class="fas fa-trash text-danger"></i></a>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td colspan="4" class="text-danger">No Record Found !</td>
										</tr>
									@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="cover-spin" style="display: none;"></div>

@endsection
@section('script')

	<script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('js/custom.js') }}"></script>
	<script src="{{ asset('js/Lobibox.js') }}"></script>
	<script>
		$(function () {
			$('#example23').DataTable({
				dom: 'Blfrtip',
			});
			$('.buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
		});

		function confirmDelete(id) {
			url = "{{ url('/admin/sliders/delete/') }}/" + id;
			deleteConfirmMessage(id, url, 'remove');
		}

		$(document).ready(function () {
			$(document).on('click', '.change_status', function () {
				var id = $(this).attr('id');
				url = "{{ url('/admin/sliders/change_status/') }}/" + id;
				var status_val = $(this).attr('data-id');
				changeStatusConfirmMessage(id, url, 'change_status');
			});
		});

		function confirmDeleteBulk() {
			const url = "{{ url('/admin/sliders/delete') }}";
			const items = [];
			$("input:checkbox[name=delete_target]:checked").each(function () {
				const parsed = Number.parseInt($(this).val());
				if (parsed !== 0)
					items.push(parsed);
			});
			if (items.length > 0)
				deleteConfirmMessageBulk(url, items);
		}

		initialized = () => {
			$('#check_all').change(function () {
				$("input:checkbox[name=delete_target]").prop('checked', this.checked);
			})
		}
	</script>
@endsection
