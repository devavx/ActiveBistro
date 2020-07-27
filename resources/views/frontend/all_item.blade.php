@extends('layouts.master')
@section('title') Active Bistro | All Item @endsection
@section('csss') 
<style type="text/css"></style>
@endsection
@section('content') 
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-sm-10 col-12 mx-auto">
				<form id="msform" class="p-3 mt-5">
			        <ul id="progressbar">
					    <li class="active" id="account"><strong>Welcome</strong></li>
						<li class="active" id="personal"><strong>Tailor Plan</strong></li>
					    <li class="active" id="payment-status"><strong>Choose Meals</strong></li>
					    <li id="payment"><strong>Checkout</strong></li>
					</ul>
			    </form>
			</div>
		</div>
	</div>

	<div class="container mt-3">
		<div class="row">
			<div class="col-lg-9 col-sm-9 col-12">
				<div class="our-menu-toggle">
					<ul class="nav nav-pills" role="tablist">
				  
					  	<li class="nav-item">
					    	<a class="nav-link active" data-toggle="tab" href="#entrees" role="tab" >Entrees Breakfast</a>
					  	</li>
					  	<li class="nav-item">
					   	 	<a class="nav-link" data-toggle="tab" href="#breakfast" role="tab">Dessert Snacks</a>
					  	</li>
					  	<li class="nav-item">
					   	 	<a class="nav-link" data-toggle="tab" href="#drinks" role="tab">Drinks</a>
					  	</li>
					</ul>
				</div>
			</div>

			<div class="col-lg-3 col-sm-3 col-12">
				<form>
					<div class="form-group mb-0">
						<select class="form-control">
							<option>Dietary Filter</option>
							<option>Vegan</option>
							<option>Gluten Free</option>
						</select>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-4 col-sm-4 col-12">
				<table class="table table-striped table-bordered w-100">
					<tr>
						<th class="p-2">Calories</th>
						<td class="p-2">3214 kcal</td>
					</tr>

					<tr>
						<th class="p-2">Protein</th>
						<td class="p-2">72 g</td>
					</tr>

					<tr>
						<th class="p-2">Fats</th>
						<td class="p-2">40 g</td>
					</tr>

					<tr>
						<th class="p-2">Carbohydrates</th>
						<td class="p-2">234 g</td>
					</tr>
				</table>
			</div>

			<div class="col-lg-4 col-sm-4 col-12">
				<div class="text-center">
					<a href="process5.html" class="text-color border p-2 pl-3 pr-3"><u>Edit My Meal Plan</u></a>
				</div>
			</div>
		</div>
	</div>


	<div class="container mt-3">

		<div class="row">
			<div class="col-12">
				<!-- Nav tabs -->
				<div class="ourentrees-breakfast mb-5">
					<div class="tab-content pt-3">
					    
					    <div class="tab-pane active" id="entrees" role="tabpanel">
					      
					    	<div class="row"> 
					    		@if(!empty(count($listData)))
					    		@foreach($listData as $rows)
						      	<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="{{ url('/storage/app/public/items').'/'.$rows->thumbnail }}" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$ {{ $rows->actual_price }}</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$ {{ $rows->selling_price }}</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">{{ $rows->name }}</h5>
									    	<p class="m-0 text-center">{{ $rows->sub_name }}</p>
									    </div>
									</div>
								</div>
								@endforeach
								@else
								<center> 
								    	<img src="{{ asset('uploads/image/not-found.jpg') }}" class="img-fluid rounded w-100 d-block">
								    	<div class="menu-col-text rounded">
								    	</div> 
								</center>
								@endif
								<!-- <div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div> -->

						    </div>

					    </div>

					    <div class="tab-pane" id="breakfast" role="tabpanel">
					      	<div class="row">
					      		<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div>

								<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div>

								<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div>

								<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div>

								<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div>

								<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div>

								<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div>

								<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div>
						    </div>
					    </div>

					    <div class="tab-pane" id="drinks" role="tabpanel">
					      	<div class="row">

					      		<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div>

								<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div>

								<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
									</div>
								</div>

								<div class="col-lg-3 col-sm-4 col-12">
									<div class="menucol rounded mt-3 shadow pb-3">
									    <div class="menuimgcol">
									    	<img src="http://bmms.maavan.com/test/bistro/uploads/black-pepper-and-sea-salt.jpg" class="img-fluid rounded w-100 d-block">
									    	<div class="menu-col-text rounded">
									    	</div>
									    </div>

									    <div class="menucoltext p-2">

									    	<div class="menucoltextpricebtn">
									    		<div class="menucoltextprice">
									    			<div class="d-flex">
									    				<p class="m-0"><del>$400</del></p>
									    				<h5 class="font-weight-bold m-0 text-color ml-2">$300</h5>
									    			</div>
									    		</div>
									    		
									    		<div class="menucoltextbtn">
									    			<button class="btn btn-info btn-md float-right">Add</button>
									    		</div>
									    	</div>
									    	
									    	<h5 class="mb-1 text-color text-center">Black Pepper and Sea Salt</h5>
									    	<p class="m-0 text-center">Black pepper and sea salt bestin town</p>
									    </div>
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

<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
@endsection