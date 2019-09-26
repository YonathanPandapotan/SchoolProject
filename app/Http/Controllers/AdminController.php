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
            $path = public_path().'/images/artikel';
            
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

            $file->move($path, $name);
            
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

        $data = array(
            'success' => $succes,
            'error' => $error
        );

        if($req->id){
            $jurusan = JurusanModel::where('id_jurusan', $req->id)->get()->first();
            $data['jurusan'] = $jurusan;
        }

        if($req->method() == 'POST'){
            JurusanModel::updateOrCreate(['id_jurusan' => $req->id], ['nama_jurusan' => $req->jurusan]);
            return redirect('admin/jurusan');
        }        

        return view('adminJurusanForm', ['login' => $user, 'data'=>$data]);
    }

    public function jurusanHapus(Request $req){
        JurusanModel::where('id_jurusan', $req->id)->delete();
        return redirect('/admin/jurusan');
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

        $data = array(
            'success' => $succes,
            'error' => $error,
            'jurusan' => $jurusan,
            'title' => $title
        );

        if($req->id){
            $siswa = SiswaModel::where('id_siswa', $req->id)->get()->first();
            $data['siswa'] = $siswa;
            $data['title'] = 'Edit Siswa';
        }

        if($req->method() == 'POST'){

            $file = $req->file('images');
            $name = time().'.jpg';
            $path = public_path().'/images/siswa';
            
            SiswaModel::updateOrCreate(['id_siswa' => $req->id],
            [
                'id_jurusan' => $req->jurusan,
                'nama_lengkap' => $req->nama,
                'nis' => $req->nis,
                'jenis_kelamin' => $req->jenis_kelamin,
                'alamat' => $req->alamat,
                'nomor_hp' => $req->nomor_hp,
                'angkatan' => $req->angkatan,
                'images' => $name,
                'status' => $req->status
            ]);

            $file->move($path, $name);
            
            return redirect('admin/siswa');
        }

        return view('adminSiswaForm', ['login' => $user, 'data'=>$data]);
    }

    public function hapusSiswa(Request $req){
        SiswaModel::where('id_siswa', $req->id)->delete();
        return redirect('/admin/siswa');
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

        $data = array(
            'success' => $succes,
            'error' => $error,
            'jurusan' => $jurusan,
            'title' => $title
        );

        if($req->id){
            $siswa = SiswaModel::where('id_siswa', $req->id)->get()->first();
            $data['siswa'] = $siswa;
            $data['title'] = 'Edit Alumni';
        }

        if($req->method() == 'POST'){

            $file = $req->file('images');
            $name = time().'.jpg';
            $path = public_path().'/images/alumni';
            
            SiswaModel::updateOrCreate(['id_siswa' => $req->id],
            [
                'id_jurusan' => $req->jurusan,
                'nama_lengkap' => $req->nama,
                'nis' => $req->nis,
                'jenis_kelamin' => $req->jenis_kelamin,
                'alamat' => $req->alamat,
                'nomor_hp' => $req->nomor_hp,
                'angkatan' => $req->angkatan,
                'images' => $name,
                'status' => $req->status
            ]);

            $file->move($path, $name);
            
            return redirect('admin/alumni');
        }

        return view('adminAlumniForm', ['login' => $user, 'data'=>$data]);
    }

    public function hapusAlumni(Request $req){
        SiswaModel::where('id_siswa', $req->id)->delete();
        return redirect('/admin/alumni');
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
        $data = array(
            'success' => $succes,
            'error' => $error,
            'jurusan' => $jurusan,
            'title' => $title
        );

        if($req->id){
            $guru = GuruModel::where('id_guru', $req->id)->get()->first();
            $data['guru'] = $guru;
            $data['title'] = 'Edit Guru';
        }

        if($req->method() == 'POST'){
            $file = $req->file('images');
            $name = time().'.jpg';
            $path = public_path().'/images/guru';
            
            GuruModel::updateOrCreate(['id_guru' => $req->id],
            [
                'nama_lengkap' => $req->nama,
                'nip' => $req->nip,
                'jenis_kelamin' => $req->jenis_kelamin,
                'golongan' => $req->golongan,
                'no_hp' => $req->nomor_hp,
                'tempat_lahir' => $req->tempat_lahir,
                'mata_pelajaran' => $req->mata_pelajaran,
                'alamat' => $req->alamat,
                'images' => $name,
                'status' => $req->status
            ]);

            $file->move($path, $name);
            
            return redirect('admin/guru');
        }

        return view('adminGuruForm', ['login' => $user, 'data'=>$data]);
    }

    public function hapusGuru(Request $req){
        GuruModel::where('id_guru', $req->id)->delete();
        return redirect('/admin/guru');
    }

    public function tentang(Request $req){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $error = array();
        $success = null;

        if($req->method() == 'POST'){
            TentangModel::truncate();

            $data = new TentangModel();
            $data->tentang = $req->tentang;
            $data->save();

        }

        $tentang = TentangModel::get()->first();

        $data = array(
            'title' => 'Edit Tentang',
            'tentang' => $tentang,
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
