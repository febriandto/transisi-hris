@extends('dashboard')

@section('title')
Data Barang
@stop

@section('content')
	<div class="card">
		<div class="card-header d-flex">
			<i class="fa fa-barcode mr-2 mt-1"></i> <strong>Daftar Barang</strong>
			<div class="card-header-actions ml-auto">
				@if (Route::current()->getName() == 'barang.index')
					<a href="#" class="card-header-action mr-3" title="Laporan"><i class="fa fa-print"></i> Laporan</a>
					<a href="barang/trash" class="card-header-action mr-3" title="trash"><i class="far fa-trash-alt"></i> Trash</a>
					<a href="#" class="card-header-action btn-tambah" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
				@endif
			</div>
		</div>
		<div>
{{-- 			{{ dd( Barang::where('id_barang', 1)->count() ) }} --}}
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered display nowrap" width="100%">
				<thead>
					<tr>
						<th width="30">No.</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Satuan</th>
						<th>Harga Beli</th>
						<th>Harga Jual</th>
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
						{!! Form::hidden('id_barang', null) !!}
						
						<div class="form-group row">
							<label for="kode_barang" class="col-sm-3 col-form-label">Kode Barang <span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::text('kode_barang', null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>
						
						<div class="form-group row">
							<label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang <span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::text('nama_barang', null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group row">
							<label for="harga_beli" class="col-sm-3 col-form-label">Harga Beli <span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::number('harga_beli', null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group row">
							<label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual <span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::number('harga_jual', null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group row">
							<label for="satuan" class="col-sm-3 col-form-label">Satuan <span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::text('satuan', null, ['required', 'class' => 'form-control']) !!}
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

		var idBarang = $(form).find('input[name="id_barang"]');
		var kodeBarang = $(form).find('input[name="kode_barang"]');
		var namaBarang = $(form).find('input[name="nama_barang"]');
		var harga_jual = $(form).find('input[name="harga_jual"]');
		var harga_beli = $(form).find('input[name="harga_beli"]');
		var satuan = $(form).find('input[name="satuan"]');

		function clearForm() {
			$(idBarang).val('');
			$(kodeBarang).val('');
			$(namaBarang).val('');
			$(harga_jual).val('');
			$(harga_beli).val('');
			$(satuan).val('');
		}

		$(document).ready(function () {
			var table = $('.table').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: "{{ route('barang.datatables') }}",
					type: "POST",
					data: {
						is_delete: "{{ Route::current()->getName() == 'barang.index' ? 'N' : 'Y' }}"
					}
				},
				columns: [
					{'data': 'no'},
					{'data': 'kode_barang'},
					{'data': 'nama_barang'},
					{'data': 'satuan'},
					{'data': 'harga_beli'},
					{'data': 'harga_jual'},
					{'data': 'aksi'}
				],
				responsive: true
			});

			$('.btn-tambah').on('click', function (e) {
				e.preventDefault();

				action = 'tambah';

				clearForm();

				$(modalFormTitle).html('Tambah Barang');
				$(modalForm).modal('show');
			});

			$('.table').on('click', '.btn-edit', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');

				action = 'edit';

				clearForm();

				$.ajax({
					url: "{{ route('barang.index') }}/"+id+"/edit",
					type: "GET",
					success: function (data) {
						$(idBarang).val(data.barang.id_barang);
						$(kodeBarang).val(data.barang.kode_barang);
						$(namaBarang).val(data.barang.nama_barang);
						$(harga_jual).val(data.barang.harga_jual);
						$(harga_beli).val(data.barang.harga_beli);
						$(satuan).val(data.barang.satuan);

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
						url: "{{ route('barang.index') }}/"+id+"/hapus",
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
						url: "{{ route('barang.index') }}/"+id+"/restore",
						type: "PATCH",
						data: {id},
						success: function (data) {
							alert('Data berhasil dikembalikan.');

							document.location = "{{ route('barang.index') }}";
						}
					});
				}
			});

			$(form).on('submit', function (e) {
				e.preventDefault();

				if (action === 'tambah') {
					url = "{{ route('barang.simpan') }}";
					type = 'POST';
				} else {
					var id = $(idBarang).val();

					url = "{{ route('barang.index') }}/"+id+"/edit";
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