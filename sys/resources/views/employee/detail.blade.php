@extends('dashboard')

@section('title')
	Employee - Detail
@stop

@section('breadcrumb')
	<span class="small"> Employee - Detail </span>
@stop

@section('content')
<section id="konten">
<div class="container">
<h5 align="" class="page_title"> Detail Employee Data
</h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">

			<div class="row">


			<div class="col-md-10">
			<div class="content">
				<div class="dropdown">
				  <button class="btn btn-primary btn-sm dropdown-toggle" id="no_radius" type="button" data-toggle="dropdown">
				  	<i class="fa fa-bars"></i>
				  </button>
				  <ul class="dropdown-menu drop_view">
				    <li><a href="emp_print.php?id_emp=<?php echo @$_GET['id_emp'];?>" target="_blank"><i class="fa fa-print icon_left"></i> Print</a></li>
				    <li><a href="../contract/contract?add=true&id_emp=<?php echo @$_GET['id_emp']?>"><i class="fa fa-grav icon_left"></i> Update Contract Status</a></li>
				    <li><a href="../promosi/promosi?add_update=true&id_emp=<?php echo @$_GET['id_emp'];?>"><i class="fa fa-gavel icon_left"></i> Promotion Update</a></li>
				    <li><a href="../mutasi/mutasi?add2=true&id_emp=<?php echo @$_GET['id_emp'];?>"><i class="fa fa-repeat icon_left"></i> Mutasi (Department) </a></li>
				    <li><a href="personal?update=true&id_emp=<?php echo @$_GET['id_emp'];?>"><i class="fa fa-pencil icon_left"></i> Update Personal Info</a></li>
				    <li><a href="exp?id_emp=<?php echo @$_GET['id_emp'];?>"><i class="fa fa-line-chart icon_left"></i> Experiences</a></li>
				    <li><a href="resign?add=true&id_emp=<?php echo @$_GET['id_emp'];?>"><i class="fa fa-link icon_left"></i> Resignation</a></li>

				  </ul>
				</div>

				<span class="right" style="margin-top: -20px;">
					<a class="btn btn-warning btn-sm" id="no_radius" href="emp?update=true&id_emp=<?php echo @$_GET['id_emp'];?>" style="position: relative; z-index: 10;" title="Edit Data Employee"><i class="fa fa-pencil"></i>
					</a>
					<a class="btn btn-default btn-sm" id="no_radius" onclick="history.go(-1);" style="position: relative; z-index: 10;" title="Close Menu">
						<i class="fa fa-close"></i>
					</a>
				</span>

						<div class="box-body">
				            <?php 
				            if (@$_GET['input']=='sukses') { ?>
				              <div class="">
				                <br>
				                <div class="alert alert-success fade in warning_msg">
				                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                  <i class="fa fa-check icon_left"></i> Photo berhasil di Tambah...
				                </div>
				              </div>
				            <?php } ?>
				            <?php 
				            if (@$_GET['rubah']=='sukses') { ?>
				              <div class="">
				                <br>
				                <div class="alert alert-warning fade in warning_msg">
				                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                  <i class="fa fa-check icon_left"></i> Photo berhasil di Update...
				                </div>
				              </div>
				            <?php } ?>
				            <?php 
				            if (@$_GET['rubah']=='gagal') { ?>
				              <div class="">
				                <br>
				                <div class="alert alert-danger fade in warning_msg">
				                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                  <i class="fa fa-trash icon_left"></i> Photo Gagal di Update...
				                </div>
				              </div>
				            <?php } ?>
				        </div>

				<hr>
				<!-- <h5>
					<b>Personal Indentity</b></h5>
				<hr>  -->

					<div class="row">
						<div class="col-md-12">
							<h4 class="emp_name_detail"><?php echo $employee->emp_name;?> ( <?php echo $employee->id_emp;?> )</h4>
						</div>

						<div class="col-md-4">
							<br>
							<img class="" src="{{asset('images/upload/'.$employee->emp_photo)}}?v=<?php echo $employee->emp_photo_v;?>"
							style="width: 100%; box-shadow: 1px 1px 4px 4px rgba(1,1,1,0.1) ">
							<a style="position: absolute; bottom: 0px; left: 15px; border-radius: 0px"
							 href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_edit_<?php echo $employee->id_emp;?>">
								<i class="fa fa-pencil icon_left"></i>Ganti Foto
							</a>

							<div id="modal_edit_<?php echo $employee->id_emp;?>" class="modal fade" role="dialog">
		                      	<div class="modal-dialog" >
		                        	<div class="modal-content" style="border-radius: 0px; margin-top: 250px;">
			                          	<div class="modal-body">
									  		<form method="POST" enctype="multipart/form-data" action="{{route('employee.ganti_foto')}}">
									  			{{csrf_field()}}
									  			<input type="hidden" name="id_emp" value="{{$employee->id_emp}}">
										  		<table id="add_new" class="cell-border" cellspacing="" width="100%">
						                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						                              	<span aria-hidden="true">&times;</span>
						                          	</button>
			                            			<h4 class="modal-title" style="border-bottom: 1px solid rgba(1,1,1,0.1); padding-bottom: 5px">Edit Photo Karyawan</h4>
											        <tr>
											        	<td width="100%">
											        		<input type="hidden" id="no_radius" name="emp_photo_v" class="form-control" value="<?php echo $employee->emp_photo_v;?>">

												        	<input required="" type="file" name="emp_photo" class="form-control" id="photo">

															<p id="error1" style="display:none; color:#FF0000;">
																Invalid Image Format! Image Format Must Be JPG, JPEG, PNG, GIF or BMP.
															</p>
															<p id="error2" style="display:none; color:#FF0000;">
																Maximum File Size Limit is 1MB.
															</p>
											        	</td>	
													</tr>			
											    	<br>
												    <tr>
						                                 <td align="right">
						                                    <label></label><br>
						                                    <button type="submit" id="submit" name="ganti_photo" class="btn btn-sm btn-primary flat" style="border-radius: 0px">
						                                    <i class="fa fa-check icon_left"></i> Update
						                                    </button>
						                                 </td>
					                                </tr>
                              					</table>
									  		</form>
										</div>
									</div>
								</div>

								<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
								<!-- INPUT photo  -->
								<script>
									$('input[type="submit"]').prop("disabled", true);
									var a=0;
									//binds to onchange event of your input field
									$('#photo').bind('change', function() {
									if ($('button:submit').attr('disabled',false)){
									  $('button:submit').attr('disabled',true);
									  }
									var ext = $('#photo').val().split('.').pop().toLowerCase();
									if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
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
									    $('button:submit').attr('disabled',false);
									    }
									}
									});
								</script>
				        	</div>
						</div>
						<div class="col-md-8">
							<br>

							<table class="table_emp_view">
								<tr>
									<td width="30%"> Department / Section </td><td>:</td>
									<td>
										<?php echo @$employee->department->dept_name ?> / 
										<?php echo @$employee->section->section_name ?>
										
									</td>
								</tr>
								<tr>
									<td width="30%"> Jabatan </td><td>:</td>
									<td>
										<?php echo @$employee->grade->grade_name ?> - 
										<?php echo @$employee->section->section_name ?>
									</td>
								</tr>
								<tr>
									<td width="30%"> Jenis Kelamin </td><td>:</td>
									<td><?php echo @$employee->emp_gender ?></td>
								</tr>
								<tr>
									<td width="30%"> Tanggal Masuk </td><td>:</td>
									<td><?php echo date('d F Y', strtotime(@$employee->emp_join_date)); ?>
									</td>
								</tr>
								<tr>
									<td width="30%"> Nomor KTP </td><td>:</td>
									<td><?php echo @$employee->emp_idktp ?></td>
								</tr>
								<tr>
									<td width="30%"> Tempat/Tgl Lahir </td><td>:</td>
									<td><?php echo @$employee->emp_placebirth ?> /
										<?php echo date('d F Y', strtotime(@$employee->emp_datebirth)); ?>
								</tr>
								<tr>
									<td width="30%"> Alamat Tinggal </td><td>:</td>
									<td><?php echo @$employee->emp_address ?></td>
								</tr>
								<tr>
									<td width="30%"> Alamat di KTP </td><td>:</td>
									<td><?php echo @$employee->emp_address_ktp ?></td>
								</tr>
								<tr>
									<td width="30%"> No HP / Telp </td><td>:</td>
									<td><?php echo @$employee->emp_phone_no ?></td>
								</tr>
								<tr>
									<td width="30%"> Alamat Email </td><td>:</td>
									<td><?php echo @$employee->emp_email ?></td>
								</tr>
								<tr>
									<td width="30%"> Status Karyawan </td><td>:</td>
									<td><?php echo @$employee->emp_status ?></td>
								</tr>

								<tr>
									<td width="30%">Usia</td><td>:</td>
									<td><?php echo @$employee->usia ?> Years Old</td>
								</tr>
								<tr>
									<td width="30%"> Lama Bekerja </td><td>:</td>
									<td>{{ $lamaKerja }}</td>
								</tr>
							</table>
						</div>
					</div>


			</div><!-- end content -->
			<br>

			<div class="content">

			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" id="no_radius" href="#home">
			  	<i class="fa fa-map-o icon_left"></i> Track Record</a>
			  </li>
			  <li>
			  	<a data-toggle="tab" id="no_radius" href="#menu2"><i class="fa fa-user-circle-o icon_left"></i> Biodata Diri</a>
			  </li>
			  <li>
			  	<a data-toggle="tab" id="no_radius" href="#menu3"><i class="fa fa-line-chart icon_left"></i> Pengalaman</a>
			  </li>
			</ul>

			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active">
			  	<br>
			    <h4>Track Record</h4>
			    <hr>

			    <div class="row">
			    	<div class="col-md-2">
			    		<img src="{{asset('images/icons/bos.png')}}" style="width: 100%; padding: 10px;">
			    	</div>
			    	
			    	@foreach( $atasan as $at )
			    	<div class="col-md-10">
			    		<h5 class=""> Atasan Langsung </h5>
			    		<h2 style="font-weight: bold"> 
			    			<?php echo $at->atasan; ?> 
			    		</h2>
			    	</div>
			    	@endforeach

			    </div>
			    <hr>

			    <div class="row">
			    	<div class="col-md-2">
			    		<img src="{{asset('images/icons/dept2.png')}}" style="width: 100%; padding: 10px;">
			    	</div>
			    	<div class="col-md-10">
			    		<h5 class=""> Perpindahan Department (Mutasi) </h5>
			    		<table id="table_emp_view2">
					    	<thead>
					    		<tr>
					    			<th width="6%">No</th>
					    			<!-- <th>Complete Name</th> -->
					    			<th>Active Date</th>
					    			<th>Category</th>
					    			<th>Department</th>
					    			<th>Head Dept</th>
					    			<!-- <th>Active Date</th>
					    		</tr> -->
					    	</thead>
					    	<tbody>
					    		@foreach($mutasi as $no => $mutasi)
					    		<tr>
					    			<td><?php echo $no+1; ?></td>
					    			<td><?php echo $mutasi->mutasi_activedate; ?></td>
					    			<td><?php echo $mutasi->mutasi_category; ?></td>
					    			<td><?php echo $mutasi->dept_name; ?></td>
					    			<td><?php echo $mutasi->dept_head; ?></td>
					    		</tr>
					    		@endforeach
					    	</tbody>
					    </table>

			    	</div>
			    </div>


			    <hr>
			    <div class="row">
			    	<div class="col-md-2">
			    		<img src="{{asset('images/icons/grade.png')}}" style="width: 100%; padding: 10px;">
			    	</div>
			    	<div class="col-md-10">
			    		<h5 class="">Promosi / Demosi Jabatan</h5>
			    		<table id="table_emp_view2">
					    	<thead>
					    		<tr>
					    			<th width="6%">No</th>
					    			<!-- <th>Complete Name</th> -->
					    			<!-- <th>Category</th> -->
					    			<th>Promosi Sebagai</th>
					    			<th>Level</th>
					    			<th>Tgl Aktif</th>
					    		</tr>
					    	</thead>
					    	<tbody>
					    		@foreach($jabatanPromosi as $no => $jp)
					    		<tr>
					    			<td><?php echo $no+1; ?></td>
					    			<td><?php echo $jp->grade_name;?></td>
					    			<td><?php echo $jp->grade_level;?></td>
					    			<td><?php echo date('d F Y', strtotime($jp->promosi_activedate))?></td>
					    		</tr>
					    		@endforeach
					    	</tbody>
					    </table>
			    	</div>
			    </div>



			    <hr>
			    <div class="row">
			    	<div class="col-md-2">
			    		<img src="{{asset('images/icons/contract.png')}}" style="width: 100%; padding: 10px;">
			    	</div>
			    	<div class="col-md-10">
			    		<h5 class="">Kontrak & Status Karyawan </h5>
			    		<table id="table_emp_view2">
					    	<thead>
					    		<tr>
					    			<th width="6%">No</th>
					    			<!-- <th>Complete Name</th> -->
					    			<th>Contract Status</th>
					    			<th>Duration</th>
					    			<th>Start Date</th>
					    			<th>End Date</th>
					    			<!-- <th>Remarks</th> -->
					    		</tr>
					    	</thead>
					    	<tbody>
					    		@foreach($kontrak as $no => $kontraks)
				                  <tr>
				                    <td><?php echo $no+1; ?></td>
				                    <td><?php echo $kontraks->contract_status;?></td>
				                    <td>
				                    <?php
				                      if($kontraks->contract_status=='Probation')
				                        {
				                          echo $kontraks->selisih_bulan.' Months';
				                        }
				                      else if($kontraks->contract_status=='Kontrak')
				                        {echo $kontraks->selisih_tahun.' Years';}
				                      else if($kontraks->contract_status=='Karyawan Tetap')
				                          {echo "Permanent";}
				                    ?>
				                    </td>
                
					    			<td><?php echo date ('d M Y', strtotime($kontraks->contract_start_date))?></td>
					    			<td>
					    				<?php
						    				if($kontraks->contract_status!='Karyawan Tetap')
						    					{echo date ('d M Y', strtotime("$kontraks->contract_end_date"));}
						    				else {echo "-";}
					    				?>
					    			</td>
					    		</tr>
					    		@endforeach
					    	</tbody>
					    </table>
			    	</div>
			    </div>

				<!-- Punishmnet Area -->
			    <hr>
			    <div class="row">
			    	<div class="col-md-2">
			    		<img src="{{asset('images/icons/punish.png')}}" style="width: 100%; padding: 10px;">
			    	</div>
			    	<div class="col-md-10">

			    		<h5 class="">Surat Peringatan </h5>
			    		
			    		<table id="table_emp_view2">
					    	<thead>
					    		<tr>
					    			<th width="6%">No</th>
					    			<th>Complete Name</th>
					    			<th>No SP</th>
					    			<th>Title</th>

					    		</tr>
					    	</thead>
					    	<tbody>
					    		
					    		@foreach( $sp as $no => $sps )
					    		<tr>
					    			<td><?php echo $no+1; ?></td>
					    			<td><?php echo $sps->emp_name;?></td>
					    			<td>

					                	<a href="#" data-toggle="modal" data-target="#<?php echo $sps->no_sp;?>">
					                	<?php echo $sps->no_sp;?>
					                	</a>
										<!-- Modal -->
										<div id="<?php echo $sps->no_sp;?>" class="modal fade" role="dialog">
										  <div class="modal-dialog">

										    <!-- Modal content-->
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal">&times;</button>
										        <h4 class="modal-title"><?php echo $sps->emp_name;?></h4>
										      </div>
										      <div class="modal-body">
										      	<table class="table_emp_view">
												<tr>
													<td width="30%"> SP Date </td><td>:</td>
													<td><?php echo date('d F Y', strtotime($sps->sp_date));?></td>
												</tr>
												<tr>
													<td width="30%"> Title </td><td>:</td>
													<td><?php echo $sps->sp_title;?></td>
												</tr>
												<tr>
													<td width="30%"> SP Description </td><td>:</td>
													<td><?php echo $sps->sp_description;?></td>
												</tr>
												<tr>
													<td width="30%"> Punishment </td><td>:</td>
													<td><?php echo $sps->sp_punishment;?></td>
												</tr>
												<tr>
													<td width="30%"> Valid Until </td><td>:</td>
													<td><?php echo date('d F Y', strtotime($sps->sp_valid_date));?></td>
												</tr>

											</table>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      </div>
										    </div>

										  </div>
										</div>
										<!-- End Modal -->
					    			</td>
					    			<td><?php echo $sps->sp_title;?></td>
					    		</tr>
					    		@endforeach
					    	</tbody>
					    </table>
			    	</div>
			    </div>
			    <!-- END PUNISHMENT -->


			    <!-- TRAINING AREA -->
			    <hr>
			    <div class="row">
			    	<div class="col-md-2">
			    		<img src="{{asset('images/icons/exp.png')}}" style="width: 100%; padding: 10px;">
			    	</div>
			    	<div class="col-md-10">
			    		
			    		<h5 class="">Training Activity </h5>
			    		
			    		<table id="table_emp_view2">
					    	<thead>
					    		<tr>
					    			<th width="6%">No</th>
					    			<th>Training Name</th>
					    			<th>Training Date</th>
					    			<th>As</th>

					    		</tr>
					    	</thead>
					    	<tbody>
					    		
					    		@foreach($training as $no => $train)
					    		<tr>
					    			<td><?php echo @$no+1; ?></td>
					    			<td>

					                	<a href="#" data-toggle="modal" data-target="#<?php echo $train->id_training_detail;?>">
					                	<?php echo $train->training_name;?>
					                	</a>
										<!-- Modal -->
										<div id="<?php echo $train->id_training_detail;?>" class="modal fade" role="dialog">
										  <div class="modal-dialog">

										    <!-- Modal content-->
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal">&times;</button>
										        <h4 class="modal-title"><?php echo $train->training_name;?></h4>
										      </div>
										      <div class="modal-body">
										      	<table class="table_emp_view">
												<tr>
													<td width="30%"> Training Date </td><td>:</td>
													<td><?php echo date('d F Y', strtotime($train->training_date));?></td>
												</tr>
												<tr>
													<td width="30%"> Training Name </td><td>:</td>
													<td><?php echo $train->training_name;?></td>
												</tr>
												<tr>
													<td width="30%"> Trainer </td><td>:</td>
													<td><?php echo $train->training_trainer;?></td>
												</tr>
												<tr>
													<td width="30%"> Held By </td><td>:</td>
													<td><?php echo $train->training_helder;?></td>
												</tr>
												<tr>
													<td width="30%"> Location </td><td>:</td>
													<td><?php $train->training_location;?></td>
												</tr>

											</table>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      </div>
										    </div>

										  </div>
										</div>
										<!-- End Modal -->
					    			</td>
					    			<td><?php echo $train->training_date;?></td>
					    			<td><?php echo $train->training_as;?></td>
					    		</tr>
					    		@endforeach
					    	</tbody>
					    </table>
			    	</div>
			    </div>
			    <hr>
			    <!-- END TRAINING ACTIVITY -->

			  </div>

			  <!-- <div id="menu1" class="tab-pane fade">
			    <h3>PUNISHMENT & ACHIEVEMENT</h3>
			    <p>Some content in menu 1.</p>
			  </div> -->

			  <div id="menu2" class="tab-pane fade">

			    <hr><h5 class="">Personal Information</h5><hr>
			    <table class="table_emp_view">
			    	
					<tr>
						<td width="30%"> WhatsApp Number </td><td width="5%">:</td>
						<td><?php echo @$personal_information->nomor_hp_2;?></td>
					</tr>
					<tr>
						<td width="30%"> Mothers Name  </td><td width="5%">:</td>
						<td><?php echo @$personal_information->pers_mother_name;?></td>
					</tr>
					<tr>
						<td width="30%"> NPWP Number </td><td>:</td>
						<td><?php echo @$personal_information->tax_id_number;?></td>
					</tr>
					<tr>
						<td width="30%"> Bank Number </td><td>:</td>
						<td><?php echo @$personal_information->rekening;?></td>
					</tr>
					<tr>
						<td width="30%"> Blood Type </td><td>:</td>
						<td><?php echo @$personal_information->pers_blood_type;?></td>
					</tr>
					<tr>
						<td width="30%"> Last Education </td><td>:</td>
						<td><?php echo @$personal_information->pers_education;?></td>
					</tr>
					<tr>
						<td width="30%"> Education Major </td><td>:</td>
						<td><?php echo @$personal_information->pers_major;?></td>
					</tr>

				</table>
				<hr>
				<h5> Family & Marital Information </h5><hr>
				<table class="table_emp_view">

					<tr>
						<td width="30%"> Marital Status </td><td>:</td>
						<td><?php echo @$personal_information->pers_marital;?></td>
					</tr>
					<tr>
						<td width="30%"> Husband / Wife Name </td><td width="5%">:</td>
						<td><?php echo @$personal_information->pers_pasangan;?></td>
					</tr>
					<tr>
						<td width="30%"> Husband / Wife Jobs </td><td>:</td>
						<td><?php echo @$personal_information->pers_pekerjaan_pasangan;?></td>
					</tr>
					<tr>
						<td width="30%"> Child </td><td>:</td>
						<td><?php echo @$personal_information->pers_child_qty;?></td>
					</tr>
					<tr>
						<td width="30%"> Child's Name 1 </td><td>:</td>
						<td><?php echo @$personal_information->pers_anak1;?></td>
					</tr>
					<tr>
						<td width="30%"> Child's Name 2 </td><td>:</td>
						<td><?php echo @$personal_information->pers_anak2;?></td>
					</tr>
					<tr>
						<td width="30%"> Child's Name 3 </td><td>:</td>
						<td><?php echo @$personal_information->pers_anak3;?></td>
					</tr>
					<tr>
						<td width="30%"> Child's Name 4 </td><td>:</td>
						<td><?php echo @$personal_information->pers_anak4;?></td>
					</tr>
					<tr>
						<td width="30%"> Child's Name 5 </td><td>:</td>
						<td><?php echo @$personal_information->pers_anak5;?></td>
					</tr>


				</table>
				<hr><h5 class="">Additional Information of Employee</h5><hr>
			    <table class="table_emp_view">

					<tr>
						<td width="30%"> Nama Saudara</td><td width="5%">:</td>
						<td><?php echo @$personal_information->nama_saudara;?></td>
					</tr>
					<tr>
						<td width="30%"> No HP Saudara</td><td width="5%">:</td>
						<td><?php echo @$personal_information->phone_saudara;?></td>
					</tr>
					<tr>
						<td width="30%"> Alamat Saudara  </td><td width="5%">:</td>
						<td><?php echo @$personal_information->alamat_saudara;?></td>
					</tr>
					<tr>
						<td width="30%"> Hubungan Saudara </td><td>:</td>
						<td><?php echo @$personal_information->hubungan_saudara;?></td>
					</tr>

				</table>

			  </div>
			  <div id="menu3" class="tab-pane fade">
			    <h5>Work Experiences</h5>
			    <hr>
			    <div class="row">
			    	<div class="col-md-2">
			    		<img src="{{asset('images/icons/exp.png')}}" style="width: 100%; padding: 10px;">
			    	</div>
			    	<div class="col-md-10">
			    		<h5 class="">Working Experiences </h5>
			    		<table id="table_emp_view2">
					    	<thead>
					    		<tr>
					    			<th width="6%">No</th>
					    			<th>Company Name</th>
					    			<th>Start Date</th>
					    			<th>End Date</th>
					    			<th>Position</th>
					    			<th>Category</th>
					    		</tr>
					    	</thead>
					    	<tbody>
					    		@foreach( $work_experience as $no => $we )
					    		<tr>
					    			<td><?php echo $no+1; ?></td>
					    			<td>
										<a href="#" data-toggle="modal" data-target="#<?php echo $we->id_experience;?>">
					                	<?php echo $we->exp_company_name;?>
					                	</a>
										<!-- Modal -->
										<div id="<?php echo $we->id_experience;?>" class="modal fade" role="dialog">
										  <div class="modal-dialog">

										    <!-- Modal content-->
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal">&times;</button>
										        <h4 class="modal-title"><?php echo $we->emp_name;?></h4>
										      </div>
										      <div class="modal-body">
										      	<table class="table_emp_view">
												<tr>
													<td width="30%"> Company Name </td><td>:</td>
													<td><?php echo $we->exp_company_name;?></td>
												</tr>
												<tr>
													<td width="30%"> Start Work </td><td>:</td>
													<td>
														<?php echo date('d F Y', strtotime($we->exp_start_date));?>
													</td>
												</tr>
												<tr>
													<td width="30%"> End Work </td><td>:</td>
													<td>
														<?php echo date('d F Y', strtotime($we->exp_end_date));?>
													</td>
												</tr>
												<tr>
													<td width="30%"> Bussiness Sector </td><td>:</td>
													<td><?php echo $we->exp_bussiness_type;?></td>
												</tr>
												<tr>
													<td width="30%"> Location </td><td>:</td>
													<td><?php echo $we->exp_region;?></td>
												</tr>
												<tr>
													<td width="30%"> Reason of Quit </td><td>:</td>
													<td><?php echo $we->exp_quit_reason;?></td>
												</tr>
												<tr>
													<td width="30%"> Job Description </td><td>:</td>
													<td><?php echo $we->exp_jobdesc;?></td>
												</tr>

											</table>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-default btn-sm" id="no_radius" data-dismiss="modal">Close</button>
										      </div>
										    </div>

										  </div>
										</div>
										<!-- End Modal -->

					    			</td>
					    			<td><?php echo $we->exp_start_date;?></td>
					    			<td><?php echo $we->exp_end_date;?></td>
					    			<td><?php echo $we->exp_last_position;?></td>
					    			<td><?php echo $we->exp_bussiness_type;?></td>
					    		</tr>
					    		@endforeach
					    	</tbody>
					    </table>
			    	</div>
			    </div>
			    <hr>
			  </div>
			</div>


			</div>

			</div>
			<div class="col-md-2">

			</div>
			</div> <!-- end Row -->


		</div> <!-- end main_area -->
	</div> <!-- end container -->
</section>
@stop