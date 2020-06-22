@extends("dashboard")

@section('title')
Work With Picking Detail | View Data
@stop

@section('breadcrumb')
<a href="{{ route('picking.index') }}"> Picking Documents </a>
<span class="text-muted mx-1"> > </span>
<span>Detail</span>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">

			<div class="card-header">
				<button class="btn btn-sm btn-default">
					<i class="fa fa-search text-info mr-2"></i>	Preview Picking
				</button>
				<button class="btn btn-sm btn-default">
					<i class="fa fa-print text-warning mr-2"></i>	Print Picking
				</button>
				<button class="btn btn-sm btn-default">
					<i class="fa fa-search text-success mr-2"></i> Export To Excel
				</button>
				<button class="btn btn-sm btn-default">
					<i class="fa fa-truck text-danger mr-2"></i> Delivery Note
				</button>
				<a href="{{ route('picking.index') }}" class="btn btn-sm btn-default float-right">
				 <i class="fa fa-times mr-2 text-danger"></i> Close
				</a>
			</div>

			<div class="card-body">
				<div class="row">

					<div class="col-md-6">
						{{-- Table Left --}}
						<table class="table table-bordered table-sm" style="width: 100%;">
							<tr>
								<td style="width: 25%;">Picking Number</td>
								<th>{{ $picking->picking_no }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Picking  Date</td>
								<th>{{ date('d F Y', strtotime($picking->picking_date)) }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Customer</td>
								<th>{{ $picking->cust_name }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Picking Status</td>
								<th>{{ $picking->picking_status }}</th>
							</tr>
						</table>
					</div>

					<div class="col-md-6">
						{{-- Table Right --}}
						<table class="table table-bordered table-sm" style="width: 100%;margin-left: auto;">
							<tr>
								<td style="width: 25%;">Description</td>
								<th>{{ $picking->picking_desc }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Picking Remarks</td>
								<th>{{ $picking->picking_rmk }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Last Update By</td>
								<th>{{ $picking->edit_by }}</th>
							</tr>
							<tr>
								<td style="width: 25%;">Last Update Time</td>
								<th>{{ date('d F Y', strtotime($picking->picking_date)) }}</th>
							</tr>
						</table>

					</div>
				</div>

				{{-- Item list of picking Number --}}
				<div class="row my-5">
					<div class="col-md-12 mb-2">

						<h5 class="d-inline-block">Item list of Picking Number : <b>{{ $picking->picking_no }}</b></h5>

						<div class="float-right">
							<form role="form" method="POST" action="{{ route('picking.finish_picking') }}">
								{{ csrf_field() }}
								<input type="hidden" name="picking_no" value="{{ $picking->picking_no }}">
								<button onclick="return confirm('Sure finish Picking sheet?')"
									style="display: @if( $picking->picking_status != 'entry_picking' ) {{ 'none' }} @endif"
									class="btn btn-primary flat btn-sm" type>
									<i class="fa fa-check icon_left"></i> Finish Picking Sheet
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
									<th>Unit</th>
									<th>Qty</th>
									<th>SPQ Item</th>
									<th>Detail Qty</th>
									<th>Update</th>
									<th width="5%">Option</th>
								</tr>
							</thead>
							<tbody>

								@if( $picking_items == NULL )
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

								@foreach($picking_items as $no => $items)
								<tr>
									<td class="text-center">{{ $no+1 }}</td>
									<td>{{ $items->item_number }}</td>
									<td>{{ $items->item_name }}</td>
									<td>{{ $items->uom_code }}</td>
									<td>{{ $items->picking_qty }}</td>
									<td>{{ $items->spq_item }}</td>
									<td>{{ $items->a }}</td>
									<td>{{ date('d F Y',strtotime($items->picking_detail_status_date)) }} </td>
									<td>
										<button type="button" style="font-size: small;width: 100%;" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Option</button>
										<ul class="dropdown-menu">
											<li>
												<a href="{{ route('picking.edit_item', $items->picking_detail_id) }}"><i class="fa fa-edit mr-2 text-info"></i> Edit</a>
											</li>
											<li>
												<form role="form" method="POST" action="{{ route('picking.delete_item') }}">
													{{ csrf_field() }}
													<input type="hidden" name="picking_detail_id" value="{{ $items->picking_detail_id }}">
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

				<div style="display: <?php if($picking->picking_status == 'finish_picking'){echo 'none';}?>">
					<hr>
					<br>

					<h5>Daftar Stock</h5>
					<table class="table table-sm table-bordered table-hover">
						
						<thead>
							<tr>
								<th>No</th>
								<th>ID</th>
								<th>Tgl Masuk</th>
								<th>Item </th>
								<th>SPQ</th>
								<th>Qty Stock</th>
								<th>Open QTy</th>
								<th width="8%">Qty Pick</th>
								<th>Loc / Pallet</th>
								<th>Tool</th>
							</tr>
						</thead>

						<tbody>
							@foreach( $list_stock as $no => $stock )
							<form action="{{ route('picking.save_item') }}" method="POST">
								<tr>  
									{{ csrf_field() }}
									<input type="hidden" name="picking_no" value="{{ $picking->picking_no }}">

									<td><?php echo $no+1;?></td>
									<td>
										<input readonly="" type="text" style="width: 40px; border: none;"
										value="<?php echo $stock->inbound_pallet_id ?>" name="inbound_pallet_id">
									</td>
									<td><?php echo date('d M Y', strtotime($stock->masuk)) ?></td>
									<td>
										<input readonly="" type="text" style="width: 100px; border: none;"
										value="<?php echo $stock->item_number ?>" name="item_number"><br>
										<?php echo $stock->item_name ?>
									</td>

									<td>
										<input readonly="" type="text" style="width: 40px; border: none;"
										value="<?php echo $stock->spq_item ?>" name="spq_item">
									</td>
									<td><?php echo number_format($stock->pallet_qty) ?> <?php echo $stock->uom_code ?> 
										( <?php echo number_format($stock->detail_qty);?> <?php echo $stock->second_uom ?> )</td>

										<td>
											<input readonly="" type="text" style="width: 40px; border: none;"
											value="<?php echo $stock->stock_open_picking ?>" name="stock_open_picking">
										</td>

										<td style="padding: 0px;">
											<input type="number" required="" 
											max="<?php echo $stock->stock_open_picking;?>" 
											placeholder="Detail Qty" 
											name="picking_qty" class="" style="height: 30px; vertical-align: middle; margin-top: 2px; 
											padding: 4px; width: 100px;">
										</td>
										<td><?php echo $stock->location_code ?> <br> (<?php echo $stock->pallet_name ?>)</td>
										<td style="padding: 6px;">
											<button type="submit" class="btn btn-xs btn-default flat" name="save_detail" 
											style="vertical-align: middle; width: 100%" 
											href="#"> <i class="fa fa-check text-success mr-2"></i> Pick </button>
										</td>
									</tr>
								</form>
								@endforeach
							</tbody>
					</table>
				</div>

				<br>
				<div class="row mt-5" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 10px 0px;">
					<div class="col-md-6 align-self-center">
						<span>List Loading Number untuk Picking sheet Nomor : <b>{{ $picking->picking_no }}</b> </span>
					</div>
					<div class="col-md-6">
					<span style="float: right;">
						<a
							class="btn btn-primary btn-sm" href="{{ route('loading.add', $picking->picking_no) }}">
							<i class="fa fa-plus"></i> &nbsp; Loading
						</a>
					</span>
				</div>
			</div>

			<div class="row mt-4">

					@if( $loading == NULL )

					<div class="col-md-12">
						<p class="text-center"><b>No Items</b></p>
					</div>

					@endif

					@foreach( $loading as $l )

						<div class="col-md-3">
							<div class="info-box">
								<span class="info-box-icon bg-green"><i class="far fa-file"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">
										LOADING NUMBER
										<a href="#">
											<span class="info-box-number">{{ $l->loading_no }}</span>
										</a>
										<h6 class="mt-2 small text-transform-uppercase" style="text-transform: uppercase;">{{ $l->loading_status }}</h6>
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