@extends('backend.master')

@section('title') Admin | Orders @endsection

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
            <h4 class="text-themecolor">Orders List</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
                <!-- <a href="{{ url('/admin/items/create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                    class="fa fa-plus-circle"></i> Create New</a> -->
                </div>
            </div>
        </div>  <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Orders List</h4>
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
                                    <th>OrderId</th> 
                                    <th>Customer Name</th> 
                                    <th>Status</th> 
                                    <th>Address</th> 
                                    <th>Total</th> 
                                    <th>No Of Meal</th> 
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody> 
                                <tr>
                                    <td> #123 </td>
                                    <td> David </td>
                                    <td> Open</td>
                                    <td> Noida KL</td>
                                    <td> 1000</td>
                                    <td>12</td>
                                    <td> 2020-12-14</td> 
                                    
                                    <td>-</td>
                                </tr><tr>
                                    <td> #124 </td>
                                    <td> David Jonsan </td>
                                    <td> Compelted</td>
                                    <td> Noida</td>
                                    <td> 1000</td>
                                    <td>12</td>
                                    <td> 2020-12-14</td> 
                                    <td>-</td>
                                </tr><tr>
                                    <td> #125 </td>
                                    <td> John Deo </td>
                                    <td> Pending</td>
                                    <td> Londaon</td>
                                    <td> 100</td>
                                    <td>1</td>
                                    <td> 2020-12-14</td> 
                                    <td>-</td>
                                </tr>  
                                                                   
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
        url = "{{ url('/admin/items/delete/') }}/"+id; 
        deleteConfirmMessage(id,url,'remove');
    }

</script>
@endsection
