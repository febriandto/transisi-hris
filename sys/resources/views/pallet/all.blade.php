@extends('dashboard')

@section('title')
Work With Pallet ID | View Data
@stop

@section('breadcrumb')
Pallet ID
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
  	<a href="{{ route('pallet.add') }}" class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-2"></i> Add New</a>
  </div>
  <div class="card-body">
    <table class="table table-striped table-bordered table-sm table-hover" width="100%" id="dataTables">
      <thead>
        <tr>
          <th width="30">No.</th>
          <th>Pallet Name</th>
          <th>Description</th>
          <th width="10%">Pallet Terisi</th>
          <th width="10%">Pallet Penuh</th>
					<th>Update By</th>
          <th width="50">Option</th>
        </tr>
      </thead>
      <tbody>
      	@foreach( $pallet as $no => $data )
      	<tr>
      		<td class="text-center">{{ $no+1 }}</td>
      		<td>{{ $data->pallet_name }}</td>
      		<td>{{ $data->pallet_desc }}</td>
          <td>
            @if( $data->pallet_fill > 0 )
              <span class="badge badge-sm badge-success">
                <i class="fa fa-check"></i>
              </span>
            @else
              <span class="badge badge-sm badge-secondary">
                <i class="fa fa-times"></i>
              </span>
            @endif
          </td>
          <td>
            @if( $data->pallet_full > 0 )
              <span class="badge badge-sm badge-success">
                <i class="fa fa-check"></i>
              </span>
            @else
              <span class="badge badge-sm badge-secondary">
                <i class="fa fa-times"></i>
              </span>
            @endif
          </td>
      		<td>{{ $data->input_by }} / {{ date('d F y',strtotime($data->input_date)) }}</td>
      		<td>
      			<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm w-100" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('pallet.edit', $data->pallet_id) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
								<form role="form" method="POST" action="{{ route('pallet.delete') }}">
									{{ csrf_field() }}
									<input type="hidden" name="pallet_id" value="{{ $data->pallet_id }}">
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