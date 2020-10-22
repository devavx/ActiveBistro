@extends('layouts.master')
@section('title') Active Bistro | Faqs @endsection
@section('csss')
	<style type="text/css"></style>
@endsection
@section('content')
	<div class="container mb-5 d-none">
		<div class="row">
			<div class="col-lg-8 col-sm-12 col-12">
				<h4 class="font-weight-bold text-color mt-5">Faq'S</h4>

				<div id="accordion" class="accordion mt-3">
					<div class="card mb-0">
						@if(!empty($listData))
							@foreach($listData as $key => $rows)
								<div class="card-header collapsed" data-toggle="collapse" href="#collapse_{{ $key }}">
									<a class="card-title">{!! $rows->faq_title !!} </a>
								</div>
								<div id="collapse_{{ $key }}" class="card-body collapse @if($key == 0) show @endif" data-parent="#accordion">
									<p>{!! $rows->faq_description !!}</p>
								</div>
						@endforeach
					@endif
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="container mt-5 mb-5">

		<div class="row">
			<div class="col-lg-8 col-sm-10 col-12 mx-auto">
				<h4 class="font-weight-bold text-color text-center">Questions About Our Meal Delivery?</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-sm-4 col-12">
				<div class="faqs-navtabs mt-3">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						@foreach($categories as $category)
							@if($loop->first)
								<a class="nav-link active" id="" data-toggle="pill" href="#tab_{{$category->id}}" role="tab" aria-controls="tab_{{$category->id}}" aria-selected="true">{{$category->title}}</a>
							@else
								<a class="nav-link" id="" data-toggle="pill" href="#tab_{{$category->id}}" role="tab" aria-controls="tab_{{$category->id}}" aria-selected="false">{{$category->title}}</a>
							@endif
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-sm-8 col-12">
				<div class="faqs-content mt-3">
					<div class="tab-content" id="v-pills-tabContent">
						@foreach($categories as $category)
							@if($loop->first)
								<div class="tab-pane fade show active" id="tab_{{$category->id}}" role="tabpanel" aria-labelledby="tab-1">
									<div id="accordion" class="accordion mt-3">
										<div class="card mb-0">
											@foreach($category->faqs as $faq)
												@if($loop->first)
													<div class="card-header" data-toggle="collapse" href="#collapse_faq_{{$faq->id}}">
														<a class="card-title"> {{$faq->faq_title}} </a>
													</div>
													<div id="collapse_faq_{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
														<p>{{$faq->faq_description}}</p>
													</div>
												@else
													<div class="card-header collapsed" data-toggle="collapse" href="#collapse_faq_{{$faq->id}}">
														<a class="card-title"> {{$faq->faq_title}} </a>
													</div>
													<div id="collapse_faq_{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
														<p>{{$faq->faq_description}}</p>
													</div>
												@endif
											@endforeach
										</div>
									</div>
								</div>
							@else
								<div class="tab-pane fade show" id="tab_{{$category->id}}" role="tabpanel" aria-labelledby="tab-1">
									<div id="accordion" class="accordion mt-3">
										<div class="card mb-0">
											@foreach($category->faqs as $faq)
												@if($loop->first)
													<div class="card-header" data-toggle="collapse" href="#collapse_faq_{{$faq->id}}">
														<a class="card-title"> {{$faq->faq_title}} </a>
													</div>
													<div id="collapse_faq_{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
														<p>{{$faq->faq_description}}</p>
													</div>
												@else
													<div class="card-header collapsed" data-toggle="collapse" href="#collapse_faq_{{$faq->id}}">
														<a class="card-title"> {{$faq->faq_title}} </a>
													</div>
													<div id="collapse_faq_{{$faq->id}}" class="card-body collapse" data-parent="#accordion">
														<p>{{$faq->faq_description}}</p>
													</div>
												@endif
											@endforeach
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script type="text/javascript"></script>
@endsection