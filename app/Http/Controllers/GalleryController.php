<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\GalleryRepositoryInterface;

class GalleryController extends Controller
{
    public function __construct(
        protected GalleryRepositoryInterface $galleryRepo,
    ) {}

    public function index()
    {
        $galleries = $this->galleryRepo->allPublished(12);

        return view('galleries.index', compact('galleries'));
    }

    public function show(int $id)
    {
        $gallery = $this->galleryRepo->findById($id);

        return view('galleries.show', compact('gallery'));
    }
}
