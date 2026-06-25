<?php $__env->startSection('title', '| Meta Tags'); ?>
<?php $__env->startSection('page_name', 'Meta Tags'); ?>
<?php $__env->startSection('section_name', 'Edit Meta Tags of item'); ?>

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
                  <i class="fas fa-tag"></i>
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
                <br/>
                <?php echo Form::model($data, ['method' => 'PATCH','route' => ['meta-tags.item.update', $data->id],'enctype'=>'multipart/form-data']); ?>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Tag:</strong>
                                <?php echo Form::text('tag', null, array('placeholder' => 'Tag','class' => 'form-control', 'required')); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                <?php echo Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control', 'required')); ?>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Slug:</strong>
                                <?php echo Form::text('slug', null, array('placeholder' => 'Slug','class' => 'form-control', 'required')); ?>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                            <?php echo e(Form::label('status', 'Active')); ?>

                            
                            <?php echo Form::checkbox('status',1, $data->status); ?>

                            
                          </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/backend/meta_tags/item_edit.blade.php ENDPATH**/ ?>