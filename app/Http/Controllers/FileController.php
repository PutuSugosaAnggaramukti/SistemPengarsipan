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
        ->paginate(10)
        ->withQueryString(); // Keeps the ?search= on pagination links

    return view('files.index', compact('files', 'search'));
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
         $validated = $request->validate([
        'year' => 'required|numeric',
        'files.*' => 'required|file|mimes:pdf|max:204800',
    ]);

    $year = $validated['year'];

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
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

    return back()->with('success', 'Files uploaded successfully!');
    // ✅ Debug check
    //dd($file->toArray());

    return redirect()->route('files.index')->with('success', 'File berhasil diupload');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    { 
      $file = File::withTrashed()->findOrFail($id);

    if ($file->trashed()) {
        abort(404, 'This file has been deleted.');
    }

    if (!$file->file_path || !Storage::exists($file->file_path)) {
        abort(404, 'File not found.');
    }

    $fileContent = Storage::get($file->file_path);
    $mimeType = Storage::mimeType($file->file_path) ?? 'application/pdf';

    return new Response($fileContent, 200, [
        'Content-Type' => $mimeType,
        'Content-Disposition' => 'inline; filename="' . $file->original_name . '"',
    ]);
    }

   
    public function destroy($id)
    {
       $file = File::withTrashed()->findOrFail($id);

    if ($file->trashed()) {
        abort(404, 'This file is already deleted.');
    }

    $file->delete();

    return redirect()->route('files.index')->with('success', 'Document deleted successfully.');
    }

    public function download($id)
    {
    $file = File::withTrashed()->findOrFail($id);

    if ($file->trashed()) {
        abort(404, 'This file has been deleted.');
    }

    if (!$file->file_path || !Storage::exists($file->file_path)) {
        abort(404, 'File not found.');
    }

    return Storage::download($file->file_path, $file->original_name);
    }

      public function restore2019($id)
    {
    $file = File::withTrashed()->findOrFail($id);
    $file->restore();

    return back()->with('success', 'File restored successfully!');
    }

    public function restoreAllFiles()
    {
    File::onlyTrashed()->restore(); // restores ALL soft deleted files
    return back()->with('success', 'All deleted files have been restored!');
    }

}
