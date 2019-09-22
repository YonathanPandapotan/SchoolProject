<?php

namespace App\Http\Controllers;

use App\ArtikelModel;
use App\BukuTamuModel;
use App\GuruModel;
use App\KategoriModel;
use App\KontakModel;
use App\UserModel;
use App\JurusanModel;
use App\SiswaModel;
use App\TentangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function home(){

        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $bukutamu = BukuTamuModel::all();
        $artikel = ArtikelModel::all();
        $guru = GuruModel::all();
        $kontak = KontakModel::all();

        $total = array(
            'bukutamu' => $bukutamu->count(),
            'artikel' => $artikel->count(),
            'guru' => $guru->count(),
            'kontak' => $kontak->count()
        );
        // return response($total['bukutamu']);

        return view('adminhome', ['data' => $total, 'login' => $user]);
    }

    public function bukutamu(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $bukutamu = BukuTamuModel::all();

        $data = array(
            'bukutamu' => $bukutamu
        );

        return view('adminbukutamu', ['login' => $user, 'data'=>$data]);
    }

    public function kategoriIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $kategori = KategoriModel::all();

        $data = array(
            'kategori' => $kategori
        );

        return view('adminkategori', ['login' => $user, 'data'=>$data]);
    }

    public function kategoriUpdate(Request $request){

        $error = array();
        $success = null;

        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $kategoriData = KategoriModel::where('id', $request->id);
        $data = array(
            'kategori' => $kategoriData
        );

        return view('adminkategoriform', ['login' => $user, 'data'=>$data, 'success' => $success, 'error' => $error]);
    }

    public function artikelIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $artikel = ArtikelModel::all();

        $data = array(
            'artikel' => $artikel
        );

        return view('adminArtikel', ['login' => $user, 'data'=>$data]);
    }

    public function jurusanIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $jurusan = JurusanModel::all();

        $data = array(
            'jurusan' => $jurusan
        );

        return view('adminJurusan', ['login' => $user, 'data'=>$data]);
    }

    public function siswaIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $siswa = SiswaModel::where('status', 'siswa')->get();

        $data = array(
            'siswa' => $siswa
        );

        return view('adminSiswa', ['login' => $user, 'data'=>$data]);
    }
    
    public function alumniIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $siswa = SiswaModel::where('status', 'alumni')->get();

        $data = array(
            'alumni' => $siswa
        );

        return view('adminAlumni', ['login' => $user, 'data'=>$data]);
    }

    public function guruIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $GuruModel = GuruModel::all();

        $data = array(
            'guru' => $GuruModel
        );

        return view('adminGuru', ['login' => $user, 'data'=>$data]);
    }

    public function tentang(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $error = array();
        $success = null;

        $tentang = TentangModel::all();

        $data = array(
            'title' => 'Edit Tentang',
            'tentang' => $tentang[0],
            'error' => $error,
            'success' => $success
          );

        return view('adminTentang', ['login' => $user, 'data' => $data]);
    }

    public function kontak(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $kontak = KontakModel::all();

        $data = array(
            'kontak' => $kontak
        );

        return view('adminKontak', ['login' => $user, 'data' => $data]);
    }
}
