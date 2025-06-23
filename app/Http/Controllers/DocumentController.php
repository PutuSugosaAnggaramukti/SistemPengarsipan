<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'pdf' => 'required|file|mimes:pdf|max:2048',
        ]);

        $path = $request->file('pdf')->store('pdfs'); // stored in storage/app/pdfs

        Document::create([
            'title' => $request->title,
            'file_path' => $path,
        ]);

        return redirect()->route('documents.index')->with('success', 'PDF uploaded.');
    }

    public function show(Request $request)
    {
       $path = $request->file('pdf')->store('public', 'pdfs'); // goes to storage/app/public/pdfs

    if (!file_exists($path)) {
        abort(404, 'PDF not found.');
    }

    return response()->file($path); // show in browser
    }

    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $document->update(['title' => $request->title]);

        return redirect()->route('documents.index')->with('success', 'PDF updated.');
    }

    public function destroy(Document $document)
    {
        if (Storage::disk('local')->exists($document->file_path)) {
            Storage::disk('local')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'PDF deleted.');
    }

    public function download(Document $document)
{
    $filePath = storage_path('app/' . $document->file_path);

    if (!file_exists($filePath)) {
        abort(404, 'File not found.');
    }

    // Force download
    return response()->download($filePath, $document->title . '.pdf');
    
}

}
