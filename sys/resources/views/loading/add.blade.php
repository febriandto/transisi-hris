@extends("dashboard")

@section('title')
Add New Loading Documents
@stop

@section('breadcrumb')
<a href="{{ URL::previous() }}"> Loading Documents  </a> <span class="mx-1"> > </span> Add Data
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('loading.save') }}">
					{{ csrf_field() }}
					
					<label>Loading Number</label>
					<input type="text" name="loading_no" class="form-control form-control-sm" value="LO<?php echo date('ymd')?><?php echo $loading_no; ?>" readonly>

					<label class="mt-3" for="picking_no">Picking Number</label>
					<input type="text" name="picking_no" class="form-control form-control-sm" value="{{ $picking->picking_no }}" readonly>

					<div class="row mt-3">
						<div class="col-md-3">
							<label>Customer ID</label>
							<input type="text" name="cust_id" class="form-control-sm form-control" value="{{ $customer->cust_id }}" readonly>
						</div>
						<div class="col-md-9">
							<label>Customer Name</label>
							<input type="text" name="cust_name" class="form-control-sm form-control" value="{{ $customer->cust_name }}" readonly>
						</div>
					</div>

					<label class="mt-3" for="loading_date">Loading Date</label>
					<input type="date" name="loading_date" class="form-control form-control-sm">

					<label class="mt-3" for="loading_rmk">Loading Remarks</label>
					<input type="text" name="loading_rmk" class="form-control form-control-sm" placeholder="Loading Remarks">

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