<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct(
        protected DocumentRepositoryInterface $documentRepo,
        protected CategoryRepositoryInterface $categoryRepo,
    ) {}

    public function index(Request $request)
    {
        $query = $request->query('kategori');
        $categories = $this->categoryRepo->findByType('dokumen');

        if ($query) {
            $category = $categories->firstWhere('slug', $query);
            $documents = $category
                ? $this->documentRepo->publishedByCategory($category->id, 15)
                : $this->documentRepo->allPublished(15);
        } else {
            $documents = $this->documentRepo->allPublished(15);
        }

        return view('documents.index', compact('documents', 'categories', 'query'));
    }

    public function show(int $id)
    {
        $document = $this->documentRepo->findById($id);

        return view('documents.show', compact('document'));
    }

    public function download(int $id)
    {
        $document = $this->documentRepo->findById($id);
        $this->documentRepo->incrementDownload($id);

        return Storage::disk('uploads')->download($document->file_path);
    }
}
