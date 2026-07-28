<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::withCount('images')->latest()->paginate(15);

        return view('admin.galleries.index', compact('galleries'));
    }

    public function show(Gallery $gallery)
    {
        $gallery->load('images');

        return view('admin.galleries.show', compact('gallery'));
    }

    public function create()
    {
        return view('admin.galleries.form');
    }

    public function store(StoreGalleryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('galleries', 'uploads');
        }
        $gallery = Gallery::create($data);
        foreach ($request->file('images', []) as $image) {
            $gallery->images()->create(['image_path' => $image->store('galleries', 'uploads')]);
        }

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil dibuat.');
    }

    public function edit(Gallery $gallery)
    {
        $gallery->load('images');

        return view('admin.galleries.form', compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();
        if ($request->hasFile('cover_image')) {
            Storage::disk('uploads')->delete($gallery->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('galleries', 'uploads');
        }
        $gallery->update($data);
        if ($request->hasFile('images')) {
            foreach ($gallery->images as $oldImage) {
                Storage::disk('uploads')->delete($oldImage->image_path);
            }
            $gallery->images()->delete();
            foreach ($request->file('images') as $image) {
                $gallery->images()->create(['image_path' => $image->store('galleries', 'uploads')]);
            }
        }

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('uploads')->delete($gallery->cover_image);
        foreach ($gallery->images as $image) {
            Storage::disk('uploads')->delete($image->image_path);
        }
        $gallery->images()->delete();
        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}
