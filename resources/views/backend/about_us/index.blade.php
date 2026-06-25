@extends('layouts.admin')
@section('title', '| General')
@section('page_name', 'General')
@section('section_name', 'General')


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
        
        
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-tabs">
              
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-five-overlay" role="tabpanel" aria-labelledby="custom-tabs-five-overlay-tab">
                    @can('general')
                    <div class="overlay-wrapper">
                      <div class="card-body">
                        @if ($message = Session::get('success'))
                          <div class="alert alert-success">
                            <p>{{ $message }}</p>
                          </div>
                        @endif
                        
                        <br/>
                        <table id="small-table" class="table table-bordered">
                          <thead>
                            <tr>
                              <th>Drag</th>
                              <th>Title</th>
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
                              <td>{{ $values->title }}</td>
                              <td>{{ ($values->status == 1)? "Active" : "Not Active" }}</td>
                              <td>
                                @can('general')
                                    <a href="{{ route('general.edit',$values->id) }}" title="Edit"><i class="fa fa-wrench"></i></a>
                                @endcan
                              </td>
                            </tr>
                            @endforeach
                          </tbody>                  
                        </table>
                        
                      </div>
              <!-- /.card-body -->
                    </div>
                    @endcan
                  </div>
                 
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>


        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script type="text/javascript">
  $(function () {
    $("#small-table").DataTable();
    $("#chairman-message-table").DataTable();

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
        url: "<?= route('generalOrderUpdate')?>",
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