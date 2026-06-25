@extends('layouts.admin')
@section('title', '| Item Images')
@section('page_name', 'Item Images')
@section('section_name', 'Item Images List')


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
                  <?=$item->name?> :-  @yield('section_name')
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                    <p>{{ $message }}</p>
                  </div>
                @endif
                @can('item-images-create')
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <!-- <div class="pull-left">
                            <h2>Users Management</h2>
                        </div> -->
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('items.addImages',$item->id) }}"> Add New images</a>
                        </div>
                    </div>
                </div>
                @endcan
                <br/>
                <table id="small-table" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Drag</th>
                      <th>Item Name</th>
                      <th>Image Name</th>
                      <th>Thumbnail Image</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="tablecontents">
                    @foreach($data as $values)
                    <tr class="row1" data-id="{{ $values->id }}">
                      <td>
                        <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;" title="change display order">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                        </div>
                        <!-- {{ $values->id }} -->
                      </td>
                      <td>{{ $values->item_name }}</td>
                      <td>{{ $values->name }}</td>
                      <td><img src="{{asset('uploads/product_items/'.$values->image)}}" width="100px" height="100px"></td>
                      <td>{{ ($values->status == 1)? "Active" : "Not Active" }}</td>
                      <td>
                        @can('item-images-delete')
                            {!! Form::open(['method' => 'GET','route' => ['items.remImages', $values->id],'style'=>'display:inline','onclick'=>'return confirm("Are you sure?")']) !!}
                            {!! Form::button('<i class="fas fa-trash-alt"></i>',['type'=>'submit','title'=>'Delete']) !!}
                        {!! Form::close() !!}
                        @endcan
                      </td>
                    </tr>
                    @endforeach
                  </tbody>                  
                </table>
                
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
  $(function () {
    $("#small-table").DataTable();

    $( "#tablecontents" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      handle: 'td:first-child',
      cancel: 'a, button, input, select, textarea',
      update: function() {
          sendOrderToServer();
      }
    });

    function sendOrderToServer() {

      var order = [];
      $('tr.row1').each(function(index,element) {
        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });

      $.ajax({
        type: "POST", 
        dataType: "json", 
        url: "<?= route('itemsImagesOrderUpdate')?>",
        data: {
          order:order,
          _token: '{{csrf_token()}}'
        },
        success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
        }
      });

    }
  });

</script>

@endsection