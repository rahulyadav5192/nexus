@extends('layouts.admin')
@section('title', '| Edit Contact & Social Media')
@section('page_name', 'Contact & Social Media Management')
@section('section_name', 'Edit Contact & Social Media')

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
                <i class="fa fa-user mr-1"></i>
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
              @if ($message = Session::get('success'))

              <div class="alert alert-success">

                <p>{{ $message }}</p>

              </div>

              @endif
              <br />
              {!! Form::model($data, ['method' => 'PATCH','route' => ['contact-details.update', $data->id]]) !!}
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4">
                  <div class="form-group">
                    <strong>Phone Number:</strong>
                    {!! Form::text('mobile', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8">
                  <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::email('email', null, array('placeholder' => 'Email ID','class' => 'form-control')) !!}
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Facebook:</strong>
                    {!! Form::text('facebook', null, array('placeholder' => 'Facebook','class' => 'form-control')) !!}
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Twitter:</strong>
                    {!! Form::text('twitter', null, array('placeholder' => 'Twitter','class' => 'form-control')) !!}
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>LinkedIn:</strong>
                    {!! Form::text('linked_in', null, array('placeholder' => 'Linked In','class' => 'form-control')) !!}
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Youtube:</strong>
                    {!! Form::text('youtube', null, array('placeholder' => 'Youtube','class' => 'form-control')) !!}
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Instagram:</strong>
                    {!! Form::text('instagram', null, array('placeholder' => 'Instagram','class' => 'form-control')) !!}
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Address:</strong>
                    {!! Form::textarea('address', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
              {!! Form::close() !!}
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
@endsection