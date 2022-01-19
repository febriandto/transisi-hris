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
<h5 class="page_title"> Data Karyawan
</h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">

			<div class="row">
			<div class="col-md-10">
			<div class="content">

				<div class="top_menu_list">
					<a class="btn btn-primary btn-sm" id="no_radius" href="#">Karyawan Aktif ({{$ActiveEmployee}})</a>
					<a class="btn btn-default btn-sm" id="no_radius" href="?resign=true"> Resign ({{$ResignEmployee}})</a>
					<span style="float:right;">
						<a class="btn btn-sm btn-warning" id="no_radius" href="emp_list"> <i class="fa fa-bars icon_left" title="See another ways"></i> Tampilan Grid </a>
						<a class="btn btn-sm btn-success" id="no_radius" href="{{ route('employee.add') }}"> <i class="fa fa-plus icon_left" title="Tambah Data Baru"></i> Tambah Baru </a>
						<a href="emp_export" target="_blank" class="btn btn-primary flat btn-sm" id="no_radius">
		                	<i class="fa fa-file-excel-o icon_left"></i> Export Ke Excel
		              	</a>
					</span>
				</div>
				<hr>
				<a class="btn {{ \Request::route()->getName() == 'employee.index' ? 'btn-warning' : 'btn-default' }}" id="no_radius" href="{{ route('employee.index') }}"> Semua Karyawan ({{$ActiveEmployee}}) </a>
				<a class="btn {{ \Request::route()->getName() == 'employee.local' ? 'btn-warning' : 'btn-default' }}" id="no_radius" href="{{ route('employee.local') }}"> Karyawan Lokal ({{$CountLocalEmploye}})</a>
				<a class="btn {{ \Request::route()->getName() == 'employee.foreign' ? 'btn-warning' : 'btn-default' }}" id="no_radius" href="{{ route('employee.foreign') }}"> Karyawan Asing ({{$CountForeignEmploye}})</a>
				<a class="btn {{ \Request::route()->getName() == 'employee.bod' ? 'btn-warning' : 'btn-default' }}" id="no_radius" href="{{ route('employee.bod') }}"> BOD ({{$CountBOD}})</a>
				<hr>
				<table id="example" class="cell-border table-hover table table-striped table-bordered" cellspacing="0" width="100%">
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
			        	@foreach($employee as $no => $value)
			        	<tr>
			        		<td> {{ $no+1 }} </td>
			        		<td> {{ $value->id_emp }} </td>
			        		<td> <a href="{{ route('employee.detail', $value->id_emp) }}"> {{ $value->emp_name }} </a> </td>
			        		<td> {{ @$value->department->dept_name }} </td>
			        		<td> {{ @$value->section->section_name }} </td>
			        		<td> {{ @$value->grade->grade_name }} </td>
			        		<td> {{ $value->emp_status }} </td>
			        	</tr>
			        	@endforeach
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

@section('script')
<script>

</script>
@stop