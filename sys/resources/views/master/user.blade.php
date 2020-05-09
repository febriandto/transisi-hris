@extends('dashboard')

@section('title')
Users
@stop

@section('content')
<button type="button" class="btn btn-success swalDefaultSuccess">
                  Launch Success Toast
                </button>
								
	<div class="card">
		<div class="card-header d-flex">
			<i class="fa fa-barcode mr-2 mt-1"></i> <strong>Daftar Users</strong>
			<div class="card-header-actions ml-auto">
				@if (Route::current()->getName() == 'user.index')
					<a href="#" class="card-header-action btn-tambah" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
				@endif
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-bordered display nowrap" width="100%">
				<thead>
					<tr>
						<th width="30">No.</th>
						<th>User ID</th>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Input Date</th>
						<th>Input By</th>
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
							<label for="id_form" class="col-sm-3 col-form-label">User ID<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::text('id_form', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
								{!! Form::hidden('id_form_before', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="name_form" class="col-sm-3 col-form-label">Name<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::text('name_form', null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="username_form" class="col-sm-3 col-form-label">Username<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::text('username_form', null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<label for="email_form" class="col-sm-3 col-form-label">Email<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::text('email_form', null, ['required', 'class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group" id="password_form_group">
							<label for="password_form" class="col-sm-3 col-form-label">Password<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::password('password_form', ['required', 'class' => 'form-control']) !!}
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

	<div class="modal fade" id="modalFormReset" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal-title-reset"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				{!! Form::open(['method' => 'POST', 'id' => 'passwordReset']) !!}
					<div class="modal-body">

						<div class="form-group">
							<label for="id_form_reset" class="col-sm-3 col-form-label">User ID<span class="text-danger">*</span></label>
							<div class="col-sm-9">
								{!! Form::text('id_form_reset', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
							</div>
						</div>
						
						<div class="form-group">
							<label for="password_form_new" class="col-sm-3 col-form-label">New Password<span class="text-danger">*</span>
							</label>
							<div class="col-sm-9">
							<input type="password" class="form-control" name="password_form_new" required>
							</div>
						</div>

						<div class="form-group">
							<label for="password_form_new_repeat" class="col-sm-3 col-form-label">Repeat<span class="text-danger">*</span>
							</label>
							<div class="col-sm-9">
							<input type="password" class="form-control" name="password_form_new_repeat" required>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Reset</button>
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
		var modalFormReset = $('#modalFormReset');

		var modalFormTitle      = $(modalForm).find('.modal-title');
		var modalFormTitleReset = $(modalFormReset).find('#modal-title-reset');

		var form           = $(modalForm).find('form');
		var formReset      = $(modalFormReset).find('form');

		var id_form        = $(form).find('input[name="id_form"]');
		var id_form_before = $(form).find('input[name="id_form_before"]');
		var name_form      = $(form).find('input[name="name_form"]');
		var username_form  = $(form).find('input[name="username_form"]');
		var email_form     = $(form).find('input[name="email_form"]');
		var password_form  = $(form).find('input[name="password_form"]');
		
		var id_form_reset  = $(formReset).find('input[name="id_form_reset"]');
		var password_form_new  = $(formReset).find('input[name="password_form_new"]');
		var password_form_new_repeat  = $(formReset).find('input[name="password_form_new_repeat"]');

		function clearForm() {
			$(id_form).val('');
			$(id_form_reset).val('');
			$(id_form_before).val('');
			$(name_form).val('');
			$(email_form).val('');
			$(username_form).val('');
			$(password_form).val('');
		}

		$(document).ready(function () {
			var table = $('.table').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: "{{ route('user.datatables') }}",
					type: "POST",
					data: {
						is_delete: "{{ Route::current()->getName() == 'user.index' ? 'N' : 'Y' }}"
					}
				},
				columns: [
					{'data': 'no'},
					{'data': 'id'},
					{'data': 'name'},
					{'data': 'username'},
					{'data': 'email'},
					{'data': 'created_at'},
					{'data': 'input_by'},
					{'data': 'aksi'}
				],
				responsive: true
			});

			// tambah
			$('.btn-tambah').on('click', function (e) {
				e.preventDefault();

				action = 'tambah';

				clearForm();

				$(modalFormTitle).html('Tambah User');
				$(modalForm).modal('show');
			});
			
			// password reset
			$('.table').on('click', '.btn-reset', function (e) {
				e.preventDefault();

				$(id_form_reset).val('');
				$(password_form_new).val('');
				$(password_form_new_repeat).val('');

				var id = this.getAttribute('data-id');

				$(id_form_reset).val(id);

				action = 'reset';

				$(modalFormTitleReset).html('Password Reset');
			  $(modalFormReset).modal('show');

			});

			// end password reset

			// edit
			$('.table').on('click', '.btn-edit', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');

				action = 'edit';

				$('#password_form_group').remove();

				clearForm();

				$.ajax({
					url: "{{ route('user.index') }}/"+id+"/edit",
					type: "GET",
					success: function (data) {
						$(id_form).val(data.user.id);
						$(id_form_before).val(data.user.id);
						$(name_form).val(data.user.name);
						$(username_form).val(data.user.username);
						$(email_form).val(data.user.email);

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
						url: "{{ route('user.index') }}/"+id+"/hapus",
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
						url: "{{ route('user.index') }}/"+id+"/restore",
						type: "PATCH",
						data: {id},
						success: function (data) {
							alert('Data berhasil dikembalikan.');

							document.location = "{{ route('user.index') }}";
						}
					});
				}
			});

			$(form).on('submit', function (e) {
				e.preventDefault();

				if (action === 'tambah') {
					url = "{{ route('user.simpan') }}";
					type = 'POST';
				}
				if(action === 'edit'){
					var id = $(id_form).val();

					url = "{{ route('user.index') }}/"+id+"/edit";
					type = 'PATCH';
				}

				if(action === 'reset'){
					var id = $(id_form_reset).val();

					url = "{{ route('user.index') }}/"+id+"/resetSave";
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

			$('#passwordReset').on('submit', function (e) {
				e.preventDefault();

				if(action === 'reset'){
					var id = $(id_form_reset).val();

					url = "{{ route('user.index') }}/"+id+"/resetSave";
					type = 'PATCH';
				}

				if (confirm('Anda yakin ingin mengganti password user ini?')) {
					
					$.ajax({
					url: url,
					type: type,
					data: $('#passwordReset').serialize(),
					success: function (data) {
						$(modalFormReset).modal('hide');
						table.ajax.reload();
					}
				});

				}
			});

		});
	</script>
@stop