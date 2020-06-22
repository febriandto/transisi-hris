@extends("dashboard")

@section('title')
Add New Item Category
@stop

@section('breadcrumb')
<a href="{{ route('itemcategory.index') }}">Item Category</a> > Add Category
@stop

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('itemcategory.save') }}">
					{{ csrf_field() }}
					
							<label for="item_cat_name">Item Category Name</label>
							<input type="text" name="item_cat_name" class="form-control form-control-sm" placeholder="Item Category Name">

							<label class="mt-2" for="item_cat_desc">Item Category Description</label>
							<input type="text" name="item_cat_desc" class="form-control form-control-sm" placeholder="Item Category Description">

					<div class="float-right mt-3">
						<a href="{{ route('itemcategory.index') }}" class="btn btn-sm btn-outline-secondary ">
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