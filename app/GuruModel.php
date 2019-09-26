<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuruModel extends Model
{
    //
    protected $table = 'guru';
    public $timestamps = false;
    protected $fillable = ['id_guru', 'nama_lengkap', 'nip', 'jenis_kelamin', 'golongan', 'no_hp', 'tempat_lahir', 'alamat', 'images', 'status'];
    protected $primaryKey = 'id_guru';
}
