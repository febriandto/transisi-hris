@extends('dashboard')

@section('title')
Work With Item Master | View Data
@stop

@section('breadcrumb')
<span>
	<a href="{{ route('customermaster.index') }}">Customer Master</a>
</span>
<span class="mx-1"> > </span>
<span> Inventory Monitor </span>
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
    <div class="card-header-actions">
    	<i class="fa fa-pallet"></i> Inventory Monitor Of {{ $customermaster->cust_name }}
    </div>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover table-striped table-sm" width="100%" id="dataTables">
      
      <thead>
        <tr>
          <th width="5%">No.</th>
          <th>Item</th>
          <th>Item Name</th>
          <th>Unit</th>
          <th>SPQ</th>
          <th>Begining</th>
          <th>Putaway</th>
          <th>Loading</th>
          <th>Ending</th>
          <th>Detail</th>
        </tr>
      </thead>

      <tbody>
      	@foreach ($inventory_monitor as $no => $data)
      	<tr>
      		<td class="text-center">{{ $no+1 }}</td>
					<td>{{ $data->item_number }}</td>
					<td>{{ $data->item_name }}</td>
					<td>{{ $data->uom_code }}</td>
					<td>{{ $data->spq_item }}</td>
					<td>{{ $data->begining_stock }}</td>
					<td></td>
					<td>{{ $data->loading_qty }}</td>
					<td>{{ $data->ending_stock }}</td>
					<td></td>
      	</tr>
      	@endforeach
      </tbody>
    </table>
  </div>
</div>

@stop