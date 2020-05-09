@extends('dashboard')

@section('title')
Pallet
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
    <i class="fa fa-barcode mr-2 mt-1"></i> <strong>Data Pallet</strong>
    <div class="card-header-actions ml-auto">
      @if (Route::current()->getName() == 'pallet.index')
      <a href="#" class="card-header-action btn-tambah" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
      @endif
    </div>
  </div>
  <div class="card-body">
    <table class="table table-striped table-bordered display nowrap" width="100%">
      <thead>
        <tr>
          <th width="30">No.</th>
          <th>Pallet ID</th>
          <th>Pallet Name</th>
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
          <label for="pallet_id" class="col-sm-3 col-form-label">Pallet ID<span class="text-danger">*</span></label>
          <div class="col-sm-12">
            {!! Form::text('pallet_id', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
            {!! Form::hidden('pallet_id_before', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
          </div>
        </div>

        <div class="form-group">
          <label for="pallet_name" class="col-sm-3 col-form-label">Pallet Name<span class="text-danger">*</span></label>
          <div class="col-sm-12">
            {!! Form::text('pallet_name', null, ['required', 'class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group">
          <label for="pallet_desc" class="col-sm-3 col-form-label">Description<span
              class="text-danger">*</span></label>
          <div class="col-sm-12">
            {!! Form::text('pallet_desc', null, ['required', 'class' => 'form-control']) !!}
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

		var pallet_id        = $(form).find('input[name="pallet_id"]');
		var pallet_id_before = $(form).find('input[name="pallet_id_before"]');
		var pallet_name      = $(form).find('input[name="pallet_name"]');
		var pallet_desc      = $(form).find('input[name="pallet_desc"]');

		function clearForm() {
			$(pallet_id).val('');
			$(pallet_name).val('');
			$(pallet_desc).val('');
		}

		$(document).ready(function () {
			var table = $('.table').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: "{{ route('pallet.datatables') }}",
					type: "POST",
					data: {
						is_delete: "{{ Route::current()->getName() == 'pallet.index' ? 'N' : 'Y' }}"
					}
				},
				columns: [
					{'data': 'no'},
					{'data': 'pallet_id'},
					{'data': 'pallet_name'},
					{'data': 'pallet_desc'},
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

				$(modalFormTitle).html('Tambah Pallet');
				$(modalForm).modal('show');
			});

			// edit
			$('.table').on('click', '.btn-edit', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');

				action = 'edit';

				clearForm();

				$.ajax({
					url: "{{ route('pallet.index') }}/"+id+"/edit",
					type: "GET",
					success: function (data) {
						$(pallet_id).val(data.pallet.pallet_id);
						$(pallet_id_before).val(data.pallet.pallet_id);
						$(pallet_name).val(data.pallet.pallet_name);
						$(pallet_desc).val(data.pallet.pallet_desc);

						$(modalFormTitle).html('Edit Pallet');
						$(modalForm).modal('show');
					}
				});
			});

			$('.table').on('click', '.btn-hapus', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');
				
				if (confirm('Anda yakin ingin menghapus data tersebut?')) {

					$.ajax({
						url: "{{ route('pallet.index') }}/"+id+"/hapus",
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
						url: "{{ route('pallet.index') }}/"+id+"/restore",
						type: "PATCH",
						data: {id},
						success: function (data) {
							alert('Data berhasil dikembalikan.');

							document.location = "{{ route('pallet.index') }}";
						}
					});
				}
			});

			$(form).on('submit', function (e) {
				e.preventDefault();

				if (action === 'tambah') {
					url = "{{ route('pallet.simpan') }}";
					type = 'POST';
				} else {
					var id = $(pallet_id).val();

					url = "{{ route('pallet.index') }}/"+id+"/edit";
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