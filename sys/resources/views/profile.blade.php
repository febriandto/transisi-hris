@extends('dashboard')

@section('title')
Profile {{ Auth::user()->name }}
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
    <i class="fa fa-user mr-2 mt-1"></i> <strong>Profile</strong>
    <div class="card-header-actions ml-auto">
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12">
				{!! Form::open([
					'method' => 'POST',
					'route' => ['profile.perbarui']
					]) !!}

        <div class="modal-body">
          {!! Form::hidden('id_user', Auth::user()->id, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
        
          <div class="form-group area">
            <label for="name_form" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-12">
              {!! Form::text('name_form', Auth::user()->name, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
            </div>
          </div>
        
          <div class="form-group area">
            <label for="username_form" class="col-sm-3 col-form-label">Username </label>
            <div class="col-sm-12">
              {!! Form::text('username_form', Auth::user()->username, ['required', 'class' => 'form-control']) !!}
            </div>
          </div>
        
          <div class="form-group area">
            <label for="email_form" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-12">
              {!! Form::text('email_form', Auth::user()->email, ['required', 'class' => 'form-control']) !!}
            </div>
          </div>
        
          <div class="form-group area">
            <label class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-12">
              <a href="#" data-toggle="modal" data-target="#modalForm" class="btn btn-outline-danger btn-sm btn-resetpass">Reset Password</a>
            </div>
					</div>
					
					<div class="modal-footer">
					<a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
						<input type="submit" class="btn btn-primary" value="Save" id="submitSimpan">
					</div>
        
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

</div>

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Reset Password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			{!! Form::open([
				'method' => 'POST',
				'route' => ['profile.passwordreset']
				]) !!}
			<div class="modal-body">

				<div class="form-group row">
					<label for="password_new" class="col-sm-3 col-form-label">New Password<span
							class="text-danger">*</span></label>
					<div class="col-sm-9">
						{!! Form::text('password_new', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
						{!! Form::hidden('id_user', Auth::user()->id, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>

				<div class="form-group row">
					<label for="password_repeat" class="col-sm-3 col-form-label">Repeat Password<span
							class="text-danger">*</span></label>
					<div class="col-sm-9">
						{!! Form::text('password_repeat', null, ['required', 'class' => 'form-control']) !!}
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-default" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary" onclick="confirm('Are you sure?')">Reset</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop