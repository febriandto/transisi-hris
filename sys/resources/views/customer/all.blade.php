@extends('dashboard')

@section('title')
Customer Master
@stop

@section('breadcrumb')
<span class="small">Customer Master</span>
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex">
    <div class="card-header-actions">
      <a href="{{ route('customermaster.add') }}" class="card-header-action btn-tambah btn-primary btn btn-sm btn" title="Tambah">
      	<i class="fa fa-plus mr-2"></i> Add New
      </a>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover table-striped table-sm" width="100%" id="dataTables" id="dataTables">
      
      <thead>
        <tr>
          <th width="5%">No.</th>
          <th>ID</th>
          <th>Cust Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Fax</th>
          <th>Remarks</th>
          <th width="50">Action</th>
        </tr>
      </thead>

      <tbody>
      	@foreach ($customers as $customer)
      	<tr>
      		<td class="text-center">{{ $no++ }}</td>
      		<td>{{ $customer['cust_id'] }}</td>
      		<td>{{ $customer['cust_name'] }}</td>
      		<td>{{ $customer['cust_email'] }}</td>
      		<td>{{ $customer['cust_phone'] }}</td>
      		<td>{{ $customer['cust_fax'] }}</td>
      		<td>{{ $customer['cust_remarks'] }}</td>
      		<td>
						<button type="button" style="font-size: small;" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">Action</button>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('customermaster.edit', $customer['cust_id']) }}">
									<i class="fa fa-edit mr-2"></i> Edit
								</a>
							</li>
							<li>
{{-- 								<a href="{{ route('customermaster.inventory_monitor', $customer['cust_id']) }}">
									<i class="fa fa-pallet mr-2"></i>Inventory Monitori
								</a> --}}
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

@section('script')
{{-- <script type="text/javascript">
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
          {'data': 'cust_email'},
					{'data': 'cust_phone'},
          {'data': 'cust_fax'},
          {'data': 'cust_remarks'},
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
</script> --}}
@stop