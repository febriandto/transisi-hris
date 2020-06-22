@extends("dashboard")

@section('title')
Edit Warehouse Area
@stop

@section('breadcrumb')
<a href="{{ route('warehousearea.index') }}">Warehouse Area</a> > Edit Warehouse Area
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('warehousearea.update') }}">
					{{ csrf_field() }}

					<input type="hidden" name="wh_area_id" value="{{ $warehousearea->wh_area_id }}">

					<label for="wh_zone_id">Warehouse Zone</label>
					<select class="form-control form-control-sm" name="wh_zone_id">
						<option> - Select - </option>
						@foreach( $warehouse_zone as $no => $data )
						<option @if( $warehousearea->wh_zone_id == $data->zone_id ) {{ 'selected' }} @endif value="{{ $data->zone_id }}">{{ $data->zone_name }}</option>
						@endforeach
					</select>

					<label class="mt-3" for="wh_area_name">Warehouse Area Name</label>
					<input type="text" name="wh_area_name" class="form-control form-control-sm" placeholder="Warehouse Area Name" value="{{ $warehousearea->wh_area_name }}">

					<label class="mt-3" for="wh_area_desc">Warehouse Area Description</label>
					<input type="text" name="wh_area_desc" class="form-control form-control-sm" placeholder="Warehouse Area Description" value="{{ $warehousearea->wh_area_desc }}">

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