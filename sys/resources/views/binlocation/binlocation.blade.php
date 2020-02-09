@extends('dashboard')

@section('title')
Bin Location
@stop

@section('content')
	<div class="card">
		<div class="card-header d-flex">
			<i class="fa fa-barcode mr-2 mt-1"></i> <strong>Daftar Bin Location</strong>
			<div class="card-header-actions ml-auto">
				@if (Route::current()->getName() == 'binlocation.index')
					<a href="#" class="card-header-action btn-tambah" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
				@endif
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered display nowrap" width="100%">
				<thead>
					<tr>
						<th width="30">No.</th>
						<th>Bin Location ID</th>
						<th>Bin Location Name</th>
						<th>Description</th>
						<th>Warehouse Row</th>
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
							<label for="bin_loc_id" class="col-sm-3 col-form-label">Bin Location ID<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::text('bin_loc_id', null, ['required', 'class' => 'form-control', 'placeholder' => '01']) !!}
								{!! Form::hidden('bin_loc_id_before', null, ['required', 'class' => 'form-control', 'placeholder' => '01']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="bin_loc_name" class="col-sm-3 col-form-label">Bin Location Name<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::text('bin_loc_name', null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="bin_loc_desc" class="col-sm-3 col-form-label">Description<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::text('bin_loc_desc', null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="wh_row_id" class="col-sm-3 col-form-label">Warehouse Row<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::select('wh_row_id', $warehouserow, null, ['required', 'class' => 'form-control']) !!}
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

		var bin_loc_id        = $(form).find('input[name="bin_loc_id"]');
		var bin_loc_id_before = $(form).find('input[name="bin_loc_id_before"]');
		var bin_loc_name      = $(form).find('input[name="bin_loc_name"]');
		var bin_loc_desc      = $(form).find('input[name="bin_loc_desc"]');
		var wh_row_id         = $(form).find('select[name="wh_row_id"]');

		function clearForm() {
			$(bin_loc_id).val('');
			$(bin_loc_name).val('');
			$(bin_loc_desc).val('');
			$(wh_row_id).val('');
		}

		$(document).ready(function () {
			var table = $('.table').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: "{{ route('binlocation.datatables') }}",
					type: "POST",
					data: {
						is_delete: "{{ Route::current()->getName() == 'binlocation.index' ? 'N' : 'Y' }}"
					}
				},
				columns: [
					{'data': 'no'},
					{'data': 'bin_loc_id'},
					{'data': 'bin_loc_name'},
					{'data': 'bin_loc_desc'},
					{'data': 'wh_row_id'},
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

				$(modalFormTitle).html('Tambah Bin Location');
				$(modalForm).modal('show');
			});

			// edit
			$('.table').on('click', '.btn-edit', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');

				action = 'edit';

				clearForm();

				$.ajax({
					url: "{{ route('binlocation.index') }}/"+id+"/edit",
					type: "GET",
					success: function (data) {
						$(bin_loc_id).val(data.binlocation.bin_loc_id);
						$(bin_loc_id_before).val(data.binlocation.bin_loc_id);
						$(bin_loc_name).val(data.binlocation.bin_loc_name);
						$(bin_loc_desc).val(data.binlocation.bin_loc_desc);
						$(wh_row_id).val(data.binlocation.wh_row_id);

						$(modalFormTitle).html('Edit Barang');
						$(modalForm).modal('show');
					}
				});
			});

			$('.table').on('click', '.btn-hapus', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');
				
				if (confirm('Anda yakin ingin menghapus data tersebut?')) {

					$.ajax({
						url: "{{ route('binlocation.index') }}/"+id+"/hapus",
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
						url: "{{ route('binlocation.index') }}/"+id+"/restore",
						type: "PATCH",
						data: {id},
						success: function (data) {
							alert('Data berhasil dikembalikan.');

							document.location = "{{ route('binlocation.index') }}";
						}
					});
				}
			});

			$(form).on('submit', function (e) {
				e.preventDefault();

				if (action === 'tambah') {
					url = "{{ route('binlocation.simpan') }}";
					type = 'POST';
				} else {
					var id = $(bin_loc_id).val();

					url = "{{ route('binlocation.index') }}/"+id+"/edit";
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
		});
	</script>
@stop