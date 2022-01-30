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
<h5 class="page_title"> Data Karyawan Resign
</h5>
</div>
<div class="bg_area">&nbsp;</div>
	<div class="container">
		<div class="main_area">	
			<div class="row">
			<div class="col-md-12">
			<div class="content">
				<!-- <table id="tabel_howto" width="100%"> -->
				<table id="example" class="cell-border table-hover table table-striped table-bordered" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th width="6%">No</th>
			                <th>NIK</th>
			                <th>Nama Karyawan</th>
			                <th>Departemen</th>
			                <th>Posisi</th>
			                <th>Kategori</th>
			                <th>Tanggal Resign</th>
			                <th>Alasan</th>
			                <!-- <th>Option</th> -->
			            </tr>
			        </thead>
			        
			        <tbody>
			        @foreach( $resign as $no => $data )
			            <tr>
			                <td align="center"><?php echo $no+1; ?></td>
			                <td><?php echo $data->id_emp;?></td>
			                <td><?php echo $data->emp_name;?></td>
			                <td><?php echo $data->dept_name;?></td>
			                <td><?php echo $data->grade_name;?></td>
			                <td><?php echo $data->rsg_category;?></td>
			                <td><?php echo date('d M Y', strtotime($data->rsg_date))?></td>
			                <td><?php echo $data->rsg_reason;?></td>
			                <!-- <td width="15%" align="center">
			                	<a class="btn_link"
			                	id="no_radius" href="emp_detail?id_emp=<?php echo $data->id_emp;?>">
			                	<i class="fa fa-search"></i></a>

			                	<a class="btn_link"
			                	id="no_radius" href="?update=true&id_emp=<?php echo $data->id_emp;?>">
			                	<i class="fa fa-pencil"></i></a>

			                	<a class="btn_link"
			                	id="no_radius" href="?del=true&id_emp=<?php echo $data->id_emp;?>" onclick="return confirm('Hapus data?')">
			                	<i class="fa fa-close"></i></a>
			                </td> -->
			            </tr>
			            @endforeach
			        </tbody>
				</table>
				<!-- <a class="btn btn-sm btn-success" id="no_radius" href="?add=true"> <i class="fa fa-plus icon_left" title="Tambah Data Baru"></i> Add New </a> -->
			</div><!-- end content -->
			</div>
			<!-- <div class="col-md-4">
				<div class="cara_dial">
				<h5> Be wise Person </h5>
				<p>
					- Sudahkah anda ngopi hari ini? <br>
					- Tetap fokus dan konsentrasi  <br>
				</p>
				</div>
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