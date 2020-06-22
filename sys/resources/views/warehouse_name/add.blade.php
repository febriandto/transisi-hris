@extends("dashboard")

@section('title')
Add Warehouse Name
@stop

@section('breadcrumb')
<a href="{{ route('warehousename.index') }}">Warehouse Name</a> > Add Warehouse Name
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('warehousename.save') }}">
					{{ csrf_field() }}
					
					<label for="wh_name">Warehouse Name</label>
					<input type="text" name="wh_name" class="form-control form-control-sm" placeholder="Warehouse Name">

					<label class="mt-3" for="wh_desc">Description</label>
					<input type="text" name="wh_desc" class="form-control form-control-sm" placeholder="Warehouse Name Description">

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