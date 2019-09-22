@extends('maindashboard')

@section('kontentadmin')
<h1>Data <small>Kategori</small></h1>

<ol class="breadcrumb" style="font-size: 15px">
  <li>
    <a href="#"><span class="fa fa-home"></span> Home</a>
  </li>
  <li>
    <a href="#"><span class="fa fa-book"></span> Kategori</a>
  </li>
</ol>
<a href="/kategori/insert" class="btn btn-primary" style="margin-bottom: 20px;"><span class="fa fa-pencil"></span> Tambah Kategori</a>

<div class="col-lg-12">
	<table id="TableId" class="table table-responsive">
		<thead>
			<th>No</th>
			<th>Kategori</th>
			<th>Actions</th>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach ($data['kategori'] as $kategori) { ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $kategori->nama_kategori; ?></td>
					<td>
						<a href="/admin/kategori/form/<?php echo $kategori->id_kategori; ?>" class="btn btn-warning">Edit</a>
						<a href="/admin/kategori/delete/<?php echo $kategori->id_kategori; ?>" class="btn btn-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini ?')">Hapus</a>
					</td>
				</tr>
			<?php 
				$no++;
			} ?>
		</tbody>
	</table>
</div>
@endsection