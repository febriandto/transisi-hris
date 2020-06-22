@extends("dashboard")

@section('title')
Work With Item Category | View Data
@stop

@section('breadcrumb')
Item Category
@stop

@section('content')
<div class="card">
	<div class="card-header">
		<a href="{{ route('itemcategory.add') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-2"></i> Add New</a>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover table-striped table-sm" id="dataTables" id="dataTables">
			<thead>
				<tr>
					<th>No</th>
					<th width="40%">Item Category Name</th>
					<th>Item Category Description</th>
					<th>Update</th>
					<th>Option</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $item_category as $no => $item )
				<tr>
					<td class="text-center">{{ $no+1 }}</td>
					<td>{{ $item->item_cat_name }}</td>
					<td>{{ $item->item_cat_desc }}</td>
					<td>{{ $item->input_by }} / {{ date('d F Y',strtotime($item->input_date)) }}</td>
					<td>
						<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm w-100" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('itemcategory.edit', $item->item_cat_id) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<form role="form" method="POST" action="{{ route('itemcategory.delete') }}">
									{{ csrf_field() }}
									<input type="hidden" name="item_cat_id" value="{{ $item->item_cat_id }}">
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