@extends("dashboard")

@section('title')
Edit Warehouse Row
@stop

@section('breadcrumb')
<a href="{{ route('warehouserow.index') }}">Warehouse Row</a> > Edit Warehouse Row
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('warehouserow.update') }}">
					{{ csrf_field() }}

					<input type="hidden" name="wh_row_id" value="{{ $warehouserow->wh_row_id }}">

					<label>Warehouse Row ID</label>
					<input type="text" class="form-control form-control-sm" readonly placeholder="{{ $warehouserow->wh_row_id }}">

					<label class="mt-3" for="wh_row_name">Warehouse Row Name</label>
					<input type="text" name="wh_row_name" class="form-control form-control-sm" value="{{ $warehouserow->wh_row_name }}">

					<label class="mt-3" for="wh_row_desc">Description</label>
					<input type="text" name="wh_row_desc" class="form-control form-control-sm" placeholder="Warehouse Description" value="{{$warehouserow->wh_row_desc}}">

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