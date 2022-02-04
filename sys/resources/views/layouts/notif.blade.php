@if (Session::has('success'))
<div class="">
    <div class="alert alert-success fade in warning_msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <i class="fa fa-check icon_left"></i> Data berhasil di Tambah...
    </div>
  </div>
 @endif

@if (Session::has('error'))
  <div class="">
    <div class="alert alert-danger fade in warning_msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <i class="fa fa-close icon_left"></i> Data Gagal di Tambah :(
    </div>
  </div>
@endif

@if (Session::has('updated'))
  <div class="">
    <div class="alert alert-warning fade in warning_msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <i class="fa fa-check icon_left"></i> Data berhasil di Edit...
    </div>
  </div>
@endif

@if (Session::has('deleted'))
  <div class="">
    <div class="alert alert-danger fade in warning_msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <i class="fa fa-trash icon_left"></i> Data berhasil di Hapus...
    </div>
  </div>
@endif