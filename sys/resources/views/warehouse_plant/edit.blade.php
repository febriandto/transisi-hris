@extends("dashboard")

@section('title')
Edit Warehouse Plant
@stop

@section('breadcrumb')
<a href="{{ route('warehouseplant.index') }}">Warehouse Plant</a> > Edit Warehouse Plant
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('warehouseplant.update') }}">
					{{ csrf_field() }}

							<input type="hidden" name="plant_id" value="{{ $warehouseplant->plant_id }}">
					
							<label for="plant_id">Plant ID</label>
							<input type="text" class="form-control form-control-sm" value="{{ $warehouseplant->plant_id }}" readonly>

							<label class="mt-2" for="plant_name">Name</label>
							<input type="text" name="plant_name" class="form-control form-control-sm" placeholder="Warehouse Name" value="{{ $warehouseplant->plant_name }}">

							<label class="mt-2" for="plant_description">Description</label>
							<input type="text" name="plant_description" class="form-control form-control-sm" placeholder="Warehouse Description" value="{{ $warehouseplant->plant_description }}">

							<label class="mt-2" for="plant_rmk">Remarks</label>
							<input type="text" name="plant_rmk" class="form-control form-control-sm" placeholder="Warehouse Remarks" value="{{ $warehouseplant->plant_rmk }}">

					<div class="float-right mt-3">
						<a href="{{ route('warehouseplant.index') }}" class="btn btn-sm btn-outline-secondary ">
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