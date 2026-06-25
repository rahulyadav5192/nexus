@extends('layouts.admin')
@section('title', '| Service Categories')
@section('page_name', 'Service Categories')
@section('section_name', 'Add Main Category')

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
                <i class="fas fa-layer-group"></i>
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

              {!! Form::open(array('route' => 'categories.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
              <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <strong>Title (En):</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <strong>Title (Ar):</strong>
                    {!! Form::text('name_ar', null, array('placeholder' => 'Title Arabic','class' => 'form-control')) !!}
                    @if ($errors->has('name_ar'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name_ar') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <strong>Description (En):</strong>
                    {!! Form::textarea('description', null, array('placeholder' => ' description','class' => 'form-control', 'required')) !!}
                    @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <strong>Description (Ar):</strong>
                    {!! Form::textarea('description_ar', null, array('placeholder' => ' description Arabic','class' => 'form-control', 'required')) !!}
                    @if ($errors->has('description_ar'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <strong>Icon (Class):</strong>
                    {!! Form::text('icon', null, array('placeholder' => 'Icon','class' => 'form-control')) !!}
                    @if ($errors->has('icon'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    {{ Form::label('active', 'Active') }}
                    {{ Form::checkbox('active', 1, true) }}
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-left">
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
<script type="text/javascript">
  $(document).ready(function() {
    CKEDITOR.replace('description');
    CKEDITOR.replace('description_ar');
  });
</script>

@endsection