@extends('dashboard')

@section('title')
Edit Master Data Customer
@stop

@section('breadcrumb')
<span>
	<a href="{{ route('customermaster.index') }}">Customer Master</a>
</span>
<span class="mx-1"> > </span>
<span> Edit </span>
@stop

@section('content')
<div class="col-md-7">
	<div class="card">
		<div class="card-body">
			<form role="form" method="POST" action="{{ route('customermaster.update') }}">
				{{ csrf_field() }}

				<div class="row border-bottom">
					<div class="col-md-6">
						<label class="my-3">Customer ID</label>
					</div>
					<div class="col-md-6 align-self-center">
						<input type="text" name="cust_id" class="form-control form-control-sm" value="{{ $customermaster->cust_id }}" readonly>
					</div>
				</div>

				<div class="row border-bottom">
					<div class="col-md-6">
						<label class="my-3">Name</label>
					</div>
					<div class="col-md-6 align-self-center">
						<input type="text" name="cust_name" class="form-control form-control-sm" placeholder="Customer Name" value="{{$customermaster->cust_name}}">
					</div>
				</div>

				<div class="row border-bottom">
					<div class="col-md-6">
						<label class="my-3">Phone</label>
					</div>
					<div class="col-md-6 align-self-center">
						<input type="text" name="cust_phone" class="form-control form-control-sm" placeholder="Customer Phone" value="{{$customermaster->cust_phone}}">
					</div>
				</div>

				<div class="row border-bottom">
					<div class="col-md-6">
						<label class="my-3">Email</label>
					</div>
					<div class="col-md-6 align-self-center">
						<input type="email" name="cust_email" class="form-control form-control-sm" placeholder="Customer Email" value="{{$customermaster->cust_email}}">
					</div>
				</div>

				<div class="row border-bottom">
					<div class="col-md-6">
						<label class="my-3">Fax</label>
					</div>
					<div class="col-md-6 align-self-center">
						<input type="text" name="cust_fax" class="form-control form-control-sm" placeholder="Customer Fax" value="{{$customermaster->cust_fax}}">
					</div>
				</div>

				<div class="row border-bottom">
					<div class="col-md-6">
						<label class="my-3">Address</label>
					</div>
					<div class="col-md-6 align-self-center">
						<input type="text" name="cust_address" class="form-control form-control-sm" placeholder="Customer Address" value="{{$customermaster->cust_address}}">
					</div>
				</div>

				<div class="row border-bottom">
					<div class="col-md-6">
						<label class="my-3">No NPWP</label>
					</div>
					<div class="col-md-6 align-self-center">
						<input type="text" name="npwp_no" class="form-control form-control-sm" placeholder="No NPWP" value="{{$customermaster->npwp_no}}">
					</div>
				</div>

				<div class="row border-bottom">
					<div class="col-md-6">
						<label class="my-3">Person in Charge (PIC)</label>
					</div>
					<div class="col-md-6 align-self-center">
						<input type="text" name="cust_person" class="form-control form-control-sm" placeholder="Person In Charge" value="{{$customermaster->cust_person}}">
					</div>
				</div>

				<div class="row border-bottom">
					<div class="col-md-6">
						<label class="my-3">Contact Person</label>
					</div>
					<div class="col-md-6 align-self-center">
						<input type="text" name="cust_contact_person" class="form-control form-control-sm" placeholder="Contact Person" value="{{$customermaster->cust_contact_person}}">
					</div>
				</div>

				<div class="row border-bottom">
					<div class="col-md-6">
						<label class="my-3">Remarks</label>
					</div>
					<div class="col-md-6 align-self-center">
						<input type="text" name="cust_remarks" class="form-control form-control-sm" placeholder="Remarks" value="{{$customermaster->cust_remarks}}">
					</div>
				</div>

				<div class="float-right mt-3">
					<a href="{{ route('customermaster.index') }}" class="btn btn-sm btn-outline-secondary">
						<i class="fa fa-times mr-2"></i>	Cancel
					</a>
					<button class="btn btn-sm btn-success" type="submit">
						<i class="fa fa-check mr-2"></i>	Save
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

@stop