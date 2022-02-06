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
		<h5 class="page_title"> Post Management </h5>
	</div>
	<div class="bg_area">&nbsp;</div>
	<div class="container">
		<div class="main_area">	
			<div class="row">
				<div class="col-md-10">
					<div class="content">					
						<div class="top_menu_list" style="float:right;">
								<i class="fa fa-plus icon_left" title="Tambah Data Baru"></i> Add New 
							</a>
						</div>
						<br>	
						<hr>
						<table id="example" class="cell-border table-hover table table-striped table-bordered" cellspacing="0" width="100%">
					        <thead>
					            <tr>
					                <th width="6%">No</th>
					                <th>Post ID</th>
					                <th>Post Title</th>
					                <th>Update</th>
					                <th width="14%">More</th>
					            </tr>
					        </thead>
					        @foreach( $post as $no => $data )
					            <tr>
					                <td align="center"><?php echo $no+1; ?></td>
					                <td><?php echo $data->post_id;?></td>
					                <td><?php echo $data->post_title;?></td>
					                <td><?php echo $data->input_by;?> / <?php echo date('d M y',strtotime($data->input_by));?></td>
					                <td align="center">
					                	<a class="btn_link"
					                	id="no_radius" href="{{ route('post.edit', $data->post_id) }}">
					                	<i class="fa fa-search"></i></a>

					                	<a class="btn_link"
					                	id="no_radius" href="{{ route('post.delete', $data->post_id) }}" onclick="return confirm('Hapus data?')">
					                	<i class="fa fa-close"></i></a>
					                </td>
					            </tr>
					            @endforeach
					        </tbody>
						</table>
					</div><!-- end content -->
				</div>
				<div class="col-md-2">
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