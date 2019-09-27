<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return redirect('/home');
});

Route::get('/admin', function(){
    return redirect('/login');
});

Route::get('/session', 'MainController@session');
Route::get('/checksession', 'MainController@checksession');

Route::group(['prefix' => '', 'as' => ''], function () {
    Route::get('/home', 'MainController@homePage');
    Route::get('/bukutamu', 'MainController@bukutamu');
    Route::get('/artikel', 'MainController@artikel');
    Route::get('/artikel/detail/{id}', 'MainController@artikelDetail');
    Route::get('/datasiswa', 'MainController@dataSiswa');
    Route::get('/siswa/detail/{id}', 'MainController@detailSiswa');
    Route::get('/dataguru', 'MainController@dataGuru');
    Route::get('/dataalumni', 'MainController@dataAlumni');
    Route::get('/alumni/detail/{id}', 'MainController@detailAlumni');
    Route::get('/tentangsekolah', 'MainController@tentangSekolah');
    Route::get('/kontak', 'MainController@kontak');
    Route::get('/login', 'MainController@login');
    Route::post('/login', 'MainController@login');
    Route::get('/logout', 'MainController@logout');
    Route::get('/listKategori/{id}', 'MainController@detailKategori');
});

Route::group(['prefix' => '', 'as' => ''], function () {
    Route::get('/admin/home', 'AdminController@home');
    Route::get('/admin/bukutamu', 'AdminController@bukutamu');
    
    Route::get('/admin/kategori', 'AdminController@kategoriIndex');
    Route::get('/admin/kategori/form', 'AdminController@kategoriForm');
    Route::get('/admin/kategori/form/{id}', 'AdminController@kategoriForm');
    Route::post('/admin/kategori/form', 'AdminController@kategoriForm');
    Route::post('/admin/kategori/form/{id}', 'AdminController@kategoriForm');
    Route::get('/admin/kategori/delete/{id}', 'AdminController@kategoriHapus');

    Route::get('/admin/artikel', 'AdminController@artikelIndex');
    Route::get('/admin/artikel/form', 'AdminController@artikelForm');
    Route::get('/admin/artikel/form/{id}', 'AdminController@artikelForm');
    Route::post('/admin/artikel/form/{id}', 'AdminController@artikelForm');
    Route::get('/admin/artikel/delete/{id}', 'AdminController@artikelHapus');

    Route::get('/admin/jurusan', 'AdminController@jurusanIndex');
    Route::get('/admin/jurusan/form', 'AdminController@jurusanForm');
    Route::get('/admin/jurusan/form/{id}', 'AdminController@jurusanForm');
    Route::post('/admin/jurusan/form', 'AdminController@jurusanForm');
    Route::post('/admin/jurusan/form/{id}', 'AdminController@jurusanForm');
    Route::get('/admin/jurusan/delete/{id}', 'AdminController@jurusanHapus');

    Route::get('/admin/siswa', 'AdminController@siswaIndex');
    Route::get('/admin/siswa/form', 'AdminController@siswaForm');
    Route::get('/admin/siswa/form/{id}', 'AdminController@siswaForm');
    Route::post('/admin/siswa/form/{id}', 'AdminController@siswaForm');
    Route::post('/admin/siswa/form', 'AdminController@siswaForm');
    Route::get('/admin/siswa/hapus/{id}', 'AdminController@hapusSiswa');
    Route::get('/admin/siswa/detail/{id}', 'AdminController@detailSiswa');

    Route::get('/admin/alumni', 'AdminController@alumniIndex');
    Route::get('/admin/alumni/form', 'AdminController@alumniForm');
    Route::get('/admin/alumni/form/{id}', 'AdminController@alumniForm');
    Route::post('/admin/alumni/form/{id}', 'AdminController@alumniForm');
    Route::post('/admin/alumni/form', 'AdminController@alumniForm');
    Route::get('/admin/alumni/hapus/{id}', 'AdminController@hapusAlumni');
    Route::get('/admin/alumni/detail/{id}', 'AdminController@detailSiswa');

    Route::get('/admin/guru', 'AdminController@guruIndex');
    Route::get('/admin/guru/form', 'AdminController@guruForm');
    Route::get('/admin/guru/form/{id}', 'AdminController@guruForm');
    Route::post('/admin/guru/form', 'AdminController@guruForm');
    Route::post('/admin/guru/form/{id}', 'AdminController@guruForm');
    Route::get('/admin/guru/hapus/{id}', 'AdminController@hapusGuru');
    Route::get('/admin/guru/detail/{id}', 'AdminController@detailGuru');

    Route::get('/admin/tentang', 'AdminController@tentang');
    Route::post('/admin/tentang', 'AdminController@tentang');

    Route::get('/admin/user', 'AdminController@manajemen');
    Route::get('/admin/user/form', 'AdminController@manajemenForm');
    Route::get('/admin/user/form/{id}', 'AdminController@manajemenForm');
    Route::POST('/admin/user/form', 'AdminController@manajemenForm');
    Route::POST('/admin/user/form/{id}', 'AdminController@manajemenForm');
    Route::get('/admin/user/hapus/{id}', 'AdminController@manajemenHapus');
    Route::get('/admin/user/detail/{id}', 'AdminController@manajemenUserDetail');

    Route::get('/admin/kontak', 'AdminController@kontak');
});



/*Route::get('/', function () {
    return view('welcome');
});*/
