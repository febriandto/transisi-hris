@extends("dashboard")

@section('title')
Add New Row Column (Kolom)
@stop

@section('breadcrumb')
<a href="{{ route('column.index') }}">Row Column ID (Kolom)</a> > Add New
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('column.save') }}">
					{{ csrf_field() }}
					
					<label for="col_name">Column Name</label>
					<input type="text" name="col_name" placeholder="Column Name" class="form-control form-control-sm">

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