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
<h5 class="page_title"> Ubah Data Karyawan
</h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">

			<div class="row">
			<div class="col-md-8">
			<div class="content">
				<span class="right">
					<a class="btn btn-danger" id="no_radius" href="../employee/emp"> <i class="fa fa-close"></i></a>
				</span>
				<!-- <table id="tabel_howto" width="100%"> -->
				<h4><b>Data Diri</b></h4>
				<hr>
				<form method="post" enctype="multipart/form-data">
				<table id="add_new" class="cell-border" cellspacing="0" width="100%">
					<tr>
			        	<td width="49%">
				        	<label> NIK </label><br>
				        	<input type="text" name="id" class="form-control" id="no_radius" value="<?php echo $id->id_emp;?>">
			        	</td>
			        	<td>&nbsp;</td>
			        	<td>
				        	<label> ID KTP / SIM </label><br>
				        	<input type="text" name="id_ktp" class="form-control" id="no_radius" value="<?php echo $id->emp_idktp;?>">
			        	</td>
			        </tr>
					<tr>
			        	<td>
				        	<label> No ID Absensi <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input type="text" name="no_id" class="form-control" id="no_radius" placeholder="No ID Absensi" value="<?php echo $id->no_id;?>" required="">
			        	</td>
			        	<td>&nbsp;</td>
			        	<td>
				        	<label> Atasan Langsung <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<select name="emp_atasan" class="form-control" id="no_radius" required="">
				        		<option value="<?php echo $id->emp_atasan;?>">
				        			<?php echo $id->emp_atasan?></option>
				        		@foreach( $atasan as $emp_atasan )
	                            <option value="<?php echo $emp_atasan->id_emp;?>"><?php echo $emp_atasan->emp_name;?></option>
	                            @endforeach
				        	</select>
			        	</td>
			        </tr>
			        <tr>
			        	<td>
				        	<label> Nama Karyawan </label><br>
				        	<input type="text" name="nama" class="form-control" id="no_radius" value="<?php echo $id->emp_name;?>">
			        	</td>
			        	<td></td>
			        	<td>
				        	<label> Nomer Telephone </label><br>
				        	<input type="text" name="telepon" class="form-control" id="no_radius" value="<?php echo $id->emp_phone_no;?>">
			        	</td>
			        </tr>
			        </tr>
			        	<td>
				        	<label> Tempat Lahir </label><br>
				        	<input type="text" name="tempat_lahir" class="form-control" id="no_radius" value="<?php echo $id->emp_placebirth;?>">
			        	</td>
			        	<td></td>
			        	<td>
				        	<label> Tanggal Lahir </label><br>
				        	<input type="date" name="tgl_lahir" class="form-control" id="no_radius" value="<?php echo $id->emp_datebirth;?>">
			        	</td>
			        </tr>
			        <tr>
			        	<td>
				        	<label> Kewarganegaraan </label><br>
				        	<select name="emp_region" class="form-control" id="no_radius" required="">
				        		<option value="<?php echo $id->emp_region;?>"><?php echo $id->emp_region;?></option>
				        		<option>- Pilih Kewarganegaraan -</option>
	                            <option value="Indonesia">Indonesia</option>
	                            <option value="China">China</option>
	                            <option value="Japan">Jepang</option>
	                            <option value="Other">Lainnya</option>
				        	</select>
			        	</td>
			        	<td></td>
			        	<td>
				        	<label> Alamat Email </label><br>
				        	<input type="email" name="email" class="form-control" id="no_radius" value="<?php echo $id->emp_email;?>">
			        	</td>
			        </tr>
			        <tr>
			        	<td>
				        	<label> Alamat </label><br>
				        	<input type="text" name="alamat" class="form-control" id="no_radius" value="<?php echo $id->emp_address;?>">
			        	</td>
			        	<td colspan="2"> &nbsp;</td>
			        </tr>
			    </table>&nbsp;
				<h4><b>Infomasi Tambahan</b></h4>
			    <hr>
			    <table id="add_new" class="cell-border" cellspacing="" width="100%">
			        <tr>
			        	<td>
							<label> Departemen </label><br>
				        	<select name="id_dept" class="form-control" id="no_radius" required="">
				        		@foreach($department as $dept)
				        		<option {{ $id->id_dept == $dept->id_dept ? 'selected' : '' }} value="{{$dept->id_dept}}"> {{$dept->dept_name}} </option>
				        		@endforeach
				        	</select>
			        	</td>
			        	<td>&nbsp;</td>
			        	<td width="50%">
				        	<label> Jabatan </label><br>
				        	<select name="grade" class="form-control" id="no_radius" required="">
				        		@foreach( $grade as $grade )
				        		<option {{ $id->id_grade == $grade->id_grade ? 'selected' : '' }} value="{{$grade->id_grade}}"> {{$grade->grade_name}} </option>
				        		@endforeach
				        	</select>
			        	</td>
			        </tr>

			        <tr>
			        	<td width="50%">
				        	<label> Seksi <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<select name="id_section" class="form-control" id="no_radius" required="">
				        		@foreach( $section as $section )
				        		<option {{ $id->id_section == $section->id_section ? 'selected' : '' }} value="{{$section->id_section}}"> {{$section->section_name}} </option>
				        		@endforeach
				        	</select>
			        	</td>
			        	<td colspan="2"> &nbsp;</td>
			        </tr>
			        <tr>
			        	<td>
				        	<label> Status </label><br>
				        	<select name="status" class="form-control" id="no_radius" required="">
	                            <option {{ $id->emp_status == 'Probation' ? 'selected' : '' }} value="Probation">Probation</option>
	                            <option {{ $id->emp_status == 'Contract' ? 'selected' : '' }} value="Contract">Contract</option>
	                            <option {{ $id->emp_status == 'Permanent' ? 'selected' : '' }} value="Permanent">Permanent</option>
								<option {{ $id->emp_status == 'Outsourching' ? 'selected' : '' }} value="Outsourching">Outsourching</option>
				        	</select>
			        	</td>
			        	<td></td>
			        	<td>
				        	<label> Tanggal Bergabung </label><br>
				        	<input type="date" name="tgl_join" class="form-control" id="no_radius" value="<?php echo $id->emp_join_date;?>">
			        	</td>
			        </tr>
				
			    </table>
				<table id="edit" class="cell-border" cellspacing="" width="100%">
					<tr>
						<td align="right">
							
			        		<label> &nbsp; </label><br>
							<button class="btn btn-primary" id="no_radius" type="submit" name="update" id="submit"> <i class="fa fa-pencil icon_left"></i> Update</button>
						</td>
					</tr>
				</table>
			</form>

			</div><!-- end content -->
			</div>
			<div class="col-md-4">
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