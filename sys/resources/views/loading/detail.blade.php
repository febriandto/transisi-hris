@extends("dashboard")

@section('title')
Work With Loading Detail | View Data
@stop

@section('breadcrumb')
<a href="{{ route('loading.index') }}"> Loading Documents </a>
<span class="text-muted mx-1"> > </span>
<span>Detail</span>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">

			<div class="card-header">
				<button class="btn btn-sm btn-default">
					<i class="fa fa-search text-info mr-2"></i>	Preview Loading
				</button>
				<button class="btn btn-sm btn-default">
					<i class="fa fa-print text-warning mr-2"></i>	Print Loading
				</button>
				<button class="btn btn-sm btn-default">
					<i class="fa fa-search text-success mr-2"></i> Export To Excel
				</button>
				<a href="{{ route('loading.index') }}" class="btn btn-sm btn-default float-right">
				 <i class="fa fa-times mr-2 text-danger"></i> Close
				</a>
			</div>

			<div class="card-body">
				<div class="row">

					<div class="col-md-6">
						{{-- Table Left --}}
						<table class="table table-bordered table-sm" style="width: 100%;">
							<tr>
								<td style="width: 25%;">Loading Number</td>
								<th>{{ $data->loading_no }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Loading  Date</td>
								<th>{{ date('d F Y', strtotime($data->loading_date)) }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Customer</td>
								<th>{{ $data->cust_name }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Picking Status</td>
								<th>{{ $data->loading_status }}</th>
							</tr>
						</table>
					</div>

					<div class="col-md-6">
						{{-- Table Right --}}
						<table class="table table-bordered table-sm" style="width: 100%;margin-left: auto;">
							<tr>
								<td style="width: 25%;">Loading Remarks</td>
								<th>{{ $data->loading_rmk }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Last Update By</td>
								<th>{{ $data->edit_by }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Last Update Time</td>
								<th>{{ date('d F Y', strtotime($data->loading_date)) }}</th>
							</tr>
						</table>

					</div>
				</div>

				{{-- Item list of picking Number --}}
				<div class="row my-5">
					<div class="col-md-12 mb-2">

						<h5 class="d-inline-block">Item list of Loading Number : <b>{{ $data->loading_no }}</b></h5>

						<div class="float-right">
							<form role="form" method="POST" action="{{ route('loading.finish_loading') }}">
								{{ csrf_field() }}
								<input type="hidden" name="loading_no" value="{{ $data->loading_no }}">
								<button onclick="return confirm('Sure finish Loading...?')"
									style="display: @if( $data->loading_status != 'entry_loading' ) {{ 'none' }} @endif"
									class="btn btn-primary flat btn-sm" type>
									<i class="fa fa-check icon_left"></i> Finish Loading
								</button>
							</form>
					</div>

					</div>
					<div class="col-md-12">
						<table class="table table-sm table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th width="6%">No</th>
                  <th>Item Number</th>
                  <th>Item Name</th>
                  <th>Item Desc</th>
                  <th>Unit</th>
                  <th>Loading Qty</th>
                  <th width="5%">Option</th>
								</tr>
							</thead>
							<tbody>

								@if( $loading_items == NULL )
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								@endif

								@foreach($loading_items as $no => $items)
								<tr>
									<td class="text-center">{{ $no+1 }}</td>
									<td>{{ $items->item_number }}</td>
									<td>{{ $items->item_name }}</td>
									<td>{{ $items->item_description }}</td>
									<td>{{ $items->uom_code }}</td>
									<td>{{ $items->loading_qty }}</td>
									<td>
										<button type="button" style="font-size: small;width: 100%; <?php if($items->loading_status=='finish_loading'){echo 'none';}?>" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Option</button>
										<ul class="dropdown-menu">
											<li>
												<a href="{{ route('loading.edit_item', $items->loading_detail_id) }}"><i class="fa fa-edit mr-2 text-info"></i> Edit</a>
											</li>
											<li>
												<form role="form" method="POST" action="{{ route('loading.delete_item') }}">
													{{ csrf_field() }}
													<input type="hidden" name="loading_detail_id" value="{{ $items->loading_detail_id }}">
													<button type="submit" class="btn btn-sm" onclick="return confirm('Delete this item...??')">
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

				<br>
				<div class="row mt-5" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 10px 0px;">
						<div class="col-md-6 align-self-center">
							<span>List Picking Number untuk Loading sheet Nomor : <b>{{ $data->picking_no }}</b> </span>
						</div>
						<div class="col-md-6">
					</div>
				</div>

				<table class="table table-sm table-bordered table-striped table-hover mt-2">

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
							<th>Option</th>
						</tr>
					</thead>

					<tbody>
						@foreach( $picking_items as $no => $items )
							<tr>
								<td align="center"><?php echo $no+1; ?></td>
								<td><?php echo $items->item_number?></td>
								<td><?php echo $items->item_name?></td>
								<td><?php echo $items->uom_code?></td>               
								<td><?php echo $items->picking_qty?></td>                   
								<td><?php echo $items->picking_open_qty?></td>                   
								<td><?php echo $items->spq_item?></td>                   
								<td><?php echo $items->picking_open_detail_qty?></td>                   
								<td>
									<?php echo $items->picking_detail_status?> <br>
									<span style="font-style: italic;">
										<?php echo date('d F Y',strtotime($items->picking_detail_status_date));?>
									</span>
								</td>                                 
								<td align="center">
									<a class="btn btn-default btn-xs flat" 
									href="{{ route('loading.do_loading', ['picking_detail' => $items->picking_detail_id, 'loading' => $data->loading_no]) }}"> 
									<i class="fa fa-check"></i> &nbsp; Loading</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

			</div>
		</div>
	</div>
</div>
@stop