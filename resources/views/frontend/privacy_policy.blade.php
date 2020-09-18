@extends('layouts.master')
@section('title') Active Bistro | Privacy & Policy @endsection
@section('csss')
	<style type="text/css"></style>
@endsection
@section('content')
	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-12">
				<div class="pricay-policy p-3 border">
					<h4 class="text-color font-weight-bold">Privacy Policy</h4>
					@if($policy!=null)
						{!! $policy->description !!}
					@else
						<h3 class="text-warning">Coming Soon !</h3>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script type="text/javascript"></script>
@endsection