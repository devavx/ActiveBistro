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

				<h3 class="font-weight-bold text-color text-center">How its Work</h3>
				<ul class="timeline">
					@if(!empty($listData))
					@foreach($listData as $key => $rows)
					<li @if ($key & 1 ) class="timeline-inverted" @endif >
						<div class="timeline-badge"><i class="fa fa-check-square-o"></i></div>
						<div class="timeline-panel">
					        <!-- <div class="timeline-heading">
					          <h4 class="timeline-title">Mussum ipsum cacilds</h4>
					          <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p>
					      </div> -->
					      <div class="timeline-body">
					      	<p>{!! $rows->description !!}</p>
					      </div>
					  </div>
					</li>
					@endforeach
					@else
					<li class="timeline-inverted">
						<div class="timeline-badge warning"><i class="fa fa-file"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title text-danger">OPPS! Not available !</h4>
							</div>
							<div class="timeline-body">
								<p></p>
								<p></p>
							</div>
						</div>
					</li>
					@endif   
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript"></script>
@endsection