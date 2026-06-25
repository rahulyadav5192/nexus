
<?php $__env->startSection('title', '| Blogs'); ?>
<?php $__env->startSection('page_name', 'Blogs'); ?>
<?php $__env->startSection('section_name', 'Edit Blogs'); ?>

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
                <i class="fas fa-blog"></i>
                <?php echo $__env->yieldContent('section_name'); ?>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php if(count($errors) > 0): ?>
              <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e($error); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <?php endif; ?>
              <br />
              <?php echo Form::model($data, ['method' => 'PATCH','route' => ['blogs.update', $data->id],'enctype'=>'multipart/form-data']); ?>

              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4">
                  <div class="form-group">
                    <strong>Categories:</strong>
                    <?php echo e(Form::select('category_id', $categories, $data->category_id,['class' => 'form-control','id'=>'category_id','required'])); ?>

                    <?php if($errors->has('category_id')): ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('category_id')); ?></strong>
                    </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <strong>Name:</strong>
                    <?php echo Form::text('blog_name', null, array('placeholder' => 'Name','class' => 'form-control')); ?>

                    <?php if($errors->has('blog_name')): ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('blog_name')); ?></strong>
                    </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                  <div class="form-group">
                    <strong>Date:</strong>
                    <?php echo Form::date('blog_date', null, array('placeholder' => 'Date','class' => 'form-control', 'required')); ?>

                  </div>
                </div>
                <?php echo $__env->make('backend.blogs._form_fields', ['data' => $data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <?php echo Form::close(); ?>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/backend/blogs/edit.blade.php ENDPATH**/ ?>