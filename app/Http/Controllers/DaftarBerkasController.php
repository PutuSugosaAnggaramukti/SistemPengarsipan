<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DaftarBerkasController extends Controller
{
    public function daftarberkaspage(){
        return view('daftarberkas.indexdaftar');
    }
}
