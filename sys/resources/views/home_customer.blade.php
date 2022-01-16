@extends('dashboard')

@section('title')
	Dashboard.
@stop

@section('breadcrumb')
	<span class="small"> Dashboard. </span>
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
              <a class="nav-link border-left border-right border-top"  href="#two" role="tab" aria-controls="two" aria-selected="false"> <i class="fas fa-people-carry mr-1"></i> Incoming Process</a>
            </li>
            <li class="nav-item">
              <a class="nav-link border-left border-right border-top" href="#three" role="tab" aria-controls="three" aria-selected="false"><i class="fas fa-box-open mr-1"></i> Outcoming</a>
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
							<div class="dt-buttons"><button class="dt-button buttons-print" tabindex="0" aria-controls="on_demand_stock" type="button"><span>Print</span></button> </div>
							<a href="{{ route('beranda.incoming_process') }}" class="btn btn-primary"> <i class="fa fa-print mr-2"></i> Print </a>
								<a href="{{ route('beranda.on_demand_stock') }}" class="btn btn-success"> <i class="fa fa-file-excel mr-2"></i> Export to excel </a>
							</div>

	        		<div class="col-12">
	        			<table class="table table-sm table-bordered table-hover table-striped" id="on_demand_stock">

	        				<thead>
	        					<tr>
		        					<th>No.</th>
		        					<th>Item Number</th>
		        					<th>Item Name</th>
		        					<th>Qty</th>
		        					<th>Qty Detail</th>
		        					<th>Receive Date</th>
		        					<th>Lot/Batch</th>
		        					<th>Inv No</th>
		        				</tr>
	        				</thead>
	        				<tbody>
	        					@foreach( $on_demand_stock as $no => $data )
	        						@if( $data->qty > 0 )
	        						<tr>
		        						<td>{{ $no+1 }}</td>
		        						<td>{{ $data->item_number }}</td>
		        						<td>{{ $data->item_name }}</td>
		        						<td>{{ $data->qty }}</td>
		        						<td>{{ $data->qty_detail }}</td>
		        						<td>{{ date("d/M/Y", strtotime($data->tgl_masuk)) }}</td>
		        						<td>{{ $data->batch }}</td>
		        						<td>{{ $data->inv_no }}</td>
		        					</tr>
	        						@endif
	        					@endforeach
	        				</tbody>
	        			</table>
	        		</div>
	        	</div>
            </div>

            <div class="tab-pane" id="two" role="tabpanel" aria-labelledby="two-tab">  

						<div style="position: absolute; top: 0; right: 0;">
							<a href="{{ route('beranda.incoming_process') }}" class="btn btn-primary"> <i class="fa fa-print mr-2"></i> Print </a>
							<a href="{{ route('beranda.incoming_process') }}" class="btn btn-success"> <i class="fa fa-file-excel mr-2"></i> Export to excel </a>
						</div>

            	<!-- Incoming Process -->
            	<table class="table table-sm table-bordered table-hover table-striped" id="dataTables">
            		<thead>
            			<tr>
            				<th>No.</th>
            				<th>Date</th>
            				<th>Inv No</th>
            				<th>Batch</th>
            				<th>Division</th>
            				<th>Remarks</th>
            			</tr>
            		</thead>

            		<tbody>
            			@foreach( $incoming_process as $no => $data )
            			<tr>
            				<td>{{ $no+1 }}</td>
            				<td>{{ date('d/M/Y', strtotime($data->tally_date)) }}</td>
            				<td>{{ $data->invoice }}</td>
            				<td>{{ $data->lot_batch }}</td>
            				<td>{{ $data->division }}</td>
            				<td>{{ $data->tally_rmk }}</td>
            			</tr>
            			@endforeach
            		</tbody>
            	</table>

            </div>

            <div class="tab-pane" id="three" role="tabpanel" aria-labelledby="three-tab">

							<div style="position: absolute; top: 0; right: 0;">
								<a href="{{ route('beranda.incoming_process') }}" class="btn btn-primary"> <i class="fa fa-print mr-2"></i> Print </a>
								<a href="{{ route('beranda.outcoming') }}" class="btn btn-success"> <i class="fa fa-file-excel mr-2"></i> Export to excel </a>
							</div>

            	{{-- Outcoming Process --}}
            	<table class="table table-sm table-bordered table-hover table-striped" id="dataTables">
            		<thead>
            			<tr>
            				<th>No.</th>
            				<th>Date</th>
            				<th>Description</th>
            				<th>Remarks</th>
            			</tr>
            		</thead>

            		<tbody>
            			@foreach( $outcoming as $no => $data )
            			<tr>
            				<td>{{ $no+1 }}</td>
            				<td>{{ date('d/M/Y', strtotime($data->picking_date)) }}</td>
            				<td>{{ $data->picking_desc }}</td>
            				<td>{{ $data->picking_rmk }}</td>
            			</tr>
            			@endforeach
            		</tbody>
            	</table>

            </div>


            <div class="tab-pane" id="four" role="tabpanel" aria-labelledby="four-tab">

							<div style="position: absolute; top: 0; right: 0;">
								<a href="{{ route('beranda.incoming_process') }}" class="btn btn-primary"> <i class="fa fa-print mr-2"></i> Print </a>
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
            	<table class="table table-sm table-bordered table-hover table-striped" id="dataTables">
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
			$('#on_demand_stock').DataTable( {
					dom: 'Bfrtip',
					buttons: [
							'print'
					]
			} );
	} );

	$('#wms-list a').on('click', function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	});
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
