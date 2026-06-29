<?php $__env->startSection('title', '| Admin Login'); ?>
<?php $__env->startSection('page_name', 'Admin Login'); ?>
<?php $__env->startSection('section_name', 'Admin Login'); ?>

<?php $__env->startSection('content'); ?>
<div class="login-box">
  <div class="login-logo">

    <img src="<?php echo e(asset('common/logo.png')); ?>" alt="PGL Logistics" class="PGL">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to Admin Panel</p>


      <form method="POST" action="<?php echo e(route('login')); ?>" autocomplete="off">
        <?php echo csrf_field(); ?>
        <div class="input-group mb-3">
          <!--<input type="email" class="form-control" autocomplete="off" placeholder="Email">-->
          <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="false" autofocus placeholder="Email ID">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="invalid-feedback" role="alert">
            <strong><?php echo e($message); ?></strong>
          </span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="input-group mb-3">
          <!--<input type="password" class="form-control" autocomplete="off" placeholder="Password">-->
          <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="false" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="fas fa-eye" id="togglePassword"></i>
            </div>
          </div>
          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <span class="invalid-feedback" role="alert">
            <strong><?php echo e($message); ?></strong>
          </span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <!--<input type="checkbox" id="remember">-->
              <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <?php if(Route::has('password.request')): ?>
        <!-- <a href="<?php echo e(route('password.request')); ?>" class="btn btn-block btn-danger">
          <i class="fab fa-key mr-2"></i> I forgot my password
        </a> -->
        <?php endif; ?>
      </div>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<script type="text/javascript">
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function(e) {

    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/nexus/resources/views/auth/login.blade.php ENDPATH**/ ?>