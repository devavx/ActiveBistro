@extends('layouts.master')
@section('title') Active Bistro | Faqs @endsection
@section('csss') 
<style type="text/css"></style>
@endsection
@section('content') 
<div class="container mb-5">
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
				<h4 class="font-weight-bold text-color text-center">Question About Our Meal Delivery?</h4>
				<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
			</div>
		</div>
		<div class="row">

			<div class="col-lg-4 col-sm-4 col-12">
				<div class="faqs-navtabs mt-3">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					  <a class="nav-link active" id="tab-1" data-toggle="pill" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">About Fresh n' Lean</a>
					  <a class="nav-link" id="tab-2" data-toggle="pill" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Meal Subscription</a>
					  <a class="nav-link" id="tab-3" data-toggle="pill" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Delivery & Shipping</a>
					  <a class="nav-link" id="tab-4" data-toggle="pill" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">Order & Billing</a>

					  <a class="nav-link" id="tab-5" data-toggle="pill" href="#tab5" role="tab" aria-controls="tab5" aria-selected="false">Prep & Storage</a>

					  <a class="nav-link" id="tab-6" data-toggle="pill" href="#tab6" role="tab" aria-controls="tab6" aria-selected="false">Packaging & Recycling </a>

					  <a class="nav-link" id="tab-7" data-toggle="pill" href="#tab7" role="tab" aria-controls="tab7" aria-selected="false">Nutritional information</a>
					</div>
				</div>
			</div>
			<div class="col-lg-8 col-sm-8 col-12">
				<div class="faqs-content mt-3">
					<div class="tab-content" id="v-pills-tabContent">
						  <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab-1">
						  	<div id="accordion" class="accordion mt-3">
						        <div class="card mb-0">
						            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseOne" class="card-body collapse show" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseThree" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse4" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse5" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse6" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						        </div>
						    </div>
						  </div>
						  <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab-2">
						  	<div id="accordion" class="accordion mt-3">
						        <div class="card mb-0">
						            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseOne" class="card-body collapse show" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseThree" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse4" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse5" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            
						        </div>
						    </div>
						  </div>
						  <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab-3">
						  	<div id="accordion" class="accordion mt-3">
						        <div class="card mb-0">
						            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseOne" class="card-body collapse show" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseThree" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse4" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            
						        </div>
						    </div>
						  </div>
						  <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab-4">
						  	<div id="accordion" class="accordion mt-3">
						        <div class="card mb-0">
						            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseOne" class="card-body collapse show" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseThree" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse4" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse5" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            
						        </div>
						    </div>
						  </div>

						  <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab-5">
						  	<div id="accordion" class="accordion mt-3">
						        <div class="card mb-0">
						            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseOne" class="card-body collapse show" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseThree" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse4" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						        </div>
						    </div>
						  </div>

						  <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab-6">
						  	<div id="accordion" class="accordion mt-3">
						        <div class="card mb-0">
						            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseOne" class="card-body collapse show" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseThree" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse4" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse5" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            
						        </div>
						    </div>
						  </div>

						  <div class="tab-pane fade" id="tab7" role="tabpanel" aria-labelledby="tab-7">
						  	<div id="accordion" class="accordion mt-3">
						        <div class="card mb-0">
						            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseOne" class="card-body collapse show" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapseThree" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse4" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse5" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>

						            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
						                <a class="card-title"> Lorem ipsum dolor sit amet </a>
						            </div>
						            <div id="collapse6" class="collapse" data-parent="#accordion">
						                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
						            </div>
						        </div>
						    </div>
						  </div>


					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
	@section('script')
	<script type="text/javascript"></script>
	@endsection