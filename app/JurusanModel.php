<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JurusanModel extends Model
{
    //
    protected $table = 'jurusan';
    public $timestamps = false;
    protected $fillable = ['id_jurusan', 'nama_jurusan'];
    protected $primaryKey = 'id_jurusan';
    public $incrementing = false;
}
