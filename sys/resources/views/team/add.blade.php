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
<h5 class="page_title"> Input Team Leader
</h5>
</div>
<div class="bg_area">&nbsp;</div>
	<div class="container">
		<div class="main_area">
			<div class="row">
				<div class="col-md-6">
					<div class="content">
						<form action="" method="post" enctype="multipart/form-data">
						    <table id="add_new" class="cell-border" cellspacing="" width="100%">
						        <tr>
						        	<td colspan="3">
							        	<label> Team Leader</label><br>
							        	<select id="team_leader_id" name="team_leader_id" class="form-control flat" required="">
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
						        		<a class="btn btn-default" id="no_radius" href="team_view">
						        			<i class="fa fa-chevron-left icon_left"></i> Kembali 
						        		</a>
						        		<button class="btn btn-success" id="no_radius" type="submit" name="save_team_leader" id="submit">
						        			<i class="fa fa-chevron-right icon_left"></i> Selanjutnya
						        		</button>
						        	</td>
						        </tr>
							</table>
						</form>
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