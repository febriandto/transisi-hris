@extends('dashboard')

@section('title')
	Dashboard
@stop

@section('breadcrumb')
	<span class="small"> Dashboard </span>
@stop


@section('content')
	<div class="row">

		{{-- Tally Sheet Information --}}
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h6 class="m-0">Tally Sheet Information</h6>
				</div>
				<div class="card-body">
					<div class="row">

						<div class="col-md-6">
							<div class="box-dashboard-1">
								<h2>{{ $all_tally_sheet[0]->a }}</h2>
								<p>All Tally Sheet</p>
							</div>
							<a href="{{route('tally.index')}}">
								<div class="text-center box-dashboard-1-footer">View Detail <i class="fa fa-arrow-circle-right ml-2"></i></div>
							</a>
						</div>

						<div class="col-md-6">
							<div class="box-dashboard-1">
								<h2>{{ $entry_tally_sheet[0]->a }}</h2>
								<p>Entry Tally Sheet</p>
							</div>
							<a href="{{route('tally.index', ['filter_by_status' => 'entry'])}}">
								<div class="text-center box-dashboard-1-footer">View Detail <i class="fa fa-arrow-circle-right ml-2"></i></div>
							</a>
						</div>

						<div class="col-md-6 mt-3">
							<div class="box-dashboard-1">
								<h2>{{ $finished_tally_sheet[0]->a }}</h2>
								<p>Finished Tally Sheet</p>
							</div>
							<a href="{{route('tally.index', ['filter_by_status' => 'finish_tally'])}}">
								<div class="text-center box-dashboard-1-footer">View Detail <i class="fa fa-arrow-circle-right ml-2"></i></div>
							</a>
						</div>

						<div class="col-md-6 mt-3">
							<div class="box-dashboard-1">
								<h2>{{ $tally_sheet_closed[0]->a }}</h2>
								<p>Tally Sheet Closed</p>
							</div>
							<a href="{{route('tally.index', ['filter_by_status' => 'tally_close'])}}">
								<div class="text-center box-dashboard-1-footer">View Detail <i class="fa fa-arrow-circle-right ml-2"></i></div>
							</a>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h6 class="m-0">PutAway Information</h6>
				</div>
				<div class="card-body">
					<div class="row">

						<div class="col-md-6">
							<div class="box-dashboard-2">
								<h2>{{ $all_putaway[0]->a }}</h2>
								<p>All Putaway</p>
							</div>
							<a href="{{route('putaway.index')}}">
								<div class="text-center box-dashboard-2-footer">View Detail <i class="fa fa-arrow-circle-right ml-2"></i></div>
							</a>
						</div>

						<div class="col-md-6">
							<div class="box-dashboard-2">
								<h2>{{ $entry_putaway_sheet[0]->a }}</h2>
								<p>Entry PutAway Sheet</p>
							</div>
							<a href="#">
								<div class="text-center box-dashboard-2-footer">View Detail <i class="fa fa-arrow-circle-right ml-2"></i></div>
							</a>
						</div>

						<div class="col-md-6 mt-3">
							<div class="box-dashboard-2">
								<h2>{{ $finish_putaway_sheet[0]->a }}</h2>
								<p>Finished PutAway Sheet</p>
							</div>
							<a href="#">
								<div class="text-center box-dashboard-2-footer">View Detail <i class="fa fa-arrow-circle-right ml-2"></i></div>
							</a>
						</div>

						<div class="col-md-6 mt-3">
							<div class="box-dashboard-2">
								<h2>{{ $putaway_finish[0]->a }}</h2>
								<p>PutAway Finish</p>
							</div>
							<a href="#">
								<div class="text-center box-dashboard-2-footer">View Detail <i class="fa fa-arrow-circle-right ml-2"></i></div>
							</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
@stop
