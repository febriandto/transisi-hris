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
<h5 class="page_title"> Input Anggota Team
</h5>
</div>
<div class="bg_area">&nbsp;</div>
	<div class="container">
		<div class="main_area">
			<div class="row">
				<div class="col-md-6">
					<div class="content">
						<form action="{{ route('team.save_team') }}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
							<input type="hidden" name="team_id" value="{{ $team->team_id }}">
						    <table id="add_new" class="cell-border" cellspacing="" width="100%">
						        <tr>
						        	<td colspan="3">
							        	<label> Pilih Karyawan</label><br>
							        	<select id="id_emp" name="id_emp" class="form-control flat" required="">
					                      	<option value=''>-- Silahkan Pilih ---</option>
					                      	@foreach( $employee as $option )
					                      	<option value='<?php echo $option->id_emp;?>'> 
					                      		<?php echo $option->id_emp." - ".$option->dept_name." - ".$option->emp_name;?>
					                      	</option>
					                      	@endforeach
					                    </select>
						        	</td>
						        </tr>
						        <tr>
						        	<td>
						        		<label> &nbsp; </label><br>
						        		<a class="btn btn-default" id="no_radius" href="{{ route('team.index') }}">
						        			<i class="fa fa-chevron-left icon_left"></i> Kembali 
						        		</a>
						        		<button class="btn btn-success" id="no_radius" type="submit" name="save_team_detail" id="submit">
						        			<i class="fa fa-chevron-right icon_left"></i> Simpan
						        		</button>
						        	</td>
						        </tr>
							</table>
						</form>
					</div><!-- end content -->
				</div>
				<div class="col-md-6">
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