@extends('backend.master')

@section('title') Admin | Postal Codes | Create @endsection

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
            <div class="container-fluid"> 
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Create Postal Codes</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/postal_codes') }}">Postal Codes</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol> 
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Create Postal Codes</h4>
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
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter name..">
                                                </div>
                                            </div>
                                           
                                        </div>  
                                    </div>
                                    <div class="form-actions">
                                        <button type="button" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <a href="{{ url('/admin/postal_codes') }}" class="btn btn-inverse">Cancel</a>
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
       