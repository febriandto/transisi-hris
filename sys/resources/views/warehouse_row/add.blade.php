@extends("dashboard")

@section('title')
Add Warehouse Row
@stop

@section('breadcrumb')
<a href="{{ route('warehouserow.index') }}">Warehouse Row</a> > Add New
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('warehouserow.save') }}">
					{{ csrf_field() }}
					
					<label for="wh_row_id">Row ID</label>
					<input type="text" name="wh_row_id" class="form-control form-control-sm" placeholder="Row ID">

					<label class="mt-3" for="wh_row_name">Warehouse Row</label>
					<input type="text" name="wh_row_name" class="form-control form-control-sm" placeholder="Warehouse Row Name">

					<label class="mt-3" for="wh_row_desc">Description</label>
					<input type="text" name="wh_row_desc" class="form-control form-control-sm" placeholder="Description">

					<div class="float-right mt-3">
						<a href="{{ route('warehouserow.index') }}" class="btn btn-sm btn-outline-secondary ">
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