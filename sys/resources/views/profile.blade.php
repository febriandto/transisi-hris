@extends('dashboard')

@section('title')
Profile {{ Auth::user()->name }}
@stop

@section('breadcrumb')
Profile
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
					'route' => ['profile.update']
					]) !!}

					<div class="modal-body">
						{!! Form::hidden('id_user', Auth::user()->id_user, ['required', 'class' => 'form-control form-control-sm', 'placeholder' => '']) !!}

						<div class="form-group area">
							<label for="name" class="col-sm-3 col-form-label">Name</label>
							<div class="col-sm-12">
								{!! Form::text('name', Auth::user()->name, ['required', 'class' => 'form-control form-control-sm', 'placeholder' => '']) !!}
							</div>
						</div>

						<div class="form-group area">
							<label for="username" class="col-sm-3 col-form-label">Username </label>
							<div class="col-sm-12">
								{!! Form::text('username', Auth::user()->username, ['required', 'class' => 'form-control form-control-sm']) !!}
							</div>
						</div>

						<br>

						{{-- <div class="form-group area">
							<label class="col-sm-3 col-form-label">Warehouse Plant</label>
							<div class="col-sm-12">
								<select name="plant_id" required class="form-control">
									<option value="">- Pilih -</option>
									@foreach( $plant as $data )
									<option {{ $data->plant_id == Auth::user()->plant_id ? 'selected' : '' }} value="{{ $data->plant_id }}"> {{$data->plant_name}} </option>
									@endforeach
								</select>
							</div>
						</div> --}}

						<br>


						<div class="form-group area">
							<label class="col-sm-3 col-form-label">Password</label>
							<div class="col-sm-12">
								<a href="#" data-toggle="modal" data-target="#modalForm" class="btn btn-outline-danger btn-sm btn-resetpass">
									<i class="fa fa-key mx-1"></i>	Reset Password
								</a>
							</div>
						</div>

						<div class="modal-footer">
							<a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
								<i class="fa fa-chevron-left mx-1"></i>	Back
							</a>
							<button type="submit" class="btn btn-success btn-sm">
								<i class="fa fa-check mx-1"></i>	Save
							</button>
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
									{!! Form::hidden('id_user', Auth::user()->id_user, ['required', 'class' => 'form-control form-control-sm', 'placeholder' => '']) !!}
									<input type="password" name="password_new" class="form-control-sm form-control" required>
								</div>
							</div>

							<div class="form-group row">
								<label for="password_repeat" class="col-sm-3 col-form-label">Repeat Password<span
									class="text-danger">*</span></label>
									<div class="col-sm-9">
										<input type="password" name="password_repeat" class="form-control-sm form-control" required>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-default btn-sm" data-dismiss="modal">
									<i class="fa fa-times mx-1"></i>	Cancel
								</button>
								<button type="submit" class="btn btn-warning btn-sm" onclick="confirm('Are you sure?')">
									<i class="fa fa-check"></i> Confirm
								</button>
							</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
				@stop