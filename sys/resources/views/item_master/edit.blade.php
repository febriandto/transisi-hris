@extends("dashboard")

@section('title')
Edit Item Master
@stop

@section('breadcrumb')
<a href="{{ route('itemmaster.index') }}">Item Master</a> > Edit Item
@stop

@section('content')
<div class="card">
	<div class="card-body">
		<form role="form" method="POST" action="{{ route('itemmaster.update') }}">
			{{ csrf_field() }}
			
			<div class="row">
				<div class="col-md-6">
					<label for="item_number">Item Number</label>
					<input type="text" name="item_number" class="form-control form-control-sm" placeholder="Item Number" value="{{ $ItemMaster->item_number }}" readonly>

					<label class="mt-2" for="item_name">Item Name</label>
					<input type="text" name="item_name" class="form-control form-control-sm" placeholder="Item Name" value="{{ $ItemMaster->item_name }}">

					<label class="mt-2" for="item_description">Item Description</label>
					<input type="text" name="item_description" class="form-control form-control-sm" placeholder="Item Description" value="{{ $ItemMaster->item_description }}">
				</div>

				<div class="col-md-6">
					<label for="uom_id">Unit of Measurement (UOM)</label>
					<select class="form-control form-control-sm" name="uom_id">
						<option> - Select - </option>
						@foreach( $uom as $data )
							<option @if( $ItemMaster->uom_id == $data->uom_id ) {{ 'selected' }} @endif value="{{ $data->uom_id }}">{{ $data->uom_code }}</option>
						@endforeach
					</select>

					<label class="mt-2" for="item_cat_id">Item Category</label>
					<select class="form-control form-control-sm" name="item_cat_id">
						<option> - Select - </option>
						@foreach( $item_cat as $data )
							<option @if( $ItemMaster->item_cat_id == $data->item_cat_id ) {{ 'selected' }} @endif value="{{ $data->item_cat_id }}">{{ $data->item_cat_name }}</option>
						@endforeach
					</select>

					<label class="mt-2" for="cust_id">Customer</label>
					<select class="form-control form-control-sm" name="cust_id">
						<option> - Select - </option>
						@foreach( $customer as $data )
							<option @if( $ItemMaster->cust_id == $data->cust_id ) {{ 'selected' }} @endif value="{{ $data->cust_id }}"> {{ $data->cust_name }} </option>
						@endforeach
					</select>
				</div>
			</div>

			<br>

			<label for="begining_stock">Begining Stock</label>
			<input type="number" name="begining_stock" class="form-control form-control-sm" placeholder="0" value="{{ $ItemMaster->begining_stock }}">

			<label class="mt-2" for="spq_item">SPQ Item</label>
			<input type="number" name="spq_item" class="form-control form-control-sm" placeholder="0" value="{{ $ItemMaster->spq_item }}">

			<label class="mt-2" for="spq_pallet">SPQ Pallet</label>
			<input type="number" name="spq_pallet" class="form-control form-control-sm" placeholder="0" value="{{ $ItemMaster->spq_pallet }}">

			<label class="mt-2" for="item_rmk">Remarks</label>
			<input type="text" name="item_rmk" class="form-control form-control-sm" placeholder="Remarks" value="{{ $ItemMaster->item_rmk }}">
			<br>

			<div class="float-right">
				<a href="{{ route('itemmaster.index') }}" class="btn btn-sm btn-outline-secondary ">
					<i class="fa fa-times"></i> Cancel
				</a>
				<button class="btn btn-sm btn-success">
					<i class="fa fa-check"></i> Save
				</button>
			</div>

		</form>
	</div>
</div>
@stop