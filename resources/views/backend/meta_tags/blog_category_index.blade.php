@extends('layouts.admin')
@section('title', '| Meta Tags')
@section('page_name', 'Meta Tags')
@section('section_name', 'Meta Tags List of Blog categories')


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
                  <i class="fas fa fa-tag"></i>
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
                <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="pt-2 px-3"><h3 class="card-title">Meta Tags :</h3></li>
                  <li class="nav-item meta-page-link">
                    <a class="nav-link" id="custom-tabs-two-home-tab" href="{{route('meta-tags.index')}}" role="tab" aria-controls="custom-tabs-two-home" aria-selected="false">Page</a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link " id="custom-tabs-two-profile-tab" href="{{route('meta-tags.category')}}" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="true">Categories</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" href="{{route('meta-tags.item')}}" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Service Items</a>
                  </li>
                   <li class="nav-item ">
                    <a class="nav-link " id="custom-tabs-two-profile-tab" href="{{route('meta-tags.blog')}}" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Blog</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link active" id="custom-tabs-two-profile-tab" href="{{route('meta-tags.blog-category')}}" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="true">Blog Categories</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane fade active show" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                     <div class="container">
                        @can('meta-tags-create')
                          <div class="row">
                              <div class="col-lg-12 margin-tb">
                                  <div class="pull-right">
                                      <a class="btn btn-success" href="{{ route('meta-tags.blog-category.create') }}"> Add Meta Tag</a>
                                  </div>
                              </div>
                          </div>
                        @endcan
                        <br/>
                        <table id='dataTable' width='100%' border="1" style='border-collapse: collapse;'>
                          <thead>
                            <tr>
                              <td>Category Name</td>
                              <td>Tags</td>
                              <td>Slug</td>
                              <td>Status</td>
                              <td>Actions</td>
                            </tr>
                          </thead>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
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
         ajax: {
            "url": "{{route('meta-tags.blog-category.showTable')}}",
            "type": "GET"
        },
         columns: [
            { data: 'page_name' },
            { data: 'tag' },
            { data: 'slug' },
            { data: 'status' },
            { data: 'actions' },
         ]
      });



    });
    </script>

@endsection