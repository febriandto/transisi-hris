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

<style type="text/css">
	.emp_list { box-shadow: 1px 1px 2px 2px rgba(1,1,1,0.1); margin-bottom: 10px; padding: 10px; border : none; }
	.emp_list:hover {box-shadow: 1px 1px 4px 4px rgba(1,1,1,0.1);}
	.emp_list_detail h4 { font-weight: bold; color: #4285f4; width: 100%; border-bottom: 1px solid rgba(1,1,1,0.1); padding-bottom: 10px; }
	.emp_list_detail h4:Hover { color: orange; }
</style>

<section id="konten">
<div class="container">
<h5 class="page_title"> Employees Data
</h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">

			<div class="row">
			<div class="col-md-9">
			<div class="content">	

				<h4 class="bold"> All Employee </h4>

				<span class="right" style="margin-top: -40px;">
					<a class="btn btn-default btn-sm" id="no_radius" onclick="history.go(-1);" style="position: relative; z-index: 10;" title="Close Menu">
						<i class="fa fa-close"></i>
					</a>
				</span>
				<hr>
					<div class="row">
						@foreach( $datas as $data )
						<div class="col-md-6">
							<a href="{{ route('employee.detail', $data->id_emp) }}">
								<div class="emp_list">
									<div class="row">
										<div class="col-md-3">
											<img src="{{ asset('images/upload/'.$data->emp_photo) }}" style="width: 100%; height: 93px">
										</div>
										<div class="col-md-9">
											<div class="emp_list_detail">
												<h5 style="font-size: 15px !important"> <?php echo $data->emp_name;?> </h5>
												<span style="color: grey; font-size: 12px !important"> <?php echo $data->grade_name;?> <?php echo $data->section_name;?></span><br>
												<span style="color: grey"> <?php echo $data->emp_status;?></span>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
						@endforeach
					</div>
			        
			</div><!-- end content -->
			</div>

			<!-- Sidebar -->
			<div class="col-md-3">
			</div>
			</div> <!-- end Row -->


		</div> <!-- end main_area -->
	</div> <!-- end container -->
</section>
@stop

@section('script')
<script>

</script>
@stop