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
Route::get('/home', 'MainController@homePage');
Route::get('/bukutamu', 'MainController@bukutamu');
Route::get('/artikel', 'MainController@artikel');
Route::get('/artikel/detail/{id}', 'MainController@artikelDetail');
Route::get('/datasiswa', 'MainController@dataSiswa');
Route::get('/dataguru', 'MainController@dataGuru');
Route::get('/dataalumni', 'MainController@dataAlumni');
Route::get('/tentangsekolah', 'MainController@tentangSekolah');
Route::get('/kontak', 'MainController@kontak');
Route::get('/login', 'MainController@login');

/*Route::get('/', function () {
    return view('welcome');
});*/
