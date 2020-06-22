@extends("dashboard")

@section('title')
Work With Putaway Detail | View Data
@stop

@section('breadcrumb')
<a href="{{ route('putaway.index') }}"> Put Away </a>
<span class="text-muted mx-1"> > </span>
<span>Detail</span>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">

			<div class="card-header">
				<button class="btn btn-sm btn-default">
					<i class="fa fa-search text-info mr-2"></i>	Preview Putaway
				</button>
				<button class="btn btn-sm btn-default">
					<i class="fa fa-print text-warning mr-2"></i>	Print
				</button>
				<a href="{{ route('putaway.index') }}" class="btn btn-sm btn-default float-right">
				 <i class="fa fa-times mr-2 text-danger"></i> Close
				</a>
			</div>

			<div class="card-body">
				<div class="row">

					<div class="col-md-6">
						{{-- Table Left --}}
						<table class="table table-bordered table-sm" style="width: 100%;">
							<tr>
								<td style="width: 25%;">Putaway Number</td>
								<th>{{ $putaway_detail->putaway_no }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Putaway Date</td>
								<th>{{ date('d F Y', strtotime($putaway_detail->putaway_date)) }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Customer</td>
								<th>{{ $putaway_detail->cust_name }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Tally Number</td>
								<th>{{ $putaway_detail->tally_no }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Putaway Remarks</td>
								<th>{{ $putaway_detail->putaway_rmk }}</th>
							</tr>
						</table>
					</div>

					<div class="col-md-6">
						{{-- Table Right --}}
						<table class="table table-bordered table-sm" style="width: 100%;margin-left: auto;">
							<tr>
								<td style="width: 25%;">Putaway Status</td>
								<th>{{ $putaway_detail->putaway_status }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Action Date	</td>
								<th>{{ $putaway_detail->putaway_date }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Last Update By</td>
								<th>{{ $putaway_detail->edit_by }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Last Update Time</td>
								<th>{{ date('d F Y', strtotime($putaway_detail->putaway_date)) }}</th>
							</tr>
						</table>

					</div>
				</div>

				{{-- Item list of Tally Number --}}
				<div class="row mt-5">
					<div class="col-md-12 mb-2">
						<h5 class="d-inline-block">Item list of Putaway Number : <b>{{ $putaway_detail->putaway_no }}</b></h5>
						<div class="float-right">
							@if( $putaway_detail->putaway_status != 'putaway_finish' )
							<form role="form" method="POST" action="{{ route('putaway.finish_putaway') }}">
								{{ csrf_field() }}
								<input type="hidden" name="tally_no" value="{{ $putaway_detail->tally_no }}">
								<button class="btn btn-sm btn-primary" type="submit" onclick="return confirm('Finish Putaway??')">
									<i class="fa fa-check mr-2"></i> Finish PutAway
								</button>
							</form>
							@endif
						</div>
					</div>

					<div class="col-md-12">
						<table class="table table-sm table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th width="6%">No</th>
									<th>Item Number</th>
									<th>Item Name</th>
									<th>Tally No</th>
									<th>Unit</th>
									<th>Qty</th>
									<th>SPQ Item</th>
									<th>Total</th>
									<th>Location</th>
								</tr>
							</thead>


							<tbody>

								@if( $putaway_items == NULL )
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								@endif

								@foreach( $putaway_items as $no => $data )
								<tr>
									<td class="text-center">{{ $no+1 }}</td>
									<td>{{ $data->item_number }}</td>
									<td>{{ $data->item_name }}</td>
									<td>{{ $data->tally_no }}</td>
									<td>{{ $data->uom_code }}</td>
									<td>{{ $data->putaway_qty }}</td>
									<td>{{ $data->spq_item }}</td>
									<td>{{ $data->a }}</td>
									<td>{{ $data->location_code }}</td>
								</tr>
								@endforeach
							</tbody>

						</table>
					</div>

					<div class="col-md-12 mt-5">
						<h5>Tally Items</h5>
						<table class="table table-sm table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Item Number</th>
									<th>Item Name</th>
									<th>Item Desc</th>
									<th>Unit</th>
									<th>Tally Qty</th>
									<th>Open Qty</th>
									<th width="11%">Option</th>
								</tr>
							</thead>
							<tbody>
								
								@if( $tally_items == NULL )
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								@endif

								@foreach($tally_items as $no => $data)
								<tr>
									<td class="text-center">{{ $no+1 }}</td>
									<td>{{ $data->item_number }}</td>
									<td>{{ $data->item_name }}</td>
									<td>{{ $data->item_description }}</td>
									<td>{{ $data->uom_code }}</td>
									<td>{{ $data->tally_qty }}</td>
									<td>{{ $data->open_qty }}</td>
									<td>
										<a href="{{ route('putaway.add_item', ['tally_detail' => $data->tally_detail_id, 'tally' => $data->tally_no, 'putaway' => $putaway_detail->putaway_no]) }}" class="btn btn-sm btn-default">
											<i class="fa fa-pallet"></i> Put Away
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>
@stop