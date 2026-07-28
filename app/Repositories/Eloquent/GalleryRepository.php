<?php

namespace App\Repositories\Eloquent;

use App\Models\Gallery;
use App\Repositories\Contracts\GalleryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryRepository implements GalleryRepositoryInterface
{
    public function allPublished(int $perPage = 12): LengthAwarePaginator
    {
        return Gallery::withCount('images')
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate($perPage);
    }

    public function latest(int $limit = 6): mixed
    {
        return Gallery::with('images')
            ->where('is_published', true)
            ->latest('published_at')
            ->take($limit)
            ->get();
    }

    public function findById(int $id): mixed
    {
        return Gallery::with('images')->findOrFail($id);
    }

    public function allPaginated(int $perPage = 12): LengthAwarePaginator
    {
        return Gallery::withCount('images')->latest()->paginate($perPage);
    }

    public function create(array $data): mixed
    {
        return Gallery::create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $g = Gallery::findOrFail($id);
        $g->update($data);

        return $g;
    }

    public function delete(int $id): bool
    {
        return Gallery::destroy($id) > 0;
    }
}
