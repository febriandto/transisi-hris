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
		<h5 class="page_title"> 
			Tambah Post
		</h5>
	</div>
	<div class="bg_area">&nbsp;</div>
	<div class="container">
		<div class="main_area">	
			<div class="row">
				<div class="col-md-8">
					<div class="content">
						<form action="{{ route('post.save') }}" method="post" enctype="multipart/form-data">
							{{ csrf_field() }}
						<table id="add_new" class="cell-border" cellspacing="0" width="100%">
					        <tr>
					        	<td>
						        	<label> ID Post (Autofill By System)</label><br>
						        	<input type="text" name="post_id" value="<?php echo $post_id;?>" class="form-control" id="no_radius" readonly>
					        	</td>
					        </tr>
					        <tr>
					        	<td>
						        	<label> Judul post </label><br>
						        	<input type="text" name="post_title" class="form-control" id="no_radius" placeholder="Judul Post">
					        	</td>
					        </tr>
					        <tr>
					        	<td>
						        	<label> Deskripsi </label><br>
						        	<textarea rows="18" name="post_desc" class="form-control" id="no_radius" placeholder="isi Post"></textarea>
					        	</td>
					        </tr>
					        <tr><td>&nbsp;</td></tr>
					        <tr>
					        	<td>
						        	<label> Cuplikan Post </label><br>
						        	<input type="text" name="post_exerp" class="form-control" id="no_radius" placeholder="Cuplikan Post">
					        	</td>
					        </tr>
					        <tr>
					        	<td>
						        	<label> Kategori </label><br>
						        	<select type="text" name="cat_id" class="form-control" id="no_radius" required="">
						        		<option value=""> -Choose Option- </option>
						        		@foreach( $post_cat as $data )
					        			<option value="<?php echo $data->cat_id;?>"> 
					        				<?php echo $data->cat_name;?> 
					        			</option>
					        			@endforeach
						        	</select>
					        	</td>
					        </tr>
					        <tr>
					        	<td>
						        	<label> Lampiran Post </label><br>
						        	<input type="file" name="post_file" class="form-control" id="post_file" placeholder="">
						        	<p id="error1" style="display:none; color:#FF0000;">
				                      Invalid File Format!<br>
				                      File Format Must Be JPG, JPEG, PNG or PDF.
				                    </p>
				                    <p id="error2" style="display:none; color:#FF0000;">
				                      Maximum File Size Limit is 3MB.
				                    </p>
					        	</td>
					        </tr>
					        <tr>
					        	<td align="right">
					        		<a class="btn btn-default" id="no_radius" href="#" onclick="history.go(-1);">
					        			<i class="fa fa-close icon_left"></i> Batal 
					        		</a>
					        		<button class="btn btn-success" id="no_radius" type="submit" name="save"> 
					        			<i class="fa fa-check icon_left"></i> Simpan
					        		</button>
					        	</td>
					        </tr>
						</table>
						</form>
						<hr>
					</div><!-- end content -->
				</div>
				<div class="col-md-4">
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