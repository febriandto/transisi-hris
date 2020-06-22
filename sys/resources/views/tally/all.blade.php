@extends("dashboard")

@section('title')
Work With Tally Documents | View Data
@stop

@section('breadcrumb')
Tally Documents
@stop

@section('content')
<div class="card">
	<div class="card-header">
		
		<a href="{{ route('tally.add') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-2"></i> Add New</a>
		<a href="#" class="btn btn-outline-info btn-sm"> <i class="fa fa-print mr-2"></i> Print</a>
		<a href="#" class="btn btn-outline-success btn-sm	"> <i class="fa fa-file-excel mr-2"></i> Export to Excel</a>
		
		<hr>

		<form role="form" method="GET" action="{{ route('tally.filter_date') }}">
			<div class="row">


					<div class="col-md-2">
						<label class="m-0">Date Start</label>
						<input type="date" name="date_1" class="form-control form-control-sm" value="{{ @$_GET['date_1'] }}">
					</div>

					<div class="col-md-2">
						<label class="m-0">Date End</label>
						<input type="date" name="date_2" class="form-control form-control-sm" value="{{ @$_GET['date_2'] }}">
					</div>

					<div class="col-md-4" style="border-right: 1px solid #eee;">
						<label class="m-0 d-block">Supplier</label>
						<select class="form-control form-control-sm d-inline-block" name="cust_id" style="width: 80%;">
							<option> - Select -</option>
							@foreach( $customer as $data )
							<option @if( @$_GET['cust_id'] == $data->cust_id ) {{ 'selected' }} @endif value="{{ $data->cust_id }}"> {{ $data->cust_name }} </option>
							@endforeach
						</select>
						<button class="btn btn-success btn-sm ml-2" type="submit"> <i class="fa fa-search"></i> </button>
					</div>

				<div class="col-md-4 align-self-center">
					<div class="float-right">
						<label class="d-block">Filter Based on Status</label>
						
						<a href="{{ route('tally.index') }}" class="btn btn-sm btn-default @if( @$_GET['filter_by_status'] == "" ) {{'bg-success'}} @endif">
							All Tally
						</a>
						@foreach( $status_filter as $data )
							<a href="?filter_by_status={{ $data->tally_status }}" class="btn btn-sm btn-default @if( @$_GET['filter_by_status'] == $data->tally_status ) {{'bg-success'}} @endif ">
								 	{{ $data->tally_status }}
							</a>
						@endforeach
					</div>
				</div>

			</div>
		</form>

	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover table-striped table-sm" id="dataTables">

			<thead>
				<tr>
					<th width="5%">No</th>
					<th>Tally No</th>
					<th>Date</th>
					<th>Customer</th>
					<th>Desc</th>
					<th>Remarks</th>
					<th>Status</th>
					<th>Option</th>
				</tr>
			</thead>

			<tbody>
				@foreach( $tally as $no => $data )
				<tr>
					<td class="text-center">{{ $no+1 }}</td>
					<td>
						<a href="{{ route('tally.show', $data->tally_no) }}">
							{{ $data->tally_no }}
						</a>
					</td>
					<td>{{ date('d F y', strtotime($data->tally_date)) }}</td>
					<td>{{ $data->cust_name }}</td>
					<td>{{ $data->tally_desc }}</td>
					<td>{{ $data->tally_rmk }}</td>
					<td>
						@if( $data->tally_status == 'tally_close' )
							<span class="badge badge-sm badge-danger">{{ $data->tally_status }}</span>
						@elseif( $data->tally_status == 'entry' )
							<span class="badge badge-sm badge-info">{{ $data->tally_status }}</span>
						@elseif( $data->tally_status == 'finish_tally' )
							<span class="badge badge-sm badge-success">{{ $data->tally_status }}</span>
						@else
							<span class="badge badge-sm badge-secondary">{{ $data->tally_status }}</span>
						@endif

					</td>
					<td>
						<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm <?php if($data->tally_status == 'tally_close'){echo 'disabled';}?>" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('tally.edit', $data->tally_no) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<a href="">
									<i class="fa fa-pallet mr-2"></i>Put Away
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