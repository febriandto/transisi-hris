@extends("dashboard")

@section('title')
Add New Item Master
@stop

@section('breadcrumb')
<a href="{{ route('itemmaster.index') }}">Item Master</a> > Add Item
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('itemmaster.save') }}">
					{{ csrf_field() }}

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label for="item_number">Item Number</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="item_number" class="form-control form-control-sm" placeholder="Item Number">
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="item_name">Item Name</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="item_name" class="form-control form-control-sm" placeholder="Item Name">
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="item_description">Item Description</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="item_description" class="form-control form-control-sm" placeholder="Item Description">
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label for="uom_id" class="mt-2">Unit of Measurement (UOM)</label>
						</div>
						<div class="col-md-6">
							<select class="form-control form-control-sm select2" name="uom_id">
								<option> - Select - </option>
								@foreach( $uom as $data )
									<option value="{{ $data->uom_id }}">{{ $data->uom_code }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="item_cat_id">Item Category</label>
						</div>
						<div class="col-md-6">
							<select class="form-control form-control-sm select2" name="item_cat_id">
								<option> - Select - </option>
								@foreach( $item_cat as $data )
									<option value="{{ $data->item_cat_id }}">{{ $data->item_cat_name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="cust_id">Customer</label>
						</div>
						<div class="col-md-6">
							<select class="form-control form-control-sm select2" name="cust_id">
								<option> - Select - </option>
								@foreach( $customer as $data )
									<option value="{{ $data->cust_id }}"> {{ $data->cust_name }} </option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label for="begining_stock">Begining Stock</label>					
						</div>
						<div class="col-md-6">
							<input type="number" name="begining_stock" class="form-control form-control-sm" placeholder="0">
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="spq_item">SPQ Item</label>
						</div>
						<div class="col-md-6">
							<input type="number" name="spq_item" class="form-control form-control-sm" placeholder="0">
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="spq_pallet">SPQ Pallet</label>
						</div>
						<div class="col-md-6">
							<input type="number" name="spq_pallet" class="form-control form-control-sm" placeholder="0">
						</div>
					</div>

					<div class="row mb-2 border-bottom">
						<div class="col-md-6">
							<label class="mt-2" for="item_rmk">Remarks</label>
						</div>
						<div class="col-md-6">
							<input type="text" name="item_rmk" class="form-control form-control-sm" placeholder="Remarks">
						</div>
					</div>

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
	</div>
</div>
@stop