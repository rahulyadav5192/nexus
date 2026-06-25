<?php $__env->startSection('title', '| Meta Tags'); ?>
<?php $__env->startSection('page_name', 'Meta Tags'); ?>
<?php $__env->startSection('section_name', 'Meta Tags List of Pages'); ?>


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
                <i class="fas fa fa-tag"></i>
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
              <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="pt-2 px-3">
                      <h3 class="card-title">Meta Tags :</h3>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-two-home-tab" href="<?php echo e(route('meta-tags.index')); ?>" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Pages</a>
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-two-profile-tab" href="<?php echo e(route('meta-tags.category')); ?>" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Categories</a>
                    </li> -->
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-two-profile-tab" href="<?php echo e(route('meta-tags.item')); ?>" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Service Items</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-two-profile-tab" href="<?php echo e(route('meta-tags.blog')); ?>" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Blog</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-two-profile-tab" href="<?php echo e(route('meta-tags.blog-category')); ?>" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Blog Categories</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                      <div class="container">
                        <table id='dataTable' width='100%' border="1" style='border-collapse: collapse;'>
                          <thead>
                            <tr>
                              <td>Page Name</td>
                              <td>Tags</td>
                              <td>Status</td>
                              <td>Actions</td>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
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
      ajax: {
        "url": "<?php echo e(route('meta-tags.showTable')); ?>",
        "type": "GET"
      },
      columns: [{
          data: 'page_name'
        },
        {
          data: 'tag'
        },
        {
          data: 'status'
        },
        {
          data: 'actions'
        },
      ]
    });

  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/backend/meta_tags/index.blade.php ENDPATH**/ ?>