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
					<!-- <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
						<a class="card-title"> Lorem ipsum dolor sit amet </a>
					</div>
					<div id="collapse6" class="collapse" data-parent="#accordion">
						<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
					</div> -->
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
								<a class="nav-link active" id="tab_{{$category->id}}" data-toggle="pill" href="#tab_{{$category->id}}" role="tab" aria-controls="tab_{{$category->id}}" aria-selected="true">{{$category->title}}</a>
							@else
								<a class="nav-link" id="tab_{{$category->id}}" data-toggle="pill" href="#tab_{{$category->id}}" role="tab" aria-controls="tab_{{$category->id}}" aria-selected="false">{{$category->title}}</a>
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
												{{--												<div class="card-header collapsed" data-toggle="collapse" href="#collapse_faq_{{$faq->id}}">--}}
												{{--													<a class="card-title"> {{$faq->faq_title}} </a>--}}
												{{--												</div>--}}
												{{--												<div id="collapse_faq_{{$faq->id}}" class="card-body collapse show" data-parent="#accordion">--}}
												{{--													<p>{{$faq->faq_description}}</p>--}}
												{{--												</div>--}}
												<span>{{$category->title}}</span>
											@endforeach
										</div>
									</div>
								</div>
							@else
								<div class="tab-pane fade show" id="tab_{{$category->id}}" role="tabpanel" aria-labelledby="tab-1">
									<div id="accordion" class="accordion mt-3">
										<div class="card mb-0">
											@foreach($category->faqs as $faq)
												{{--												<div class="card-header collapsed" data-toggle="collapse" href="#collapse_faq_{{$faq->id}}">--}}
												{{--													<a class="card-title"> {{$faq->faq_title}} </a>--}}
												{{--												</div>--}}
												{{--												<div id="collapse_faq_{{$faq->id}}" class="card-body collapse show" data-parent="#accordion">--}}
												{{--													<p>{{$faq->faq_description}}</p>--}}
												{{--												</div>--}}
												<span>{{$category->title}}</span>
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