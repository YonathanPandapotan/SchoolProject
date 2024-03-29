@extends('main')

@section('kontent')
<?php 
	foreach ($data['kategoriList'] as $kategori) { 
?>
	<h2 class="title-top">Kategori <?php echo $kategori->nama_kategori; ?></h2>
	<div class="middle-panel">
		<div class="bottom-middle-panel">
			<ul>
				<?php 
					foreach ($data['artikel'] as $artikel) {
				 ?>
					<li>
						<div class="date">
							<?php echo $artikel->waktu; ?> - <?php echo date('d/m/Y', strtotime($artikel->tanggal)); ?>
						</div>
						<div class="title">
							<a href="/artikel/detail/<?php echo $artikel->id_artikel; ?>/<?php echo Str::slug($artikel->judul); ?>"><?php echo $artikel->judul; ?></a>
						</div>
						<div class="text">
							<?php echo substr(strip_tags($artikel->isi), 0, 250); ?>
						</div>
					</li>
				 <?php } ?>
			</ul>
		</div>
	</div>
<?php } ?>
@endsection