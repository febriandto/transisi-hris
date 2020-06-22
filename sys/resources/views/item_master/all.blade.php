@extends("dashboard")

@section('title')
Work With Item Master | View Data
@stop

@section('breadcrumb')
Item Master
@stop

@section('content')
<div class="card">
	<div class="card-header">
		<a href="{{ route('itemmaster.add') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-2"></i> Add New</a>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover table-striped table-sm" id="dataTables" id="dataTables">
			<thead>
				<tr>
					<th>No</th>
					<th>Item Number</th>
					<th>Item Name</th>
					<th>Unit</th>
					<th>SPQ Item</th>
					<th>SPQ Pallet</th>
					<th>Customer</th>
					<th>Option</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $item_master as $no => $item )
				<tr>
					<td class="text-center">{{ $no+1 }}</td>
					<td>{{ $item->item_number }}</td>
					<td>{{ $item->item_name }}</td>
					<td>{{ $item->uom_code }}</td>
					<td>{{ $item->spq_item }}</td>
					<td>{{ $item->spq_pallet }}</td>
					<td>{{ $item->cust_name }}</td>
					<td>
						<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('itemmaster.edit', $item->item_number) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<form role="form" method="POST" action="{{ route('itemmaster.delete') }}">
									{{ csrf_field() }}
									<input type="text" name="item_number" value="{{ $item->item_number }}" hidden>
									<button type="submit" style="border: none;width: 65%;background: none;color: #777;" onclick="return confirm('Delete??');">
										<i class="fa fa-times mr-2"></i> Delete
									</button>
								</form>
							</li>
							<li>
								<a href="">
									<i class="fa fa-hand-paper mr-2"></i>Hold
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
@stop