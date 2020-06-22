@extends("dashboard")

@section('title')
Add New Location
@stop

@section('breadcrumb')
<a href="{{ route('location.index') }}">Location</a> > Add New
@stop

@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('location.save') }}">
					{{ csrf_field() }}
					
					<label for="location_id">Location ID (Autofill)</label>
					<input type="text" name="location_id" placeholder="Location ID" class="form-control form-control-sm" value="LOC{{ $location_id }}" readonly>

					<label class="mt-3" for="location_name">Location Name</label>
					<input type="text" name="location_name" placeholder="Location Name" class="form-control form-control-sm" required>

					<label class="mt-3" for="location_desc">Location Description</label>
					<input type="text" name="location_desc" placeholder="Location Description" class="form-control form-control-sm">

					<br>
					<hr>

					<div class="row">
						<div class="col-md-6">

							<label for="warehouse_plant">Warehouse Plant</label>
							<select class="form-control form-control-sm" name="plant_id">
								<option> - Select - </option>
								@foreach($warehouse_plant as $data)
								<option value="{{ $data->plant_id }}">{{ $data->plant_name }}</option>
								@endforeach
							</select>

							<label class="mt-3" for="warehouse_bin">Warehouse BIN</label>
							<select class="form-control form-control-sm" name="bin_loc_id">
								<option> - Select - </option>
								@foreach($warehouse_bin as $data)
								<option value="{{ $data->bin_loc_id }}">{{ $data->bin_loc_name }}</option>
								@endforeach
							</select>

							<label class="mt-3" for="col_id">Row Column</label>
							<select class="form-control form-control-sm" name="col_id" id="rowcolumn" value="">
								<option value=""> - Select - </option>
								@foreach($warehouse_column as $data)
								<option value="{{ str_pad($data->col_id, 2, '0', STR_PAD_LEFT) }}">{{ $data->col_name }}</option>
								@endforeach
							</select>

							<label class="mt-3" for="zone_id">Warehouse Zone</label>
							<select class="form-control form-control-sm" name="zone_id">
								<option> - Select - </option>
								@foreach($warehouse_zone as $data)
								<option value="{{ $data->zone_id }}">{{ $data->zone_name }}</option>
								@endforeach
							</select>

						</div>
						<div class="col-md-6">
							
							<label for="wh_id">Warehouse Name</label>
							<select class="form-control form-control-sm" name="wh_id">
								<option> - Select - </option>
								@foreach($warehouse_name as $data)
								<option value="{{ $data->wh_id }}">{{ $data->wh_name}}</option>
								@endforeach
							</select>

							<label class="mt-3" for="wh_row_id">Warehouse Row</label>
							<select class="form-control form-control-sm" name="wh_row_id" id="warehouserow" value="">
								<option value=""> - Select - </option>
								@foreach($warehouse_row as $data)
								<option value="{{ $data->wh_row_id }}">{{ $data->wh_row_name }}</option>
								@endforeach
							</select>

							<label class="mt-3" for="level_id">Row Level</label>
							<select class="form-control form-control-sm" name="level_id" id="rowlevel" value="">
								<option value=""> - Select - </option>
								@foreach($warehouse_level as $data)
								<option value="{{ str_pad($data->level_id, 2, '0', STR_PAD_LEFT) }}">{{ $data->level_name }}</option>
								@endforeach
							</select>

							<label class="mt-3" for="location_rmk">Remarks</label>
							<input type="text" name="location_rmk" class=" form-control form-control-sm" placeholder="Remarks">

						</div>
					</div>

					<label class="mt-3">Location Code</label>
					<input type="text" id="location_code" name="location_code" class="form-control form-control-sm" placeholder="Location Code" value="" readonly>



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