@extends('main')

@section('kontent')
<h2 class="title-top">Tentang Sekolah</h2>

<div>
	<?php if($data['tentang']) {
		echo $data['tentang']->tentang; 
		}else{
			echo ''; 
		}?>
</div>

 @endsection