<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    //
    protected $table = 'siswa';

    public $fillable = ['id_siswa', 'id_jurusan', 'nama_lengkap', 'nis', 'jenis_kelamin', 'alamat', 'nomor_hp', 'angkatan', 'images', 'status'];
    protected $primaryKey = 'id_siswa';
    public $timestamps = false;
}