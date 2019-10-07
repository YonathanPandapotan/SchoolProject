<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    //
    protected $table = 'kategori';
    public $timestamps = false;
    protected $fillable = ['id_kategori', 'nama_kategori'];
    protected $primaryKey = 'id_kategori';
    public $incrementing = false;
}
