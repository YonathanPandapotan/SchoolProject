<?php

namespace App\Http\Controllers;

use App\ArtikelModel;
use App\BukuTamuModel;
use App\GuruModel;
use App\KategoriModel;
use App\KontakModel;
use App\SiswaModel;
use App\TentangModel;
use App\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class MainController extends Controller
{

    public function homePage() {
        $data = $this->template();
        $artikel = ArtikelModel::all();
        $data['artikel'] = $artikel;

        return view('home', ['data' => $data]);
    }

    public function cookies(Request $request){

        return response($request->cookie('key'));

        $cookie = Cookie::make('key', 'value', 1);
        Cookie::queue('key', 'value', 1);

        return response('cookies!')->withCookie($cookie);
    }
    
    public function bukutamu(){
        $bukutamu = BukuTamuModel::all();
        $total = $bukutamu->count();
        
        $data = $this->template();
        $data['bukutamu'] = $bukutamu;
        $data['total'] = $total;

        return view('bukutamu', ['data' => $data]);
    }

    public function artikel(){
        $data = $this->template();
        $artikel = ArtikelModel::all();
        $data['artikel'] = $artikel;

        return view('artikel', ['data' => $data]);
    }

    public function artikelDetail($id){
        $data = $this->template();
        $artikel = ArtikelModel::where('id_artikel', $id)->get();

        if(count($data) == 0){
            $data['error_message'] = 'Artikel tidak ditemukan';
            return view('errordetailartikel', ['data' => $data]);
        }

        $previous = ArtikelModel::where('id_artikel', '<', $artikel[0]['id_artikel'])->max('id_artikel');
        $next = ArtikelModel::where('id_artikel', '>', $artikel[0]['id_artikel'])->min('id_artikel');
        $data['artikel'] = $artikel;
        $data['prev'] = $previous;
        $data['next'] = $next;

        return view('detailartikel', ['data' => $data]);
    }

    public function dataSiswa(){
        $data = $this->template();
        $siswa = SiswaModel::where('status', 'Siswa')->get();
        $data['siswa'] = $siswa;

        return view('siswa', ['data' => $data]);
    }

    public function detailSiswa(Request $req){
        $data = $this->template();

        $siswa = SiswaModel::where('id_siswa', $req->id)->get();

        $data['siswa'] = $siswa;

        return view('detailSiswa', ['data' => $data]);
    }

    public function dataGuru(){
        $data = $this->template();
        $dataguru = GuruModel::all();
        $data['guru'] = $dataguru;

        return view('dataguru', ['data' => $data]);
    }

    public function detailGuru(Request $req){
        $data = $this->template();

        $guru = GuruModel::where('id_guru', $req->id)->get();

        $data['guru'] = $guru;

        return view('detailGuru', ['data' => $data]);
    }

    public function dataAlumni(){
        $data = $this->template();
        $dataalumni = SiswaModel::where('status', 'Alumni')->get();
        $data['alumni'] = $dataalumni;

        return view('alumni', ['data' => $data]);
    }

    public function detailAlumni(Request $req){
        $data = $this->template();

        $alumni = SiswaModel::where('id_siswa', $req->id)->get();

        $data['siswa'] = $alumni;

        return view('detailSiswa', ['data' => $data]);
    }

    public function tentangSekolah(){
        $data = $this->template();
        $tentang = TentangModel::all();
        $data['tentang'] = $tentang[0];

        return view('tentang', ['data' => $data]);
    }

    public function kontak(){
        $data = $this->template();
        $error = array();
        $success = null;

        $kontak = KontakModel::all();

        $data['error'] = $error;
        $data['success'] = $success;
        $data['kontak'] = $kontak;

        return view('kontak', ['data'=>$data]);

    }

    public function detailKategori(Request $req){

        $data = $this->template();
        $kategori = KategoriModel::where('nama_kategori', str_replace('-', ' ', $req->nama))->get();
        // return response($kategori->nama_kategori);
        $artikel = ArtikelModel::where('id_kategori', $kategori[0]->id_kategori)->get();

        $data['kategoriList'] = $kategori;
        $data['artikel'] = $artikel;

        return view('detailKategori', ['data' => $data]);
    }

    public function login(Request $request){

        $message = array();

        if($request->session()->get('login') == 'true'){
            return redirect('/admin/home');
        }

        if($request->method() == 'POST'){              
            $user = UserModel::where('email', $request->username)->where('password', md5($request->password))->get()->first();
            if($user == null){
                $message['success'] = true;
                $message['message'] = 'User tidak ditemukan';
            }
            else{
                // $auth_token = Str::random(40);
                // UserModel::where('email', $request->username)->update(['auth_token' => $auth_token]);;
                // $cookie = Cookie::make('auth_token', $auth_token, 10);
                $request->session()->put('nama-lengkap', $user->nama_lengkap);
                $request->session()->put('username', $user->username);
                $request->session()->put('email', $user->email);
                $request->session()->put('no_hp', $user->no_hp);
                $request->session()->put('alamat', $user->alamat);
                $request->session()->put('login', 'true');
                return redirect('/admin/home');
            }
        }
        return view('login', ['message' => $message]);
    }

    public function logout(Request $req){

        $req->session()->flush();
        return redirect('login');
    }

    public function adminhome(){
        $bukutamu = BukuTamuModel::all();
        $artikel = ArtikelModel::all();
        $guru = GuruModel::all();
        $kontak = KontakModel::all();
        $userdata = UserModel::where('id_user', 3)->get();
        
        $total = array(
            'artikel' => $artikel,
            'guru' => $guru,
            'kontak' => $kontak,
            'bukutamu' => $bukutamu
        );

        $data = array(
            'userData' => $userdata[0],
            'total' => $total
        );

        return view('homeadmin', ['data' => $data]);
    }

    public function template(){

        $artikel = ArtikelModel::all();
        $kategori = KategoriModel::all();
        $data = [
            'main_artikel' => $artikel,
            'kategori' => $kategori
        ];

        return $data;
    }

    public function session(Request $request){

        $request->session()->put('key', 'apalek');

        return response($request->session()->all());
    }

    public function checksession(Request $request){

        return response($request->session()->all());
    }
}

