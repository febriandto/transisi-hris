@extends("dashboard")

@section('title')
Item Detail
@stop

@section('breadcrumb')
<a href="{{ route('itemmaster.index') }}">Item Master</a>
<span class="mx-2"> > </span>
<span> Add Item </span>
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label for="item_number">Item Number</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="item_number" class="form-control form-control-sm" value="{{$item->item_number}}" readonly>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="item_name">Item Name</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-sm" value="{{$item->item_name}}" readonly>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="item_description">Item Description</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-sm" value="{{$item->item_description}}" readonly>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label for="uom_id" class="mt-2">Unit of Measurement (UOM)</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-sm" value="{{$item->uom_id}}" readonly>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="item_cat_id">Item Category</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-sm" value="{{$item->item_cat_id}}" readonly>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="cust_id">Customer</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-sm" value="{{$item->cust_id}}" readonly>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label for="begining_stock">Begining Stock</label>					
						</div>
						<div class="col-md-6">
							<input type="number" class="form-control form-control-sm" value="{{$item->begining_stock}}" readonly>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="spq_item">SPQ Item</label>
						</div>
						<div class="col-md-6">
							<input type="number" class="form-control form-control-sm" value="{{$item->spq_item}}" readonly>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="spq_pallet">SPQ Pallet</label>
						</div>
						<div class="col-md-6">
							<input type="number" class="form-control form-control-sm" value="{{$item->spq_pallet}}" readonly>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="item_rmk">Remarks</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-sm" value="{{$item->item_rmk}}" readonly>
						</div>
					</div>

					<div class="float-right">
						<a href="{{URL::previous()}}" class="btn btn-sm btn-outline-secondary ">
							<i class="fa fa-chevron-left mr-1"></i> Back
						</a>
					</div>

			</div>
		</div>
	</div>
</div>
@stop