@extends('layouts.admin')
@section('title', '| Operations Disciplines')
@section('page_name', 'Operations Disciplines')
@section('section_name', 'Edit Discipline')

@section('content')

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">@yield('page_name')</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-dolly"></i>
                @yield('section_name')
              </h3>
            </div>
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
              {!! Form::model($data, ['method' => 'PATCH', 'route' => ['product-items.update', $data->id], 'enctype' => 'multipart/form-data']) !!}
              <div class="row">
                @include('backend.product_items._form_fields', ['data' => $data])
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
