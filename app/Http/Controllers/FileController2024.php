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
        ->paginate(10); // Optional: for pagination

       $files = Tahun2024::where('original_name', 'like', "%{$search}%")->paginate(10);
        return view('files.index2024', compact('files','search'));
    }

     public function store2024(Request $request)
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

                Tahun2024::create([
                    'original_name' => $file->getClientOriginalName(),
                    'generated_name' => $filename,
                    'filepath2024' => $path,
                    'year' => $year,
                ]);
            }
        }
    }

    return back()->with('success', 'PDF documents uploaded successfully.');

    // ✅ Debug check
    //dd($file->toArray());

    return redirect()->route('files.index2024')->with('success', 'File berhasil diupload');
    }

     public function show2024($id)
    {
       $file = Tahun2024::findOrFail($id);

    if (!$file->filepath2024 || !Storage::exists($file->filepath2024)) {
        abort(404, 'File not found.');
    }

    // Get file content
    $fileContent = Storage::get($file->filepath2024);

    // Get file mime type (optional fallback)
    $mimeType = Storage::mimeType($file->filepath2024) ?? 'application/pdf';

    return new Response($fileContent, 200, [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
    ]);
    }

     public function destroy2024($id)
    {
       $file = Tahun2024::findOrFail($id);

    if (!empty($file->filepath2024) && Storage::exists($file->filepath2024)) {
        Storage::delete($file->filepath2024);
    }

    $file->delete();

    return redirect()->route('files.index2024')->with('success', 'Document deleted successfully.');
    }

    public function download2024($id)
    {
        $file = Tahun2024::findOrFail($id);

    if (!$file->filepath2024 || !Storage::exists($file->filepath2024)) {
        abort(404, 'File not found.');
    }

    return Storage::download($file->filepath2024, $file->original_name);
    }
}
