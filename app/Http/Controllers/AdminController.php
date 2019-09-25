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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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

    public function kategoriForm(Request $req){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $succes = null;
        $error = array();
        $data = array(
            'success' => $succes,
            'error' => $error
        );

        if($req->id){
            $kategori = KategoriModel::where('id_kategori', $req->id)->get()->first();
            $data['kategori'] = $kategori;
        }

        if($req->method() == 'POST'){
            KategoriModel::updateOrCreate(['id_kategori' => $req->id], ['nama_kategori' => $req->kategori]);
            return redirect('admin/kategori');
        }

        return view('adminKategoriForm', ['login' => $user, 'data'=>$data]);
    }

    public function kategoriHapus(Request $req){
        KategoriModel::where('id_kategori', $req->id)->delete();
        return redirect('/admin/kategori');
    }

    public function artikelIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $artikel = ArtikelModel::all();

        $data = array(
            'artikel' => $artikel
        );

        return view('adminArtikel', ['login' => $user, 'data'=>$data]);
    }

    public function artikelForm(Request $req){

        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $succes = null;
        $error = array();
        $kategori = KategoriModel::all();
        $data = array(
            'success' => $succes,
            'error' => $error,
            'kategori' => $kategori
        );

        if($req->id){
            $artikel = ArtikelModel::where('id_artikel', $req->id)->get()->first();
            $data['artikel'] = $artikel;
        }

        if($req->method() == 'POST'){

            $file = $req->file('images');
            $name = time().'.jpg';
            $path = public_path().'/images/';
            $file->move($path, $name);
            
            ArtikelModel::updateOrCreate(['id_artikel' => $req->id],
            [
                'id_artikel' => random_int(0000, 9999),
                'id_kategori' => $req->kategori,
                'judul' => $req->judul,
                'penulis' => $req->penulis,
                'isi' => $req->penulis,
                'tanggal' => Carbon::now()->toDateString(),
                'waktu' => Carbon::now()->toTimeString(),
                'images' => $name
            ]);
            
            return redirect('admin/artikel');
        }

        return view('adminArtikelForm', ['login' => $user, 'data'=>$data]);
    }

    public function artikelHapus(Request $req){
        ArtikelModel::where('id_artikel', $req->id)->delete();
        return redirect('/admin/artikel');
    }

    public function jurusanIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $jurusan = JurusanModel::all();

        $data = array(
            'jurusan' => $jurusan
        );

        return view('adminJurusan', ['login' => $user, 'data'=>$data]);
    }

    public function jurusanForm(Request $req){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $succes = null;
        $error = array();
        $kategori = KategoriModel::all();

        if($req->id){
            return response('yeah boi');
        }

        if($req->method() == 'POST'){
            return response('oioi');
        }

        $data = array(
            'success' => $succes,
            'error' => $error,
            'kategori' => $kategori
        );

        return view('adminJurusanForm', ['login' => $user, 'data'=>$data]);
    }

    public function siswaIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $siswa = SiswaModel::where('status', 'siswa')->get();

        $data = array(
            'siswa' => $siswa
        );

        return view('adminSiswa', ['login' => $user, 'data'=>$data]);
    }

    public function siswaForm(Request $req){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $succes = null;
        $error = array();
        $jurusan = JurusanModel::all();
        $title = 'Tambah Siswa';

        if($req->id){
            return response('yeah boi');
        }

        if($req->method() == 'POST'){
            return response('oioi');
        }

        $data = array(
            'success' => $succes,
            'error' => $error,
            'jurusan' => $jurusan,
            'title' => $title
        );

        return view('adminSiswaForm', ['login' => $user, 'data'=>$data]);
    }
    
    public function alumniIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $siswa = SiswaModel::where('status', 'alumni')->get();

        $data = array(
            'alumni' => $siswa
        );

        return view('adminAlumni', ['login' => $user, 'data'=>$data]);
    }

    public function alumniForm(Request $req){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $succes = null;
        $error = array();
        $jurusan = JurusanModel::all();
        $title = 'Tambah Alumni';

        if($req->id){
            return response('yeah boi');
        }

        if($req->method() == 'POST'){
            return response('oioi');
        }

        $data = array(
            'success' => $succes,
            'error' => $error,
            'jurusan' => $jurusan,
            'title' => $title
        );

        return view('adminSiswaForm', ['login' => $user, 'data'=>$data]);
    }

    public function guruIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $GuruModel = GuruModel::all();

        $data = array(
            'guru' => $GuruModel
        );

        return view('adminGuru', ['login' => $user, 'data'=>$data]);
    }

    public function guruForm(Request $req){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $succes = null;
        $error = array();
        $jurusan = JurusanModel::all();
        $title = 'Tambah Guru';

        if($req->id){
            return response('yeah boi');
        }

        if($req->method() == 'POST'){
            return response('oioi');
        }

        $data = array(
            'success' => $succes,
            'error' => $error,
            'jurusan' => $jurusan,
            'title' => $title
        );

        return view('adminGuruForm', ['login' => $user, 'data'=>$data]);
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
