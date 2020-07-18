@extends('dashboard')

@section('title')
	Work with Master Data Customer | View Data
@stop

@section('breadcrumb')
	<span>
		<a href="{{ route('customermaster.index') }}">Customer Master</a>
	</span>
	<span class="mx-1"> > </span>
	<span> Detail</span>
@stop

@section('content')
<div class="row">
	<div class="col-md-6">

		{{-- Customer Detail --}}
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6 align-self-center">
						<p class="font-weight-bold mb-0">Customer Detail:</p>
					</div>
					<div class="col-md-6 text-right">
						<a href="{{ route('customermaster.edit', $customermaster['cust_id']) }}" class="btn btn-warning btn-sm"> <i class="fa fa-edit mr-1"></i> Edit</a>
					</div>
				</div>
			</div>

			<div class="card-body">
				<table class="table table-sm table-striped table-bordered table-hover">
						<tr>
							<th>Customer Name</th>
							<td>{{ $customermaster['cust_name'] }}</td>
						</tr>
						<tr>
							<th>Customer Phone</th>
							<td>{{ $customermaster['cust_phone'] }}</td>
						</tr>
						<tr>
							<th>Customer Fax</th>
							<td>{{ $customermaster['cust_fax'] }}</td>
						</tr>
						<tr>
							<th>Customer Email</th>
							<td>{{ $customermaster['cust_email'] }}</td>
						</tr>
						<tr>
							<th>Customer Address</th>
							<td>{{ $customermaster['cust_address'] }}</td>
						</tr>
						<tr>
							<th>No NPWP</th>
							<td>{{ $customermaster['npwp_no'] }}</td>
						</tr>
						<tr>
							<th>Person in Charge (PIC)</th>
							<td>{{ $customermaster['cust_person'] }}</td>
						</tr>
						<tr>
							<th>Contact Person</th>
							<td>{{ $customermaster['cust_contact_person'] }}</td>
						</tr>
						<tr>
							<th>Remarks</th>
							<td>{{ $customermaster['cust_remarks'] }}</td>
						</tr>
				</table>
			</div>
		</div>

	</div>


	<div class="col-md-6">
		{{-- Customer Address --}}
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6 align-self-center">
						<p class="font-weight-bold mb-0">Customer Address:</p>
					</div>
					<div class="col-md-6 text-right">
						<a href="{{ route('customeraddress.add', ['cust_id' => $customermaster['cust_id']] ) }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-1"></i> Add New</a>
					</div>
				</div>
			</div>

			<div class="card-body">
				<table class="table table-sm table-striped table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Address Name</th>
							<th>Description</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						@foreach($customer_address as $no => $address)
							<tr>
								<td class="text-center">{{ $no+1 }}</td>
								<td>{{ $address->add_name }}</td>
								<td>{{ $address->add_desc }}</td>
								<td width="5%">
									<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Action</button>
									<ul class="dropdown-menu">
										<li>
											<a href="{{ route('customeraddress.edit', $address->cust_add_id) }}">
												<i class="fa fa-edit mr-2"></i> Edit
											</a>
										</li>
									</ul>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		</div>
	</div>

	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-6 align-self-center">
						<p class="font-weight-bold mb-0">List Item / Produk milik Customer :</p>
					</div>
					<div class="col-md-6 text-right">
						<a href="{{ route('itemmaster.add', ['cust_id' => $customermaster['cust_id']] ) }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-1"></i> Add New</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-sm table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Item Number</th>
							<th>Item Name</th>
							<th>Unit</th>
							<th>Stock</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $items as $no => $item )
						<tr>
							<td>{{ $no+1 }}</td>
							<td>{{ $item->item_number }}</td>
							<td>{{ $item->item_name }}</td>
							<td>{{ $item->uom_code }}</td>
							<td>{{ $item->ending_stock }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
@stop