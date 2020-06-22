@extends("dashboard")

@section('title')
Add New UOM (Unit of Measurement)
@stop

@section('breadcrumb')
<a href="{{ route('uom.index') }}">UOM (Unit of Measurement)</a> > Edit UOM
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('uom.update') }}">
					{{ csrf_field() }}

					<input type="hidden" name="uom_id" value="{{ $uom->uom_id }}">

					<label for="uom_code">UOM Code</label>
					<input type="text" name="uom_code" class="form-control form-control-sm" placeholder="UOM (Unit of Measurement)" value="{{ $uom->uom_code }}">

					<label class="mt-2" for="uom_desc">UOM Name</label>
					<input type="text" name="uom_desc" class="form-control form-control-sm" placeholder="Item Category Description" value="{{ $uom->uom_desc }}">

					<div class="float-right mt-3">
						<a href="{{ route('uom.index') }}" class="btn btn-sm btn-outline-secondary ">
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