@extends("dashboard")

@section('title')
Work With Loading Documents | View Data
@stop

@section('breadcrumb')
Loading Documents
@stop

@section('content')
<div class="card">
	
	<div class="card-body">
		<table class="table table-bordered table-hover table-striped table-sm" id="dataTables">

			<thead>
				<tr>
					<th width="6%">No</th>
					<th>Loading Number</th>
					<th>Date</th>
					<th>Picking No</th>
					<th>Customer</th>
					<th>Remarks</th>
					<th>Status Update</th>
					<th width="9%">Option</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $loading as $no => $data )
				<tr>
					<td class="text-center">{{ $no+1 }}</td>
					<td>
						<a href="{{ route('loading.detail', $data->loading_no) }}">
							{{ $data->loading_no }}
						</a>
					</td>
					<td>{{ date('d F y', strtotime($data->loading_date)) }}</td>
					<td>{{ $data->picking_no }}</td>
					<td>{{ $data->cust_name }}</td>
					<td>{{ $data->loading_rmk }}</td>
					<td>
						{{ $data->loading_status }} 
						<br> {{ date('d F Y', strtotime($data->status_date)) }}
					</td>
					<td>
						<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('loading.edit', $data->loading_no) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-stop mr-2"></i>Hold
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