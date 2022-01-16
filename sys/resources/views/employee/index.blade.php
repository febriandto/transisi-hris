@extends('dashboard')

@section('title')
	Employee
@stop

@section('breadcrumb')
	<span class="small"> Employee </span>
@stop

@section('content')
<section id="konten">
<div class="container">
<h5 class="page_title"> Data Semua Karyawan
</h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">

			<div class="row">
			<div class="col-md-10">
			<div class="content">

				<div class="top_menu_list">
					<a class="btn btn-primary btn-sm" id="no_radius" href="#">Karyawan Aktif ()</a>
					<a class="btn btn-default btn-sm" id="no_radius" href="?resign=true"> Resign ()</a>
					<span style="float:right;">
						<a class="btn btn-sm btn-warning" id="no_radius" href="emp_list"> <i class="fa fa-bars icon_left" title="See another ways"></i> Tampilan Grid </a>
						<a class="btn btn-sm btn-success" id="no_radius" href="?add=true"> <i class="fa fa-plus icon_left" title="Tambah Data Baru"></i> Tambah Baru </a>
						<a href="emp_export" target="_blank" class="btn btn-primary flat btn-sm" id="no_radius">
		                	<i class="fa fa-file-excel-o icon_left"></i> Export Ke Excel
		              	</a>
					</span>
				</div>
				<hr>
				<a class="btn btn-warning" id="no_radius" href="emp"> Semua Karyawan () </a>
				<a class="btn btn-default" id="no_radius" href="?karyawan_lokal=true"> Karyawan Lokal ()</a>
				<a class="btn btn-default" id="no_radius" href="?karyawan_asing=true"> Karyawan Asing ()</a>
				<a class="btn btn-default" id="no_radius" href="?bod=true"> BOD ()</a>
				<hr>
				<table id="example" class="cell-border table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th width="6%">No</th>
			                <th>NIK</th>
			                <th>Nama Karyawan</th>
			                <th>Departemen</th>
							<th>Seksi</th>
			                <th>Jabatan</th>
			                <th>Status</th>
			                <!-- <th>Option</th> -->
			            </tr>
			        </thead>

			        <tbody>
			        </tbody>
				</table>
			</div><!-- end content -->
			</div>
			<div class="col-md-2">
			</div>
			</div> <!-- end Row -->


		</div> <!-- end main_area -->
	</div> <!-- end container -->
</section>
@stop