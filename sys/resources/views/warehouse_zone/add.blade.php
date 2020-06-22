@extends("dashboard")

@section('title')
Add Warehouse Zone
@stop

@section('breadcrumb')
<a href="{{ route('warehousezone.index') }}">Warehouse Zone</a> > Add Warehouse Zone
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('warehousezone.save') }}">
					{{ csrf_field() }}
					
					<label for="zone_name">Zone Name</label>
					<input type="text" name="zone_name" class="form-control form-control-sm" placeholder="Warehouse Zone Name">

					<label class="mt-3" for="zone_desc">Description</label>
					<input type="text" name="zone_desc" class="form-control form-control-sm" placeholder="Warehouse Zone Description">

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