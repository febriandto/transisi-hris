@extends('dashboard')

@section('title')
Work With Data Customer Address | View Data
@stop

@section('breadcrumb')
<span class="small">Data Customer Address</span>
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
    <div class="card-header-actions">
      <a href="{{ route('customeraddress.add') }}" class="card-header-action btn-tambah btn-primary btn btn-sm btn" title="Tambah">
      	<i class="fa fa-plus mr-2"></i> Add New
      </a>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover table-striped table-sm" width="100%" id="dataTables" id="dataTables">
      
      <thead>
        <tr>
          <th width="5%">No.</th>
          <th>Customer</th>
          <th>Address Name</th>
          <th>Description</th>
          <th width="50">Action</th>
        </tr>
      </thead>

      <tbody>
      	@foreach ($customer_address as $no => $data)
      	<tr>
      		<td class="text-center">{{ $no+1 }}</td>
      		<td>{{ $data->cust_name }}</td>
      		<td>{{ $data->add_name }}</td>
      		<td>{{ $data->add_desc }}</td>
      		<td>
						<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('customeraddress.edit', $data->cust_add_id) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-pallet mr-2"></i>Inventory Monitori
								</a>
							</li>
							<li>
								<form role="form" method="POST" action="{{ route('customeraddress.delete') }}">
									{{ csrf_field() }}
									<input type="hidden" name="cust_add_id" value="{{ $data->cust_add_id }}">
									<button type="submit" style="border: none;width: 65%;background: none;color: #777;" onclick="return confirm('Delete??');">
										<i class="fa fa-times mr-2"></i> Delete
									</button>
								</form>
							</li>
						</ul>
					</td>
      	</tr>
      	@endforeach
      </tbody>
    </table>
  </div>
</div>

@stop