@extends('layouts.admin')
@section('title', '| Customers')
@section('page_name', 'Customers')
@section('section_name', 'Edit Customer')

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
                  <i class="fas fa-user"></i>
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
                <br/>
                {!! Form::model($data, ['method' => 'PATCH','route' => ['customers.update', $data->id],'enctype'=>'multipart/form-data']) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <strong>First Name:</strong>
                                {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control', 'required')) !!}
                                @if ($errors->has('first_name'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <strong>Last Name:</strong>
                                {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control', 'required')) !!}
                                @if ($errors->has('last_name'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <strong>Contact Number:</strong>
                                {!! Form::text('contact_number', null, array('placeholder' => 'Contact Number','class' => 'form-control', 'required')) !!}
                                @if ($errors->has('contact_number'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_number') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <strong>Emirates ID:</strong>
                                {!! Form::text('emirates_id', null, array('placeholder' => 'Emirates ID','class' => 'form-control', 'required')) !!}
                                @if ($errors->has('emirates_id'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('emirates_id') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <strong>Emirates ID Expiry Date:</strong>
                                {!! Form::date('eid_expiry_date', null, array('placeholder' => 'Emirates ID Expiry Date','class' => 'form-control', 'required')) !!}
                                @if ($errors->has('eid_expiry_date'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('eid_expiry_date') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                          <div class="form-group">
                            <strong>Status:</strong>
                            {!! Form::select('status', array(0 => 'Not Active', 1 => 'Active', 2 => 'Block'), $data->status,array('class' => 'form-control', 'required')); !!}
                            @if ($errors->has('status'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">    
                        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                {!! Form::close() !!}
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

@endsection