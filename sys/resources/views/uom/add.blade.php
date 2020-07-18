@extends("dashboard")

@section('title')
Add New UOM (Unit of Measurement)
@stop

@section('breadcrumb')
<a href="{{ route('uom.index') }}">UOM (Unit of Measurement)</a> 
<span class="mx-1"> > </span>
<span> Add UOM </span>
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('uom.save') }}">
					{{ csrf_field() }}
					
					<label for="uom_code">UOM Code</label>
					<input type="text" name="uom_code" class="form-control form-control-sm" placeholder="UOM (Unit of Measurement)">

					<label class="mt-3" for="uom_desc">UOM Desc</label>
					<input type="text" name="uom_desc" class="form-control form-control-sm" placeholder="Item Category Description">

					<div class="float-right mt-3">
						<a href="{{ route('uom.index') }}" class="btn btn-sm btn-outline-secondary ">
							<i class="fa fa-times mx-1"></i> Cancel
						</a>
						<button class="btn btn-sm btn-success">
							<i class="fa fa-check mx-1"></i> Save
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
@stop