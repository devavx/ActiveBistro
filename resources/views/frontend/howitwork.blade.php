@extends('layouts.master')
@section('title') Active Bistro | How It Work @endsection
@section('csss')
	<style type="text/css"></style>
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="howitworks mt-5 mb-5">
					<h3 class="font-weight-bold text-color text-center">How its Works?!</h3>
					<ul class="timeline">
						@foreach($items as $item)
							@if($loop->index%2==0)
								<li>
									<div class="timeline-badge">
										<img src="{{$item->image}}" alt="" style="height: 30px;!important; width: 30px;!important;">
									</div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">{{$item->title}}</h4>
										</div>
										<div class="timeline-body">
											<p>
												{!! $item->description !!}
											</p>
										</div>
									</div>
								</li>
							@else
								<li class="timeline-inverted">
									<div class="timeline-badge">
										<img src="{{$item->image}}" alt="" style="height: 30px;!important; width: 30px;!important;">
									</div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">{{$item->title}}</h4>
										</div>
										<div class="timeline-body">
											<p>
												{!! $item->description !!}
											</p>
										</div>
									</div>
								</li>
							@endif
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script type="text/javascript"></script>
@endsection