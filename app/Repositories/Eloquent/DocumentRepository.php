<?php

namespace App\Repositories\Eloquent;

use App\Models\Document;
use App\Repositories\Contracts\DocumentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class DocumentRepository implements DocumentRepositoryInterface
{
    public function all(int $perPage = 15): LengthAwarePaginator
    {
        return Document::with('category', 'user')->latest()->paginate($perPage);
    }

    public function allPublished(int $perPage = 15): LengthAwarePaginator
    {
        return Document::with('category')
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate($perPage);
    }

    public function findById(int $id): mixed
    {
        return Document::with('category', 'user')->findOrFail($id);
    }

    public function publishedByCategory(int $categoryId, int $perPage = 15): LengthAwarePaginator
    {
        return Document::with('category')
            ->where('category_id', $categoryId)
            ->where('is_published', true)
            ->latest('published_at')
            ->paginate($perPage);
    }

    public function search(string $query, int $perPage = 15): LengthAwarePaginator
    {
        return Document::with('category')
            ->where('is_published', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->paginate($perPage);
    }

    public function count(): int
    {
        return Document::count();
    }

    public function incrementDownload(int $id): void
    {
        Document::where('id', $id)->increment('download_count');
    }

    public function allPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return Document::with('category', 'user')->latest()->paginate($perPage);
    }

    public function create(array $data): mixed
    {
        return Document::create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $doc = Document::findOrFail($id);
        $doc->update($data);

        return $doc;
    }

    public function delete(int $id): bool
    {
        return Document::destroy($id) > 0;
    }
}
