@extends("dashboard")

@section('title')
Edit Data Customer Address
@stop

@section('breadcrumb')
<a href="{{ route('customeraddress.index') }}">Data Customer Address</a> > Edit Address
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('customeraddress.update') }}">
					{{ csrf_field() }}
					
					<input type="hidden" name="cust_add_id" value="{{ $customeraddress->cust_add_id }}">

					<label for="item_cat_name">Customer</label>
					<select class="form-control form-control-sm select2" name="cust_id">
						<option> - Select -</option>
						@foreach( $customer as $data )
						<option @if( $data->cust_id == $customeraddress->cust_id ) {{ 'selected' }} @endif value="{{ $data->cust_id }}"> {{ $data->cust_name }} </option>
						@endforeach
					</select>

					<label class="mt-3" for="add_name">Customer Address</label>
					<input type="text" name="add_name" class="form-control form-control-sm" placeholder="Address" value="{{ $customeraddress->add_name }}">

					<label class="mt-3" for="add_desc">Address Description</label>
					<input type="text" name="add_desc" class="form-control form-control-sm" placeholder="Description" value="{{ $customeraddress->add_desc }}">

					<div class="float-right mt-3">
						<a href="{{ route('customeraddress.index') }}" class="btn btn-sm btn-outline-secondary ">
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