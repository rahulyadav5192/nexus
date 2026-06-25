@extends('layouts.admin')
@section('title', '| Enquiry')
@section('page_name', 'Enquiry')
@section('section_name', 'Enquiry List')


<!-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('page_name')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa fa-book"></i>
                  @yield('section_name')
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                    <p>{{ $message }}</p>
                  </div>
                @endif
                
                <br/>
                
                <div class="container">
                    <table id='dataTable' width='100%' border="1" style='border-collapse: collapse;'>
                      <thead>
                        <tr>
                          <td>Name</td>
                          <td>Email ID</td>
                          <td>Subject</td>
                          <td>Phone</td>
                          <td>Country</td>
                          <td>City</td>
                          <td>Status</td>
                          <td>Submitted</td>
                          <td>Actions</td>
                        </tr>
                      </thead>
                    </table>
                </div>
                
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script type="text/javascript">
    $(document).ready(function(){

      // DataTable
      $('#dataTable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{route('enquiry.getData')}}",
         columns: [
            { data: 'name','orderable':false },
            { data: 'email','orderable':false },
            { data: 'subject','orderable':false },
            { data: 'phone','orderable':false },
            { data: 'country','orderable':false },
            { data: 'city','orderable':false },
            { data: 'status','orderable':false },
            { data: 'submitted_at','orderable':false },
            { data: 'actions' },
         ]
      });

    });
    </script>

@endsection