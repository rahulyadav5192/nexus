@extends('layouts.admin')
@section('title', '| Blogs')
@section('page_name', 'Blogs')
@section('section_name', 'Blogs List')


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
                  @yield('section_name')
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                    <p>{{ $message }}</p>
                  </div>
                @endif
                @can('blogs-create')
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <!-- <div class="pull-left">
                            <h2>Users Management</h2>
                        </div> -->
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('blogs.create') }}"> Add New</a>
                        </div>
                    </div>
                </div>
                @endcan
                <br/>
                <table id="small-table" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Drag</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Sections</th>
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
                      <td>{{ $values->blog_name }}</td>
                      <td>{{ ($values->status == 1)? "Active" : "Not Active" }}</td>
                      <td><a href="{{ route('blogs.sections',$values->id) }}" title="Edit"><i class="fa fa-server"></i></a></td>
                      <td>
                        @can('blogs-edit')
                            <a href="{{ route('blogs.edit',$values->id) }}" title="Edit" style="margin-right: 10px; display: inline-block;">
                              <i class="fa fa-wrench"></i>
                            </a>
                        @endcan
                        @can('blogs-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['blogs.destroy', $values->id],'style'=>'display:inline','onclick'=>'return confirm("Are you sure?")']) !!}
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
    $("#small-table").DataTable({
      columnDefs: [
        { orderable: false, targets: [0, 3, 4] } // Disable sorting on Drag, Sessions, and Actions columns
      ]
    });

    // Make sure edit links are clickable - prevent sortable from interfering
    $(document).on('click', 'a[href*="blogs.edit"]', function(e) {
      e.stopPropagation();
      // Allow default link behavior
      return true;
    });

    $( "#tablecontents" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      handle: 'td:first-child', // Only allow dragging from the first column (Drag column)
      cancel: 'a, button, input, select, textarea', // Cancel sortable on interactive elements
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
        url: "<?= route('blogsOrderUpdate')?>",
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