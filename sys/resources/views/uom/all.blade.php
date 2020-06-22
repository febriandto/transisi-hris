@extends("dashboard")

@section('title')
Work With UOM (Unit of Measurement) | View Data
@stop

@section('breadcrumb')
UOM (Unit of Measurement)
@stop

@section('content')
<div class="card">
	<div class="card-header">
		<a href="{{ route('uom.add') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-2"></i> Add New</a>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover table-striped table-sm" id="dataTables" id="dataTables">
			<thead>
				<tr>
					<th>No</th>
					<th>Code</th>
					<th>Description</th>
					<th>Update</th>
					<th>Option</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $uom as $no => $data )
				<tr>
					<td class="text-center">{{ $no+1 }}</td>
					<td>{{ $data->uom_code }}</td>
					<td>{{ $data->uom_desc }}</td>
					<td>{{ $data->input_by }} / {{ date('d F Y',strtotime($data->input_date)) }}</td>
					<td>
						<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('uom.edit', $data->uom_id) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<form role="form" method="POST" action="{{ route('uom.delete') }}">
									{{ csrf_field() }}
									<input type="text" name="uom_id" value="{{ $data->uom_id }}" hidden>
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