@extends('dashboard')

@section('title')
Customer Master
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
    <i class="fa fa-barcode mr-2 mt-1"></i> <strong>Data Customer Master</strong>
    <div class="card-header-actions ml-auto">
      @if (Route::current()->getName() == 'customermaster.index')
      <a href="#" class="card-header-action btn-tambah" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
      @endif
    </div>
  </div>
  <div class="card-body">
    <table class="table table-striped table-bordered display nowrap" width="100%">
      <thead>
        <tr>
          <th width="30">No.</th>
          <th>ID</th>
          <th>Name</th>
          <th>Address</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Fax</th>
          <th>Person</th>
          <th>Contact Person</th>
          <th>Remarks</th>
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

        <div class="form-group row area">
          <div class="col-6">
            <label for="cust_id">Customer ID<span class="text-danger">*</span></label>
              {!! Form::text('cust_id', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
              {!! Form::hidden('cust_id_before', null, ['required', 'class' => 'form-control', 'placeholder' => ''])
              !!}
          </div>
          <div class="col-6">
            <label for="cust_name">Name<span class="text-danger">*</span></label>
              {!! Form::text('cust_name', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
          </div>
        </div>

        <div class="form-group row area">
          <div class="col-12">
            <label for="cust_address">Address<span class="text-danger">*</span></label>
            {!! Form::text('cust_address', null, ['required', 'class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group row area">
          <div class="col-4">
            <label for="cust_phone">Phone<span class="text-danger">*</span></label>
            {!! Form::text('cust_phone', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
          </div>

          <div class="col-4">
            <label for="cust_email">Email<span class="text-danger">*</span></label>
            {!! Form::text('cust_email', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
          </div>

          <div class="col-4">
            <label for="cust_fax">Fax<span class="text-danger">*</span></label>
            {!! Form::text('cust_fax', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
          </div>
        </div>

        <div class="form-group row area">
          <div class="col-6">
            <label for="cust_person">Customer Person<span class="text-danger">*</span></label>
            {!! Form::text('cust_person', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
          </div>
          <div class="col-6">
            <label for="cust_contact_person">Contact Person<span class="text-danger">*</span></label>
            {!! Form::text('cust_contact_person', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
          </div>
        </div>

        <div class="form-group row area">
          <div class="col-12">
            <label for="cust_remarks">Customer Remarks<span class="text-danger">*</span></label>
            {!! Form::text('cust_remarks', null, ['required', 'class' => 'form-control', 'placeholder' => '']) !!}
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

		var cust_id             = $(form).find('input[name="cust_id"]');
		var cust_id_before      = $(form).find('input[name="cust_id_before"]');
		var cust_name           = $(form).find('input[name="cust_name"]');
		var cust_address        = $(form).find('input[name="cust_address"]');
		var cust_remarks        = $(form).find('input[name="cust_remarks"]');
		var cust_phone          = $(form).find('input[name="cust_phone"]');
		var cust_email          = $(form).find('input[name="cust_email"]');
		var cust_fax            = $(form).find('input[name="cust_fax"]');
		var cust_person         = $(form).find('input[name="cust_person"]');
		var cust_contact_person = $(form).find('input[name="cust_contact_person"]');

		function clearForm() {
      $(':input').not(':submit ,[name="cust_id_before"]').val('');
		}

		$(document).ready(function () {
			var table = $('.table').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url : "{{ route('customermaster.datatables') }}",
					type: "POST",
					data: {
						is_delete: "{{ Route::current()->getName() == 'customermaster.index' ? 'N' : 'Y' }}"
					}
				},
				columns: [
					{'data': 'no'},
					{'data': 'cust_id'},
					{'data': 'cust_name'},
					{'data': 'cust_address'},
					{'data': 'cust_phone'},
          {'data': 'cust_email'},
          {'data': 'cust_fax'},
          {'data': 'cust_person'},
          {'data': 'cust_contact_person'},
          {'data': 'cust_remarks'},
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

				$(modalFormTitle).html('Tambah Customer');
				$(modalForm).modal('show');
			});

			// edit
			$('.table').on('click', '.btn-edit', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');

				action = 'edit';

				clearForm();

				$.ajax({
					url: "{{ route('customermaster.index') }}/"+id+"/edit",
					type: "GET",
					success: function (data) {
						$(cust_id).val(data.customer.cust_id);
						$(cust_id_before).val(data.customer.cust_id);
						$(cust_phone).val(data.customer.cust_phone);
            $(cust_name).val(data.customer.cust_name);
            $(cust_fax).val(data.customer.cust_fax);
            $(cust_email).val(data.customer.cust_email);
            $(cust_person).val(data.customer.cust_person);
            $(cust_contact_person).val(data.customer.cust_contact_person);
            $(cust_address).val(data.customer.cust_address);
            $(cust_remarks).val(data.customer.cust_remarks);

						$(modalFormTitle).html('Edit Customer');
						$(modalForm).modal('show');
					}
				});
			});

			$('.table').on('click', '.btn-hapus', function (e) {
				e.preventDefault();

				var id = this.getAttribute('data-id');
				
				if (confirm('Anda yakin ingin menghapus data tersebut?')) {

					$.ajax({
						url: "{{ route('customermaster.index') }}/"+id+"/hapus",
						type: "DELETE",
						data: {id},
						success: function (data) {
              toastr.success('Data berhasil dihapus.');

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
						url: "{{ route('customermaster.index') }}/"+id+"/restore",
						type: "PATCH",
						data: {id},
						success: function (data) {
              toastr.success('Data berhasil dikembalikan.');

							document.location = "{{ route('customermaster.index') }}";
						}
					});
				}
			});

			$(form).on('submit', function (e) {
				e.preventDefault();

				if (action === 'tambah') {
					url = "{{ route('customermaster.simpan') }}";
					type = 'POST';
				} else {
					var id = $(cust_id).val();

					url = "{{ route('customermaster.index') }}/"+id+"/edit";
					type = 'PATCH';
				}

				$.ajax({
					url: url,
					type: type,
					data: $(form).serialize(),
					success: function (data) {
						$(modalForm).modal('hide');
            table.ajax.reload();
            toastr.success('Data berhasil tersimpan.');
					}
				});
			});

			window.location.hash = "master-data";
		});
</script>
@stop