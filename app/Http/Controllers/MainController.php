<?php

namespace App\Http\Controllers;

use App\ArtikelModel;
use App\BukuTamuModel;
use App\GuruModel;
use App\KategoriModel;
use App\SiswaModel;
use App\TentangModel;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function homePage() {
        $data = $this->template();
        $artikel = ArtikelModel::all();
        $data['artikel'] = $artikel;

        return view('home', ['data' => $data]);
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

    public function dataGuru(){
        $data = $this->template();
        $dataguru = GuruModel::all();
        $data['guru'] = $dataguru;

        return view('dataguru', ['data' => $data]);
    }

    public function dataAlumni(){
        $data = $this->template();
        $dataalumni = SiswaModel::where('status', 'Alumni')->get();
        $data['alumni'] = $dataalumni;

        return view('alumni', ['data' => $data]);
    }

    public function tentangSekolah(){
        $data = $this->template();
        $tentang = TentangModel::all();
        $data['tentang'] = $tentang[0];

        return view('tentang', ['data' => $data]);
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
}
