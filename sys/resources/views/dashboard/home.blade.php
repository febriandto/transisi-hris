@extends('dashboard')

@section('title')
	Dashboard
@stop

@section('breadcrumb')
	<span class="small"> Dashboard </span>
@stop


<?php 

	$bulan = [
		1 => "January",
		2 => "February",
		3 => "March",
		4 => "April",
		5 => "May",
		6 => "June",
		7 => "July",
		8 => "August",
		9 => "September",
		10 => "October",
		11 => "November",
		12 => "December",
	];

	$chartTallyQty2020 = [
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0,
		6 => 0,
		7 => 0,
		8 => 0,
		9 => 0,
		10 => 0,
		11 => 0,
		12 => 0,
	];
	$chartTallyQty2021 = [
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0,
		6 => 0,
		7 => 0,
		8 => 0,
		9 => 0,
		10 => 0,
		11 => 0,
		12 => 0,
	];

	$chartPutawayQty2020 = [
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0,
		6 => 0,
		7 => 0,
		8 => 0,
		9 => 0,
		10 => 0,
		11 => 0,
		12 => 0,
	];
	$chartPutawayQty2021 = [
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0,
		6 => 0,
		7 => 0,
		8 => 0,
		9 => 0,
		10 => 0,
		11 => 0,
		12 => 0,
	];

	$chartPickingQty2020 = [
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0,
		6 => 0,
		7 => 0,
		8 => 0,
		9 => 0,
		10 => 0,
		11 => 0,
		12 => 0,
	];
	$chartPickingQty2021 = [
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0,
		6 => 0,
		7 => 0,
		8 => 0,
		9 => 0,
		10 => 0,
		11 => 0,
		12 => 0,
	];

	$chartLoadingQty2020 = [
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0,
		6 => 0,
		7 => 0,
		8 => 0,
		9 => 0,
		10 => 0,
		11 => 0,
		12 => 0,
	];
	$chartLoadingQty2021 = [
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0,
		6 => 0,
		7 => 0,
		8 => 0,
		9 => 0,
		10 => 0,
		11 => 0,
		12 => 0,
	];

foreach ($count_tally_2020 as $no => $data) {

	$chartTallyQty2020[$data->bulan] = $data->qty;

}
foreach ($count_tally_2021 as $no => $data) {

	$chartTallyQty2021[$data->bulan] = $data->qty;

}

foreach ($count_putaway_2020 as $no => $data) {

	$chartPutawayQty2020[$data->bulan] = $data->qty;

}
foreach ($count_putaway_2021 as $no => $data) {

	$chartPutawayQty2021[$data->bulan] = $data->qty;

}

foreach ($count_picking_2020 as $no => $data) {

	$chartPickingQty2020[$data->bulan] = $data->qty;

}
foreach ($count_picking_2021 as $no => $data) {

	$chartPickingQty2021[$data->bulan] = $data->qty;

}

foreach ($count_loading_2020 as $no => $data) {

	$chartLoadingQty2020[$data->bulan] = $data->qty;

}
foreach ($count_loading_2021 as $no => $data) {

	$chartLoadingQty2021[$data->bulan] = $data->qty;

}

 ?>

@section('content')
<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<canvas id="tally_putaway" width="400" height="200"></canvas>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<canvas id="picking_loading" width="400" height="200"></canvas>
					</div>
				</div>
			</div>
		</div>

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
							<a href="{{route('putaway.index', ['filter_by_status' => 'entry_putaway'])}}">
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
							<a href="{{route('putaway.index', ['filter_by_status' => 'putaway_finish'])}}">
								<div class="text-center box-dashboard-2-footer">View Detail <i class="fa fa-arrow-circle-right ml-2"></i></div>
							</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
@stop


@section('script')
<script>
var ctx = document.getElementById('tally_putaway').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?= "'" . implode("','", $bulan) . "'"; ?>],
        datasets: [
        {
            label: 'Tally 2020',
            data: [<?=  implode(",", $chartTallyQty2020) ?>],
            borderColor: [
                'rgb(243,169,53)',
            ],
            borderWidth: 1
        },
        {
            label: 'Tally 2021',
            data: [<?=  implode(",", $chartTallyQty2021) ?>],
            borderColor: [
                'rgb(199,53,88)',
            ],
            borderWidth: 1
        },
        {
            label: 'Putaway 2020',
            data: [<?=  implode(",", $chartPutawayQty2020) ?>],
            borderColor: [
                'rgb(110,190,159)',
            ],
            borderWidth: 1
        }
        ,
        {
            label: 'Putaway 2021',
            data: [<?=  implode(",", $chartPutawayQty2021) ?>],
            borderColor: [
                'rgb(37,134,164)',
            ],
            borderWidth: 1
        }
        ]
    },
    options: {
    responsive: true,
    tooltips: {
      mode: 'label',
    },
    hover: {
      mode: 'nearest',
      intersect: true
    },
    scales: {
      xAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Bulan'
        }
      }],
      yAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Total'
        }
      }]
    }
  }
});

var ctx = document.getElementById('picking_loading').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?= "'" . implode("','", $bulan) . "'"; ?>],
        datasets: [
	        {
	            label: 'Picking 2020',
	            data: [<?=  implode(",", $chartPickingQty2020) ?>],
	            borderColor: [
	                'rgb(243,169,53)',
	            ],
	            borderWidth: 1
	        },
	        {
	            label: 'Picking 2021',
	            data: [<?=  implode(",", $chartPickingQty2021) ?>],
	            borderColor: [
	                'rgb(199,53,88)',
	            ],
	            borderWidth: 1
	        },

	        {
	            label: 'Loading 2020',
	            data: [<?=  implode(",", $chartLoadingQty2020) ?>],
	            borderColor: [
	                'rgb(110,190,159)',
	            ],
	            borderWidth: 1
	        },
	        
	        {
	            label: 'Loading 2021',
	            data: [<?=  implode(",", $chartLoadingQty2021) ?>],
	            borderColor: [
	                'rgb(37,134,164)',
	            ],
	            borderWidth: 1
	        }
        ]
    },
    options: {
    responsive: true,
    tooltips: {
      mode: 'label',
    },
    hover: {
      mode: 'nearest',
      intersect: true
    },
    scales: {
      xAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Bulan'
        }
      }],
      yAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Total'
        }
      }]
    }
  }
});
</script>
@stop
