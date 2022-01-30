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
<h5 class="page_title"> Employee Accidents  Data
</h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">	
			
			<div class="row">
			<div class="col-md-9">
			<div class="content">
				<!-- <table id="tabel_howto" width="100%"> -->
				<table id="example" class="cell-border table-hover table table-striped table-bordered" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th width="5%">No</th>
			                <th>Kode Accidents</th>
			                <th>Accident Category</th>
			                <th>Employee's Name</th>
			                <th>Departement</th>
			                <th>Option</th>
			            </tr>
			        </thead>
			        
			        <tbody>
			        	@foreach( $accident_employee as $no => $data )
			            <tr>
			                <td align="center"><?php echo $no+1; ?></td>
			                <td>
			                	<a href="{{ route('employee.detail', $data->id_emp) }}">
			                		<?php echo $data->id_accident;?>
			                	</a>
			                </td>
			                <td><?php echo $data->acc_catname;?></td>
			                <td><?php echo $data->emp_name;?></td>
			                <td><?php echo $data->dept_name;?></td>
			                <td width="" align="center">

			                	<a class="btn_link" 
			                	id="no_radius" href="{{ route('accident.edit', $data->id_accident) }}">
			                	<i class="fa fa-pencil"></i></a>
			                </td>
			            </tr>
			            @endforeach
			        </tbody>
				</table>
				<hr>
				<a class="btn btn-sm btn-success" id="no_radius" href="{{ route('accident.add') }}"> <i class="fa fa-plus icon_left" title="Tambah Data Baru"></i> Add New </a>
			</div><!-- end content -->
			</div>
			<div class="col-md-3">
			</div>
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