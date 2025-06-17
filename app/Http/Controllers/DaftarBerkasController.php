<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DaftarBerkasController extends Controller
{
    public function daftarberkaspage(){
         $files = File::latest()->paginate(10);
          return view('daftarberkas.indexdaftar', compact('files'));
    }
}
