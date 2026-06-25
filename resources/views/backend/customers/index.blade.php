@extends('layouts.admin')
@section('title', '| Customers')
@section('page_name', 'Customers')
@section('section_name', 'Customers List')


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
                  <i class="fas fa fa-users"></i>
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
                @can('customers-create')
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('customers.create') }}"> Add New</a>
                        </div>
                    </div>
                </div>
                @endcan
                <br/>
                
                <div class="container">
                    <table id='dataTable' width='100%' border="1" style='border-collapse: collapse;'>
                      <thead>
                        <tr>
                          <td>ID</td>
                          <td>First Name</td>
                          <td>Last Name</td>
                          <td>Email ID</td>
                          <td>Contact Number</td>
                          <td>Registered Date</td>
                          <td>Status</td>
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
         ajax: "{{route('customers.getData')}}",
         columns: [
            { data: 'id' },
            { data: 'first_name' },
            { data: 'last_name' },
            { data: 'email' },
            { data: 'contact_number' },
            { data: 'registred_date' },
            { data: 'status' },
            { data: 'actions' },
         ]
      });

    });
    </script>

@endsection