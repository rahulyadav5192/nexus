
<?php $__env->startSection('title', '| Operations Disciplines'); ?>
<?php $__env->startSection('page_name', 'Operations Disciplines'); ?>
<?php $__env->startSection('section_name', 'Disciplines List'); ?>


<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $__env->yieldContent('page_name'); ?></h1>
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
                <?php echo $__env->yieldContent('section_name'); ?>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php if($message = Session::get('success')): ?>
              <div class="alert alert-success">
                <p><?php echo e($message); ?></p>
              </div>
              <?php endif; ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products-create')): ?>
              <div class="row">
                <div class="col-lg-12 margin-tb">
                  <!-- <div class="pull-left">
                            <h2>Users Management</h2>
                        </div> -->
                  <div class="pull-right">
                    <a class="btn btn-success" href="<?php echo e(route('product-items.create')); ?>"> Add New</a>
                  </div>
                </div>
              </div>
              <?php endif; ?>
              <br />
              <table id="small-table" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Drag</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Thumbnail Image</th>
                    <th>Status</th>
                    <!-- <th>Images</th> -->
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="tablecontents">
                  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="row1" data-id="<?php echo e($values->id); ?>">
                    <td>
                      <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;" title="change display order">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </div>
                      <!-- <?php echo e($values->id); ?> -->
                    </td>
                    <td><?php echo e($values->name); ?></td>
                    <td><?php echo e($values->category_tag ?? '-'); ?></td>
                    <td><img src="<?php echo e($values->image_url); ?>" width="100" height="150" alt="<?php echo e($values->image_alt ?? $values->name); ?>"></td>
                    <td><?php echo e(($values->status == 1)? "Active" : "Not Active"); ?></td>
                    <!-- <td>
                      <a type="button" href="<?php echo e(route('items.showImages',$values->id)); ?>" class="btn btn-block btn-outline-primary btn-xs">Add Images</a>
                    </td> -->
                    <td>
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products-edit')): ?>
                      <a href="<?php echo e(route('product-items.edit',$values->id)); ?>" title="Edit" style="margin-right: 10px; display: inline-block;">
                        <i class="fa fa-wrench"></i>
                      </a>
                      <?php endif; ?>
                      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('products-delete')): ?>
                      <?php echo Form::open(['method' => 'DELETE','route' => ['product-items.destroy', $values->id],'style'=>'display:inline','onclick'=>'return confirm("Are you sure?")']); ?>

                      <?php echo Form::button('<i class="fas fa-trash-alt"></i>',['type'=>'submit','title'=>'Delete']); ?>

                      <?php echo Form::close(); ?>

                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
  $(function() {
    $("#small-table").DataTable();

    $("#tablecontents").sortable({
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
      $('tr.row1').each(function(index, element) {
        order.push({
          id: $(this).attr('data-id'),
          position: index + 1
        });
      });

      $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?= route('productItemsOrderUpdate') ?>",
        data: {
          order: order,
          _token: '<?php echo e(csrf_token()); ?>'
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/backend/product_items/index.blade.php ENDPATH**/ ?>