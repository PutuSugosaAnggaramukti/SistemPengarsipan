<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class FileController
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $files = Document::query()
            ->where('tahun', '2019')
            ->when($search, function ($query, $search) {
                $query->where('nama_document', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('files.index', compact('files', 'search'));
    }

    public function indexdaftarberkas()
    {
        return view('files.indexdaftarberkas');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|numeric',
            'files.*' => 'required|file|mimes:pdf|max:512000',
        ]);

        $year = $validated['year'];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs("uploads/Document/{$year}", $filename, 'public');

                Document::create([
                    'nomor' => null,
                    'tanggal' => now(),
                    'tahun' => $year,
                    'nama_document' => $file->getClientOriginalName(),
                    'direktory_document' => $path,
                    'npp' => auth()->user()->npp ?? 0,
                ]);
            }
        }

        return back()->with('success', 'Files uploaded successfully!');
    }

    public function show($id)
    {
        $file = Document::withTrashed()->findOrFail($id);

        if ($file->trashed()) {
            abort(404, 'This file has been deleted.');
        }

        if (!$file->direktory_document || !Storage::disk('public')->exists($file->direktory_document)) {
            abort(404, 'File not found.');
        }

        $fileContent = Storage::disk('public')->get($file->direktory_document);
        $mimeType = Storage::disk('public')->mimeType($file->direktory_document) ?? 'application/pdf';

        return new Response($fileContent, 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $file->nama_document . '"',
        ]);
    }

    public function destroy($id)
    {
        $file = Document::withTrashed()->findOrFail($id);

        if ($file->trashed()) {
            abort(404, 'This file is already deleted.');
        }

        $file->delete();

        return redirect()->route('files.index')->with('success', 'Document deleted successfully.');
    }

    public function download($id)
    {
        $file = Document::withTrashed()->findOrFail($id);

        if ($file->trashed()) {
            abort(404, 'This file has been deleted.');
        }

        if (!$file->direktory_document || !Storage::disk('public')->exists($file->direktory_document)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($file->direktory_document, $file->nama_document);
    }

    public function restore2019($id)
    {
        $file = Document::withTrashed()->findOrFail($id);
        $file->restore();

        return back()->with('success', 'File restored successfully!');
    }

    public function restoreAllFiles()
    {
        Document::onlyTrashed()->restore();
        return back()->with('success', 'All deleted files have been restored!');
    }
}
