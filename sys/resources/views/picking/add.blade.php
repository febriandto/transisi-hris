@extends("dashboard")

@section('title')
Add new Picking Documents
@stop

@section('breadcrumb')
<a href="{{ URL::previous() }}"> Picking Documents </a> <span class="mx-1"> > </span> Add Data
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('picking.save') }}">
					{{ csrf_field() }}

					<input type="hidden" name="periode_id" value="{{ $periode_id }}">
					
					<label>Picking Number</label>
					<input type="text" name="picking_no" class="form-control form-control-sm" value="P{{ date('ymd') }}{{ $picking_no }}" readonly>

					<label class="mt-3" for="picking_date">Picking Date</label>
					<input type="date" name="picking_date" class="form-control form-control-sm">

					<label class="mt-3" for="picking_desc">Description</label>
					<input type="text" name="picking_desc" class="form-control form-control-sm" placeholder="Picking Description">

					<label class="mt-3" for="cust_id">Customer</label>
					<select class="form-control form-control-sm" name="cust_id">
						<option> - Select - </option>
						@foreach( $customer as $data )
						<option value="{{ $data->cust_id }}"> {{ $data->cust_name }} </option>
						@endforeach
					</select>

					<label class="mt-3" for="picking_rmk">Picking Remarks</label>
					<input type="text" name="picking_rmk" class="form-control form-control-sm" placeholder="Picking Remarks">

					<div class="float-right mt-3">
						<a href="{{ URL::previous() }}" class="btn btn-sm btn-outline-secondary"> <i class="fa fa-times mr-2"></i> Cancel</a>
						<button class="btn btn-sm btn-success"> <i class="fa fa-check mr-1" type="submit"></i> Save</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@stop