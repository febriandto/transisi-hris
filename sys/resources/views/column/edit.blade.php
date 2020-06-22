@extends("dashboard")

@section('title')
Work With Row Column (Kolom) | Edit Data
@stop

@section('breadcrumb')
<a href="{{ route('column.index') }}">Row Column (Kolom)</a> > Edit Data
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('column.update') }}">
					{{ csrf_field() }}

					<input type="hidden" name="col_id" value="{{ $column->col_id }}">

					<label for="col_name">Column Name</label>
					<input type="text" name="col_name" placeholder="column Name" class="form-control form-control-sm" value="{{ $column->col_name }}">

					<div class="float-right mt-3">
						<a href="{{ route('column.index') }}" class="btn btn-sm btn-outline-secondary ">
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