@extends('maindashboard')

@section('kontentadmin')
<h1>Data <small>Alumni</small></h1>

<ol class="breadcrumb" style="font-size: 15px">
  <li>
    <a href="#"><span class="fa fa-home"></span> Home</a>
  </li>
  <li>
    <a href="#"><span class="fa fa-book"></span> Alumni</a>
  </li>
</ol>
<a href="/admin/alumni/form" class="btn btn-primary" style="margin-bottom: 20px;"><span class="fa fa-pencil"></span> Tambah Alumni</a>

<div class="col-lg-12">
	<table id="TableId" class="table table-responsive">
		<thead>
			<th>No</th>
			<th>Foto</th>
			<th>Nis</th>
			<th>Nama</th>
			<th>Jenis Kelamin</th>
			<th>Angkatan</th>
			<th>Actions</th>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach ($data['alumni'] as $alumni) { ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td>
						<?php if($alumni->images) { ?> 
						<img src="{{asset('images/alumni').'/'.$alumni->images}}" style="width: 50px;height: 50px" alt="<?php echo $alumni->judul; ?>">
					<?php } else { ?>
						<img src="{{asset('images/no_user.jpg')}}" style="width: 50px;height: 50px">
					<?php } ?>
					</td>
					<td><?php echo $alumni->nis; ?></td>
					<td><?php echo $alumni->nama_lengkap; ?></td>
					<td><?php echo $alumni->jenis_kelamin; ?></td>
					<td><?php echo $alumni->angkatan; ?></td>
					<td>
						<a href="/admin/alumni/form/<?php echo $alumni->id_siswa; ?>" class="btn btn-warning">Edit</a>
						<a href="/admin/alumni/detail/<?php echo $alumni->id_siswa; ?>" class="btn btn-info">Detail</a>
						<a href="/admin/alumni/hapus/<?php echo $alumni->id_siswa; ?>" class="btn btn-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini ?')">Hapus</a>
					</td>
				</tr>
			<?php 
				$no++;
			} ?>
		</tbody>
	</table>
</div>
@endsection