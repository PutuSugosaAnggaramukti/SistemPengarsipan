<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class FileController2020
{
    public function index2020(Request $request)
    {
        $search = $request->input('search');

        $files = Document::query()
            ->where('tahun', '2020')
            ->when($search, function ($query, $search) {
                $query->where('nama_document', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('files.index2020', compact('files', 'search'));
    }

    public function store2020(Request $request)
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

    public function show2020($id)
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

    public function destroy2020($id)
    {
        $file = Document::withTrashed()->findOrFail($id);

        if ($file->trashed()) {
            abort(404, 'This file is already deleted.');
        }

        $file->delete();

        return redirect()->route('files.index2020')->with('success', 'Document deleted successfully.');
    }

    public function download2020($id)
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

    public function restore2020($id)
    {
        $file = Document::withTrashed()->findOrFail($id);
        $file->restore();

        return back()->with('success', 'File restored successfully!');
    }

    public function restoreAll2020()
    {
        Document::onlyTrashed()->restore();
        return back()->with('success', 'All deleted files have been restored!');
    }
}
