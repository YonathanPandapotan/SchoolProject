@extends('main')

@section('kontent')
<h2 class="title-top">Data Alumni</h2>

<table class="table-striped paging-table">	
	<thead>	
		<th>Foto</th>
		<th>NIS</th>
		<th>Nama</th>
		<th>Kelas</th>
		<th style="width: 88px">Jenis Kelamin</th>
		<th>Angkatan</th>
	</thead>
	<tbody>
		<?php 
			foreach ($data['alumni'] as $alumni) {
		 ?>
			<tr>
				<td>
					<?php if($alumni->images) { ?>
						<img src="{{asset('images/alumni').'/'.$alumni->images}}" alt="" style="width: 50px;height: 50px;">
					<?php }else { ?>
						<img src="{{asset('images/no_user.jpg')}}" alt="" style="width: 50px;height: 50px;">
					<?php } ?>		
				</td>
				<td style="vertical-align: middle"><?php echo $alumni->nis; ?></td>
				<td style="vertical-align: middle;">
					<a href="/alumni/detail/<?php echo $alumni->id_siswa ?>"><?php echo $alumni->nama_lengkap; ?></a>
				</td>
				<td style="vertical-align: middle;"><?php echo $alumni->nama_jurusan; ?></td>
				<td style="vertical-align: middle;"><?php echo $alumni->jenis_kelamin; ?></td>
				<td style="vertical-align: middle;"><?php echo $alumni->angkatan; ?></td>
			</tr>
		 <?php } ?>
	</tbody>
</table>
 @endsection