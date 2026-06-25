
<?php $__env->startSection('title', '| Subscriber'); ?>
<?php $__env->startSection('page_name', 'Subscriber'); ?>
<?php $__env->startSection('section_name', 'Subscriber List'); ?>


<!-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->


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
                <i class="fas fa fa-book"></i>
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

              <br />

              <div class="container">
                <table id='dataTable' width='100%' border="1" style='border-collapse: collapse;'>
                  <thead>
                    <tr>
                      <td>Email ID</td>
                      <td>Date</td>
                    </tr>
                  </thead>
                </table>
              </div>

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

    // DataTable
    $('#dataTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "<?php echo e(route('subscribers.getData')); ?>",
      columns: [{
          data: 'email',
          'orderable': false
        },
        {
          data: 'updated_at',
          'orderable': false
        },
      ]
    });

  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/backend/subscribers/index.blade.php ENDPATH**/ ?>