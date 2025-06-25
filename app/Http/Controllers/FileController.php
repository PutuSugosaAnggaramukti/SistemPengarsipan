<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $files = File::query()
        ->when($search, function ($query, $search) {
            $query->where('original_name', 'like', "%{$search}%")
                  ->orWhere('generated_name', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10); // Optional: for pagination

       $files = File::where('original_name', 'like', "%{$search}%")->paginate(10);
        return view('files.index', compact('files','search'));
    }

    public function index2020(Request $request)
    {
        return view('files.index2020'); // Blade file at resources/views/files/index2020.blade.php
    }

    public function indexdaftarberkas(){
        return view('files.indexdaftarberkas');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

                File::create([
                    'original_name' => $file->getClientOriginalName(),
                    'generated_name' => $filename,
                    'file_path' => $path,
                    'year' => $year,
                ]);
            }
        }
    }

    return back()->with('success', 'PDF documents uploaded successfully.');

    // ✅ Debug check
    //dd($file->toArray());

    return redirect()->route('files.index')->with('success', 'File berhasil diupload');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    { 
       $file = File::findOrFail($id);

    if (!$file->file_path || !Storage::exists($file->file_path)) {
        abort(404, 'File not found.');
    }

    // Get file content
    $fileContent = Storage::get($file->file_path);

    // Get file mime type (optional fallback)
    $mimeType = Storage::mimeType($file->file_path) ?? 'application/pdf';

    return new Response($fileContent, 200, [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $file = File::findOrFail($id);

    if (!empty($file->file_path) && Storage::exists($file->file_path)) {
        Storage::delete($file->file_path);
    }

    $file->delete();

    return redirect()->route('files.index')->with('success', 'Document deleted successfully.');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);

    if (!$file->file_path || !Storage::exists($file->file_path)) {
        abort(404, 'File not found.');
    }

    return Storage::download($file->file_path, $file->original_name);
    }

}
