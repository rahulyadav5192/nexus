@extends('layouts.admin')
@section('title', '| Product Items')
@section('page_name', 'Product Items')
@section('section_name', 'Add Product Item')

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
                  <i class="fas fa-dolly-flatbed"></i>
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

                {!! Form::open(array('route' => 'featured-products.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Products:</strong>
                                {{Form::select('product_items_id', $product_items, null,['class' => 'form-control','id'=>'product_items_id','required'])}}
                                @if ($errors->has('product_items_id'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('product_items_id') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Category:</strong>
                                <?php $categoryLabels = [
    1 => 'Featured',
    2 => 'Popular',
    3 => 'Highlighted',
    4 => 'New Arrived',
]; ?>
                                
                                {{Form::select('category', $categoryLabels, null,['class' => 'form-control','id'=>'category','required'])}}
                                @if ($errors->has('category'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('category') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                           <div class="form-group">
                    <strong>For Highlighted products - Image (First- 570×540 px, Remaining- 570×225 px)</strong><br/>
                    <strong>For New Arrivals,Top Rated,Featured - Image (First- 270×274 px, Remaining- 570×225 px)</strong>
                    <br />
                    <input type="file" name="image" required>
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
  $( document ).ready(function() {
    CKEDITOR.replace( 'description' ); 
  });
</script>

@endsection