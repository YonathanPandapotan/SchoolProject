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
            KategoriModel::updateOrCreate(['id_kategori' => $req->id], ['id_kategori' => Str::random(5), 'nama_kategori' => $req->kategori]);
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
            $file = null;
            $name = '';
            $path = '';
            if($file = $req->file('images')){
                $file = $req->file('images');
                $name = time().'.jpg';
                $path = public_path().'/images/artikel';
            }
            else{
                $name = $req->images;
            }

            $artikel= null;
            if(ArtikelModel::where('id_artikel', $req->id)->first()){
                $artikel = ArtikelModel::where('id_artikel', $req->id)->first();
                $artikel->id_kategori = $req->kategori;
                $artikel->judul = $req->judul;
                $artikel->penulis = $req->penulis;
                $artikel->isi = $req->isi;
                $artikel->tanggal = Carbon::now()->toDateString();
                $artikel->waktu = Carbon::now()->toTimeString();
                $artikel->images = $name;
                $artikel->save();
            }
            else{
                $artikel = new ArtikelModel();
                $artikel->id_artikel = Str::random(25);
                $artikel->id_kategori = $req->kategori;
                $artikel->judul = $req->judul;
                $artikel->penulis = $req->penulis;
                $artikel->isi = $req->isi;
                $artikel->tanggal = Carbon::now()->toDateString();
                $artikel->waktu = Carbon::now()->toTimeString();
                $artikel->images = $name;
                $artikel->save();
            }
            if($file = $req->file('images')){
                $file->move($path, $name);
            }
            
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
            JurusanModel::updateOrCreate(['id_jurusan' => $req->id], ['id_jurusan' => Str::random(5), 'nama_jurusan' => $req->jurusan]);
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
        $siswa = SiswaModel::where('status', 'Siswa')->get();

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
            $file = null;
            $name = '';
            $path = '';
            if($req->file('images')){
                $file = $req->file('images');
                $name = time().'.jpg';
                $path = public_path().'/images/siswa';
            }
            else{
                $name = $req->images;
            }

            $siswa = null;
            if(SiswaModel::where('id_siswa', $req->id)->first()){
                $siswa = SiswaModel::where('id_siswa', $req->id)->first();
                $siswa->id_jurusan = $req->jurusan;
                $siswa->nama_lengkap = $req->nama;
                $siswa->nis = $req->nis;
                $siswa->jenis_kelamin = $req->jenis_kelamin;
                $siswa->alamat = $req->alamat;
                $siswa->no_hp = $req->nomor_hp;
                $siswa->angkatan = $req->angkatan;
                $siswa->images = $name;
                $siswa->status = $req->status;
                $siswa->save();
            }
            else{
                $siswa = new SiswaModel();
                $siswa->id_siswa = Str::random(35);
                $siswa->id_jurusan = $req->jurusan;
                $siswa->nama_lengkap = $req->nama;
                $siswa->nis = $req->nis;
                $siswa->jenis_kelamin = $req->jenis_kelamin;
                $siswa->alamat = $req->alamat;
                $siswa->no_hp = $req->nomor_hp;
                $siswa->angkatan = $req->angkatan;
                $siswa->images = $name;
                $siswa->status = $req->status;
                $siswa->save();
            }
            
            if($req->file('images')){
                $file->move($path, $name);
            }
            
            return redirect('admin/siswa');
        }

        return view('adminSiswaForm', ['login' => $user, 'data'=>$data]);
    }

    public function hapusSiswa(Request $req){
        SiswaModel::where('id_siswa', $req->id)->delete();
        return redirect('/admin/siswa');
    }

    public function detailSiswa(Request $req){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $siswa = SiswaModel::join ('jurusan', 'jurusan.id_jurusan', '=', 'siswa.id_jurusan')->where('siswa.id_siswa', $req->id)->get()->first();

        $data = array(
            'title' => 'Detail Siswa',
            'siswa' => $siswa
        );

        return view('adminSiswaDetail', ['login' => $user, 'data' => $data]);
    }
    
    public function alumniIndex(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $siswa = SiswaModel::where('status', 'Alumni')->get();

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
        else{
            $name = $req->images;
        }

        if($req->method() == 'POST'){

            $file = null;
            $name = '';
            $path = '';
            if($req->file('images')){
                $file = $req->file('images');
                $name = time().'.jpg';
                $path = public_path().'/images/alumni';
            }

            $siswa = null;
            if(SiswaModel::where('id_siswa', $req->id)->first()){
                $siswa = SiswaModel::where('id_siswa', $req->id)->first();
                $siswa->id_jurusan = $req->jurusan;
                $siswa->nama_lengkap = $req->nama;
                $siswa->nis = $req->nis;
                $siswa->jenis_kelamin = $req->jenis_kelamin;
                $siswa->alamat = $req->alamat;
                $siswa->no_hp = $req->nomor_hp;
                $siswa->angkatan = $req->angkatan;
                $siswa->images = $name;
                $siswa->status = $req->status;
                $siswa->save();
            }
            else{
                $siswa = new SiswaModel();
                $siswa->id_siswa = Str::random(35);
                $siswa->id_jurusan = $req->jurusan;
                $siswa->nama_lengkap = $req->nama;
                $siswa->nis = $req->nis;
                $siswa->jenis_kelamin = $req->jenis_kelamin;
                $siswa->alamat = $req->alamat;
                $siswa->no_hp = $req->nomor_hp;
                $siswa->angkatan = $req->angkatan;
                $siswa->images = $name;
                $siswa->status = $req->status;
                $siswa->save();
            }
            
            if($req->file('images')){
                $file->move($path, $name);
            }
            
            return redirect('admin/alumni');
        }

        return view('adminAlumniForm', ['login' => $user, 'data'=>$data]);
    }

    public function detailAlumni(Request $req){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $siswa = SiswaModel::join ('jurusan', 'jurusan.id_jurusan', '=', 'siswa.id_jurusan')->where('siswa.id_siswa', $req->id)->get()->first();

        $data = array(
            'title' => 'Detail Siswa',
            'siswa' => $siswa
        );

        return view('adminAlumniDetail', ['login' => $user, 'data' => $data]);
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

            $file = null;
            $name = '';
            $path = '';
            if($req->file('images')){
                $file = $req->file('images');
                $name = time().'.jpg';
                $path = public_path().'/images/guru';
            }

            else{
                $name = $req->images;
            }

            $guru = null;
            if(GuruModel::where('id_guru', $req->id_guru)->first()){
                $guru->nama_lengkap = $req->nama;
                $guru->nip = $req->nip;
                $guru->jenis_kelamin = $req->jenis_kelamin;
                $guru->golongan = $req->golongan;
                $guru->no_hp = $req->nomor_hp;
                $guru->tempat_lahir = $req->tempat_lahir;
                $guru->mata_pelajaran = $req->mata_pelajaran;
                $guru->alamat = $req->alamat;
                $guru->images = $name;
                $guru->status = $req->status;
                $guru->save();
            }else{
                $guru = new GuruModel();
                $guru->id_guru = Str::random(10);
                $guru->nama_lengkap = $req->nama;
                $guru->nip = $req->nip;
                $guru->jenis_kelamin = $req->jenis_kelamin;
                $guru->golongan = $req->golongan;
                $guru->no_hp = $req->nomor_hp;
                $guru->tempat_lahir = $req->tempat_lahir;
                $guru->mata_pelajaran = $req->mata_pelajaran;
                $guru->alamat = $req->alamat;
                $guru->images = $name;
                $guru->status = $req->status;
                $guru->save();
            }

            if($req->file('images')){
                $file->move($path, $name);
            }
            
            return redirect('admin/guru');
        }

        return view('adminGuruForm', ['login' => $user, 'data'=>$data]);
    }

    public function hapusGuru(Request $req){
        GuruModel::where('id_guru', $req->id)->delete();
        return redirect('/admin/guru');
    }

    public function detailGuru(Request $req){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $guru = GuruModel::where('id_guru', $req->id)->get()->first();

        $data = array(
            'title' => 'Detail Guru',
            'guru' => $guru
        );

        return view('adminGuruDetail', ['login' => $user, 'data' => $data]);
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

    public function manajemen(){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $userData = UserModel::all();

        $data = array(
            'user' => $userData,
            'title' => 'Data User'
        );

        return view('adminUser', ['login' => $user, 'data' => $data]);
    }

    public function manajemenForm(Request $req){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $succes = null;
        $error = array();
        $title = 'Tambah User';
        $data = array(
            'success' => $succes,
            'error' => $error,
            'title' => $title
        );

        if($req->id){
            $guru = UserModel::where('id_user', $req->id)->get()->first();
            $data['user'] = $guru;
            $data['title'] = 'Edit Guru';
        }

        if($req->method() == 'POST'){

            $file = null;
            $name = '';
            $path = '';
            if($req->file('images')){
                $file = $req->file('images');
                $name = time().'.jpg';
                $path = public_path().'/images/user';
            }
            else{
                $name = $req->images;
            }

            $user = null;
            if(UserModel::where('id_user', $req->id)->first()){
                $user->nama_lengkap = $req->nama_lengkap;
                $user->email = $req->email;
                $user->no_hp = $req->no_hp;
                $user->alamat = $req->alamat;
                $user->username = $req->username;
                $user->password = $req->password;
                $user->images = $name;
                $user->save();
            }
            else{
                $user = new UserModel();
                $user->id_user = Str::random(10);
                $user->nama_lengkap = $req->nama_lengkap;
                $user->email = $req->email;
                $user->no_hp = $req->no_hp;
                $user->alamat = $req->alamat;
                $user->username = $req->username;
                $user->password = $req->password;
                $user->images = $name;
                $user->save();
            }

            if($req->file('images')){
                $file->move($path, $name);
            }
            
            return redirect('admin/user');
        }

        return view('adminUserForm', ['login' => $user, 'data'=>$data]);
    }

    public function manajemenHapus(Request $req){
        UserModel::where('id_user', $req->id)->delete();
        return redirect('/admin/user');
    }

    public function manajemenUserDetail(Request $req){
        $user = UserModel::where('username', Session::get('username'))->get()->first();
        $userData = UserModel::where('id_user', $req->id)->get()->first();

        $data = array(
            'title' => 'Detail Guru',
            'user' => $userData
        );

        return view('adminUserDetail', ['login' => $user, 'data' => $data]);
    }    

}

