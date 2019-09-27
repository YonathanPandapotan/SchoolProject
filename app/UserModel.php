<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
    protected $table = "user";
    public $timestamps = false;
    protected $fillable = ['id_guru', 'nama_lengkap', 'email', 'no_hp', 'alamat', 'username', 'password', 'images'];
    protected $primaryKey = 'id_user';
}
