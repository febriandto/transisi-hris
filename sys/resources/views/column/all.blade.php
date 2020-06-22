@extends('dashboard')

@section('title')
Work With Row Column (Kolom) | View Data
@stop

@section('breadcrumb')
Row Column (Kolom)
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
  	<a href="{{ route('column.add') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-2"></i> Add New</a>
  </div>
  <div class="card-body">
    <table class="table table-striped table-bordered table-sm table-hover" width="100%" id="dataTables">
      <thead>
        <tr>
          <th width="30">No.</th>
          <th>Column ID</th>
          <th>Column Name</th>
					<th>Update By</th>
          <th width="50">Option</th>
        </tr>
      </thead>
      <tbody>
      	@foreach( $column as $no => $data )
      	<tr>
      		<td class="text-center">{{ $no+1 }}</td>
      		<td>
            <?php
              echo str_pad($data->col_id, 2, '0', STR_PAD_LEFT);
            ?>
          </td>
      		<td>{{ $data->col_name }}</td>
      		<td>{{ $data->input_by }} / {{ date('d F y',strtotime($data->input_date)) }}</td>
      		<td>
      			<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm w-100" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('column.edit', $data->col_id) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<form role="form" method="POST" action="{{ route('column.delete') }}">
									{{ csrf_field() }}
									<input type="hidden" name="col_id" value="{{ $data->col_id }}">
									<button type="submit" style="border: none;width: 65%;background: none;color: #777;" onclick="return confirm('Delete??');">
										<i class="fa fa-times mr-2"></i> Delete
									</button>
								</form>
							</li>
						</ul>
      		</td>
      	</tr>
      	@endforeach
      </tbody>
    </table>
  </div>
</div>
@stop