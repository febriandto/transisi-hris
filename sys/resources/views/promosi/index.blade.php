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
<h5 class="page_title"> Data Promosi Karyawan
</h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">	
			
			<div class="row">
			<div class="col-md-9">
			<div class="content">

				<a class="btn btn-sm btn-success" id="no_radius" href="{{ route('promosi.add') }}"> <i class="fa fa-plus icon_left" title="Tambah Data Baru"></i> Tambah Baru </a>
				<hr>
				<!-- <table id="tabel_howto" width="100%"> -->
				<table id="example" class="cell-border" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th width="5%">No</th>
			                <th>Nama Karyawan</th>
			                <th>Posisi Baru</th>
			                <th>Tingkat</th>
			                <th>Kategori</th>
			                <th>Tanggal Aktif</th>
			                <!-- <th>Option</th> -->
			            </tr>
			        </thead>
			        
			        <tbody>
			        	@foreach( $promosi as $no => $data )
			            <tr>
			                <td align="center"><?php echo $no+1; ?></td>
			                <td>
			                	<a href="{{ route('employee.detail', $data->id_emp) }}"><?php echo $data->emp_name;?></a>
			                </td>
			                <td><?php echo $data->grade_name;?></td>
			                <td><?php echo $data->grade_level;?></td>
			                <td><?php echo $data->promosi_category;?></td>
			                <td><?php echo $data->promosi_activedate;?></td>
			            </tr>
			            @endforeach
			        </tbody>
				</table>
			</div><!-- end content -->
			</div>
			<div class="col-md-3">
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