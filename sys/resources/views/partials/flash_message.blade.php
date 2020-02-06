@if (Session::has('flash_success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		{{ Session::get('flash_success') }}
	</div>
@endif

@if (Session::has('flash_info'))
	<div class="alert alert-info alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		{{ Session::get('flash_info') }}
	</div>
@endif

@if (Session::has('flash_warning'))
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		{{ Session::get('flash_warning') }}
	</div>
@endif

@if (Session::has('flash_danger'))
	<div class="alert alert-danger bg-danger alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		{{ Session::get('flash_danger') }}
	</div>
@endif