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
<h5 class="page_title"> Data Anggota Team (<?php echo $team_leader; ?>)
</h5>
</div>
<div class="bg_area">&nbsp;</div>
	<div class="container">
		<div class="main_area">
			<div class="row">
				<div class="col-md-10">
					<div class="content">
						<div class="box-body">
				            <?php 
				            if (@$_GET['input']=='sukses') { ?>
				              <div class="">
				                <div class="alert alert-success fade in warning_msg">
				                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                  <i class="fa fa-check icon_left"></i> Data berhasil di Tambah...
				                </div>
				              </div>
				            <?php } ?>
				            <?php 
				            if (@$_GET['input']=='gagal') { ?>
				              <div class="">
				                <div class="alert alert-danger fade in warning_msg">
				                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                  <i class="fa fa-close icon_left"></i> Data Gagal di Tambah :(
				                </div>
				              </div>
				            <?php } ?>
				            <?php 
				            if (@$_GET['rubah']=='sukses') { ?>
				              <div class="">
				                <div class="alert alert-warning fade in warning_msg">
				                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                  <i class="fa fa-check icon_left"></i> Data berhasil di Edit...
				                </div>
				              </div>
				            <?php } ?>
				            <?php 
				            if (@$_GET['hapus']=='sukses') { ?>
				              <div class="">
				                <div class="alert alert-danger fade in warning_msg">
				                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                  <i class="fa fa-trash icon_left"></i> Data berhasil di Hapus...
				                </div>
				              </div>
				            <?php } ?>
				        </div>
						<div class="top_menu_list">
							<a class="btn btn-sm btn-success" id="no_radius" href=""> 
								<i class="fa fa-plus icon_left" title="Tambah Data Baru"></i> Tambah Anggota 
							</a>
							<a class="btn btn-sm btn-primary" id="no_radius" href="team_view"> 
								<i class="fa fa-check icon_left"></i> Selesai
							</a>
							<!-- <a href="emp_export" target="_blank" class="btn btn-primary flat btn-sm" id="no_radius">
			                	<i class="fa fa-file-excel-o icon_left"></i> Export To Excel
			              	</a> -->
						</div>
						<hr>
						<table id="example" class="cell-border table-hover table table-striped table-bordered" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th width="6%">No</th>
					                <th>NIK</th>
					                <th>Employee Name</th>
					                <th>Department</th>
					                <th>Level</th>
					                <th>Option</th>
					            </tr>
					        </thead>

					        <tbody>
					        @foreach( $team as $no => $data )
					            <tr>
					                <td align="center"><?php echo $no+1; ?></td>
					                <td><?php echo $data->id_emp;?></td>
					                <td><a href="../employee/emp_detail?id_emp=<?php echo $data->id_emp;?>">
					                	<?php echo $data->emp_name;?>
					                </td>
					                <td><?php echo $data->dept_name;?></td>
					                <td><?php echo $data->grade_name;?></td>
					                <td align="center">
					                	<!-- <a class="btn_link"
					                	id="no_radius" href="?update_team_detail=true&team_id=<?php echo $data->team_id;?>&team_detail_id=<?php echo $data->team_detail_id;?>">
					                	EDIT</a>
					                	| -->
					                	<a class="btn_link"
					                	id="no_radius" href="?del_team_detail=true&team_id=<?php echo $data->team_id;?>&team_detail_id=<?php echo $data->team_detail_id;?>" onclick="return confirm('Hapus data?')">
					                	DELETE</a>
					                </td>
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