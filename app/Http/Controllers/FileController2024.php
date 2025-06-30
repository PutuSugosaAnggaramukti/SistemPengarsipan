<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tahun2024;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class FileController2024
{
    public function index2024(Request $request)
    {
        $search = $request->input('search');

        $files = Tahun2024::query()
        ->when($search, function ($query, $search) {
            $query->where('original_name', 'like', "%{$search}%")
                  ->orWhere('generated_name', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // Keeps the ?search= on pagination links

    return view('files.index2024', compact('files', 'search'));
    }

     public function store2024(Request $request)
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

            Tahun2024::create([
                'original_name' => $file->getClientOriginalName(),
                'generated_name' => $filename,
                'filepath2024' => $path,
                'year' => $year,
            ]);
        }
    }

    return back()->with('success', 'Files uploaded successfully!');


    // ✅ Debug check
    //dd($file->toArray());

    return redirect()->route('files.index2024')->with('success', 'File berhasil diupload');
    }

     public function show2024($id)
    {
      $file = Tahun2024::withTrashed()->findOrFail($id);

    if ($file->trashed()) {
        abort(404, 'This file has been deleted.');
    }

    if (!$file->filepath2024 || !Storage::exists($file->filepath2024)) {
        abort(404, 'File not found.');
    }

    $fileContent = Storage::get($file->filepath2024);
    $mimeType = Storage::mimeType($file->filepath2024) ?? 'application/pdf';

    return new Response($fileContent, 200, [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
    ]);
    }

     public function destroy2024($id)
    {
      $file = Tahun2024::withTrashed()->findOrFail($id);

    if ($file->trashed()) {
        abort(404, 'This file is already deleted.');
    }

    $file->delete();

    return redirect()->route('files.index2024')->with('success', 'Document deleted successfully.');
    }

    public function download2024($id)
    {
      $file = Tahun2024::withTrashed()->findOrFail($id);

    if ($file->trashed()) {
        abort(404, 'This file has been deleted.');
    }

    if (!$file->filepath2024 || !Storage::exists($file->filepath2024)) {
        abort(404, 'File not found.');
    }

    return Storage::download($file->filepath2024, $file->original_name);
    }

    public function restore2024($id)
    {
    $file = Tahun2024::withTrashed()->findOrFail($id);
    $file->restore();

    return back()->with('success', 'File restored successfully!');
    }

    public function restoreAll2024()
    {
    Tahun2024::onlyTrashed()->restore(); // restores ALL soft deleted files
    return back()->with('success', 'All deleted files have been restored!');
    }

}
