@extends('layouts.admin')
@section('title', '| Edit Company Profile')
@section('page_name', 'About Us')
@section('section_name', 'Edit Company Profile')

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
                <i class="fas fa-laptop-house"></i>
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
              {!! Form::model($data, ['method' => 'PATCH','route' => ['general.update', $data->id],'enctype'=>'multipart/form-data']) !!}
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Name (En):</strong>
                    {!! Form::text('title', null, array('placeholder' => 'Title English','class' => 'form-control')) !!}
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Name (Ar):</strong>
                    {!! Form::text('title_er', null, array('placeholder' => 'Title Arabic','class' => 'form-control')) !!}
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Description (En):</strong>
                    {!! Form::textarea('description', null, array('placeholder' => 'Description English', 'id'=>'cp_description', 'class' => 'form-control')) !!}
                  </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                    <strong>Description (Ar):</strong>
                    {!! Form::textarea('description_ar', null, array('placeholder' => 'Description Arabic', 'id'=>'cp_description_ar', 'class' => 'form-control')) !!}
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

<script type="text/javascript">
  $(document).ready(function() {
    CKEDITOR.replace('cp_description');
    CKEDITOR.replace('cp_description_ar');
  });
</script>
@endsection