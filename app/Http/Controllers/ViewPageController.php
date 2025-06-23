<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;

class ViewPageController
{
    public function indexview()
    {
        return view('viewberkas.indexview');
    }

//      public function show($id)
//     {
//        $file = File::findOrFail($id);

//         return Response::make($file->file, 200, [
//             'Content-Type' => 'application/pdf',
//             'Content-Disposition' => 'inline; filename="' . $file->name . '"'
//         ]);
//     }

//     public function viewInline($id)
// {
//     $file = File::findOrFail($id);
//     return view('indexview', ['pdfData' => $file->file]);
// }
}
