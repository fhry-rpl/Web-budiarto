<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct(
        protected DocumentRepositoryInterface $documentRepo,
        protected CategoryRepositoryInterface $categoryRepo,
    ) {}

    public function index()
    {
        $documents = $this->documentRepo->all(15);

        return view('admin.documents.index', compact('documents'));
    }

    public function show(Document $document)
    {
        return view('admin.documents.show', compact('document'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->findByType('dokumen');

        return view('admin.documents.form', compact('categories'));
    }

    public function store(StoreDocumentRequest $request)
    {
        $data = $request->validated();
        $data['file_path'] = $request->file('file')->store('documents');
        $data['user_id'] = auth()->id();
        Document::create($data);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Dokumen berhasil diunggah.');
    }

    public function edit(Document $document)
    {
        $categories = $this->categoryRepo->findByType('dokumen');

        return view('admin.documents.form', compact('document', 'categories'));
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $data = $request->validated();
        if ($request->hasFile('file')) {
            Storage::disk('uploads')->delete($document->file_path);
            $data['file_path'] = $request->file('file')->store('documents', 'uploads');
        }
        $document->update($data);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Document $document)
    {
        Storage::disk('uploads')->delete($document->file_path);
        $document->delete();

        return redirect()->route('admin.documents.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }
}
