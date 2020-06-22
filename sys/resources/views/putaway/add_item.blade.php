@extends("dashboard")

@section('title')
Do Put Away for selected Item
@stop

@section('breadcrumb')
<a href="{{ URL::previous() }}"> Put Away </a> <span class="mx-1"> > </span> Do Put Away
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('putaway.save_item') }}">
					{{ csrf_field() }}

					<input type="hidden" name="putaway_no" value="{{ $putaway->putaway_no }}">
					<input type="hidden" name="tally_no" value="{{ $tally->tally_no }}">
	
					<label>Item Number</label>
					<input type="text" name="item_number" class="form-control form-control-sm" value="{{ $data->item_number }}" readonly>

					<div class="row">
						<div class="col-md-8">
							<label class="mt-3">Item Name</label>
							<input type="text" name="item_name" class="form-control form-control-sm" value="{{ $data->item_name }}" readonly>
						</div>

						<div class="col-md-4">
							<label class="mt-3">SPQ item</label>
							<input type="text" name="spq_item" class="form-control form-control-sm" value="{{ $data->spq_item }}" readonly>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<label class="mt-3">Tally Qty</label>
							<input type="text" name="tally_qty" class="form-control form-control-sm" value="{{ $data->tally_qty }}" readonly>
						</div>
						<div class="col-md-4">
							<label class="mt-3">Open Qty</label>
							<input type="text" name="open_qty" class="form-control form-control-sm" value="{{ $data->open_qty }}" readonly>
						</div>
						<div class="col-md-4">
							<label class="mt-3">Put Away Qty</label>
							<input type="text" name="putaway_qty" class="form-control form-control-sm" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-md-8">
							<label class="mt-3">Put Away Location</label>
							<select class="form-control form-control-sm" name="location_id">
								<option> - Select -</option>
								@foreach( $putaway_location as $data )
								<option value="{{ $data->location_id }}"> {{ $data->location_code }} </option>
								@endforeach
							</select>
						</div>

						<div class="col-md-4">
							<label class="mt-3">Pallet ID</label>
							<select class="form-control form-control-sm" name="pallet_id">
								<option> - Select -</option>
								@foreach($pallet as $data)
								<option value="{{ $data->pallet_id }}"> {{ $data->pallet_id }} - {{ $data->pallet_name }} </option>
								@endforeach
							</select>
							<input type="checkbox" name="pallet_full" value="1" class="mt-2">
							<label for="pallet_full">Pallet Penuh</label>
						</div>
					</div>

					<div class="float-right mt-3">
						<a class="btn btn-sm btn-outline-secondary" href="{{ URL::previous() }}">
							<i class="fa fa-times mr-2"></i> Cancel
						</a>
						<button class="btn btn-sm btn-success">
							<i class="fa fa-check mr-2"></i> Save
						</button>
					</div>


				</form>
			</div>
		</div>
	</div>
</div>
@stop