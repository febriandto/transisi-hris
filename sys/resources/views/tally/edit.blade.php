@extends("dashboard")

@section('title')
Edit Tally Documents
@stop

@section('breadcrumb')
<a href="{{ route('tally.index') }}"> Tally Documents </a>
<span class="text-muted mx-1"> > </span>
<span>Edit Tally</span>
@stop

@section('content')
<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('tally.update') }}">
					{{ csrf_field() }}
					<div class="form-group row">
						<label for="tally_no" class="col-sm-2 col-form-label">Tally Number</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="tally_no" placeholder="<?php echo $tally->tally_no; ?>" disabled>
							<input type="text" class="form-control" id="tally_no" name="tally_no" value="<?php echo $tally->tally_no; ?>" hidden>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Tally Date</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" name="tally_date" value="{{ $tally->tally_date }}">
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Tally Description</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="tally_desc" value="{{ $tally->tally_desc }}" placeholder="Tally Description">
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Customer</label>
						<div class="col-sm-10">
							<select class="form-control" name="cust_id">
								<option>- Pilih -</option>
								@foreach( $customers as $customer )
									<option @if($tally->cust_id == $customer->cust_id) selected @endif value="{{ $customer->cust_id }}">{{ $customer->cust_name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Tally Remarks</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="tally_rmk" value="{{ $tally->tally_rmk }}" placeholder="Tally Remarks">
						</div>
					</div>

					<div class="form-group row mt-4" style="flex-direction: row-reverse;">
						<button class="btn btn-sm btn-success ml-2 mr-2"> <i class="fa fa-check mr-1"></i> Save</button>
						<a href="{{ route('tally.index') }}" class="btn btn-sm btn-outline-secondary "> <i class="fa fa-times mr-1"></i> Cancel</a>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
@stop