<?php

namespace App\Http\Controllers;

use App\ArtikelModel;
use App\BukuTamuModel;
use App\GuruModel;
use App\KontakModel;
use App\UserModel;
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
            'bukutamu' => $bukutamu,
            'artikel' => $artikel,
            'guru' => $guru,
            'kontak' => $kontak
        );
        // return response($total['bukutamu']);

        return view('adminhome', ['data' => $total, 'login' => $user]);
    }
}
