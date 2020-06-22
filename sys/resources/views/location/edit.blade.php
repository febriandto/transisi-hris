@extends("dashboard")

@section('title')
Work With Location | Edit Data
@stop

@section('breadcrumb')
<a href="{{ route('location.index') }}">Location</a> > Edit Data
@stop

@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('location.update') }}">
					{{ csrf_field() }}
					
					<label for="location_id">Location ID (Autofill)</label>
					<input type="text" name="location_id" placeholder="Location ID" class="form-control form-control-sm" value="{{ $location->location_id }}" readonly>

					<div class="row">
						<div class="col-md-6">
							<label class="mt-3" for="location_code">Location Code</label>
							<input type="text" name="location_code" placeholder="Location Name" class="form-control form-control-sm" required value="{{ $location->location_code }}">
						</div>
						<div class="col-md-6">
							<label class="mt-3" for="location_name">Location Name</label>
							<input type="text" name="location_name" placeholder="Location Name" class="form-control form-control-sm" required value="{{ $location->location_name }}">
						</div>
					</div>

					<label class="mt-3" for="location_desc">Location Description</label>
					<input type="text" name="location_desc" placeholder="Location Description" class="form-control form-control-sm" value="{{ $location->location_desc }}">

					<br>
					<hr>

					<div class="row">
						<div class="col-md-6">

							<label for="warehouse_plant">Warehouse Plant</label>
							<select class="form-control form-control-sm" name="plant_id">
								<option> - Select - </option>
								@foreach($warehouse_plant as $data)
								<option @if( $location->plant_id == $data->plant_id ) {{ 'selected' }} @endif  value="{{ $data->plant_id }}">{{ $data->plant_name }}</option>
								@endforeach
							</select>

							<label class="mt-3" for="warehouse_bin">Warehouse BIN</label>
							<select class="form-control form-control-sm" name="bin_loc_id">
								<option> - Select - </option>
								@foreach($warehouse_bin as $data)
								<option @if( $location->bin_loc_id == $data->bin_loc_id ) {{ 'selected' }} @endif value="{{ $data->bin_loc_id }}">{{ $data->bin_loc_name }}</option>
								@endforeach
							</select>

							<label class="mt-3" for="zone_id">Warehouse Zone</label>
							<select class="form-control form-control-sm" name="zone_id">
								<option> - Select - </option>
								@foreach($warehouse_zone as $data)
								<option @if( $location->zone_id == $data->zone_id ) {{ 'selected' }} @endif value="{{ $data->zone_id }}">{{ $data->zone_name }}</option>
								@endforeach
							</select>

						</div>
						<div class="col-md-6">

							<label for="wh_area_id">Warehouse Area</label>
							<select class="form-control form-control-sm" name="wh_area_id" id="warehouserow" value="">
								<option value=""> - Select - </option>
								@foreach($warehouse_area as $data)
								<option @if( $location->wh_area_id == $data->wh_area_id ) {{ 'selected' }} @endif value="{{ $data->wh_area_id }}">
									{{ $data->wh_area_id }} | {{ $data->wh_area_name }}
								</option>
								@endforeach
							</select>

							<label class="mt-3" for="wh_row_id">Warehouse Row</label>
							<select class="form-control form-control-sm" name="wh_row_id" id="warehouserow" value="">
								<option value=""> - Select - </option>
								@foreach($warehouse_row as $data)
								<option @if( $location->wh_row_id == $data->wh_row_id ) {{ 'selected' }} @endif value="{{ $data->wh_row_id }}">{{ $data->wh_row_name }}</option>
								@endforeach
							</select>

							<label class="mt-3" for="location_rmk">Remarks</label>
							<input type="text" name="location_rmk" class=" form-control form-control-sm" placeholder="Remarks" value="{{ $location->location_rmk }}">

						</div>
					</div>

					{{-- button --}}
					<div class="float-right mt-3">
						<a href="{{ route('location.index') }}" class="btn btn-sm btn-outline-secondary ">
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

@section('script')
<script>
	$( "select" ).change(function () {

	var warehouseRow = $( "#warehouserow option:selected" ).attr("value"),
	rowColumn = $("#rowcolumn option:selected").attr("value"),
	rowLevel = $("#rowlevel option:selected").attr("value");

	if( warehouseRow != "" && rowColumn != "" && rowLevel != "" ){

		$("#location_code").attr("value", warehouseRow+"."+rowColumn+"."+rowLevel);

	}else{

		$("#location_code").attr("value", "");

	}
}).change();
</script>
@stop