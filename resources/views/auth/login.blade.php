@extends('layouts.admin_login')
@section('title', '| Admin Login')
@section('page_name', 'Admin Login')
@section('section_name', 'Admin Login')

@section('content')
<div class="login-box">
  <div class="login-logo">

    <img src="{{asset('common/logo.png')}}" alt="PGL Logistics" class="PGL">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to Admin Panel</p>


      <form method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf
        <div class="input-group mb-3">
          <!--<input type="email" class="form-control" autocomplete="off" placeholder="Email">-->
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="false" autofocus placeholder="Email ID">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <!--<input type="password" class="form-control" autocomplete="off" placeholder="Password">-->
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="false" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="fas fa-eye" id="togglePassword"></i>
            </div>
          </div>
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <!--<input type="checkbox" id="remember">-->
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
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
        @if (Route::has('password.request'))
        <!-- <a href="{{ route('password.request') }}" class="btn btn-block btn-danger">
          <i class="fab fa-key mr-2"></i> I forgot my password
        </a> -->
        @endif
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

@endsection