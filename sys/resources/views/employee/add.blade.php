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
<h5 class="page_title"> Input Data Karyawan
</h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">

			<div class="row">
			<div class="col-md-8">
			<div class="content">
				<span class="right">
					<a class="btn btn-danger" id="no_radius" href="{{ route('employee.index') }}"> <i class="fa fa-close"></i></a>
				</span>
				<h4><b>Data Diri</b></h4>
				<hr>
				<form action="{{route('employee.save')}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<table id="add_new" class="cell-border" cellspacing="" width="100%">
					<tr>
			        	<td width="49%">
				        	<label> NIK <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input type="text" name="id" class="form-control" id="no_radius" placeholder="No Induk Karyawan" required="">
			        	</td>
			        	<td>&nbsp;</td>
			        	<td>
				        	<label> ID KTP / SIM <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input type="number" maxlength="17" name="id_ktp" class="form-control" id="no_radius" placeholder="ID / Tanda Pengenal" required="">
			        	</td>
			        </tr>
					<tr>
			        	<td>
				        	<label> No ID Absensi <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input type="text" name="no_id" class="form-control" id="no_radius" placeholder="No ID Absensi" required="">
			        	</td>
			        	<td>&nbsp;</td>
			        	<td>
				        	<label> Atasan Langsung <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<select name="emp_atasan" class="form-control" id="no_radius" required="">
				        		<option>- Pilih Atasan Langsung -</option>
				        		@foreach( $atasanLangsung as $data )
				        		<option value="{{$data->id_emp}}"> {{ $data->emp_name }} </option>
				        		@endforeach
				        	</select>
			        	</td>
			        </tr>
			        <tr>
			        	<td>
				        	<label> Nama Karyawan <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input type="text" name="nama" class="form-control" id="no_radius" placeholder="Nama Lengkap Karyawan" required="">
			        	</td>
			        	<td></td>
			        	<td>
				        	<label> Nomer Telepon <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input type="number" name="telepon" class="form-control" id="no_radius" placeholder="08xxxxxxxx">
			        	</td>
			        </tr>
			        </tr>
			        	<td>
				        	<label> Tempat Lahir <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input type="text" name="tempat_lahir" class="form-control" id="no_radius" placeholder="Kota / Tempat Lahir">
			        	</td>
			        	<td></td>
			        	<td>
				        	<label> Tanggal Lahir <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input type="date" name="tgl_lahir" class="form-control" id="no_radius">
			        	</td>
			        </tr>
			        <tr>
			        	<td>
				        	<label> Alamat Email </label><br>
				        	<input type="email" name="email" class="form-control" id="no_radius" placeholder="example@xdsakti.com">
			        	</td>
			        	<td></td>
			        	<td>
				        	<label> Jenis Kelamin <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<select name="emp_gender" class="form-control" id="no_radius" required="">
				        		<option>- Pilih Jenis Kelamin -</option>
	                            <option value="Male">Laki - Laki</option>
	                            <option value="Female">Perempuan</option>
				        	</select>
			        	</td>
			        </tr>
			        <tr>
			        	<td colspan="3">
				        	<label> Alamat <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input type="text" name="alamat" class="form-control" id="no_radius" placeholder="Alamat Tempat Tinggal / Domisili">
			        	</td>
			        </tr>
			        <tr>
			        	<td>
				        	<label> Kewarganegaraan </label><br>
				        	<select name="emp_region" class="form-control" id="no_radius" required="">
				        		<option>- Pilih Kewarganegaraan -</option>
	                            <option value="Indonesia">Indonesia</option>
	                            <option value="China">China</option>
	                            <option value="Japan">Jepang</option>
	                            <option value="Other">Lainnya</option>
				        	</select>
			        	</td>
			        	<td></td>
			        	<td>
				        	<label> Bussines Core <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<select name="emp_main_cat" class="form-control" id="no_radius" required="">
				        		<option>- Pilih Bussines Core -</option>
	                            <option value="Direct">Direct</option>
	                            <option value="Indirect">Indirect</option>
	                            <option value="General Administration">General Administration</option>
	                            <option value="Commercial">Commercial</option>
				        	</select>
			        	</td>
			        </tr>
			    </table>

			    <br>
				<h4><b>Pas Foto</b></h4>
			    <hr>
			    <table id="add_new" class="cell-border" cellspacing="" width="100%">
			        <tr>
			        	<td width="100%">
				        	<label> Upload Foto <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input required="" type="file" name="emp_photo" class="form-control" id="picture">
			        	</td>
					</tr>
				</table>
				<p id="error1" style="display:none; color:#FF0000;">
					Format Gambar Salah! Format Gambar harus JPG, JPEG, PNG, GIF atau BMP.
				</p>
				<p id="error2" style="display:none; color:#FF0000;">
					File Gambar Maximun 1 MegaByte.
				</p>				

			    <br>
				<h4><b>Posisi & Karyawan</b></h4>
			    <hr>
			    <table id="add_new" class="cell-border" cellspacing="" width="100%">
			        <tr>
			        	<td width="45%">
				        	<label> Departemen <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<select name="dept" class="form-control" id="no_radius" required="">
				        		<option> - Pilih Departemen - </option>
				        		@foreach( $dept as $data )
				        		<option value="{{$data->id_dept}}"> {{ $data->dept_name }} </option>
				        		@endforeach
				        	</select>
			        	</td>
			        	<td>&nbsp;</td>
			        	<td width="50%">
				        	<label> Seksi <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<select name="id_section" class="form-control" id="no_radius" required="">
				        		<option> - Pilih Section - </option>
				        		@foreach( $section as $data )
				        		<option value="{{$data->id_section}}"> {{ $data->section_name }} </option>
				        		@endforeach
				        	</select>
			        	</td>
			        </tr>
			        <tr>
			        	<td width="50%">
				        	<label> Sub Seksi <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<select name="id_subsection" class="form-control" id="no_radius" required="">
				        		<option> - Pilih Sub Seksi - </option>
				        		@foreach( $subSection as $data )
				        		<option value="{{$data->id_subsection}}"> {{ $data->subsection_name }} </option>
				        		@endforeach
				        	</select>
			        	</td>
			        	<td>
				        	&nbsp;
			        	</td>
			        	<td width="50%">
				        	<label> Jabatan <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<select name="grade" class="form-control" id="no_radius" required="" >
				        		<option> - Pilih Jabatan - </option>
				        		@foreach( $grade as $data )
				        		<option value="{{$data->id_grade}}"> {{ $data->grade_name }} </option>
				        		@endforeach
				        	</select>
			        	</td>
			        </tr>
				</table>

				<br>
				<h4><b>Status & Kontrak</b></h4>
			    <hr>
			    <table id="add_new" class="cell-border" cellspacing="" width="100%">
			    	<tr>
			        	<td width="50%">
				        	<label> Status </label><br>
				        	<select name="status" class="form-control" id="no_radius" required="">
				        		<option>- Pilih Status -</option>
	                            <option value="Probation">		Probation</option>
	                            <option value="Contract">		Contract</option>
	                            <option value="Permanent">		Permanent</option>
	                            <option value="Outsourcing">	Outsourcing</option>
				        	</select>
			        	</td>
			        	<td>
				        	&nbsp;
			        	</td>
			        	<td>
				        	&nbsp;
			        	</td>
			        </tr>
			        <tr>
			        	<td width="50%">
				        	<label> Tanggal Masuk <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input type="date" name="tgl_join" class="form-control" id="no_radius" required="">
			        	</td>
			        	<td>
				        	&nbsp;
			        	</td>
			        	<td>
				        	<label> Tanggal Berakhir Kontrak <span style="color: red; text-align: right;">(*)</span></label><br>
				        	<input type="date" name="emp_contract_end_date" class="form-control" id="no_radius" required="">
			        	</td>
			        </tr>

			        <tr>
			        	<td colspan="3">
				        	<label> Keterangan Kontrak</label><br>
				        	<select name="emp_contract_remarks" class="form-control" id="no_radius" required="" placeholder="Contract Notes">
				        		<option value="">- Pilih Keterangan Kontrak -</option>
				        		<option value="Probation"> Probation</option>
				        		<option value="Contract 1"> Contract 1 </option>
				        		<option value="Contract 2"> Contract 2 </option>
				        		<option value="Permanent"> Permanent </option>
				        	</select>
			        	</td>
			        </tr>
			        <tr>
			        	<td>
			        		<label> &nbsp; </label><br>
			        		<button class="btn btn-success" id="no_radius" type="submit" name="save" id="submit">
			        		<i class="fa fa-save icon_left"></i> Simpan</button>
			        		<a class="btn btn-default" id="no_radius" href="emp"><i class="fa fa-close icon_left"></i> Batal </a>
			        	</td>
			        </tr>
				</table>

				</form>
				<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
					<script>
					$('input[type="submit"]').prop("disabled", true);
					var a=0;
					//binds to onchange event of your input field
					$('#picture').bind('change', function() {
					if ($('input:submit').attr('disabled',false)){
						$('input:submit').attr('disabled',true);
						}
					var ext = $('#picture').val().split('.').pop().toLowerCase();
					if ($.inArray(ext, ['gif','png','jpg','jpeg','JPG','bmp']) == -1){
						$('#error1').slideDown("slow");
						$('#error2').slideUp("slow");
						a=0;
						}else{
						var picsize = (this.files[0].size);
						if (picsize > 1000000){
						$('#error2').slideDown("slow");
						a=0;
						}else{
						a=1;
						$('#error2').slideUp("slow");
						}
						$('#error1').slideUp("slow");
						if (a==1){
							$('input:submit').attr('disabled',false);
							}
					}
					});
					</script>
				<hr>
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