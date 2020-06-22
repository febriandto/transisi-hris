@extends("dashboard")

@section('title')
Edit Warehouse Name
@stop

@section('breadcrumb')
<a href="{{ route('warehousename.index') }}">Warehouse name</a> > Edit Warehouse Name
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('warehousename.update') }}">
					{{ csrf_field() }}

							<input type="hidden" name="wh_id" value="{{ $warehousename->wh_id }}">
					
							<label for="wh_name">Warehouse Name</label>
							<input type="text" name="wh_name" class="form-control form-control-sm" value="{{ $warehousename->wh_name }}">

							<label class="mt-2" for="wh_desc">Description</label>
							<input type="text" name="wh_desc" class="form-control form-control-sm" placeholder="Warehouse Name Description" value="{{ $warehousename->wh_desc }}">

					<div class="float-right mt-3">
						<a href="{{ route('warehousename.index') }}" class="btn btn-sm btn-outline-secondary ">
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