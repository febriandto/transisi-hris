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
<h5 class="page_title"><i class="fa fa-server icon_left"></i> Mutasi Data
</h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">	
			
			<div class="row">
			<div class="col-md-8">
			<div class="content">

				<a class="btn btn-sm btn-success" id="no_radius" href="{{ route('mutasi.add') }}"> <i class="fa fa-plus icon_left" title="Tambah Data Baru"></i> Add New </a>
				<hr>
				<!-- <table id="tabel_howto" width="100%"> -->
				<table id="example" class="cell-border" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th width="5%">No</th>
			                <th>Employee Name</th>
			                <th>Departement</th>
			                <th>Active Date</th>
			                <th>Category</th>
			                <!-- <th>Option</th> -->
			            </tr>
			        </thead>
			        
			        <tbody>
			        	@foreach( $mutasi as $no => $data )
			            <tr>
			                <td align="center"><?php echo $no+1; ?></td>
			                <td>
			                	<a href="{{ route('employee.detail', $data->id_emp) }}"><?php echo $data->emp_name;?></a>
			                </td>
			                <td><?php echo $data->dept_name;?></td>
			                <td><?php echo $data->mutasi_activedate;?></td>
			                <td><?php echo $data->mutasi_category;?></td>
			                <!-- <td width="15%" align="center">

			                
			                	<a class="btn_link" 
			                	id="no_radius" href="?update=true&id_mutasi=<?php echo $data->id_mutasi;?>">
			                	<i class="fa fa-pencil"></i></a>
			                
			                	<a class="btn_link" 
			                	id="no_radius" href="?del=true&id_mutasi=<?php echo $data->id_mutasi;?>" onclick="return confirm('Are You Sure Want to Delete ?')">
			                	<i class="fa fa-close"></i></a>
			                </td> -->
			            </tr>
			            @endforeach
			        </tbody>
				</table>
				
			</div><!-- end content -->
			</div>
			<div class="col-md-4">
				@include('layouts.notif')
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