@extends('layouts.admin')
@section('title', '| Testimonials')
@section('page_name', 'Testimonials')
@section('section_name', 'Edit Testimonials')

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
                <i class="fas fa-book-open"></i>
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
              {!! Form::model($data, ['method' => 'PATCH','route' => ['testimonials.update', $data->id],'enctype'=>'multipart/form-data']) !!}
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Person Name:</strong>
                    {!! Form::text('person_name', null, array('placeholder' => 'Person Name','class' => 'form-control')) !!}
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <strong>Designation:</strong>
                    {!! Form::text('designation', null, array('placeholder' => 'Designation','class' => 'form-control', 'required')) !!}
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Select Image (Size 80 X 80):</strong>
                    <br />
                    <input type="file" name="partner_image">
                  </div>
                  <img src="{{asset('uploads/testimonials/'.$data->image)}}" width="80px" height="80px">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Quotes:</strong>
                    {!! Form::textarea('quotes', null, array('placeholder' => 'Quotes','class' => 'form-control', 'required')) !!}
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    {{ Form::label('active', 'Active') }}

                    {!! Form::checkbox('active',1, $data->status) !!}

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