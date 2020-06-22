@extends("dashboard")

@section('title')
Edit Warehouse Name
@stop

@section('breadcrumb')
<a href="{{ route('warehousezone.index') }}">Warehouse name</a> > Edit Warehouse Name
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('warehousezone.update') }}">
					{{ csrf_field() }}

							<input type="hidden" name="zone_id" value="{{ $warehousezone->zone_id }}">
					
							<label for="zone_name">Zone Name</label>
							<input type="text" name="zone_name" class="form-control form-control-sm" value="{{ $warehousezone->zone_name }}">

							<label class="mt-2" for="zone_desc">Description</label>
							<input type="text" name="zone_desc" class="form-control form-control-sm" placeholder="Warehouse Zone Description" value="{{ $warehousezone->zone_desc }}">

					<div class="float-right mt-3">
						<a href="{{ route('warehousezone.index') }}" class="btn btn-sm btn-outline-secondary ">
							<i class="fa fa-times"></i> Cancel
						</a>
						<button class="btn btn-sm btn-success">
							<i class="fa fa-check"></i> Save
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@stop