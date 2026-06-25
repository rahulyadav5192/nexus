
<?php $__env->startSection('title', '| Users Management'); ?>
<?php $__env->startSection('page_name', 'Users Management'); ?>
<?php $__env->startSection('section_name', 'Admin Users List'); ?>

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
                  <i class="fa fa-users mr-1"></i>
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
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <!-- <div class="pull-left">
                            <h2>Users Management</h2>
                        </div> -->
                        <div class="pull-right">
                            <a class="btn btn-success" href="<?php echo e(route('users.create')); ?>"> Create New User</a>
                        </div>
                    </div>
                </div>
                <br/>
                <table class="table table-bordered">
                 <tr>
                   <th>No</th>
                   <th>Name</th>
                   <th>Email</th>
                   <th>Roles</th>
                   <th width="280px">Action</th>
                 </tr>
                 <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e(++$i); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td>
                      <?php if(!empty($user->getRoleNames())): ?>
                        <?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <label class="badge badge-success"><?php echo e($v); ?></label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </td>
                    <td>
                       <a href="<?php echo e(route('users.show',$user->id)); ?>" title="View"><i class="fa fa-eye"></i></a>
                       
                          <a href="<?php echo e(route('users.edit',$user->id)); ?>" title="Edit"><i class="fa fa-wrench"></i></a>
                      
                       <?php if($user->id!=1){ ?>
                        <?php echo Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']); ?>

                            <?php echo Form::button('<i class="fas fa-trash-alt"></i>',['type'=>'submit','title'=>'Delete']); ?>

                        <?php echo Form::close(); ?>

                      <?php } ?>
                    </td>
                  </tr>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <?php echo $data->render(); ?>

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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/backend/users/index.blade.php ENDPATH**/ ?>