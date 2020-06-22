@extends("dashboard")

@section('title')
Add Warehouse Area
@stop

@section('breadcrumb')
<a href="{{ route('warehousearea.index') }}">Warehouse Area</a> > Add New
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('warehousearea.save') }}">
					{{ csrf_field() }}
					
					<label for="wh_zone_id">Warehouse Zone</label>
					<select class="form-control form-control-sm" name="wh_zone_id">
						<option> - Select - </option>
						@foreach( $warehouse_zone as $no => $data )
						<option value="{{ $data->zone_id }}">{{ $data->zone_name }}</option>
						@endforeach
					</select>

					<label class="mt-3" for="wh_area_name">Warehouse Area Name</label>
					<input type="text" name="wh_area_name" class="form-control form-control-sm" placeholder="Warehouse Area Name">

					<label class="mt-3" for="wh_area_desc">Warehouse Area Description</label>
					<input type="text" name="wh_area_desc" class="form-control form-control-sm" placeholder="Warehouse Area Description">

					<div class="float-right mt-3">
						<a href="{{ route('warehousearea.index') }}" class="btn btn-sm btn-outline-secondary ">
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