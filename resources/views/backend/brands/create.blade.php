@extends('layouts.admin')
@section('title', '| Brands Management')
@section('page_name', 'Brands Management')
@section('section_name', 'Add New Brands')

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
                <i class="fas fa-hands-helping"></i>
                @yield('section_name')
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if (count($errors) > 0)
              <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <br />

              {!! Form::open(array('route' => 'brands.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Select Image (Size 191 X 75):</strong>
                    <br />
                    <input type="file" name="brand_image" required>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    {{ Form::label('active', 'Active') }}
                    {{ Form::checkbox('active', 1, true) }}
                    <!--
                            get checkbox Form::checkbox('active',null, 'n')
                            -->
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
              {!! Form::close() !!}


            </div>
          </div>
        </section>
      </div>
    </div>
  </section>



</div>

@endsection