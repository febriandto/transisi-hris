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
<h2 class="page_title"> 
</h2>
</div>
<div class="bg_area">&nbsp;</div>

	<div class="container">
		<div class="main_area">	
			
			<div class="row">
			<div class="col-md-8">
			<div class="content">
				<h4><b>Personal Indentity</b></h4>
				<hr>
				<!-- <table id="tabel_howto" width="100%"> -->
				<form action="{{  route('accident.update') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="hidden" name="id_accident_old" value="{{$accident->id_accident}}">
				<table id="add_new" class="cell-border" cellspacing="" width="100%">
					<tr>
			        	<td>
				        	<label> Accident Code </label><br>
				        	<input type="text" name="id_accident" class="form-control" id="no_radius" required="" placeholder="Accident Code" value="{{ $accident->id_accident }}">
			        	</td>
			        	<td>&nbsp;</td>
			        	<td>
				        	<label> Employee </label><br>
				        	<select name="id_emp" class="form-control" id="no_radius" required="">
				        		<option> -- Please Choose -- </option>
				        		@foreach( $employee as $emp )
	                            	<option {{ $accident->id_emp == $emp->id_emp ? 'selected' : '' }} value="{{ $emp->id_emp }}"> {{ $emp->id_emp }} -- {{ $emp->emp_name }}</option>
				        		@endforeach
				        	</select>
			        	</td>
			        </tr>
			        </tr>
			        	<td>
				        	<label> Accident's Category </label><br>
				        	<select name="id_acc_cat" class="form-control" id="no_radius" required="">
				        		<option value=""> -- Please Choose -- </option>
				        		@foreach( $accident_category as $cat )
                                	<option {{ $accident->id_acc_cat == $cat->id_acc_cat ? 'selected' : '' }} value="{{$cat->id_acc_cat}}"> {{$cat->acc_catname}} </option>
				        		@endforeach
				        	</select>
			        	</td>
			        	<td></td>
			        	<td width="50%">
				        	<label> Condition</label><br>
				        	<select name="acc_condition" class="form-control" id="no_radius">
				        		<option> -- Please Choose -- </option>
				        		<option {{ $accident->acc_condition == 'Kecelakaan' ? 'selected' : '' }} value="Kecelakaan"> Kecelakaan</option>
				        		<option {{ $accident->acc_condition == 'Sakit' ? 'selected' : '' }} value="Sakit"> Sakit</option>
				        	</select>
			        	</td>
			        </tr>
			        <tr>
			        	<td>
				        	<label> Time of the Incident </label><br>
				        	<input type="time" name="acc_time" class="form-control" id="no_radius" required="" value="{{ $accident->acc_time }}">
			        	</td>
			       		<td></td>
			        	<td>
				        	<label> Date of the Incident </label><br>
				        	<input type="date" name="acc_date" class="form-control" id="no_radius" value="{{ $accident->acc_date }}">
			        	</td>
			        </tr>
			    </table>&nbsp;
			    <table id="add_new" class="cell-border" cellspacing="" width="100%">
			    	<tr>
			        	<td>
				        	<label> Description </label><br>
				        	<textarea name="acc_desc" class="form-control" id="no_radius">{{$accident->acc_desc}}</textarea>
			        	</td>
			        </tr>
			        <tr>
			        	<td>
				        	<label><br> Recovery Description </label><br>
				        	<textarea name="acc_recovery_desc" class="form-control" id="no_radius">{{$accident->acc_recovery_desc}}</textarea>
			        	</td>
			        </tr>
			        <tr>
			        	<td>
			        		<label> &nbsp; </label><br>
			        		<button class="btn btn-success" id="no_radius" type="submit" name="save"> 
			        		<i class="fa fa-save icon_left"></i> Simpan</button>
			        		<a class="btn btn-default" id="no_radius" href="acc_emp"><i class="fa fa-close icon_left"></i> Batal </a>
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