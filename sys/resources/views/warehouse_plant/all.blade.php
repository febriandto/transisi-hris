@extends('dashboard')

@section('title')
Work With Warehouse Plant | View Data
@stop

@section('breadcrumb')
Warehouse Plant
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
  	<a href="{{ route('warehouseplant.add') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-2"></i> Add New</a>
  </div>
  <div class="card-body">
    <table class="table table-striped table-bordered table-sm table-hover" width="100%" id="dataTables">
      <thead>
        <tr>
          <th width="30">No.</th>
          <th>Plant ID</th>
          <th>Plant Name</th>
					<th>Description</th>
					<th>Plant rmk</th>
          <th>Input By</th>
          <th width="50">Aksi</th>
        </tr>
      </thead>
      <tbody>
      	@foreach( $warehouse_plant as $no => $data )
      	<tr>
      		<td>{{ $no+1 }}</td>
      		<td>{{ $data->plant_id }}</td>
      		<td>{{ $data->plant_name }}</td>
      		<td>{{ $data->plant_description }}</td>
      		<td>{{ $data->plant_rmk }}</td>
      		<td>{{ $data->input_by }} / {{ date('d F y',strtotime($data->input_date)) }}</td>
      		<td>
      			<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm w-100" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('warehouseplant.edit', $data->plant_id) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<form role="form" method="POST" action="{{ route('warehouseplant.delete') }}">
									{{ csrf_field() }}
									<input type="hidden" name="plant_id" value="{{ $data->plant_id }}">
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