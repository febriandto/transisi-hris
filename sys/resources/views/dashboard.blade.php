<?php

@$route_name = \Request::route()->getName();
@$route_name = str_replace(['.', '_'], ' ', str_replace(["index", "show"], "", @$route_name));

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>GROWTH - HRIS | Manage you human Resource</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('images/icon2.png') }}">
	<!-- fontawsome icon -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- main css -->
	<link rel="stylesheet" href="{{asset('css/hris/main.css')}}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{asset('css/hris/animate.css')}}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{asset('css/hris/bootstrap.min.css')}}">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900" rel="stylesheet">
</head>

<!-- custom css -->
<style type="text/css">
	@media (min-width: 992px) {

		.sidebar-mini.sidebar-collapse .main-sidebar,
		.sidebar-mini.sidebar-collapse .main-sidebar::before {

			margin-left: 0;

			width: 4.2rem;

		}

	}
</style>

<body style="background-color: rgba(1,1,1,0.1); font-family: 'Roboto', sans-serif;">

	<nav class="navbar navbar-default" id="main_menu" style="border-radius: 0px;">
	  <div class="container-fluid container">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a style="border-right: 1px solid rgba(1,1,1,0.1)" class="navbar-brand" href="../dashboard/dashboard"><img src="{{asset('images/icon2.png')}}" height="25"></a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">

	        <li id="<?php if(@$page == 'dashboard'){echo 'active';}?>"><a href="../dashboard/dashboard"><i class="fa fa-tachometer icon_left"></i> Dashboard</a></li>
	        <li class="dropdown" id="<?php if(@$page == 'emp'){echo 'active';}?>">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o icon_left"></i> Pelayanan HR &nbsp; <i class="fa fa-angle-down"></i></a>
	          <ul class="dropdown-menu wide">
	          <div class="row">
	          <div class="col-md-6 drop_space">
	            <h5> Umum </h5>
	            <li style="border-right: none;"><a href="../employee/emp"><i class="fa fa-user-circle-o icon_left"></i> Data Karyawan</a></li>
	            <li style="border-right: none;"><a href="../acc_emp/acc_emp"><i class="fa fa-anchor icon_left"></i> Kecelakaan Karyawan</a></li>
	            <li style="border-right: none;"><a href="../contract/contract"><i class="fa fa-file-archive-o icon_left"></i> Kontrak & Updates</a></li>
	            <li style="border-right: none;"><a href="../employee/resign"><i class="fa fa fa-paw icon_left"></i> Resign</a></li>
	            <li style="border-right: none;"><a href="../team/team_view"><i class="fa fa fa-users icon_left"></i> Tim Karyawan</a></li>

	            <br>
	            <h5> BPJS Area </h5>
	            <li style="border-right: none;"><a href="../bpjs/bpjs"><i class="fa fa-file-archive-o icon_left"></i> BPJS TK & JHT Karyawan</a></li>
	            <li style="border-right: none;"><a href="../bpjs_kes/bpjs_kes"><i class="fa fa-file-archive-o icon_left"></i> BPJS Ketenagakerjaan</a></li>
	          </div>

	          <div class="col-md-6 drop_space">
	            <h5> Transaksi </h5>
	            <li style="border-right: none;"><a href="../sp/sp"><i class="fa fa-warning icon_left"></i> Surat Peringatan </a></li>
	            <li style="border-right: none;"><a href="../mutasi/mutasi"><i class="fa fa-exchange icon_left"></i> Mutasi </a></li>
	            <li style="border-right: none;"><a href="../promosi/promosi"><i class="fa fa-chevron-right icon_left"></i> Promosi / Demosi</a></li>  
	            <li style="border-right: none;"><a href="../post/post"><i class="fa fa-chevron-right icon_left"></i> Post Update</a></li>     
	            <br>
	            

	            <h5> Aturan - Aturan </h5>
	            <li style="border-right: none;"><a href="../sop/sop"><i class="fa fa-warning icon_left"></i> SOP </a></li>
	            <li style="border-right: none;"><a href="../mutasi/mutasi"><i class="fa fa-exchange icon_left"></i> Mutasi </a></li>
	            <li style="border-right: none;"><a href="../promosi/promosi"><i class="fa fa-chevron-right icon_left"></i> Promosi / Demosi</a></li>            
	          </div>
	          </div>
	          </ul>
	        </li>


	        <li class="dropdown" id="<?php if(@$page == 'performance'){echo 'active';}?>">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bookmark-o icon_left"></i> Performa &nbsp; <i class="fa fa-angle-down"></i>
	          <ul class="dropdown-menu wide">
	          <div class="row">
	          <div class="col-md-6 drop_space">
	            <h5> Umum </h5>
	            <li style="border-right: none;"><a style="margin-left: -20px;" href="../training/training"><i class="fa fa-warning icon_left"></i> Pelatihan</a></li>
	            <li style="border-right: none;"><a href="../dept/dept_comp"><i class="fa fa-window-restore icon_left"></i> Kompetensi Departemen</a></li>
	            <li style="border-right: none;"><a href="../jobdesc/jobdesc"><i class="fa fa-server icon_left"></i> Job Desk</a></li>
	            <li style="border-right: none;"><a href="../org/org"><i class="fa fa-sitemap icon_left"></i> Organisation Chart</a></li>
	          </div>

	          <div class="col-md-6 drop_space">
	            <h5> Performa </h5>
	            <li style="border-right: none;"><a href="../performance/pa_staff"><i class="fa fa-warning icon_left"></i> PA Staff </a></li>
	            <li style="border-right: none;"><a href="../performance/pa_op"><i class="fa fa-exchange icon_left"></i> PA Operator </a></li>
	            <!-- <li style="border-right: none;"><a href="../performance/performance"><i class="fa fa-exchange icon_left"></i> KPI (Key Performance) </a></li> -->
	          </div>
	          </div>
	          </ul>
	        </li>

	        <li class="dropdown" id="<?php if(@$page == 'attendance'){echo 'active';}?>">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-street-view icon_left"></i> Absensi &nbsp; <i class="fa fa-angle-down"></i></a>

	          <ul class="dropdown-menu wide">
	          <div class="row">
	          <div class="col-md-6 drop_space">
	            <h5> ABSENSI FINGER </h5>
	            <li><a href="../attendance/daily?date_choosen=<?php echo date('Y-m-d');?>"><i class="fa fa-retweet icon_left"></i>Absensi Harian</a></li>
	            <li style="border-right: none;"><a href="../attendance/monthly?year=<?php echo date('Y');?>&month=<?php echo date('m');?>"><i class="fa fa-retweet icon_left"></i>Absensi Bulanan</a></li>
	            <li style="border-right: none;"><a href="../attendance/summary?start_date=<?php echo date('Y-m-01');?>&end_date=<?php echo date('Y-m-31');?>"><i class="fa fa-server icon_left"></i> Laporan Absensi</a></li>
	            <li style="border-right: none;"><a href="../attendance/resume"><i class="fa fa-server icon_left"></i> Absen Perorangan </a></li>
	            <br>

	            <h5> ABSENSI ONLINE  </h5>
	            <li style="border-right: none;"><a href="../absen_online/absen_online_harian?date_choosen=<?php echo @$today;?>">
	              <i class="fa fa-retweet icon_left"></i>Absensi Harian</a>
	            </li>
	            <li style="border-right: none;"><a href="../absen_online/absen_online_bulanan?month_choosen=<?php echo date('Y-m');?>">
	              <i class="fa fa-retweet icon_left"></i>Absensi Bulanan</a>
	            </li>
	            <li style="border-right: none;"><a href="#../absen_online/summary?start_date=<?php echo date('Y-m-01');?>&end_date=<?php echo date('Y-m-31');?>">
	              <i class="fa fa-server icon_left"></i> Laporan Absensi</a>
	            </li>
	            <li style="border-right: none;"><a href="#../absen_online/resume">
	              <i class="fa fa-server icon_left"></i> Absen Perorangan </a>
	            </li>
	            <!-- <li style="border-right: none;"><a href="../absen_online/absen_online_user">
	              <i class="fa fa-user icon_left"></i> Pengguna Absensi Online </a>
	            </li> -->
	            <!-- <br>
	            <h5> Over Time </h5>
	            <li style="border-right: none;"><a href="../attendance/daily?date_choosen=<?php echo date('Y-m-d');?>"><i class="fa fa-ticket icon_left"></i> SPL </a></li>
	            <li style="border-right: none;"><a href="../attendance/monthly"><i class="fa fa-sliders icon_left"></i>Overtime Log</a>
	            </li>
	            <li style="border-right: none;"><a href="../jobdesc/jobdesc"><i class="fa-search-plus icon_left"></i>Overtime Review</a></li> -->
	          </div>

	          <div class="col-md-6 drop_space">
	            <h5> Manajemen Ijin </h5>
	            <li><a href="../cuti/m_cuti"><i class="fa fa-th icon_left"></i>Master Cuti Tahunan</a></li>

	            <li><a href="../cuti/cuti_khusus"><i class="fa fa-th icon_left"></i>Master Cuti Khusus</a></li>
	            <li><a href="../cuti/m_cuti_special"><i class="fa fa-th icon_left"></i>Master Cuti Spesial</a></li>
	            <li style="border-right: none;"><a href="../attendance/cuti"><i class="fa fa-minus-square icon_left"></i>List Pemakaian Cuti</a></li>
	            <li style="border-right: none;"><a href="../cuti/cuti_info"><i class="fa fa-coffee icon_left"></i>Info Seputar Cuti</a></li>

	            <br>
	            <h5> Management Ijin  </h5>
	            <li style="border-right: none;"><a href="../ijin/ijin"><i class="fa fa-user icon_left">     </i>Data Ijin</a></li>
	            <li style="border-right: none;"><a href="../ijin/ijin_cat"><i class="fa fa-exchange icon_left">   </i>Kategori Ijin</a></li>

	            
	          </div>
	          </div>
	          </ul>
	        </li>

	        <li class="dropdown" id="<?php if(@$page == 'payroll'){echo 'active';}?>">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa fa-object-group icon_left"></i> Penggajian <span class="caret"></span></a>
	          <ul class="dropdown-menu wide">
	          <div class="row">
	          <div class="col-md-6 drop_space">
	            <h5> Employment </h5>
	            <li><a href="#../training/training"><i class="fa fa-retweet icon_left"></i> Employee List</a></li>
	            <li><a href="#../dept/dept_comp"><i class="fa fa-server icon_left"></i>     Employee Turn Over</a></li>
	            <li><a href="#../jobdesc/jobdesc"><i class="fa fa-server icon_left"></i>    New Employee</a></li>
	            <li><a href="#../org/org"><i class="fa fa-file icon_left"></i>              Employee Status</a></li>
	          </div>
	          </div>
	          </ul>
	        </li>

	        <!-- <li class="dropdown" id="<?php if(@$page == 'it'){echo 'active';}?>">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa fa-window-restore icon_left"></i> Zona IT  <span class="caret"></span></a>
	          <ul class="dropdown-menu wide">
	          <div class="row">
	          <div class="col-md-6 drop_space">
	            <h5> Akses Publik  </h5>
	            <li style="border-right: none;"><a href="../it/cctv"><i class="fa fa-angle-right icon_left"></i> CCTV </a></li>
	            <li style="border-right: none;"><a href="../it/ext"><i class="fa fa-angle-right icon_left"></i> Phone Extension </a></li>
	            <li style="border-right: none;"><a href="#../training/training"><i class="fa fa-angle-right icon_left"></i> Email Account </a></li>
	            <li style="border-right: none;"><a href="#../training/training"><i class="fa fa-angle-right icon_left"></i> Wifi  </a></li>
	            <div class="divider"></div>
	            <li style="border-right: none;"><a href="../it/ts"><i class="fa fa-angle-right icon_left"></i>
	              Trouble Shooting
	            </a></li>
	            <li style="border-right: none;"><a href="../it/it_daily"><i class="fa fa-angle-right icon_left"></i>
	              Daily Activity
	            </a></li>
	          </div>

	          <div class="col-md-6 drop_space">
	            <h5> Manajemen Aset </h5>
	            <li><a href="../it/asset"><i class="fa fa-angle-right icon_left"></i> PC & Laptop </a></li>
	            <li><a href="../it/asset_other"><i class="fa fa-angle-right icon_left"></i> Printer </a></li>
	            <li><a href="../it/asset_other"><i class="fa fa-angle-right icon_left"></i> Aksesoris & Tools </a></li>
	            <li><a href="../it/asset_repair"><i class="fa fa-angle-right icon_left"></i> Asset Repair </a></li>
	          </div>
	          </div>
	          </ul>
	        </li> -->



	      </ul>
	      <ul class="nav navbar-nav navbar-right" >
	        <li><a href="#"><i class="fa fa-user-circle-o icon_left"></i> {{Auth::user()->name}} </a></li>
	        <li class="dropdown <?php if(@$page == 'menu'){echo 'active';}?>">
	          <a style="padding:18px;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	          <i class="fa fa-th"></i></a>
	          <ul class="dropdown-menu" id="menu_kanan" style="margin-right: -1px;">
	            <li style="border-right: none;"><a href="#">Todo List <span class="bolder red_text right" 
	              style="margin-top: px;"> 1 </span> </a></li>
	            
	            <li style="border-right: none;"><a href="../password/password">Ganti Password </a></li>
	            <li style="border-right: none;"><a href="#">Profile </a></li>
	            <li style="border-right: none;"><a href="../saran/saran">Kritik & Saran </a></li>
	            <li style="border-right: none;"><a href="../advance/advance"> <i class="fa fa-bars icon_left"></i> Advance Setting </a></li>
	            <li role="separator" class="divider"></li>
	            <li style="border-right: none;"><a href="../../logout"><i class="fa fa-lock icon_left"></i> Logout</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>


	@yield('content')


	<div class="container">
		<p class="light" align=""> HRIS | <?php echo date('Y')?> <span style="float:right"> <span id=tick2> </span> &nbsp;|&nbsp;
		<?php
			$date = new DateTime();
			//echo $date->format('l, jS F, Y');
			$array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
			$hr = $array_hr[date('N')];
			 /* script menentukan tanggal */   
			$tgl= date('j');
			/* script menentukan bulan */
			  $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
			  $bln = $array_bln[date('n')];
			/* script menentukan tahun */ 
			$thn = date('Y');
			echo $hr . ", " . $tgl . " " . $bln . " " . $thn; 
		?>
		</p>
	</div>


	<!-- Jquery Library -->
	<script src="{{asset('js/hris/jquery-3.1.1.min.js')}}"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="{{asset('js/hris/bootstrap.min.js')}}"></script>
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
	<script src="{{asset('js/hris/highcharts.js')}}"></script>
	<script src="{{asset('js/hris/highcharts-more.js')}}"></script>
	<script src="{{asset('js/hris/modules/exporting.js')}}"></script>
	<!-- Tiny MCE Text Area -->
	<script src="{{asset('js/hris/tinymce/tinymce.min.js')}}"></script>
	<!-- Datatable -->
	<link rel="stylesheet" href="{{asset('css/hris/datatables.min.css')}}" type="text/css" />
	<script type="text/javascript" src="{{asset('js/hris/datatables.min.js')}}"></script>

	<script>
	  @if(Session::has('message'))
	    var type = "{{ Session::get('alert-type', 'info') }}";
	    switch(type){
	        case 'info':
	            toastr.info("{{ Session::get('message') }}");
	            break;
	        
	        case 'warning':
	            toastr.warning("{{ Session::get('message') }}");
	            break;

	        case 'success':
	            toastr.success("{{ Session::get('message') }}");
	            break;

	        case 'error':
	            toastr.error("{{ Session::get('message') }}");
	            break;
	    }
	  @endif
	</script>

	<script type="text/javascript">

		@$(document).ready(function() {
		    @$('#example').DataTable()
		    .removeClass( 'display' )
		    .addClass('table table-striped table-bordered');
		    ;
		  }

		   );

		  @$(document).ready(function() {
		    @$('#example2').DataTable()
		    .removeClass( 'display' )
		    .addClass('table table-striped table-bordered');
		    ;
		  } );

		  @$(document).ready(function() {
		    @$('#example3').DataTable()
		    .removeClass( 'display' )
		    .addClass('table table-striped table-bordered');
		    ;
		  } );

		@$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': @$('meta[name="csrf-token"]').attr('content')
			}
		});

		tinymce.init({
		  //selector: 'textarea',  // change this value according to your HTML
		  selector : "textarea:not(.mceNoEditor)", // Select all textarea exluding the mceNoEditor class
		  plugins: "paste",
		  menu: {

		    file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
		    edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
		    view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
		    insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
		    format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat' },
		    tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
		    table: { title: 'Table', items: 'inserttable tableprops deletetable row column cell' },
		    help: { title: 'Help', items: 'help' }
		  }
		});

	   // For demo to fit into DataTables site builder...
	 @$('#example')
	    .removeClass( 'display' )
	    .addClass('table table-striped table-bordered');

	      // For demo to fit into DataTables site builder...
	@$('#example2')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');

	var table = @$('#example2').DataTable({
	   lengthMenu: [ [10, 25, 100, -1], [10, 25, 100, "All"] ],
	   pageLength: 10
	});

		// For demo to fit into DataTables site builder...
	@$('#example3')
		.removeClass( 'display' )
		.addClass('table table-striped table-bordered');

	var table = @$('#example').DataTable({
	   lengthMenu: [ [10, 25, 100, -1], [10, 25, 100, "All"] ],
	   pageLength: 25
	});


	@$(document).ready(function() { 

      @$('#calendar').fullCalendar({ 
         draggable: true, 
         events: "json_events.php", 
         eventDrop: function(event, delta) { 
            alert(event.title + ' was moved ' + delta + ' days\n' + 
               '(should probably update your database)'); 
         }, 
         loading: function(bool) { 
            if (bool) @$('#loading').show(); 
            else @$('#loading').hide(); 
         } 
      }); 

   });

	</script>
	@yield('script')
</body>
</html>