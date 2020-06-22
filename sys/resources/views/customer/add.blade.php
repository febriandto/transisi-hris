@extends('dashboard')

@section('title')
Add New Master Data Customer
@stop

@section('breadcrumb')
<span>
	<a href="{{ route('customermaster.index') }}">Customer Master</a>
</span>
<span class="mx-1"> > </span>
<span> Add New</span>
@stop

@section('content')
<div class="col-md-7">
	<div class="card">
	  <div class="card-body">
	  		<form role="form" method="POST" action="{{ route('customermaster.save') }}">
	  			{{ csrf_field() }}
			  	<div class="row">
			  			<label>Customer ID</label>
					  	<input type="text" name="cust_id" class="form-control form-control-sm" value="C{{ $cust_id }}" readonly>

					  	<label class="mt-3">Name</label>
					  	<input type="text" name="cust_name" class="form-control form-control-sm" placeholder="Customer Name">

					  	<label class="mt-3">Phone</label>
					  	<input type="text" name="cust_phone" class="form-control form-control-sm" placeholder="Customer Phone">

					  	<label class="mt-3">Email</label>
					  	<input type="email" name="cust_email" class="form-control form-control-sm" placeholder="Customer Email">
			  			
			  			<label class="mt-3">Fax</label>
					  	<input type="text" name="cust_fax" class="form-control form-control-sm" placeholder="Customer Fax">

					  	<label class="mt-3">Person in Charge (PIC)</label>
					  	<input type="text" name="cust_person" class="form-control form-control-sm" placeholder="Person In Charge">

					  	<label class="mt-3">Contact Person</label>
					  	<input type="text" name="cust_contact_person" class="form-control form-control-sm" placeholder="Contact Person">

					  	<label class="mt-3">Remarks</label>
					  	<input type="text" name="cust_remarks" class="form-control form-control-sm" placeholder="Remarks">
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