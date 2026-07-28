<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements PostRepositoryInterface
{
    public function all(int $perPage = 15): LengthAwarePaginator
    {
        return Post::with('category', 'user')->latest()->paginate($perPage);
    }

    public function allPublished(int $perPage = 10): LengthAwarePaginator
    {
        return Post::with('category')
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate($perPage);
    }

    public function findPublished(string $slug): mixed
    {
        return Post::with('category', 'user')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
    }

    public function findById(int $id): mixed
    {
        return Post::with('category', 'user')->findOrFail($id);
    }

    public function publishedByCategory(string $categoryType, int $perPage = 10): LengthAwarePaginator
    {
        return Post::with('category')
            ->where('is_published', true)
            ->whereHas('category', fn ($q) => $q->where('type', $categoryType))
            ->latest('published_at')
            ->paginate($perPage);
    }

    public function count(): int
    {
        return Post::count();
    }

    public function latest(int $limit = 6): mixed
    {
        return Post::with('category')
            ->where('is_published', true)
            ->latest('published_at')
            ->take($limit)
            ->get();
    }

    public function search(string $query, int $perPage = 10): LengthAwarePaginator
    {
        return Post::with('category')
            ->where('is_published', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('body', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->paginate($perPage);
    }

    public function allPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Post::with('category', 'user')->latest()->paginate($perPage);
    }

    public function create(array $data): mixed
    {
        return Post::create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $post = Post::findOrFail($id);
        $post->update($data);

        return $post;
    }

    public function delete(int $id): bool
    {
        return Post::destroy($id) > 0;
    }
}
