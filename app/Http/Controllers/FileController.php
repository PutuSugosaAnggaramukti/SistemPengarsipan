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

    public function indexview()
    {
        return view('files.indexview');
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
        'file' => 'required|mimes:pdf,docx|max:204800',], [
        'file.max' => 'The file is too large. Maximum size is 200MB.',
    ]);

    $uploadedFile = $request->file('file');
    $fileName = $uploadedFile->hashName(); // auto-generates unique name

    // 🔐 Store the file in "storage/app/uploads"
    $storedPath = $uploadedFile->storeAs('uploads', $fileName); // returns 'uploads/xxxx.pdf'

    // ✅ Save to database
    $file = File::create([
        'original_name' => $uploadedFile->getClientOriginalName(),
        'generated_name' => $fileName,
        'file_path' => $storedPath, // <=== THIS MUST BE SAVED!
    ]);

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
