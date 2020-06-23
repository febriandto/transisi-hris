@extends("dashboard")

@section('title')
Loading selected Item
@stop

@section('breadcrumb')
<a href="{{ URL::previous() }}"> Loading Documents  </a> <span class="mx-1"> > </span> Do Loading
@stop

@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('loading.do_loading_save') }}">
					{{ csrf_field() }}

					<input type="hidden" name="loading_no" value="{{$loading->loading_no}}">
					<input type="hidden" name="picking_no" value="{{$data->picking_no}}">

					
					<label>Item Number</label>
					<input type="text" name="item_number" class="form-control form-control-sm" value="{{$data->item_number}}" readonly>

					<div class="row">
						<div class="col-md-7">
							<label class="mt-3">Item Name</label>
							<input type="text" name="item_name" class="form-control form-control-sm" value="{{$data->item_name}}" readonly>
						</div>
						<div class="col-md-5">
							<label class="mt-3">Inbound ID</label>
							<input type="number" name="inbound_pallet_id" class="form-control form-control-sm" value="{{$data->inbound_pallet_id}}" readonly>
						</div>
					</div>
					<br>

					<div class="row mt-3">
						<div class="col-md-4">
							<div class="border p-2">
								<p class="m-0">Pallet : {{ $data->pallet_name }}</p>
								<input readonly type="hidden" name="pallet_id" value="{{$data->pallet_id}}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="border p-2">
								<p class="m-0">Location : {{ $data->location_code }}</p>
								<input readonly type="hidden" name="location_code" value="{{$data->location_code}}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="border p-2">
								<p class="m-0">Stok Saat ini : ( {{$data->pallet_qty}} {{$data->uom_code}})</p>
								<input type="hidden" name="pallet_qty" value="{{ $data->pallet_qty }}" readonly>
							</div>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-4">
							<label>Picking QTY ( {{ $data->uom_code }} )</label>
							<input readonly type="number" name="picking_qty" class="form-control form-control-sm" value="{{$data->picking_qty}}">
						</div>
						<div class="col-md-4">
							<label>Open Qty ( {{ $data->uom_code }})</label>
              <input readonly type="number" name="picking_open_qty" class="form-control form-control-sm" value="{{$data->picking_open_qty}}">
						</div>
						<div class="col-md-4">
							<label>SPQ Item</label>
              <input type="number" name="spq_item" class="form-control form-control-sm" value="{{$data->spq_item}}" readonly>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-4">
							<label>Picking Detail Qty ( {{$data->second_uom}} )</label>
							<input readonly type="number" name="picking_detail_qty" class="form-control form-control-sm" value="{{$data->picking_detail_qty}}">
						</div>
						<div class="col-md-4">
							<label>Open Detail Qty ( {{ $data->second_uom }})</label>
              <input readonly type="number" name="picking_open_detail_qty" class="form-control form-control-sm" value="{{$data->picking_open_detail_qty}}">
						</div>
						<div class="col-md-4">
							<label>Loading Qty ( {{ $data->second_uom }})</label>
              <input type="number" name="loading_detail_qty" class="form-control form-control-sm" max="{{$data->picking_open_detail_qty}}" required placeholder="Detail Qty">
						</div>
					</div>

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