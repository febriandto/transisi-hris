@extends("dashboard")

@section('title')
Work With Tally Detail | View Data
@stop

@section('breadcrumb')
<a href="{{ route('tally.index') }}"> Tally Documents </a>
<span class="text-muted mx-1"> > </span>
<span>Detail</span>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">

			<div class="card-header">
				<button class="btn btn-sm btn-default">
					<i class="fa fa-search text-info mr-2"></i>	Preview Tally
				</button>
				<button class="btn btn-sm btn-default">
					<i class="fa fa-print text-warning mr-2"></i>	Print Tally
				</button>
				<button class="btn btn-sm btn-default">
					<i class="fa fa-search text-success mr-2"></i> Export To Excel
				</button>
				<a href="{{ route('tally.index') }}" class="btn btn-sm btn-default float-right">
				 <i class="fa fa-times mr-2 text-danger"></i> Close
				</a>
			</div>

			<div class="card-body">
				<div class="row">

					<div class="col-md-6">
						{{-- Table Left --}}
						<table class="table table-bordered table-sm" style="width: 90%;">
							<tr>
								<td style="width: 25%;">Tally Number</td>
								<th>{{ $tally->tally_no }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Tally Date</td>
								<th>{{ date('d F Y', strtotime($data->tally_date)) }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Customer</td>
								<th>{{ $data->cust_name }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Tally Status</td>
								<th>{{ $data->tally_status }}</th>
							</tr>
						</table>
					</div>

					<div class="col-md-6">
						{{-- Table Right --}}
						<table class="table table-bordered table-sm" style="width: 100%;margin-left: auto;">
							<tr>
								<td style="width: 25%;">Tally Description</td>
								<th>{{ $data->tally_desc }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Tally Remarks	</td>
								<th>{{ $data->tally_rmk }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Last Update By</td>
								<th>{{ $data->edit_by }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Last Update Time</td>
								<th>{{ date('d F Y', strtotime($data->tally_date)) }}</th>
							</tr>
						</table>

					</div>
				</div>

				{{-- Item list of Tally Number --}}
				<div class="row my-5">
					<div class="col-md-12 mb-2">
						<h5 class="d-inline-block">Item list of tally number : <b>{{ $tally->tally_no }}</b></h5>
						<div class="float-right">
							<form class="d-inline-block" role="form" method="POST" action="{{ route('tally.finish_tally', $tally->tally_no) }}">
								{{ csrf_field() }}
								<input type="hidden" name="tally_no" value="{{ $tally->tally_no }}">
								<button
									style="display:  <?php if( $tally->tally_status !='entry'){echo 'none';}?>" type="submit"
									class="btn btn-primary flat btn-sm" onclick="return confirm('Sure finish Tally Sheet?')" >
									<i class="fa fa-check icon_left"></i> Finish Tally Sheet
								</button>
							</form>

						<a 
						style="display:  <?php if( $tally->tally_status !='entry'){echo 'none';}?>"
						class="btn btn-success flat btn-sm" 
						href="{{ route('tally.add_item', $tally->tally_no) }}">
						<i class="fa fa-plus icon_left"></i> Add New Item
					</a>
				</div>
					</div>
					<div class="col-md-12">
						<table class="table table-sm table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th width="6%">No</th>
									<th>Item Number</th>
									<th>Item Name</th>
									<th>Unit</th>
									<th>Qty</th>
									<th>Open Qty</th>
									<th>SPQ Item</th>
									<th>Detail Qty</th>
									<th>Status</th>
									<th></th>
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
									<td></td>
									<td></td>
								</tr>
								@endif

								@foreach($tally_items as $no => $items)
								<tr>
									<td class="text-center">{{ $no+1 }}</td>
									<td>{{ $items->item_number }}</td>
									<td>{{ $items->item_name }}</td>
									<td>{{ $items->uom_code }}</td>
									<td>{{ $items->tally_qty }}</td>
									<td>{{ $items->open_qty }}</td>
									<td>{{ $items->spq_item }}</td>
									<td>{{ $items->a }}</td>
									<td>{{ $items->tally_detail_status }}</td>
									<td>
										<button type="button" style="font-size: small;width: 100%;" class="btn btn-default dropdown-toggle btn-sm <?php if($tally->tally_status == 'tally_close' OR $tally->tally_status == 'finish_tally'){echo 'disabled';}?>" data-toggle="dropdown" aria-expanded="false">Option</button>
										<ul class="dropdown-menu">
											<li>
												<a href="{{ route('tally.edit_item', ['tally' => $tally->tally_no, 'item' => $items->tally_detail_id] ) }}"><i class="fa fa-edit mr-2 text-info"></i> Edit</a>
											</li>
											<li>
												<form role="form" method="POST" action="{{ route('tally.delete_item', $items->tally_detail_id) }}">
													{{ csrf_field() }}
													<input type="hidden" name="tally_detail_id" value="{{ $items->tally_detail_id }}">
													<button type="submit" class="btn btn-sm" onclick="return confirm('Delete this item??')">
														<i class="fa fa-times mr-2 text-danger"></i> Delete
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

				<div class="row mt-4" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 10px 0px;">
					<div class="col-md-6 align-self-center">
						<span>List Putaway Number untuk Tally sheet {{ $tally->tally_no }}</span>
					</div>
					<div class="col-md-6">
					<span style="float: right;">
						<a
							class="btn btn-primary btn-sm <?php if($tally->tally_status == 'entry'){echo 'disabled';}?>" href="{{ route('putaway.add', $tally->tally_no) }}">
							<i class="fa fa-plus"></i> &nbsp; Put Away
						</a>
					</span>
				</div>
			</div>

				<div class="row mt-4">

					@if( $putaway == NULL )

					<div class="col-md-12">
						<p class="text-center"><b>No Items</b></p>
					</div>

					@endif

					@foreach( $putaway as $p )

						<div class="col-md-3">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="far fa-file"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">
										PUTAWAY NUMBER
										<a href="{{ route('putaway.detail', ['putaway' => $p->putaway_no, 'tally' => $tally->tally_no]) }}">
											<span class="info-box-number">{{ $p->putaway_no }}</span>
										</a>
										<h6 class="mt-2 small text-transform-uppercase" style="text-transform: uppercase;">{{ $p->putaway_status }}</h6>
									</span>
								</div>
							</div>
						</div>

					@endforeach


				</div>

			</div>
		</div>
	</div>
</div>
@stop