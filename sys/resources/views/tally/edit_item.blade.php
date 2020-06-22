@extends("dashboard")

@section('title')
Edit Item to Tally
@stop

@section('breadcrumb')
Edit Item
@stop

@section('content')

<style>
	#select:hover{
		cursor: pointer;
	}
</style>

<div class="modal fade" id="modalItems" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalItemsLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalItemsLabel">Select Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<table class="table table-hover table-sm" id="dataTables">
      		<thead>
      			<tr>
	      			<th>No</th>
	      			<th>Item Number</th>
	      			<th>Name</th>
	      			<th>Description</th>
	      			<th>Customer</th>
	      			<th>Unit</th>
	      		</tr>
      		</thead>
      		<tbody>
      			@foreach($items as $no => $item)
      			<tr id="select" onclick="fill('#item_number', '<?php echo $item->item_number; ?>')">
      				<td>{{ $no+1 }}</td>
      				<td>{{ $item->item_number }}</td>
      				<td>{{ $item->item_name }}</td>
      				<td>{{ $item->item_description }}</td>
      				<td>{{ $item->cust_id }}</td>
      				<td>{{ $item->uom_code }}</td>
      			</tr>
      			@endforeach
      		</tbody>
      	</table>
      </div>
    </div>
  </div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('tally.update_item') }}">
					{{ csrf_field() }}

					<input type="hidden" name="tally_no" value="{{ $tally->tally_no }}">
					<input type="hidden" name="tally_detail_id" value="{{ $tally_detail_id }}">

					<label for="item_number" class="d-block">Item Number</label>
					<input type="text" name="item_number" id="item_number" class="form-control form-control-sm" placeholder="Choose Item" style="width: 80%;display: inline-block;" value="{{ $item_number }}">
					
					<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modalItems">
						<i class="fa fa-search"></i>
					</button>

					<label for="tally_qty" class="mt-3">Tally Quantity</label>
					<input type="number" name="tally_qty" class="form-control form-control-sm" placeholder="Qty" value="{{ $tally_qty }}">

					<div class="float-right mt-3">
						<a href="{{ URL::previous() }}" class="btn btn-sm btn-outline-secondary">
							<i class="fa fa-times mr-2"></i>	Close
						</a>
						<button class="btn btn-sm btn-success" type="submit">
						 <i class="fa fa-check mr-2"></i>	Save
						</button>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop


@section('script')
<script>
	function fill(div, txt){

		$(div).val(txt);
		$('#modalItems').modal('hide')
	}
</script>
@stop