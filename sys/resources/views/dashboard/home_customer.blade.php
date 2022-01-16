@extends('dashboard')

@section('title')
	Dashboard
@stop

@section('breadcrumb')
	<span class="small"> Dashboard </span>
@stop

@section('content')

<style>
	.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link{
	}
	.nav-tabs .nav-item a.nav-link{
		color: #9a9a9a;
	}
	.nav-tabs .nav-item a.active{
		color: blue;
	}
</style>

<div class="mx-3">
  <div class="row">
    <div class="col-12">
      <div class="card" style="background: none;border: none;box-shadow:none;">
        <div class="card-header" style="padding-left: 10px;">
          <ul class="nav nav-tabs card-header-tabs" id="wms-list" role="tablist">
            
            <li class="nav-item">
              <a class="nav-link border-left border-right border-top active" href="#one" role="tab" aria-controls="one" aria-selected="true"> <i class="fas fa-box mr-1"></i> On Demand Stock</a>
            </li>

            <li class="nav-item">
              <a class="nav-link border-left border-right border-top"  href="#two" role="tab" aria-controls="two" aria-selected="false" id="tab-incoming-process"> <i class="fas fa-people-carry mr-1"></i> Incoming Process</a>
            </li>

            <li class="nav-item">
              <a class="nav-link border-left border-right border-top" href="#three" role="tab" aria-controls="three" aria-selected="false" id="tab-outcoming"><i class="fas fa-box-open mr-1"></i> Outcoming</a>
            </li>

            <li class="nav-item">
              <a class="nav-link border-left border-right border-top" href="#four" role="tab" aria-controls="four" aria-selected="false"><i class="fas fa-shipping-fast mr-1"></i> Delivered</a>
            </li>
          </ul>
        </div>
        <div class="card-body bg-white border-left border-right border-bottom">

           <div class="tab-content mt-3">
            <div class="tab-pane active" id="one" role="tabpanel">
            	{{-- <div class="row">
	        		<div class="col-md-3">
	        			<input type="text" class="form-control" placeholder="Filter . . .">
	        		</div>
	        		<div class="offset-md-6 col-md-3 text-right">
		        		<button class="btn btn-primary"> <i class="fas fa-plus mr-2"></i> New Tally</button>
	        		</div>
	        	</div> --}}

	        	{{-- On Demand Stock --}}
	        	<div class="row mt-4">

							<div style="position: absolute; top: 0; right: 0;">
								<a href="{{ route('beranda.print_on_demand_stock') }}" class="btn btn-primary" target="_blank"> <i class="fa fa-print mr-2"></i> Print </a>

								<a href="{{ route('beranda.on_demand_stock') }}" class="btn btn-success"> <i class="fa fa-file-excel mr-2"></i> Export to excel </a>
							</div>

							<!-- <div class="col-md-12">
								<div class="row">
									<form action="" method="GET" class="d-flex w-100">
										<div class="offset-md-7"></div>

										<div class="col-md-2 col-sm-12">
								        <small class="mr-2">From</small>
								        <input type="date" value="{{ $from }}" name="from" class="form-control form-control-sm" />
								    </div>
								    
								    <div class="col-md-2 col-sm-12 mb-3">
								        <small class="mr-2">To</small>
								        <input type="date" value="{{ $to }}" name="to" class="form-control form-control-sm" />
								    </div>

								    <div class="col-md-1 align-self-center">
								    	<button class="btn btn-sm btn-success"> OK </button>
								    </div>

							    </form>
								</div>
							</div> -->

	        		<div class="col-12">
	        			<table class="table table-sm table-bordered table-hover table-striped" id="on_demand_stock">

	        				<thead>
	        					<tr>
                          			<th>No.</th>
                      				<th>SKU/Part No</th>
                      				<th>Part Name/Desc</th>
                      				<th>Inv. No</th>
                      				<th>Batch</th>
                      				<th>Division</th>
                      				<th>Pallet</th>
                      				<th>Pallet Note</th>
                      				<th>Location</th>
                      				<th>Plant</th>
                      				<th>Qty</th>
                      				<th>Detail Qty</th>
                      				<th>Uom</th>
                      				<th>Spq</th>
                      				<th>Tanggal Masuk</th>
                      			</tr>
	        				</thead>
	        				<tbody>
	        					<?php $total = 0; $total_detail = 0; ?>
              			@foreach($on_demand_stock as $no => $data)
              			    @if( $data->qty != 0 )
              			    <tr>
              			        <td>{{ $no+1 }}</td>
                  				<td>{{$data->item_number}}</td>
                  				<td>{{$data->item_name}}</td>
                  				<td>{{$data->inv_no}}</td>
                  				<td>{{$data->batch}}</td>
                  				<td>{{$data->division}}</td>
                  				<td>{{ @$data->pallet_id}}</td>
                  				<td>{{ @$data->pallet_note}}</td>
                  				<td>{{ isset($data->pallet->location->location_code) ? $data->pallet->location->location_code : '-' }}</td>
                  				<td>{{ @$data->plant->plant_name}}</td>
                  				<td>{{ number_format($data->qty) }}</td>
                  				<td>{{ number_format($data->qty * ($data->item->spq_item == '' ? $data->qty : $data->item->spq_item)) }}</td>
                  				<td>{{ @$data->item->uom->uom_code }}</td>
                  				<td>{{ number_format(@$data->spq_item) }}</td>
                  				<td>{!! '<i class="hidden_val d-none">'.$data->tgl_masuk.'</i>'.date('d/m/Y', strtotime($data->tgl_masuk)) !!}</td>
                  			</tr>
              			    @endif
              			<?php $total += $data->qty; $total_detail += $data->qty_detail; ?>
              			@endforeach
	        				</tbody>
	        				<tfoot>
	        					<tr>
                          			<th></th>
                      				<th></th>
                      				<th></th>
                      				<th></th>
                      				<th></th>
                      				<th></th>
                      				<th></th>
                      				<th></th>
                      				<th></th>
                      				<th>{{ number_format($total) }}</th>
                      				<th>{{ number_format($total_detail) }}</th>
                      				<th></th>
                      				<th></th>
                      				<th></th>
                      			</tr>
	        				</tfoot>
	        			</table>
	        		</div>
	        	</div>
            </div>

            <div class="tab-pane {{ @$_GET['tab'] == 'incoming_process' ? 'active' : '' }}" id="two" role="tabpanel" aria-labelledby="two-tab">  

						<div style="position: absolute; top: 0; right: 0;">
							<!--<a target="_blank" href="{{ route('beranda.print_incoming_process') }}" class="btn btn-primary"> <i class="fa fa-print mr-2"></i> Print </a>-->

							<a href="{{ route('beranda.incoming_process') }}{{ isset($_GET['tab']) ? '?from='.$_GET['from'].'&to='.$_GET['to'] : '' }}" class="btn btn-success"> <i class="fa fa-file-excel mr-2"></i> Export to excel </a>

						</div>

								<div class="row">
									<form action="" method="GET" class="d-flex w-100">
										<input type="hidden" name="tab" value="incoming_process">
										<div class="offset-md-7"></div>

										<div class="col-md-2 col-sm-12">
								        <small class="mr-2">From</small>
								        <input type="date" value="{{ $from }}" name="from" class="form-control form-control-sm" />
								    </div>
								    
								    <div class="col-md-2 col-sm-12 mb-3">
								        <small class="mr-2">To</small>
								        <input type="date" value="{{ $to }}" name="to" class="form-control form-control-sm" />
								    </div>

								    <div class="col-md-1 align-self-center">
								    	<button class="btn btn-sm btn-success"> OK </button>
								    </div>

							    </form>
								</div>

            	<!-- Incoming Process -->
            	<table class="table table-sm table-bordered table-hover table-striped" id="incoming_process">
            		<thead>
            			<tr>
										<th width="6%">No</th>
										<th>No.Truck</th>
										<th>No.Container</th>
										<th>Forwarder</th>
										<th>SKU/Part No</th>
										<th>Part Name</th>
										<th>Inv.No</th>
										<th>Lot/Batch</th>
										<th>Division</th>
										<th>Qty</th>
										<th>UOM</th>
										<th>Total</th>
										<th>Location</th>
										<th>Pallet</th>
										<th>Date</th>
									</tr>
            		</thead>

            		<tbody>
            			@php $i = 1; $total_incoming_process = 0; $total_detail_incoming = 0; @endphp
									@foreach($incoming_process as $in)
									    <tr>
									        <td>{{ $i }}</td>
									        <td>{{ $in->no_mobil }}</td>
									        <td>{{ $in->no_container }}</td>
									        <td>-</td>
									        <td>{{ $in->item_number }}</td>
									        <td>{{ $in->item_name }}</td>
									        <td>{{ $in->inv_no }}</td>
									        <td>{{ $in->batch }}</td>
									        <td>{{ $in->division }}</td>
									        <td>{{ $in->qty }}</td>
									        <td>{{ $in->uom_code }}</td>
									        <td>{{ number_format($in->detail) }}</td>
									        <td>{{ $in->location_code }}</td>
									        <td>{{ $in->pallet_id }}</td>
									        <td>{!! '<i class="hidden_val d-none">'.$in->tgl_masuk.'</i>'.date('d/m/Y', strtotime($in->tgl_masuk)) !!}</td>
									    </tr>
									    @php $i++; $total_incoming_process += $in->qty; $total_detail_incoming += $in->detail; @endphp
									@endforeach
            		</tbody>
            		<tfoot>
									<tr>
										<th width="6%"></th>
										<th colspan="7"></th>
										<th>Total</th>
										<th>{{ number_format($total_incoming_process) }}</th>
										<th></th>
										<th>{{ number_format($total_detail_incoming) }}</th>
										<th></th>
										<th></th>
										<th></th>
									</tr>
								</tfoot>
            	</table>

            </div>

            <div class="tab-pane" id="three" role="tabpanel" aria-labelledby="three-tab">

							<div style="position: absolute; top: 0; right: 0;">
								<!--<a target="_blank" href="{{ route('beranda.print_outcoming') }}" class="btn btn-primary"> <i class="fa fa-print mr-2"></i> Print </a>-->

								<a href="{{ route('beranda.outcoming') }}{{ isset($_GET['tab']) ? '?from='.$_GET['from'].'&to='.$_GET['to'] : '' }}" class="btn btn-success"> <i class="fa fa-file-excel mr-2"></i> Export to excel </a>
							</div>

							<div class="row">
									<form action="" method="GET" class="d-flex w-100">
										<input type="hidden" name="tab" value="outcoming">
										<div class="offset-md-7"></div>

										<div class="col-md-2 col-sm-12">
								        <small class="mr-2">From</small>
								        <input type="date" value="{{ $from }}" name="from" class="form-control form-control-sm" />
								    </div>
								    
								    <div class="col-md-2 col-sm-12 mb-3">
								        <small class="mr-2">To</small>
								        <input type="date" value="{{ $to }}" name="to" class="form-control form-control-sm" />
								    </div>

								    <div class="col-md-1 align-self-center">
								    	<button class="btn btn-sm btn-success"> OK </button>
								    </div>

							    </form>
								</div>

            	{{-- Outcoming Process --}}
            	<table class="table table-sm table-bordered table-hover table-striped" id="outcoming">
            		<thead>
            			<tr>
										<th width="6%">No</th>
										<th>SKU/Part No</th>
										<th>Part Name</th>
										<th>Inv.No</th>
										<th>Lot/Batch</th>
										<th>Division</th>
										<th>Qty</th>
										<th>UOM</th>
										<th>SPQ</th>
										<th>Total</th>
										<th>Location</th>
										<th>Pallet</th>
										<th>Date In</th>
										<th>DO No.</th>
										<th>Driver</th>
										<th>Ship To</th>
										<th>Date Out</th>
									</tr>
            		</thead>

            		<tbody>
            			@php $i = 1; $total = 0; $total_detail = 0; @endphp
										@foreach($outcoming as $out)
										    <tr>
                            			        <td>{{ $i }}</td>
                            			        <td>{{ $out->item_number }}</td>
                            			        <td>{{ $out->item_name }}</td>
                            			        <td>{{ $out->inv_no }}</td>
                            			        <td>{{ $out->batch }}</td>
                            			        <td>{{ $out->division }}</td>
                            			        <td>{{ number_format($out->qty) }}</td>
                            			        <td>{{ $out->uom_code }}</td>
                            			        <td>{{ number_format($out->spq_item) }}</td>
                            			        <td>{{ number_format($out->detail) }}</td>
                            			        <td>{{ $out->location_code }}</td>
                            			        <td>{{ $out->pallet_id }}</td>
                            			        <td>{!! '<i class="hidden_val d-none">'.$out->tgl_masuk.'</i>'.date('d/m/Y', strtotime($out->tgl_masuk)) !!}</td>
                            			        
                            			        <td>{{ $out->do_number }}</td>
                            			        <td>{{ $out->dn_driver_name }}</td>
                            			        <td>{{ $out->add_name }}</td>
                            			        <!--<td>{!! $out->add_name.' &nbsp; <i class="fa fa-chevron-right" title="Click to view address" onclick="$(this).parent().find(\'.add\').toggle()"></i> <i class="add" style="display: none;">'.$out->add_desc.'</i>' !!}</td>-->
                            			        <td>{!! '<i class="hidden_val d-none">'.$out->input_date.'</i>'.date('d/m/Y', strtotime($out->input_date)) !!}</td>
                            			    </tr>
										    @php $i++; $total += $out->qty; $total_detail += $out->detail; @endphp
										    
										@endforeach
            		</tbody>
            		<tfoot>
									<tr>
										<th colspan="6">Total</th>
										<th>{{ number_format($total) }}</th>
										<th></th>
										<th>{{ number_format($total_detail) }}</th>
										<th colspan="8"></th>
									</tr>
								</tfoot>
            	</table>

            </div>


            <div class="tab-pane" id="four" role="tabpanel" aria-labelledby="four-tab">

							<div style="position: absolute; top: 0; right: 0;">
								<!-- <a target="_blank" href="{{ route('beranda.print_delivered') }}" class="btn btn-primary"> <i class="fa fa-print mr-2"></i> Print </a> -->

								<a href="{{ route('beranda.delivered') }}" class="btn btn-success"> <i class="fa fa-file-excel mr-2"></i> Export to excel </a>
							</div>

							<!-- modal delivery note detail -->
							<div class="modal fade" id="modalDetail" data-backdrop="static" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" style="margin: 5%;min-width: 90% !important;">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Delivery Note Detail</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											
										</div>
									</div>
								</div>
							</div>

							<!-- Deliered Process -->
            	<table class="table table-sm table-bordered table-hover table-striped" id="delivered">
            		<thead>
            			<tr>
            				<th>No.</th>
            				<th>DN Number</th>
            				<th>DO Number</th>
            				<th>Driver Name</th>
            				<th>Vehicle</th>
            				<th>Date</th>
            				<th>Remarks</th>
            			</tr>
            		</thead>

            		<tbody>
            			@foreach( $delivered as $no => $data )
            			<tr>
            				<td>{{ $no+1 }}</td>
            				<td><a href="#" onclick="event.preventDefault(); showDnDetail('{{ $data->dn_number }}')">{{ $data->dn_number }}</a></td>
            				<td>{{ $data->do_number }}</td>
            				<td>{{ $data->dn_driver_name }}</td>
            				<td>{{ @$data->vehicle->plat_no }}</td>
            				<td>{{ date('d/M/Y', strtotime($data->dn_date)) }}</td>
            				<td>{{ $data->dn_rmk }}</td>
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
</div>
@stop

@section('script')
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script>

	$(document).ready(function() {

		var incoming_process = <?php echo @$_GET['tab'] == 'incoming_process' ? 1 : 0 ?> ;
		var outcoming = <?php echo @$_GET['tab'] == 'outcoming' ? 1 : 0 ?> ;

		if( incoming_process ){
			$("#tab-incoming-process ").tab('show')
		}
		if( outcoming ){
			$("#tab-outcoming ").tab('show')
		}

		$('#wms-list a').on('click', function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		});
	    
			var x = $('#on_demand_stock').DataTable( {
			    "columnDefs": [ {
                    "searchable": false,
                    "orderable": true,
                    "targets": 0
                } ],
                "order": [[ 0, 'asc' ]]
			} );
			
			x.on( 'order.dt search.dt', function () {
                x.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
			

			var t = $('#incoming_process').DataTable( {
			    "columnDefs": [ {
                    "searchable": false,
                    "orderable": true,
                    "targets": 0
                } ],
                "order": [[ 0, 'asc' ]]
			} );
			
			t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
            
            var z = $('#outcoming').DataTable( {
			    "columnDefs": [ {
                    "searchable": false,
                    "orderable": true,
                    "targets": 0
                } ],
                "order": [[ 0, 'asc' ]]
			} );
			
			z.on( 'order.dt search.dt', function () {
                z.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

			$('#delivered').DataTable( {
			} );
	} );

	$('body').addClass('sidebar-collapse');

	function showDnDetail(id){
            
		$('#modalDetail').modal('show');
		$('#modalDetail .modal-body').html("Loading...");
		$.ajax({
					headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url : '{{ route('delivery_note.detail') }}',
					cache : false,
					type : 'POST',
					data : {
							dn_number : id
					},
					success : function(data){
							
						$('#modalDetail .modal-body').html(data);
						$('#modalDetail .modal-body table').DataTable();
							
					}
		});
		
	}
</script>
@stop
