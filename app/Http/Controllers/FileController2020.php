<?php

namespace App\Http\Controllers;

use App\Models\Tahun2020; // Assuming the File model is used for file uploads
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController2020
{
        public function index2020(Request $request)
    {
        $search = $request->input('search');

        $files = Tahun2020::query()
        ->when($search, function ($query, $search) {
            $query->where('original_name', 'like', "%{$search}%")
                  ->orWhere('generated_name', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Optional: for pagination

       $files = Tahun2020::where('original_name', 'like', "%{$search}%")->paginate(10);
        return view('files.index2020', compact('files','search'));
    }

     public function store2020(Request $request)
    {
        $request->validate([
        'year' => 'required|digits:4|integer|min:2000|max:' . now()->year,
        'files' => 'required',
        'files.*' => 'mimes:pdf|max:204800',
    ]);

    $year = $request->year;

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            if ($file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs("public/documents/{$year}", $filename);

                Tahun2020::create([
                    'original_name' => $file->getClientOriginalName(),
                    'generated_name' => $filename,
                    'filepath' => $path,
                    'year' => $year,
                ]);
            }
        }
    }

    return back()->with('success', 'PDF documents uploaded successfully.');

    // ✅ Debug check
    //dd($file->toArray());

    return redirect()->route('files.index2020')->with('success', 'File berhasil diupload');
    }
    
     public function show2020($id)
    { 
       $file = Tahun2020::findOrFail($id);

    if (!$file->filepath || !Storage::exists($file->filepath)) {
        abort(404, 'File not found.');
    }

    // Get file content
    $fileContent = Storage::get($file->filepath);

    // Get file mime type (optional fallback)
    $mimeType = Storage::mimeType($file->filepath) ?? 'application/pdf';

    return new Response($fileContent, 200, [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
    ]);
    }

     public function destroy2020($id)
    {
       $file = Tahun2020::findOrFail($id);

    if (!empty($file->filepath) && Storage::exists($file->filepath)) {
        Storage::delete($file->filepath);
    }

    $file->delete();

    return redirect()->route('files.index2020')->with('success', 'Document deleted successfully.');
    }

    public function download2020($id)
    {
        $file = Tahun2020::findOrFail($id);

    if (!$file->filepath || !Storage::exists($file->filepath)) {
        abort(404, 'File not found.');
    }

    return Storage::download($file->filepath, $file->original_name);
    }
}
