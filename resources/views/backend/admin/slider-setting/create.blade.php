@extends('backend.master')

@section('title') Admin | Sliders | Create @endsection

@section('style')  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}"/>

<link rel="stylesheet" href="{{ asset('css/Lobibox.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/loader_spin.css') }}">
 
<style type="text/css">     
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
                        <h4 class="text-themecolor">Sliders</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/sliders') }}">Sliders</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol> 
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Sliders</h4>
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
                                <form action="{{ route('admin.sliders.store') }}" class="dropzone" id="dropzoneForm" method="post" enctype="multipart/form-data">
                                    @csrf                                     
                                </form>

                                <div class="form-actions" style="margin-top: 20px">
                                    <button type="button" id="submit-all" class="btn btn-success"> <i class="fa fa-check"></i> Upload</button>
                                    <a href="{{ url('/admin/sliders') }}" class="btn btn-inverse">Cancel</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">Uploaded Image</h3>
                            </div>
                            <div class="panel-body" id="uploaded_image">
                              
                            </div>
                          </div>
                        </div>
                    </div>
                </div> 
                </div> 
        </div>
        <div id="cover-spin" style="display: none;"></div> 
         @endsection
    @section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script> 
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/Lobibox.js') }}"></script>
     <script> 
        Dropzone.options.dropzoneForm = {
          autoProcessQueue: false,
          addRemoveLinks: true, 
          acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg,.mp4",
          init: function(){
           var submitButton = document.querySelector('#submit-all');
           myDropzone = this;
           submitButton.addEventListener("click", function(){
            myDropzone.processQueue();
           });
           var messageS='File Uploaded Successfully !';
           var messageClass='success';
           this.on("error", function(file, errorMessage) {
              var messageS=errorMessage;
              var messageClass='error'; 
              console.log("error : " + errorMessage );
          });
           this.on("complete", function(){
            if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
            {
             var _this = this;
             _this.removeAllFiles();
              
              (function ($) {
                  "use strict";                              
                      Lobibox.notify(messageClass, {
                          position: 'top right',
                          msg: messageS
                      });
              })(jQuery);
            }
             // load_images();
           });
          },
        };

    // load_images();
    function load_images(){
        $.ajax({
          url:"{{ route('admin.sliders.fetch') }}",
          success:function(data){
            $('#uploaded_image').html(data);
          }
        })
      }
    </script>
    <script type="text/javascript">     
         $(document).on('click', '.remove_image', function(){
            var id = $(this).attr('id');
            url = "{{ url('/admin/sliders/delete/') }}/"+id; 
            deleteConfirmMessage(id,url,'remove');
          });
    </script>
    @endsection
       