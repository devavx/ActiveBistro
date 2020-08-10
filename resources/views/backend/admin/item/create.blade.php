@extends('backend.master')

@section('title') Admin | Item | Create @endsection

@section('style')  
 <link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #000 !important;
    }
    .error{
        color: red;
    }
</style>
@endsection
@section('content')
<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Create Item</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/items') }}">Item</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Create Item</h4>
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
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{ route('admin.items.store') }}" id="add_form" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body"> 
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter name..">
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Sub Name</label>
                                                    <input type="text" id="sub_name" name="sub_name" class="form-control" placeholder="Enter Sub name..">
                                                </div>
                                            </div>  -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Category </label>
                                                    <select class="form-control" id="category_id" name="category_id" required>
                                                        <option value="">Select Category</option>
                                                        @if(!empty($categoryList))
                                                            @foreach($categoryList as $rows)
                                                                <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                                            @endforeach 
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Short Description</label>
                                                    <input type="text" name="short_description" id="short_description" class="form-control" placeholder="Enter Short Description..">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Description </label>
                                                    <input type="text" name="long_description" id="long_description" class="form-control" placeholder="Enter Sub name..">
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Protein</label>
                                                    <input type="text" name="protein" id="protein" class="form-control" placeholder="Enter protein..">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Calories </label>
                                                    <input type="text" name="calories" id="calories" class="form-control" placeholder="Enter calories..">
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Carbs</label>
                                                    <input type="text" name="carbs" id="carbs" class="form-control" placeholder="Enter Carbs..">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Type </label>
                                                    <select class="form-control" id="item_type_id" name="item_type_id">
                                                        <option value="">Select Type</option>
                                                        @if(!empty($itemTypeList))
                                                            @foreach($itemTypeList as $rows)
                                                                <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                                            @endforeach 
                                                        @endif
                                                    </select>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Selling Price</label>
                                                    <input type="number" name="selling_price" id="selling_price" class="form-control" placeholder="Enter Selling price..">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Regular Price </label>
                                                    <input type="number" name="actual_price" id="actual_price" class="form-control" placeholder="Enter Regual Price..">
                                                </div>
                                            </div> 
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-md-6"> 
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Category </label>
                                                    <select class="form-control" id="category_id" name="category_id" required>
                                                        <option value="">Select Category</option>
                                                        @if(!empty($categoryList))
                                                            @foreach($categoryList as $rows)
                                                                <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                                            @endforeach 
                                                        @endif
                                                    </select>
                                                </div>
                                            </div> 
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Avatar</label>
                                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control" title="Select thumbnail..">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Ingredient</label>
                                                    <select class="form-control select2 select2-multiple" id="ingredient_id" name="ingredient_id[]"   style="width: 100%" multiple="multiple" data-placeholder="Please Select">
                                                        @if(!empty(@listData))
                                                            @foreach($listData as $rows)
                                                            <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                                            @endforeach
                                                        @else
                                                            <option value="">Select</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div> 
                                        </div> 
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <a href="{{ route('admin.items.index') }}" class="btn btn-inverse">Cancel</a>
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

    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(".select2").select2({
            placeholder: "Please select Ingredient",
            allowClear: true
        });
        $(document).ready(function () {      

           $('#add_form').validate({ // initialize the plugin
                rules: { 
                    name: {
                        required: true,               
                    },selling_price: {
                        required: true,               
                    },actual_price: {
                        required: true,               
                    },
                    sub_name: {
                        required: true,               
                    },short_description: {
                        required: true,               
                    },long_description: {
                        required: true,               
                    },
                    protein: {
                        required: true,               
                    },
                    calories: {
                        required: true,               
                    },carbs: {
                        required: true,               
                    },
                    "category_id":"required",
                    "item_type_id": {
                        required: true,               
                    },
                    "ingredient_id[]":"required",               
                    },
                    messages: {
                    "ingredient_id[]": {
                        required: 'Please select at least one.'
                    }
                }   
            });

            $(document).on('click', '#edit_profile', function(){
                if (!$("#add_form").valid()) { // Not Valid
                    return false;
                } else {
                    
                }
            }); 
        }); 
    </script>
    @endsection
       