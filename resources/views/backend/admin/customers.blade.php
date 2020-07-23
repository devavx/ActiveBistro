@extends('backend.master')

@section('title') Admin | Customers @endsection

@section('style') 
    <link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
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
                        <h4 class="text-themecolor">Customer List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Customer</li>
                            </ol>
                            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Customer List</h4>
                                <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                                <div class="table-responsive m-t-40">
                                    <table id="example23"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>address</th>
                                                <th>Profile Image</th>
                                                <th>Create At</th> 
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <!-- <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </tfoot> -->
                                        <tbody>

                                          @if(!empty($listData))
                                            @foreach($listData as $rows)
                                            <tr>
                                                <td>{{ $rows->name ?? '-' }}</td>
                                                <td>{{ $rows->email ?? '-' }}</td>
                                                <td>{{ $rows->address ?? '-' }}</td>
                                                <td> <img src="{{ $rows->profile_image }}" class="img-thumbnail" width="100"></td>
                                                <td>{{ changeDateFormat($rows->created_at,'M-d-Y') }}</td>
                                                <td>'-</td>
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
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                 
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    @endsection
    @section('script')
    
    <script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
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

    </script>
    @endsection
 