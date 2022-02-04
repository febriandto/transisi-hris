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
<h5 class="page_title"> Data Surat Peringatan </h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">	
			
			<div class="row">
			<div class="col-md-10">
			<div class="content">

				<a class="btn btn-sm btn-success" id="no_radius" href="{{ route('sp.add') }}"> <i class="fa fa-plus icon_left" title="Tambah Data Baru"></i> Add New </a>
				<hr>
				<!-- <table id="tabel_howto" width="100%"> -->
				<table id="example" class="cell-border table-hover table table-striped table-bordered" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th width="6%">No</th>
			                <th>SP No</th>
			                <th>SP date</th>
			                <th>SP Title</th>
			                <th>Emp Name</th>
			                <th>Emp Status</th>
			                <th>SP Status</th>
			                <th width="10%">Option</th>
			            </tr>
			        </thead>
			        
			        <tbody>
			        	@foreach( $sp as $no => $data )
			            <tr>
			                <td align="center"><?php echo $no+1; ?></td>
			                <td><?php echo $data->no_sp;?></td>
			                <td><?php echo date('d F Y', strtotime($data->sp_date)); ?></td>
			                <td><?php echo $data->sp_title;?></td>
			                <td><?php echo $data->emp_name;?></td>
			                <td><?php echo $data->emp_status;?></td>
			                <td><?php echo $data->sp_status;?></td>
			                <td align="center">
			                	<a class="btn_link"
			                	id="no_radius" href="{{ route('sp.edit', $data->no_sp) }}">
			                	<i class="fa fa-pencil"></i></a>

			                	<a class="btn_link"
			                	id="no_radius" href="{{ route('sp.delete', ['no_sp' => $data->no_sp ]) }}" onclick="return confirm('Hapus data?')">
			                	<i class="fa fa-close"></i></a>
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