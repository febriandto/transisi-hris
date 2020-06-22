@extends("dashboard")

@section('title')
Edit Level ID
@stop

@section('breadcrumb')
<a href="{{ route('level.index') }}">Level ID</a> > Edit Level
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('level.update') }}">
					{{ csrf_field() }}

					<input type="hidden" name="level_id" value="{{ $level->level_id }}">

					<label for="level_name">level Name</label>
					<input type="text" name="level_name" placeholder="Level Name" class="form-control form-control-sm" value="{{ $level->level_name }}">

					<div class="float-right mt-3">
						<a href="{{ route('level.index') }}" class="btn btn-sm btn-outline-secondary ">
							<i class="fa fa-times"></i> Cancel
						</a>
						<button class="btn btn-sm btn-success">
							<i class="fa fa-check"></i> Save
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@stop