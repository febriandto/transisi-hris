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
<h5 class="page_title"> Add new Employtee Mutation</b></h45>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">	
			
			<div class="row">
			<div class="col-md-8">
			<div class="content">
				
				<!-- <table id="tabel_howto" width="100%"> -->
				<form action="{{ route('mutasi.save') }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
				<table id="add_new" class="cell-border" cellspacing="" width="100%">
			        <tr>
			        	<td>
				        	<label> Employee </label><br>
				        	<input style="padding: 4px 4px 5px 4px; font-size: 13px; color: grey;" type="text" name="id_emp" id="a" placeholder="Please Choose Employee">

				        	<button class="btn btn-primary" id="no_radius" onclick="$('.browse').fadeToggle();" type="button">
				        		<i class="fa fa-navicon"></i>
				        	</button>

				        	<div class="browse" 
				        	style="display: none; position: fixed; width: 600px; top:0; margin-top: 150px; left: 50%; margin-left: -300px; box-shadow: 0 0 10px 0 #000; background-color: white; padding: 15px; font-size: 13px; z-index: 10;" >

				        		<table id="example" class="cell-border table-hover" cellspacing="0" width="100%">
				        			<thead>
				        				<tr>
				        					<th>ID</th>
				        					<th>Name</th>
				        					<th>Email</th>
				        				</tr>
				        			</thead>
				        			<tbody>

				        				@foreach( $employee as $emp )
				        				<tr>
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
			        	<td>
				        	<label> Departement </label><br>
				        	<select name="id_dept" class="form-control" id="no_radius" required="">
				        		<option value=""> -- Please Choose -- </option>
				        		@foreach( $dept as $data )
                                <option value="{{ $data->id_dept }}">{{ $data->dept_name }}</option>
                                @endforeach
				        	</select>
			        	</td>
			        </tr>
			        <tr>
			        	<td>
				        	<label> Active Date </label><br>
				        	<input type="date" name="mutasi_activedate" class="form-control" id="no_radius" required="">
			        	</td>
			        </tr>
			        <tr>
			        	<td>
			        		<label> &nbsp; </label><br>
			        		<button class="btn btn-success" id="no_radius" type="submit" name="save"> 
			        		<i class="fa fa-save icon_left"></i> Simpan</button>
			        		<a class="btn btn-default" id="no_radius" href="mutasi"><i class="fa fa-close icon_left"></i> Batal </a>
			        	</td>
			        </tr>
			    </table>

				</form>
				<hr>
			</div><!-- end content -->
			</div>
			<div class="col-md-4">
				<div class="cara_dial">
				<h5> Be wise Person </h5>
				<p>
					- Sudahkah anda ngopi hari ini? <br>
					- Tetap fokus dan konsentrasi  <br>
				</p>
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