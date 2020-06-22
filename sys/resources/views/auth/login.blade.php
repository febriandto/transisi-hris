@extends('layouts.auth')

@section('content')

<br>
<br>
<br>
<br>

@error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

<div class="row">  
  <div class="col-md-3">&nbsp;</div>
  <div class="col-md-6">
    @if(Session::has('flash_danger'))
      <div class="alert alert-danger text-center" style="position: absolute;width: 96%;">Username dan Password tidak cocok</div>
    @endif
    <div class="login_area">
    <div class="row">
      <div class="col-md-7" style="border-right: 1px solid rgba(1,1,1,0.1)">
        <div style="margin-top: 10%;">
          <img src="/wms_update/dist/img/login.svg" alt="" width="80%" >
        </div>
      </div>
      <div class="col-md-5">
        <br><br>
        <h2 style="font-weight: bold;">  
          <img src="/wms_update/dist/img/logo_sincrum2.png" style="width: 100%">
         
        </h2> 
        <h6 class="mt-2"> Loging in to your account.</h6><hr>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group has-feedback">
              <input type="text" name="username" class="form-control" placeholder="Username">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="float-right">
              <button type="submit" name="login" class="btn btn-primary btn-block btn-flat btn-sm">
                <i class="fa fa-lock"></i> &nbsp; Sign In
              </button>
            </div>

          </form>
      </div>

    </div>

  </div>

  </div>

  <div class="col-md-2">&nbsp;</div>

</div>

<!-- <div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
                <span class="login100-form-title p-b-43">

                    <img src="{{ asset('images/logo_syncrum.png') }}" alt="" width="60%" style="margin-bottom: 40px;">
                    <div style="clear: both;"></div>
                    Login to continue
                </span>
                
                @if(Session::has('flash_danger'))
                    <div class="alert alert-danger text-center">Username/Password salah</div>
                @endif

                <div class="wrap-input100 validate-input" data-validate="Username is required">
                    <input class="input100" type="text" name="username">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Username</span>
                </div>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Password</span>
                </div>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        Login
                    </button>
                </div>

            </form>
            <div class="login100-more" style="background-image: url('images/bg-01.jpg');">
            </div>
        </div>
    </div>
</div> -->

@endsection
