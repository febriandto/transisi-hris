@extends('dashboard')

@section('title')
Warehouse
@stop

@section('content')
	<div class="card">
		<div class="card-header d-flex">
			<i class="fa fa-barcode mr-2 mt-1"></i> <strong>Data Warehouse</strong>
			<div class="card-header-actions ml-auto">
				@if (Route::current()->getName() == 'warehouse.index')
					<a href="#" class="card-header-action btn-tambah" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
				@endif
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered display nowrap" width="100%">
				<thead>
					<tr>
						<th width="30">No.</th>
						<th>Warehouse ID</th>
						<th>Warehouse Name</th>
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

						<div class="form-group">
							<label for="wh_id" class="col-sm-3 col-form-label">Warehouse ID<span class="text-danger">*</span></label>
							<div class="col-sm-12">
								{!! Form::text('wh_id', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
								{!! Form::hidden('wh_id_before', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="wh_name" class="col-sm-3 col-form-label">Warehouse Name<span class="text-danger">*</span></label>
							<div class="col-sm-12">
								{!! Form::text('wh_name', null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="wh_description" class="col-sm-3 col-form-label">Description<span class="text-danger">*</span></label>
							<div class="col-sm-12">
								{!! Form::text('wh_description', null, ['required', 'class' => 'form-control']) !!}
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

		var wh_id          = $(form).find('input[name="wh_id"]');
		var wh_id_before   = $(form).find('input[name="wh_id_before"]');
		var wh_name        = $(form).find('input[name="wh_name"]');
		var wh_description = $(form).find('input[name="wh_description"]');

		function clearForm() {
			$(wh_id).val('');
			$(wh_name).val('');
			$(wh_description).val('');
		}

		$(document).ready(function () {
			var table = $('.table').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: "{{ route('warehouse.datatables') }}",
					type: "POST",
					data: {
						is_delete: "{{ Route::current()->getName() == 'warehouse.index' ? 'N' : 'Y' }}"
					}
				},
				columns: [
					{'data': 'no'},
					{'data': 'wh_id'},
					{'data': 'wh_name'},
					{'data': 'wh_description'},
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

				$(modalFormTitle).html('Tambah Warehouse');
				$(modalForm).modal('show');
			});

			// edit
			$('.table').on('click', '.btn-edit', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');

				action = 'edit';

				clearForm();

				$.ajax({
					url: "{{ route('warehouse.index') }}/"+id+"/edit",
					type: "GET",
					success: function (data) {
						$(wh_id).val(data.warehouse.wh_id);
						$(wh_id_before).val(data.warehouse.wh_id);
						$(wh_name).val(data.warehouse.wh_name);
						$(wh_description).val(data.warehouse.wh_description);

						$(modalFormTitle).html('Edit Warehouse');
						$(modalForm).modal('show');
					}
				});
			});

			$('.table').on('click', '.btn-hapus', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');
				
				if (confirm('Anda yakin ingin menghapus data tersebut?')) {

					$.ajax({
						url: "{{ route('warehouse.index') }}/"+id+"/hapus",
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
						url: "{{ route('warehouse.index') }}/"+id+"/restore",
						type: "PATCH",
						data: {id},
						success: function (data) {
							alert('Data berhasil dikembalikan.');

							document.location = "{{ route('warehouse.index') }}";
						}
					});
				}
			});

			$(form).on('submit', function (e) {
				e.preventDefault();

				if (action === 'tambah') {
					url = "{{ route('warehouse.simpan') }}";
					type = 'POST';
				} else {
					var id = $(wh_id).val();

					url = "{{ route('warehouse.index') }}/"+id+"/edit";
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