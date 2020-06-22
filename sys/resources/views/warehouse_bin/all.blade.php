@extends('dashboard')

@section('title')
Work With Warehouse Bin | View Data
@stop

@section('breadcrumb')
Warehouse Bin
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
  	<a href="{{ route('warehousebin.add') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-2"></i> Add New</a>
  </div>
  <div class="card-body">
    <table class="table table-striped table-bordered table-sm table-hover" width="100%" id="dataTables">
      <thead>
        <tr>
          <th width="30">No.</th>
          <th>Bin Name</th>
          <th>Description</th>
					<th>Update By</th>
          <th width="50">Option</th>
        </tr>
      </thead>
      <tbody>
      	@foreach( $warehouse_bin as $no => $data )
      	<tr>
      		<td class="text-center">{{ $no+1 }}</td>
      		<td>{{ $data->bin_loc_name }}</td>
      		<td>{{ $data->bin_loc_desc }}</td>
      		<td>{{ $data->input_by }} / {{ date('d F y',strtotime($data->input_date)) }}</td>
      		<td>
      			<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm w-100" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('warehousebin.edit', $data->bin_loc_id) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<form role="form" method="POST" action="{{ route('warehousebin.delete') }}">
									{{ csrf_field() }}
									<input type="hidden" name="bin_loc_id" value="{{ $data->bin_loc_id }}">
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