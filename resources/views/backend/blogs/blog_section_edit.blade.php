@extends('layouts.admin')
@section('title', '| Blog Sections')
@section('page_name', 'Blog Sections')
@section('section_name', 'Edit Blog Sections')

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
                  <i class="fas fa-blog"></i>
                  @yield('section_name') : <b><i><?=$blog->blog_name?></i></b>
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
                {!! Form::model($data, ['method' => 'PATCH','route' => ['blogs.sections.update', [$blog->id,$data->id]],'enctype'=>'multipart/form-data']) !!}
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Title:</strong>
                                {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
                                @if ($errors->has('title'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Short Descriptions</strong>
                                <br/>
                                {!! Form::textarea('description', null, array('placeholder' => 'Short Description','class' => 'form-control','rows'=>6)) !!}
                                @if ($errors->has('description'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Select  Image (Size width: 750 px):</strong>
                                <br/>
                                <input type="file" name="blog_image">
                                @if ($errors->has('blog_image'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('blog_image') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <img src="{{asset('uploads/blogs/'.$data->section_image)}}" width="270px" height="270px">
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
    $( document ).ready(function() {
      CKEDITOR.replace( 'description' ); 
    });
  </script>

@endsection