@extends("dashboard")

@section('title')
Work With Put Away | View Data
@stop

@section('breadcrumb')
Put Away
@stop

@section('content')
<div class="card">
	<div class="card-header">
		<a href="#" class="btn btn-outline-success btn-sm	"> <i class="fa fa-file-excel mr-2"></i> Export to Excel</a>
		<hr>

		<form role="form" method="GET" action="{{ route('putaway.filter_date') }}" style="display: inline-block;">
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
						<option @if( $data->cust_id == @$_GET['cust_id'] ) {{'selected'}} @endif value="{{ $data->cust_id }}"> {{ $data->cust_name }} </option>
						@endforeach
					</select>
					<button class="btn btn-success btn-sm ml-2" type="submit"> <i class="fa fa-search"></i> </button>
				</div>

				<div class="col-md-4 align-self-center">
					<div class="float-right">
						<label class="d-block">Filter Based on Status</label>

						<a href="{{ route('putaway.index') }}" class="btn btn-sm btn-default @if( @$_GET['filter_by_status'] == "" ) {{'bg-success'}} @endif">
							All Putaway
						</a>
						@foreach( $status_filter as $data )
						<a href="?filter_by_status={{ $data->putaway_status }}" class="btn btn-sm btn-default @if( @$_GET['filter_by_status'] == $data->putaway_status ) {{'bg-success'}} @endif ">
							{{ $data->putaway_status }}
						</a>
						@endforeach
					</div>
				</div>

			</div>
		</form>

	</div>
	<div class="card-body">
		<table class="table table-bordered table-hover table-striped table-sm" id="dataTables" id="dataTables">

			<thead>
				<tr>
					<th width="6%">No</th>
					<th>Putaway Number</th>
					<th>Date</th>
          <th>Customer</th>
          <th>Remarks</th>
          <th>Status</th>
          <th>Action Date</th>
          <th width="10%">Option</th>
        </tr>
			</thead>

			<tbody>
				@foreach( $putaway as $no => $data )
				<tr>
					<td class="text-center">{{ $no+1 }}</td>
					<td>
						<a href="{{ route('putaway.detail', ['putaway' => $data->putaway_no, 'tally' => $data->tally_no]) }}">
							{{ $data->putaway_no }}
						</a>
					</td>
					<td>{{ date('d F Y', strtotime($data->putaway_date)) }}</td>
					<td>{{ $data->cust_name }}</td>
					<td>{{ $data->putaway_rmk }}</td>
					<td>
						@if( $data->putaway_status == 'putaway' )
							<span class="badge badge-sm badge-secondary">{{ $data->putaway_status }}</span>
						@endif
						@if( $data->putaway_status == 'entry_putaway' )
							<span class="badge badge-sm badge-info">{{ $data->putaway_status }}</span>
						@endif
						@if( $data->putaway_status == 'putaway_finish' )
							<span class="badge badge-sm badge-success">{{ $data->putaway_status }}</span>
						@endif

					</td>
					<td>{{ date('d F Y', strtotime($data->status_date)) }}</td>
					<td>
						<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="#">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<a href="">
									<i class="fa fa-pallet mr-2"></i>Put Away
								</a>
							</li>
							<li>
								<a href="">
									<i class="fa fa-times mr-2"></i>Hold
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