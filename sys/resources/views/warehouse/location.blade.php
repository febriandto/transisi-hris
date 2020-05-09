@extends('dashboard')

@section('title')
Location
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
    <i class="fa fa-barcode mr-2 mt-1"></i> <strong>Data Location</strong>
    <div class="card-header-actions ml-auto">
      @if (Route::current()->getName() == 'warehouselocation.index')
      <a href="#" class="card-header-action btn-tambah" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
      @endif
    </div>
  </div>
  <div class="card-body">
    <table class="table table-striped table-bordered display nowrap" width="100%">
      <thead>
        <tr>
          <th width="30">No.</th>
          <th>Location ID</th>
          <th>Location Name</th>
          <th>Plant</th>
          <th>Warehouse</th>
          <th>Zone</th>
          <th>Area</th>
          <th>Row</th>
          <th>Location rmk</th>
          <th>Input By</th>
          <th>Input Date</th>
          <th width="50">Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-cen tered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['method' => 'POST']) !!}
      <div class="modal-body">

        <div class="form-group">
          <label for="location_id" class="col-sm-3 col-form-label">Location ID<span class="text-danger">*</span></label>
          <div class="col-sm-12">
            {!! Form::text('location_id', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
            {!! Form::hidden('location_id_before', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
          </div>
        </div>

        <div class="form-group">
          <label for="location_name" class="col-sm-3 col-form-label">Location Name<span class="text-danger">*</span></label>
          <div class="col-sm-12">
            {!! Form::text('location_name', null, ['required', 'class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          <label for="plant_id" class="col-sm-3 col-form-label">Warehouse Plant<span
              class="text-danger">*</span></label>
          <div class="col-sm-12">
            {!! Form::select('plant_id', $warehouseplant, null, ['required', 'class' => 'form-control']) !!}
          </div>
				</div>
				
				<div class="form-group">
					<label for="wh_id" class="col-sm-3 col-form-label">Warehouse Name<span class="text-danger">*</span></label>
					<div class="col-sm-12">
						{!! Form::select('wh_id', $warehousename, null, ['required', 'class' => 'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					<label for="wh_row_id" class="col-sm-3 col-form-label">Warehouse Row<span class="text-danger">*</span></label>
					<div class="col-sm-12">
						{!! Form::select('wh_row_id', $warehouserow, null, ['required', 'class' => 'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					<label for="wh_zone_id" class="col-sm-3 col-form-label">Warehouse Zone<span class="text-danger">*</span></label>
					<div class="col-sm-12">
						{!! Form::select('wh_zone_id', $warehousezone, null, ['required', 'class' => 'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					<label for="wh_area_id" class="col-sm-3 col-form-label">Warehouse Area<span class="text-danger">*</span></label>
					<div class="col-sm-12">
						{!! Form::select('wh_area_id', $warehousearea, null, ['required', 'class' => 'form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					<label for="location_rmk" class="col-sm-3 col-form-label">Location rmk<span class="text-danger">*</span></label>
					<div class="col-sm-12">
						{!! Form::text('location_rmk', null, ['required', 'class' => 'form-control']) !!}
					</div>
				</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@stop

@section('script')
<script type="text/javascript">
  var action;

		var modalForm      = $('#modalForm');
		var modalFormTitle = $(modalForm).find('.modal-title');
		var form           = $(modalForm).find('form');

		var location_id          = $(form).find('input[name="location_id"]');
		var location_id_before   = $(form).find('input[name="location_id_before"]');
		var location_name        = $(form).find('input[name="location_name"]');
		var location_rmk 				 = $(form).find('input[name="location_rmk"]');

		var plant_id   = $(form).find('select[name="plant_id"]');
		var wh_id      = $(form).find('select[name="wh_id"]');
		var wh_row_id  = $(form).find('select[name="wh_row_id"]');
		var wh_zone_id = $(form).find('select[name="wh_zone_id"]');
		var wh_area_id = $(form).find('select[name="wh_area_id"]');

		function clearForm() {
			$(location_id).val('');
			$(location_rmk).val('');
			$(location_name).val('');

			$(wh_id).val('');
			$(plant_id).val('');
			$(wh_row_id).val('');
			$(wh_zone_id).val('');
			$(wh_area_id).val('');
		}

		$(document).ready(function () {
			var table = $('.table').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: "{{ route('warehouselocation.datatables') }}",
					type: "POST",
					data: {
						is_delete: "{{ Route::current()->getName() == 'warehouselocation.index' ? 'N' : 'Y' }}"
					}
				},
				columns: [
					{'data': 'no'},
					{'data': 'location_id'},
					{'data': 'location_name'},
					{'data': 'plant_name'},
					{'data': 'wh_name'},
					{'data': 'wh_zone_name'},
					{'data': 'wh_area_name'},
					{'data': 'wh_row_name'},
					{'data': 'location_rmk'},
					{'data': 'input_by'},
					{'data': 'input_date'},
					{'data': 'aksi'}
				],
				responsive: true
			});

			// tambah
			$('.btn-tambah').on('click', function (e) {
				e.preventDefault();

				action = 'tambah';

				clearForm();

				$(modalFormTitle).html('Tambah Location');
				$(modalForm).modal('show');
			});

			// edit
			$('.table').on('click', '.btn-edit', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');

				action = 'edit';

				clearForm();

				$.ajax({
					url: "{{ route('warehouselocation.index') }}/"+id+"/edit",
					type: "GET",
					success: function (data) {
						$(location_id).val(data.warehouselocation.location_id);
						$(location_id_before).val(data.warehouselocation.location_id);
						$(location_name).val(data.warehouselocation.location_name);
						$(location_rmk).val(data.warehouselocation.location_rmk);

						$(plant_id).val(data.warehouselocation.plant_id);
						$(wh_id).val(data.warehouselocation.wh_id);
						$(wh_zone_id).val(data.warehouselocation.wh_zone_id);
						$(wh_row_id).val(data.warehouselocation.wh_row_id);
						$(wh_area_id).val(data.warehouselocation.wh_area_id);

						$(modalFormTitle).html('Edit Location');
						$(modalForm).modal('show');
					}
				});
			});

			$('.table').on('click', '.btn-hapus', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');
				
				if (confirm('Anda yakin ingin menghapus data tersebut?')) {

					$.ajax({
						url: "{{ route('warehouselocation.index') }}/"+id+"/hapus",
						type: "DELETE",
						data: {id},
						success: function (data) {
							alert('Data berhasil dihapus.');

							table.ajax.reload();
						}
					});
				}
			});

			$('.table').on('click', '.btn-restore', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');
				
				if (confirm('Anda yakin ingin mengembalikan data tersebut?')) {

					$.ajax({
						url: "{{ route('warehouselocation.index') }}/"+id+"/restore",
						type: "PATCH",
						data: {id},
						success: function (data) {
							alert('Data berhasil dikembalikan.');

							document.location = "{{ route('warehouselocation.index') }}";
						}
					});
				}
			});

			$(form).on('submit', function (e) {
				e.preventDefault();

				if (action === 'tambah') {
					url = "{{ route('warehouselocation.simpan') }}";
					type = 'POST';
				} else {
					var id = $(location_id).val();

					url = "{{ route('warehouselocation.index') }}/"+id+"/edit";
					type = 'PATCH';
				}

				$.ajax({
					url: url,
					type: type,
					data: $(form).serialize(),
					success: function (data) {
						$(modalForm).modal('hide');
						table.ajax.reload();
					}
				});
			});

			window.location.hash = "master-data";
		});
</script>
@stop