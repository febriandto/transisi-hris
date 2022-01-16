@extends('layouts.auth')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-4">
        <div style="vertical-align: middle;">
        <br><br>
        <div class="col-md-12 mx-auto" >
        <div class="card card-signin my-5" style="vertical-align: middle; padding: 0px !important;">
          <div class="card-body" style="padding: 15px !important;">
            <h4 align="center" style="background: transparent;"> <img src="{{asset('images/hris_logo4.png')}}" width="100%" > </h4>
            <hr>
            <h5 class="card-title text-center">HRIS LOGIN FORM</h5>
            
            @if( session()->get( 'password' ) )
                <div class="alert alert-danger" role="alert">
                    <strong>{{ session()->get( 'password' ) }}</strong>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="form-signin">
            {{ csrf_field() }}
              <div class="form-label-group">
                <input type="text" id="inputEmail" class="form-control" name="username" placeholder="NIK" required autofocus>
                <label for="inputEmail">NIK</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <!-- <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div> -->
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="login">Sign in</button>
              <!-- <hr class="my-4">
              <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
            </form>
            <br>
            <!-- <hr>

            <p align="center">Human Resource Information System</p> -->
          </div>
        </div>

      </div>
      </div>

      </div>
      <div class="col-lg-4"></div> 
    </div>
  </div>

    <p style="position: absolute; bottom: 10px; left: 20%; width: 60%; color: white; font-size: 13px; line-height: 1;" align="center"> HRIS - Human Resource System <BR>
  Version. 1.0.1.2 </p>


  <style type="text/css">
:root {
  --input-padding-x: 1.5rem;
  --input-padding-y: .75rem;
}

body {
  background: #007bff;
  background: linear-gradient(to right, #0062E6, #33AEFF);
}

.card-signin {
  border: 0;
  border-radius: 1rem;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.card-signin .card-title {
  margin-bottom: 2rem;
  font-weight: 300;
  font-size: 1.5rem;
}

.card-signin .card-body {
  padding: 2rem;
}

.form-signin {
  width: 100%;
}

.form-signin .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  transition: all 0.2s;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group input {
  height: auto;
  border-radius: 2rem;
}

.form-label-group>input,
.form-label-group>label {
  padding: var(--input-padding-y) var(--input-padding-x);
}

.form-label-group>label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0;
  /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
  padding-top: calc(var(--input-padding-y) / 3);
  padding-bottom: calc(var(--input-padding-y) / 3);
  font-size: 12px;
  color: #777;
}

.btn-google {
  color: white;
  background-color: #ea4335;
}

.btn-facebook {
  color: white;
  background-color: #3b5998;
}

/* Fallback for Edge
-------------------------------------------------- */

@supports (-ms-ime-align: auto) {
  .form-label-group>label {
    display: none;
  }
  .form-label-group input::-ms-input-placeholder {
    color: #777;
  }
}

/* Fallback for IE
-------------------------------------------------- */

@media all and (-ms-high-contrast: none),
(-ms-high-contrast: active) {
  .form-label-group>label {
    display: none;
  }
  .form-label-group input:-ms-input-placeholder {
    color: #777;
  }
}

@media (min-width: 768px)
.col-md-7 {
    -ms-flex: 0 0 58.333333%;
    /* flex: 0 0 58.333333%; */
    /* max-width: 58.333333%; */
    width: 100%;
}

</style>

<style type="text/css">
  @media only screen and (max-width: 600px) {
  #mobile_box_login { margin-top: 100px; }
}
</style>

<style type="text/css">
  .gagal_login { text-align: center; color: red;  width: 100%; margin-top: 20px; background: yellow; padding: 5px; border: 1px solid red; border-radius: 5px; }
</style>

@endsection
