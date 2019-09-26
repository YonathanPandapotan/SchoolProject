@extends('maindashboard')

@section('kontentadmin')
<h1>Data <small>Guru</small></h1>

<ol class="breadcrumb" style="font-size: 15px">
  <li>
    <a href="#"><span class="fa fa-home"></span> Home</a>
  </li>
  <li>
    <a href="#"><span class="fa fa-book"></span> Guru</a>
  </li>
</ol>
<a href="/admin/guru/form" class="btn btn-primary" style="margin-bottom: 20px;"><span class="fa fa-pencil"></span> Tambah Guru</a>

<div class="col-lg-12">
	<table id="TableId" class="table table-responsive">
		<thead>
			<th>No</th>
			<th>Foto</th>
			<th>NIP</th>
			<th>Nama</th>
			<th>Mata Pelajaran</th>
			<th>Jenis Kelamin</th>
			<th>Status</th>
			<th>Actions</th>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach ($data['guru'] as $guru) { ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td>
						<?php if($guru->images) { ?> 
						<img src="{{asset('images/guru').'/'.$guru->images}}" style="width: 50px;height: 50px">
					<?php } else { ?>
						<img src="{{asset('images/no_user.jpg')}}" style="width: 50px;height: 50px">
					<?php } ?>
					</td>
					<td><?php echo $guru->nip; ?></td>
					<td><?php echo $guru->nama_lengkap; ?></td>
					<td><?php echo $guru->mata_pelajaran; ?></td>
					<td><?php echo $guru->jenis_kelamin; ?></td>
					<td><?php echo $guru->status; ?></td>
					<td>
						<a href="/admin/guru/form/<?php echo $guru->id_guru; ?>" class="btn btn-warning">Edit</a>
						<a href="/admin/guru/detail/<?php echo $guru->id_guru; ?>" class="btn btn-success">Detail</a>
						<a href="/admin/guru/hapus/<?php echo $guru->id_guru; ?>" class="btn btn-danger" onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini ?')">Hapus</a>
					</td>
				</tr>
			<?php 
				$no++;
			} ?>
		</tbody>
	</table>
</div>
@endsection