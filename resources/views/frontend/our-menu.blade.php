@extends('layouts.master')
@section('title') Our Menu  @endsection
@section('csss') 
<style type="text/css">
	
</style>
 @endsection
@section('content') 



	<div class="container mt-5">
		<div class="row">
			<div class="col-12">
				<div class="our-menu-top">
					<div class="menu-name">
						<h1 class="font-weight-bold text-color">MENU</h1>
					</div>
					<div class="menu-date border p-2">
						<p class="text-center mb-0 text-color">Week on <br> Sep <br> <span>10</span></p>
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

</body>
</html>