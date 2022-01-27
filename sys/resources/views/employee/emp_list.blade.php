@extends('dashboard')

@section('title')
	Employee
@stop

@section('breadcrumb')
	<span class="small"> Employee </span>
@stop

@section('content')
<style type="text/css">
	.sidebar_content {color: white;}
</style>

<section id="konten">
<div class="container">
<h5 class="page_title"> Employees Data List
</h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">

			<div class="row">
			<div class="col-md-12"">
			<div class="content">

				
				<div class="row">
					<div class="col-md-3">
						<div class="org_item">
							<a href="{{ route('emp_list.detail', 'all_list') }}">
							<img src="{{ asset('images/icons/dept2.png') }}" style="width: 100%">
							<hr>
							<h5 align="center" class="link_ungu"> All Department </h5>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="org_item">
							<a href="{{ route('emp_list.detail', 1) }}">
							<img src="{{ asset('images/icons/hr_icon2.png') }}" style="width: 100%">
							<hr>
							<h5 align="center" class="link_ungu"> HRGA </h5>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="org_item">
							<a href="{{ route('emp_list.detail', 2) }}">
							<img src="{{ asset('images/icons/fa_icon2.png') }}" style="width: 100%">
							<hr>
							<h5 align="center" class="link_ungu"> Finance & Accounting </h5>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="org_item">
							<a href="{{ route('emp_list.detail', 3) }}">
							<img src="{{ asset('images/icons/purch_icon2.png') }}" style="width: 100%">
							<hr>
							<h5 align="center" class="link_ungu"> Purchasing </h5>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="org_item">
							<a href="{{ route('emp_list.detail', 4) }}">
							<img src="{{ asset('images/icons/mkt.PNG') }}" style="width: 100%">
							<hr>
							<h5 align="center" class="link_ungu"> Marketing </h5>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="org_item">
							<a href="{{ route('emp_list.detail', 5) }}">
							<img src="{{ asset('images/icons/prod_icon2.png') }}" style="width: 100%">
							<hr>
							<h5 align="center" class="link_ungu"> Production </h5>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="org_item">
							<a href="{{ route('emp_list.detail', 6) }}">
							<img src="{{ asset('images/icons/wh_icon2.png') }}" style="width: 100%">
							<hr>
							<h5 align="center" class="link_ungu"> Warehouse </h5>
							</a>
						</div>
					</div>
				</div>
				
			</div><!-- end content -->
			</div>
			<!-- <div class="col-md-3">
			</div> -->
			</div> <!-- end Row -->


		</div> <!-- end main_area -->
	</div> <!-- end container -->
</section>
@stop

@section('script')
<script>

</script>
@stop