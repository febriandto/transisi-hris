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
<h5 class="page_title"> Data Kontrak Karyawan </h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">	
			
			<div class="row">
			<div class="col-md-12">
			<div class="content">
				<!-- <table id="tabel_howto" width="100%"> -->
				<table id="example" class="cell-border table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th width="6%">No</th>
			                <th>NIK</th>
			                <th>Nama Lengkap</th>
			                <th>Status Kontrak</th>
			                <th>Durasi</th>
			                <th>Tanggal Bergabung</th>
			                <th>Tanggal Berakhir</th>
			                <th>Catatan</th>
			            </tr>
			        </thead>
			        
			        <tbody>
			        	@foreach( $contract as $no => $data )
			            <tr>
			                <td align="center"><?php echo $no+1; ?></td>
			                <td>
			                	<a href="#" data-toggle="modal" data-target="#<?php echo $data->id_emp;?>">
			                	<?php echo $data->id_emp;?>	
			                	</a>	
								<!-- Modal -->
								<div id="<?php echo $data->id_emp;?>" class="modal fade" role="dialog">
								  <div class="modal-dialog">

								    <!-- Modal content-->
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title"><?php echo $data->emp_name;?></h4>
								      </div>
								      <div class="modal-body">
								      	<table class="table_emp_view">
										<tr>
											<td width="30%"> Departemen </td><td>:</td>
											<td><?php echo $data->dept_name;?></td>
										</tr>
										<tr>
											<td width="30%"> Posisi </td><td>:</td>
											<td><?php echo $data->grade_name;?></td>
										</tr>
										<tr>
											<td width="30%"> Jenis Kelamin </td><td>:</td>
											<td><?php echo $data->emp_gender;?></td>
										</tr>
										<tr>
											<td width="30%"> Tanggal Bergabung </td><td>:</td>
											<td><?php echo $data->emp_join_date;?></td>
										</tr>
										<tr>
											<td width="30%"> Tempat, Tanggal Lahir </td><td>:</td>
											<td><?php echo $data->emp_placebirth;?> / 
												<?php echo date('d F Y', strtotime($data->emp_datebirth)); ?>
										</tr>
										<tr>
											<td width="30%"> Alamat </td><td>:</td>
											<td><?php echo $data->emp_address;?></td>
										</tr>
										<tr>
											<td width="30%"> Nomer Telepon </td><td>:</td>
											<td><?php echo $data->emp_phone_no;?></td>
										</tr>
										<tr>
											<td width="30%"> Alamat Email </td><td>:</td>
											<td><?php echo $data->emp_email;?></td>
										</tr>
										<tr>
											<td width="30%"> Status Kontrak </td><td>:</td>
											<td><?php echo $data->emp_status;?></td>
										</tr>
									</table>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
								      </div>
								    </div>

								  </div>
								</div>
								<!-- End Modal -->

			                </td>
			                <td><?php echo $data->emp_name;?></td>
			                <td><?php echo $data->contract_status;?></td>
			                <td><?php echo $data->durasi;?> Month</td>
			                <td>
			                	<?php echo date('d F Y', strtotime($data->contract_start_date)); ?>
			                </td>
			                <td>
			                	<?php echo date('d F Y', strtotime($data->contract_end_date)); ?>
			                </td>
			                <td><?php echo $data->remarks;?></td>
			            </tr>
			            @endforeach
			        </tbody>
				</table>
				<!-- <hr>
				<a class="btn btn-sm btn-success" id="no_radius" href="?add=true"> <i class="fa fa-plus icon_left" title="Tambah Data Baru"></i> Add New </a> -->
			</div><!-- end content -->
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