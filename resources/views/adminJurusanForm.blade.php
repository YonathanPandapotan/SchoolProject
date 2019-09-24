@extends('maindashboard')

@section('kontentadmin')
<h1>Tambah <small>Jurusan</small></h1>

<ol class="breadcrumb" style="font-size: 15px">
  <li>
    <a href="#"><span class="fa fa-home"></span> Home</a>
  </li>
  <li>
    <a href="#"><span class="fa fa-book"></span> Jurusan</a>
  </li>
  <li>
    <a href="#"><span class="fa fa-pencil"></span>Tambah Jurusan</a>
  </li>
</ol>
<div class="col-xs-12">
	<a href="/admin/jurusan" class="btn btn-danger" style="margin-bottom: 15px"><span class="fa fa-arrow-left"></span> Kembali</a>
</div>
<div class="col-xs-12">
	<?php 
	if (isset($data['error']) && count($data['error']) > 0) {
 ?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<ul class="list-square">
			<?php foreach ($data['error'] as $error) { ?>
				<li><?php echo $error; ?></li>
			<?php } ?>
		</ul>
	</div>
 <?php } elseif (isset($data['success'])) { ?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<?php echo $data['success']; ?>
	</div>
	<meta http-enquiv="refresh" content="1;url=<?php echo PATH; ?>?page=jurusan">
 <?php } ?>
</div>
<div class="col-xs-7">
	<form method="post">
		<div class="form-group">
			<label>Nama Jurusan</label>
			<input type="text" name="jurusan" class="form-control" <?php if (isset($data['jurusan'])) echo "value='" . $data['jurusan']->nama_jurusan . "'"; ?>>
		</div>
		<button type="submit" class="btn btn-primary">Simpan</button>
	</form>
</div>
@endsection