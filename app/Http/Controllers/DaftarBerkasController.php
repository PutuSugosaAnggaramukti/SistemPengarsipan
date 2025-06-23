<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DaftarBerkasController extends Controller
{
    public function daftarberkaspage(){
         
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }
}
