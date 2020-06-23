@extends("dashboard")

@section('title')
Work with Loading Detail | Edit Data
@stop

@section('breadcrumb')
<a href="{{ URL::previous() }}"> Loading Documents  </a> <span class="mx-1"> > </span> Edit Loading item
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('loading.update_item') }}">
					{{ csrf_field() }}

					<input type="hidden" name="loading_detail_id" value="{{ $loading_detail->loading_detail_id }}">
					<input type="hidden" name="current_picking_qty" value="{{ $current_picking_qty }}">
					<input type="hidden" name="loading_no" value="{{ $loading_detail->loading_no }}">
					
					<label>Item Number</label>
					<input type="text" name="item_number" class="form-control form-control-sm" value="{{ $loading_detail->item_number }}" readonly>

					<label class="mt-3">Loading Quantity</label>
					<input type="number" name="loading_qty" class="form-control form-control-sm" value="{{ $loading_detail->loading_qty }}">

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