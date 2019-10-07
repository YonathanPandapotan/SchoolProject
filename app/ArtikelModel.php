<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtikelModel extends Model
{
    //
    protected $table = 'artikel';

    public $fillable = ['id_artikel', 'id_kategori', 'judul', 'penulis', 'isi', 'tanggal', 'waktu', 'images'];
    protected $primaryKey = 'id_artikel';
    public $timestamps = false;
    public $incrementing = false;
}
