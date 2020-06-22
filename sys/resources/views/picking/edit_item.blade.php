@extends("dashboard")

@section('title')
Work with Picking Detail | Edit Data
@stop

@section('breadcrumb')
<a href="{{ URL::previous() }}"> Picking Documents </a> <span class="mx-1"> > </span> Edit Item
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('picking.update_item') }}">
					{{ csrf_field() }}

					<input type="hidden" name="picking_detail_id" value="{{ $picking_detail->picking_detail_id }}">
					<input type="hidden" name="picking_no" value="{{ $picking_detail->picking_no }}">
					
					<label>Item Number</label>
					<input type="text" name="item_number" class="form-control form-control-sm" value="{{ $picking_detail->item_number }}" readonly>

					<label class="mt-3">Pick Qty</label>
					<input type="number" name="picking_qty" class="form-control form-control-sm" value="{{ $picking_detail->picking_qty }}">

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