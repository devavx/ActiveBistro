@extends('backend.master')

@section('title') Admin | Home Setting @endsection

@section('style') 
<link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}"/>

<link rel="stylesheet" href="{{ asset('css/Lobibox.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/loader_spin.css') }}">
<style type="text/css">


</style>
@endsection
@section('content')

<!-- ============================================================== -->
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
            <h4 class="text-themecolor"> Home Setting List</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active"> Home Setting</li>
                </ol>
                <a href="{{ url('/admin/home_setting/create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                    class="fa fa-plus-circle"></i> Create New</a>
                </div>
            </div>
        </div>  <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Home Setting List</h4>
<div class="text-right">
				<button class="btn btn-primary mr-4"><i class="fa fa-trash mr-2"></i>Delete</button>
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
                        <div class="table-responsive m-t-40">
                            <table id="example23"
                            class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
<th>Sr. No.</th>
				<th scope="col" class="border"><label><input type="checkbox" data-tablesaw-checkall><span class="sr-only"> Check All</span></label></th>
                                    <th>Title</th> 
                                    <th>Description</th> 
                                    <th>Thumbnail</th> 
                                    <th>Status</th> 
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody> 

                                  @if(!empty($listData))
                                    @foreach($listData as $rows)
                                <tr> 
<td>1</td>
<td><label><input type="checkbox"><span class="sr-only"> Select Row </span></label></td>
                                    <td> {{ $rows->title ?? '-' }}</td>
                                    <td> {!! $rows->description ?? '-' !!}</td>
                                    <td><img src="{{ $rows->thumbnail }}" alt="image" width="100"> </td>
                                    @if($rows->active)
                                        <td> <button type="button" class="btn btn-success change_status" id="{{ $rows->id }}" data-id="{{ $rows->active }}">Active</button> </td>
                                    @else
                                        <td> <button type="button" class="btn btn-danger change_status" id="{{ $rows->id }}" data-id="{{ $rows->active }}">Inactive</button> </td>
                                    @endif
                                    <td> {{ changeDateFormat($rows->created_at,'M-d-Y') }}</td> 
                                    <td> 
                                        <a class="like" href="{{ route('admin.home_setting.edit',$rows->id) }}" title="Edit"><i class="fas fa-edit text-info"></i></a> /   
                                        <a class="remove" href="javascript:void(0)" onclick="confirmDelete({{ $rows->id }})" title="Remove"><i class="fas fa-trash text-danger"></i></a>
                                    </td>                                  
                                </tr>  
                                   @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-danger">No Record Found !</td>
                                </tr> 
                                @endif                              
                            </tbody>
                            </table>
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

<script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
 <script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/Lobibox.js') }}"></script>
<script>
    $(function () {           
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
            'csv', 'excel', 'pdf', 'print'
            ]
        });
        $('.buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    });

    function confirmDelete(id) {
        url = "{{ url('/admin/home_setting/delete/') }}/"+id; 
        deleteConfirmMessage(id,url,'remove');
    }

    $(document).ready(function(){
        $(document).on('click','.change_status',function(){
            var id = $(this).attr('id');
            url = "{{ url('/admin/home_setting/change_status/') }}/"+id; 
            var status_val = $(this).attr('data-id');
            changeStatusConfirmMessage(id,url,'change_status');
        });
    });

</script>
@endsection
