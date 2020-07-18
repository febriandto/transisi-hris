@extends("dashboard")

@section('title')
Edit Item Master
@stop

@section('breadcrumb')
<a href="{{ route('itemmaster.index') }}">Item Master</a> 
<span class="mx-2"> > </span>
<span> Edit Item </span>
@stop

@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('itemmaster.update') }}">
					{{ csrf_field() }}

					<div class="row border-bottom">
						<div class="col-md-6 my-3">
							<label class="mb-0" for="item_number">Item Number</label>
						</div>
						<div class="col-md-6 align-self-center">
							<input type="text" name="item_number" class="form-control form-control-sm" placeholder="Item Number" value="{{$ItemMaster->item_number}}">
						</div>
					</div>

					<div class="row border-bottom">
						<div class="col-md-6 my-3">
							<label class="mb-0" for="item_name">Item Name</label>
						</div>
						<div class="col-md-6 align-self-center">
							<input type="text" name="item_name" class="form-control form-control-sm" placeholder="Item Name" value="{{$ItemMaster->item_name}}">
						</div>
					</div>

					<div class="row border-bottom">
						<div class="col-md-6 my-3">
							<label class="mb-0" for="item_description">Item Description</label>
						</div>
						<div class="col-md-6 align-self-center">
							<input type="text" name="item_description" class="form-control form-control-sm" placeholder="Item Description" value="{{$ItemMaster->item_description}}">
						</div>
					</div>

					<div class="row border-bottom">
						<div class="col-md-6 my-3">
							<label class="mb-0" for="uom_id">Unit of Measurement (UOM)</label>
						</div>
						<div class="col-md-6 align-self-center">
							<select class="form-control form-control-sm select2" name="uom_id">
								<option> - Select - </option>
								@foreach( $uom as $data )
								<option value="{{ $data->uom_id }}" @if($ItemMaster->uom_id == $data->uom_id) {{"selected"}} @endif>{{ $data->uom_code }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row border-bottom">
						<div class="col-md-6 my-3">
							<label class="mb-0" for="second_uom">Second UOM</label>
						</div>
						<div class="col-md-6 align-self-center">
							<input type="text" name="second_uom" class="form-control form-control-sm" placeholder="Second UOM" value="{{$ItemMaster->second_uom}}">
						</div>
					</div>

					<div class="row border-bottom">
						<div class="col-md-6 my-3">
							<label class="mb-0" for="item_cat_id">Item Category</label>
						</div>
						<div class="col-md-6 align-self-center">
							<select class="form-control form-control-sm select2" name="item_cat_id">
								<option> - Select - </option>
								@foreach( $item_cat as $data )
								<option value="{{ $data->item_cat_id }}" @if($ItemMaster->item_cat_id == $data->item_cat_id) {{"selected"}} @endif>{{ $data->item_cat_name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row border-bottom">
						<div class="col-md-6 my-3">
							<label class="mb-0" for="cust_id">Customer</label>
						</div>
						<div class="col-md-6 align-self-center">
							<select class="form-control form-control-sm select2" name="cust_id">
								<option> - Select - </option>
								@foreach( $customer as $data )
								<option value="{{ $data->cust_id }}" @if($ItemMaster->cust_id == $data->cust_id) {{"selected"}} @endif> {{ $data->cust_name }} </option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row border-bottom">
						<div class="col-md-6 my-3">
							<label class="mb-0" for="begining_stock">Begining Stock</label>					
						</div>
						<div class="col-md-6 align-self-center">
							<input type="number" name="begining_stock" class="form-control form-control-sm" placeholder="0" value="{{$ItemMaster->begining_stock}}">
						</div>
					</div>

					<div class="row border-bottom">
						<div class="col-md-6 my-3">
							<label class="mb-0" for="spq_item">SPQ Item</label>
						</div>
						<div class="col-md-6 align-self-center">
							<input type="number" name="spq_item" class="form-control form-control-sm" placeholder="0" value="{{$ItemMaster->spq_item}}">
						</div>
					</div>

					<div class="row border-bottom">
						<div class="col-md-6 my-3">
							<label class="mb-0" for="spq_pallet">SPQ Pallet</label>
						</div>
						<div class="col-md-6 align-self-center">
							<input type="number" name="spq_pallet" class="form-control form-control-sm" placeholder="0" value="{{$ItemMaster->spq_pallet}}">
						</div>
					</div>

					<div class="row border-bottom">
						<div class="col-md-6 my-3">
							<label class="mb-0" for="item_rmk">Remarks</label>
						</div>
						<div class="col-md-6 align-self-center">
							<input type="text" name="item_rmk" class="form-control form-control-sm" placeholder="Remarks" value="{{$ItemMaster->item_rmk}}">
						</div>
					</div>

					<div class="float-right mt-3">
						<a href="{{ route('itemmaster.index') }}" class="btn btn-sm btn-outline-secondary ">
							<i class="fa mx-1 fa-times"></i> Cancel
						</a>
						<button class="btn btn-sm btn-success">
							<i class="fa mx-1 fa-check"></i> Save
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@stop