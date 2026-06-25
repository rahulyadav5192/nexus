<?php $__env->startSection('title', '| Operations Disciplines'); ?>
<?php $__env->startSection('page_name', 'Operations Disciplines'); ?>
<?php $__env->startSection('section_name', 'Add Discipline'); ?>

<?php $__env->startSection('content'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $__env->yieldContent('page_name'); ?></h1>
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
                <i class="fas fa-dolly-flatbed"></i>
                <?php echo $__env->yieldContent('section_name'); ?>
              </h3>
            </div>
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

              <?php echo Form::open(['route' => 'product-items.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

              <div class="row">
                <?php echo $__env->make('backend.product_items._form_fields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
              <?php echo Form::close(); ?>

            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/backend/product_items/create.blade.php ENDPATH**/ ?>