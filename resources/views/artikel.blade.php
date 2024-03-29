@extends('main')

@section('kontent')
<h2 class="title-top">Berita Terbaru</h2>

<div class="middle-panel">
	<div class="bottom-middlle-panel">
		<ul>
			<?php foreach ($data['artikel'] as $artikel) { ?>
				<li>
					<div class="date"><?php echo $artikel->waktu; ?> - <?php echo date('d/m/Y', strtotime($artikel->tanggal)); ?></div>
				<div class="title">
					<a href="/artikel/detail/<?php echo $artikel->id_artikel; ?>/<?php echo Str::slug($artikel->judul); ?>"><?php echo $artikel->judul; ?></a>
				</div>
				<div class="text">
					<?php echo substr(strip_tags($artikel->isi), 0,250); ?>
				</div>
				</li>
				
			<?php } ?>
		</ul>
	</div>
</div>

 @endsection