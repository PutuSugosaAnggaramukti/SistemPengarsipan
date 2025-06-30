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
        ->paginate(10)
        ->withQueryString(); // Keeps the ?search= on pagination links

    return view('files.index2020', compact('files', 'search'));
    }

     public function store2020(Request $request)
    {
           $validated = $request->validate([
        'year' => 'required|numeric',
        'files.*' => 'required|file|mimes:pdf|max:204800',
    ]);

    $year = $validated['year'];

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
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

    return back()->with('success', 'Files uploaded successfully!');
    // ✅ Debug check
    //dd($file->toArray());

    return redirect()->route('files.index2020')->with('success', 'File berhasil diupload');
    }
    
     public function show2020($id)
    { 
       $file = Tahun2020::withTrashed()->findOrFail($id);

    if ($file->trashed()) {
        abort(404, 'This file has been deleted.');
    }

    if (!$file->filepath || !Storage::exists($file->filepath)) {
        abort(404, 'File not found.');
    }

    $fileContent = Storage::get($file->filepath);
    $mimeType = Storage::mimeType($file->filepath) ?? 'application/pdf';

    return new Response($fileContent, 200, [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
    ]);
    }

     public function destroy2020($id)
    {
        $file = Tahun2020::withTrashed()->findOrFail($id);

    if ($file->trashed()) {
        abort(404, 'This file is already deleted.');
    }

    $file->delete();

    return redirect()->route('files.index2020')->with('success', 'Document deleted successfully.');
    }

    public function download2020($id)
    {
       $file = Tahun2020::withTrashed()->findOrFail($id);

    if ($file->trashed()) {
        abort(404, 'This file has been deleted.');
    }

    if (!$file->filepath || !Storage::exists($file->filepath)) {
        abort(404, 'File not found.');
    }

    return Storage::download($file->filepath, $file->original_name);
    }

    public function restore2020($id)
    {
    $file = Tahun2020::withTrashed()->findOrFail($id);
    $file->restore();

    return back()->with('success', 'File restored successfully!');
    }

    public function restoreAll2020()
    {
    Tahun2020::onlyTrashed()->restore(); // restores ALL soft deleted files
    return back()->with('success', 'All deleted files have been restored!');
    }

}
