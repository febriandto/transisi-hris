@extends('dashboard')

@section('title')
Warehouse Area
@stop

@section('content')
	<div class="card">
		<div class="card-header d-flex">
			<i class="fa fa-barcode mr-2 mt-1"></i> <strong>Data Warehouse Area</strong>
			<div class="card-header-actions ml-auto">
				@if (Route::current()->getName() == 'warehousearea.index')
					<a href="#" class="card-header-action btn-tambah" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
				@endif
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered display nowrap" width="100%">
				<thead>
					<tr>
						<th width="30">No.</th>
						<th>Warehouse Area ID</th>
						<th>Warehouse Area Name</th>
						<th>Warehouse Zone</th>
						<th>Description</th>
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
		<div class="modal-dialog modal-lg modal-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				{!! Form::open(['method' => 'POST']) !!}
					<div class="modal-body">

						<div class="form-group area">
							<label for="wh_area_id" class="col-sm-3 col-form-label">Warehouse Area ID<span class="text-danger">*</span></label>
							<div class="col-sm-12">
								{!! Form::text('wh_area_id', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
								{!! Form::hidden('wh_area_id_before', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
							</div>
						</div>
						
						<div class="form-group area">
							<label for="wh_area_name" class="col-sm-3 col-form-label">Warehouse Area Name<span class="text-danger">*</span></label>
							<div class="col-sm-12">
								{!! Form::text('wh_area_name', null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group area">
							<label for="wh_zone_id" class="col-sm-3 col-form-label">Warehouse Zone<span class="text-danger">*</span></label>
							<div class="col-sm-12">
								{!! Form::select('wh_zone_id', $warehousezone, null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>
						
						<div class="form-group area">
							<label for="wh_area_desc" class="col-sm-3 col-form-label">Description<span class="text-danger">*</span></label>
							<div class="col-sm-12">
								{!! Form::text('wh_area_desc', null, ['required', 'class' => 'form-control']) !!}
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

		var modalForm = $('#modalForm');
		var modalFormTitle = $(modalForm).find('.modal-title');

		var form = $(modalForm).find('form');

		var wh_area_id        = $(form).find('input[name="wh_area_id"]');
		var wh_area_id_before = $(form).find('input[name="wh_area_id_before"]');
		var wh_area_name      = $(form).find('input[name="wh_area_name"]');
		var wh_zone_id        = $(form).find('select[name="wh_zone_id"]');
		var wh_area_desc      = $(form).find('input[name="wh_area_desc"]');

		function clearForm() {
			$(wh_area_id).val('');
			$(wh_zone_id).val('');
			$(wh_area_name).val('');
			$(wh_area_desc).val('');
		}

		$(document).ready(function () {
			var table = $('.table').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: "{{ route('warehousearea.datatables') }}",
					type: "POST",
					data: {
						is_delete: "{{ Route::current()->getName() == 'warehousearea.index' ? 'N' : 'Y' }}"
					}
				},
				columns: [
					{'data': 'no'},
					{'data': 'wh_area_id'},
					{'data': 'wh_area_name'},
					{'data': 'wh_zone_name'},
					{'data': 'wh_area_desc'},
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

				$(modalFormTitle).html('Tambah Warehouse Area');
				$(modalForm).modal('show');
			});

			// edit
			$('.table').on('click', '.btn-edit', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');

				action = 'edit';

				clearForm();

				$.ajax({
					url: "{{ route('warehousearea.index') }}/"+id+"/edit",
					type: "GET",
					success: function (data) {
						$(wh_area_id).val(data.warehousearea.wh_area_id);
						$(wh_area_id_before).val(data.warehousearea.wh_area_id);
						$(wh_zone_id).val(data.warehousearea.wh_zone_id);
						$(wh_area_name).val(data.warehousearea.wh_area_name);
						$(wh_area_desc).val(data.warehousearea.wh_area_desc);

						$(modalFormTitle).html('Edit Warehouse Area');
						$(modalForm).modal('show');
					}
				});
			});

			$('.table').on('click', '.btn-hapus', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');
				
				if (confirm('Anda yakin ingin menghapus data tersebut?')) {

					$.ajax({
						url: "{{ route('warehousearea.index') }}/"+id+"/hapus",
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
						url: "{{ route('warehousearea.index') }}/"+id+"/restore",
						type: "PATCH",
						data: {id},
						success: function (data) {
							alert('Data berhasil dikembalikan.');

							document.location = "{{ route('warehousearea.index') }}";
						}
					});
				}
			});

			$(form).on('submit', function (e) {
				e.preventDefault();

				if (action === 'tambah') {
					url = "{{ route('warehousearea.simpan') }}";
					type = 'POST';
				} else {
					var id = $(wh_area_id).val();

					url = "{{ route('warehousearea.index') }}/"+id+"/edit";
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