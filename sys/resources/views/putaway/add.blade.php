@extends("dashboard")

@section('title')
Add New Put Away
@stop

@section('breadcrumb')
<a href="{{ URL::previous() }}"> Put Away </a> <span class="mx-1"> > </span> Add Data
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('putaway.save') }}">
					{{ csrf_field() }}

					<input type="hidden" name="periode_id" value="{{ $periode_id }}">
					
					<label>Putaway Number</label>
					<input type="text" name="putaway_no" class="form-control form-control-sm" value="P{{ date('ymd') }}{{ $putaway_no }}" readonly>

					<label class="mt-3">Tally No</label>
					<input type="text" name="tally_no" class="form-control form-control-sm" value="{{ $tally->tally_no }}" readonly>

					<label class="mt-3" for="putaway_date">Putaway Date</label>
					<input type="date" name="putaway_date" class="form-control form-control-sm">

					<label class="mt-3" for="putaway_rmk">Putaway Remarks</label>
					<input type="text" name="putaway_rmk" class="form-control form-control-sm" placeholder="Remarks">

					<div class="float-right mt-3">
						<a href="{{ URL::previous() }}" class="btn btn-sm btn-outline-secondary"> <i class="fa fa-times mr-2"></i> Cancel</a>
						<button class="btn btn-sm btn-success"> <i class="fa fa-check mr-1" type="submit"></i> Save</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@stop