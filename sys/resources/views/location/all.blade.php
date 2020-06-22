@extends('dashboard')

@section('title')
Work With Location | View Data
@stop

@section('breadcrumb')
Location
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
  	<a href="{{ route('location.add') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-2"></i> Add New</a>
  </div>
  <div class="card-body">
    <table class="table table-striped table-bordered table-sm table-hover" width="100%" id="dataTables">
      <thead>
        <tr>
          <th>No.</th>
          <th>Location Code</th>
          <th>Location Name</th>
					<th>Update By</th>
          <th width="50">Option</th>
        </tr>
      </thead>
      <tbody>
      	@foreach( $location as $no => $data )
      	<tr>
      		<td class="text-center">{{ $no+1 }}</td>
          <td>{{ $data->location_code }}</td>
      		<td>{{ $data->location_name }}</td>
      		<td>{{ $data->input_by }} / {{ date('d F y',strtotime($data->input_date)) }}</td>
      		<td>
      			<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm w-100" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('location.edit', $data->location_id) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<form role="form" method="POST" action="{{ route('location.delete') }}">
									{{ csrf_field() }}
									<input type="hidden" name="location_id" value="{{ $data->location_id }}">
									<button type="submit" class="btn btn-sm" onclick="return confirm('Delete??');">
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