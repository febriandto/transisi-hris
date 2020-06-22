@extends("dashboard")

@section('title')
Add New Pallet ID
@stop

@section('breadcrumb')
<a href="{{ route('pallet.index') }}">Pallet ID</a> > Add New
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('pallet.save') }}">
					{{ csrf_field() }}
					
					<label for="pallet_name">Pallet Name</label>
					<input type="text" name="pallet_name" placeholder="Pallet Name" class="form-control form-control-sm">

					<label class="mt-3" for="pallet_desc">Description</label>
					<input type="text" name="pallet_desc" class="form-control form-control-sm" placeholder="Pallet Description">

					<div class="float-right mt-3">
						<a href="{{ route('pallet.index') }}" class="btn btn-sm btn-outline-secondary ">
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