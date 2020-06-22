@extends("dashboard")

@section('title')
Add Warehouse Bin
@stop

@section('breadcrumb')
<a href="{{ route('warehousebin.index') }}">Warehouse Bin</a> > Add New
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('warehousebin.save') }}">
					{{ csrf_field() }}
					
					<label for="bin_loc_name">Bin Name</label>
					<input type="text" name="bin_loc_name" placeholder="Warehouse Bin Name" class="form-control form-control-sm">

					<label class="mt-3" for="bin_loc_desc">Description</label>
					<input type="text" name="bin_loc_desc" class="form-control form-control-sm" placeholder="Warehouse Bin Description">

					<div class="float-right mt-3">
						<a href="{{ route('warehousebin.index') }}" class="btn btn-sm btn-outline-secondary ">
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