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
<h5 class="page_title">Tambah Data SP
</h5>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">	
			
			<div class="row">
			<div class="col-md-8">
			<div class="content">
				
				<!-- <table id="tabel_howto" width="100%"> -->
				<form action="{{ route('sp.save') }}" method="post">
				{{ csrf_field() }}

				<table id="add_new" class="cell-border" cellspacing="0" width="100%">
					<tr>
			        	<td>
				        	<label> Employee </label><br>
				        	<input style="padding: 4px 4px 5px 4px; font-size: 13px; color: grey;" type="text" name="id_emp" id="a" placeholder="Choose Employee">

				        	<button class="btn btn-primary" id="no_radius" onclick="$('.browse').fadeToggle();" type="button">
				        		<i class="fa fa-navicon"></i>
				        	</button>

				        	<div class="browse" 
				        	style="display: none; position: fixed; width: 600px; top:0; margin-top: 150px; left: 50%; margin-left: -300px; box-shadow: 0 0 10px 0 #000; background-color: white; padding: 15px; font-size: 13px; z-index: 10;" >

				        		<table id="example" class="cell-border table-hover" cellspacing="0" width="100%">
				        			<thead>
				        				<tr>
				        					<th width="10%">No</th>
				        					<th>ID</th>
				        					<th>Name</th>
				        					<th>Place Birth</th>
				        				</tr>
				        			</thead>
				        			<tbody>
				        				@foreach( $emp as $no => $emp )
				        				<tr>
				        					<td>
				        						<span onclick="fill('#a', '<?php echo $emp->id_emp; ?>')">
				        							<?php echo $no+1 ?>
				        						</span>
				        					</td>
				        					<td>
				        						<span onclick="fill('#a', '<?php echo $emp->id_emp; ?>')">
				        							<?php echo $emp->id_emp ?>
				        						</span>
				        					</td>
				        					<td>
				        						<span onclick="fill('#a', '<?php echo $emp->id_emp; ?>')">
				        							<?php echo $emp->emp_name ?>
				        						</span>
				        					</td>
				        					<td>
				        						<span onclick="fill('#a', '<?php echo $emp->id_emp; ?>')">
				        							<?php echo $emp->emp_placebirth ?>
				        						</span>
				        					</td>
				        				</tr>
				        				@endforeach

				        			</tbody>
				        		</table>

				        		<script>
				        			function fill(div, txt){

				        				$(div).val(txt);
				        				$('.browse').fadeToggle();

				        			}
				        		</script>

				        	</div>
			        	</td>
			        </tr>
			        <tr>
			        	<td><hr></td>
			        </tr>

			        <tr>
			        	<td>
			        	<label> SP No </label><br>
			        	<input type="text" name="no_sp" value="SP-<?php echo date('Y');?>-<?php echo $no;?>" class="form-control" id="no_radius" placeholder="SP Number">
			        	</td>
			        </tr>

			        <tr>
			        	<td>
			        	<label> SP Date </label><br>
			        	<input type="date" name="sp_date" class="form-control" id="no_radius" placeholder="SP Date Sign">
			        	</td>
			        </tr>
			        <tr>
			        	<td>
			        	<label> SP Category </label><br>
			        	<select name="id_spcat" class="form-control" id="no_radius">
			        		<option value=""> --pilih--</option>
			        		@foreach( $sp_cat as $data )
			        		<option value="<?php echo $data->id_spcat;?>"><?php echo $data->spcat_name;?></option>
			        		@endforeach
			        	</select>
			        	</td>
			        </tr>
			        <tr>
			        	<td>
			        	<label> SP Title </label><br>
			        	<input type="text" name="sp_title" class="form-control" id="no_radius" placeholder="SP Title">
			        	</td>
			        </tr>
			        <tr>
			        	<td>
			        	<label> SP Description Case </label><br>
			        	<textarea name="sp_description" rows="10" class="form-control" id="no_radius" placeholder="SP Detail Description"></textarea>
			        	</td>
			        </tr>
			        <tr>
			        	<td>&nbsp;</td>
			        </tr>
			        <tr>
			        	<td>
			        	<label> SP Punishment Desc </label><br>
			        	<textarea name="sp_punishment" rows="10" class="form-control" id="no_radius" placeholder="SP Detail Punishment"></textarea>
			        	</td>
			        </tr>
			        <tr>
			        	<td>&nbsp;</td>
			        </tr>
			        <tr>
			        	<td>
			        	<label> SP Valid Date </label><br>
			        	<input type="date" name="sp_valid_date" class="form-control" id="no_radius" placeholder="SP Valid Until">
			        	</td>
			        </tr>    

			        <tr>
			        	<td>
			        		<label> &nbsp; </label><br>
			        		<button class="btn btn-success" id="no_radius" type="submit" name="save"> 
			        		<i class="fa fa-save icon_left"></i> Save</button>
			        		<a class="btn btn-danger" id="no_radius" href="sp"><i class="fa fa-close icon_left"></i> cancel </a>
			        	</td>
			        </tr>

				</table>
				</form>
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