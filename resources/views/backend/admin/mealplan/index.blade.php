@extends('backend.master')

@section('title') Admin | Meal Plan @endsection

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
            <h4 class="text-themecolor">Meal Plan List</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Meal Plan</li>
                </ol>
                <a href="{{ url('/admin/meals/create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                    class="fa fa-plus-circle"></i> Create New</a>
                </div>
            </div>
        </div>  <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Meal List</h4>
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
                                    <th>Name</th>
                                    <th>Day</th>
                                    <th>Thumbnail</th>
                                   <!--  <th>Rate For 2 Days</th>
                                    <th>Rate For 3 Days</th>
                                    <th>No Of Meal Two Days</th>
                                    <th>No Of Meal Three Days</th> -->
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php 
                                if(!empty($mealList)){ 
                                $days = App\MealPlan::AllWeekDays; 
                                foreach($mealList as $rows){  
                                $day =  $rows->no_of_days ; 
                                    ?>
                                <tr>
                                    <td> {{ $rows->name ?? '-'}}</td>
                                    <td> {{ $days[$day] ?? '-' }}</td>
                                    <td>
                                        @foreach($rows->images as $image)
                                            <img src="{{ $image->file }}" alt="image" width="100">
                                        @endforeach
                                    </td>

                                    @if($rows->active)
                                        <td> <button type="button" title="Click for Inactive" class="btn btn-success change_status" id="{{ $rows->id }}" data-id="{{ $rows->active }}">Active</button> </td>
                                    @else
                                        <td> <button type="button" title="Click for Active" class="btn btn-danger change_status" id="{{ $rows->id }}" data-id="{{ $rows->active }}">Inactive</button> </td>
                                    @endif
                                    <td> {{ changeDateFormat($rows->created_at,'M-d-Y') }}</td>
                                    <td style="text-align: center; ">
                                        <a class="like" href="{{ route('admin.meals.edit',$rows->id) }}" title="Edit"><i class="fas fa-edit"></i></a>  
                                        <a class="remove" href="javascript:void(0)" onclick="confirmDelete({{ $rows->id }})" title="Remove"><i class="fas fa-trash"></i></a>
                                    </td> 
                                </tr>  
                                <?php }
                                }else{ ?>
                                <tr>
                                    <td colspan="6" class="text-danger">No Record Found !</td>
                                </tr> 
                                <?php } ?>                                      
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
        url = "{{ url('/admin/meals/delete/') }}/"+id; 
        deleteConfirmMessage(id,url,'remove');
    }
    $(document).ready(function(){
        $(document).on('click','.change_status',function(){
            var id = $(this).attr('id');
            url = "{{ url('/admin/meals/change_status/') }}/"+id; 
            var status_val = $(this).attr('data-id');
            changeStatusConfirmMessage(id,url,'change_status');
        });
    });

</script>
@endsection
