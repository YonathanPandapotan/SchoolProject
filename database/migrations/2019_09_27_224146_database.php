<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Database extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel', function (Blueprint $table) {
            $table->bigIncrements('id_artikel')->primary();
            $table->integer('id_kategori');
            $table->string('judul', 255);
            $table->string('penulis', 255);
            $table->longText('isi');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('images',255);
        });

        Schema::create('bukutamu', function (Blueprint $table) {
            $table->bigIncrements('id_bukutamu')->primary();
            $table->string('full_name', 255);
            $table->string('email', 255);
            $table->string('website', 255);
            $table->text('comment');
        });

        Schema::create('guru', function (Blueprint $table) {
            $table->bigIncrements('id_guru')->primary();
            $table->string('nama_lengkap', 255);
            $table->string('nip', 255);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('golongan', 255);
            $table->string('no_hp', 50);
            $table->string('tempat_lahir', 255);
            $table->string('mata_pelajaran', 255);
            $table->text('alamat');
            $table->string('images', 255);
            $table->string('status', 255);
        });

        Schema::create('jurusan', function (Blueprint $table) {
            $table->bigIncrements('id_jurusan')->primary();
            $table->string('nama_jurusan', 255);
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->bigIncrements('id_kategori')->primary();
            $table->string('nama_kategori', 255);
        });

        Schema::create('kontak', function (Blueprint $table) {
            $table->bigIncrements('id_kontak')->primary();
            $table->string('nama_lengkap', 255);
            $table->string('email', 255);
            $table->string('website', 255);
            $table->text('isi');
        });

        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('id_siswa')->primary();
            $table->integer('id_jurusan');
            $table->string('nama_lengkap', 255);
            $table->string('nis', 50);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('no_hp', 255);
            $table->integer('angkatan');
            $table->string('images', 255);
            $table->string('status', 200);
        });

        Schema::create('tentang', function (Blueprint $table){
            $table->longText('tentang');
        });

        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id_user')->primary();
            $table->string('nama_lengkap', 255);
            $table->string('email', 255);
            $table->string('no_hp', 255);
            $table->text('alamat');
            $table->string('username', 255);
            $table->string('password', 255);
            $table->string('images', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
