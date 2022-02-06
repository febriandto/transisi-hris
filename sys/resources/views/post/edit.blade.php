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
		<h4 class="page_title"> Edit Post</h4>
	</div>
	<div class="bg_area">&nbsp;</div>
	<div class="container">
		<div class="main_area">	
			<div class="row">
				<div class="col-md-8">
					<div class="content">
						<form action="{{ route('post.update') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="post_id" value="{{ $post->post_id }}">
							<table id="add_new" class="cell-border" cellspacing="0" width="100%">
						        <tr>
						        	<td>
							        	<label> Judul post </label><br>
							        	<input type="text" value="<?php echo $post->post_title;?>" 
							        		name="post_title" class="form-control" id="no_radius" placeholder="Judul Post">
						        	</td>
						        </tr>
						        <tr>
						        	<td>
							        	<label> Deskripsi </label><br>
							        	<textarea rows="18" name="post_desc" class="form-control" id="no_radius" placeholder="isi Post"><?php echo $post->post_desc;?></textarea>
						        	</td>
						        </tr>
						        <tr><td>&nbsp;</td></tr>
						        <tr>
						        	<td>
							        	<label> Cuplikan Post </label><br>
							        	<input type="text" value="<?php echo $post->post_exerp;?>" name="post_exerp" class="form-control" id="no_radius" placeholder="Cuplikan Post">
						        	</td>
						        </tr>
						        <tr>
						        	<td>
							        	<label> Kategori </label><br>
							        	<select type="text" name="cat_id" class="form-control" id="no_radius" required="">
							        		@foreach( $post_cat as $data )
							        		<option {{ $data->cat_id == $post->cat_id ? 'selected' : '' }} value="<?php echo $data->cat_id;?>"> <?php echo $data->cat_name;?> </option>
							        		@endforeach
							        	</select>
						        	</td>
						        </tr>
						        <tr>
						        	<td align="right">
						        		<label> &nbsp; </label><br>
						        		<a class="btn btn-default" id="no_radius" href="#" onclick="history.go(-1);">
						        			<i class="fa fa-close icon_left"></i> Batal </a>
						        		<button class="btn btn-success" id="no_radius" type="submit" name="update"> 
						        		<i class="fa fa-check icon_left"></i> Update</button>
						        	</td>
						        </tr>
							</table>
						</form>
						
						<hr>
					</div><!-- end content -->
				</div>

				<div class="col-md-4">
					<div class="" style="background-color: white; padding: 10px;">
						<h4> Lampiran Post </h4>
						<hr>
						@foreach( $post_img_v as $data )

						<img width="100%" src="{{asset('images/upload/post/'. $data->post_img)}}?v={{$data->post_img_v}}" alt="{{$data->post_img}}?v={{$data->post_img_v}}">

						<hr>
						<button type="button" class="btn btn-info" style="border-radius: 0px;" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-refresh icon_left"></i>Ganti Lampiran
						</button>

						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
							    <!-- Modal content-->
							    <div class="modal-content">
								    <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">Ganti Lampiran Post</h4>
								    </div>
								    <div class="modal-body">
								        <form action="{{ route('post.ganti_gambar') }}" method="post" enctype="multipart/form-data">
								        {{ csrf_field() }}
								        	<table width="100%">
								        		<tr>
								        			<td>
								        				<label> Versi Lampiran </label>
								        				<input id="no_radius" type="text" class="form-control"
								        				 name="post_img_v" value="<?php echo $data->a;?>" readonly>
								        			</td>
								        			<td>&nbsp;</td>
								        			<td>
								        				<label> ID Post </label>
								        				<input id="no_radius" type="text" class="form-control"
								        				 name="post_id" value="<?php echo $data->post_id;?>" readonly>
								        			</td>
								        		</tr>
								        		<tr>
								        			<td colspan="3">&nbsp;</td>
								        		</tr>
								        		<tr>
								        			<td colspan="3">
								        				<label> Upload Lampiran Baru</label>
								        				<input type="file" name="post_file" class="form-control" required
								        				id="post_file">
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
								        			<td colspan="3" align="right">
								        				<button type="submit" class="btn btn-primary" name="ganti_gambar" id="no_radius" style="margin-top: 10px;"> Simpan Lampiran </button>
								        			</td>
								        		</tr>
								        	</table>
								        </form>
								    </div>
							    </div>
							</div>
						</div>
						@endforeach
					</div>
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