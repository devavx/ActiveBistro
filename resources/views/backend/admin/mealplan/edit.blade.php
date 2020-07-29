@extends('backend.master')

@section('title') Admin | Meal Plan | Edit @endsection

@section('style')  
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #000 !important;
    }
    
</style>
@endsection
@section('content')
<div class="page-wrapper"> 
            <div class="container-fluid"> 
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Edit Meal Plan</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/meals') }}">Meal Plan</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Edit Meal Plan</h4>
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
                            @if(count($errors) > 0 )
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{ route('admin.meals.update',$mealplan->id) }}" method="post">
                                    @csrf
                                    @method('PUT') 
                                    <div class="form-body">
                                       <!--  <h3 class="card-title">Person Info</h3>
                                        <hr>
                                          -->
                                         
                                        <!--/row-->
                                        <!-- <h3 class="box-title m-t-40">Address</h3> -->
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter name.." value="{{ $mealplan->name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <label>Select Days</label>
                                                    <select class="form-control" name="no_of_days" id="no_of_days">
                                                        <option value="">Select Days</option>
                                                        @foreach(App\MealPlan::AllWeekDays as $key => $day)
                                                        <option value="{{ $key }}" <?php if ($mealplan->no_of_days == $key):
                                                        echo "selected";  endif ?>>{{ $day }}</option>
                                                        @endforeach
                                                    </select> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Rate Per Item</label>
                                                    <input type="text" name="rate_per_item" class="form-control" placeholder="Rate Per Item.." value="{{ $mealplan->rate_per_item }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Rate Per Item Three Days</label>
                                                    <input type="text" name="rate_per_item_three_days" class="form-control" placeholder="Enter Rate Per Item Three Days..." value="{{ $mealplan->rate_per_item_three_days }}">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No of Meals in Two Days</label>
                                                    <input type="text" name="meal_in_two_days" class="form-control" placeholder="Meal in three Days..." value="{{ $mealplan->meal_in_two_days }}">
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No of Meals in Two Days</label>
                                                    <input type="text" name="meal_in_three_days" class="form-control" placeholder="Meal in three Days..." value="{{ $mealplan->meal_in_three_days }}">
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                     <div class="row"> 
                                        @php
                                            $ids = (isset($mealplan) && $mealplan->items->count() > 0 ) ? array_pluck($mealplan->items->toArray(), 'id') : null;
                                        @endphp
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Select Item</label>
                                                    <select class="form-control select2 select2-multiple" id="item_id" name="item_id[]"   style="width: 100%" multiple="multiple" data-placeholder="Please Select">
                                                        @if(!empty(@listData))
                                                            @foreach($listData as $rows)
                                                            <option value="{{ $rows->id }}"  @if(!is_null($ids) && in_array($rows->id, $ids))
                                                            {{'selected'}}
                                                            @endif>{{ $rows->name }}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="">Select</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div> 
                                        </div> 
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
                </div> 
        </div>
         @endsection
    @section('script')
    
    <script type="text/javascript" src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
         $(".select2").select2({
            placeholder: "Please select Item",
            allowClear: true
        });
    </script>
    @endsection
       