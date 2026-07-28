<?php

namespace App\Repositories\Eloquent;

use App\Models\Page;
use App\Repositories\Contracts\PageRepositoryInterface;

class PageRepository implements PageRepositoryInterface
{
    public function findBySlug(string $slug): mixed
    {
        return Page::where('slug', $slug)->where('is_published', true)->firstOrFail();
    }

    public function findPublishedBySlug(string $slug): mixed
    {
        return Page::where('slug', $slug)->where('is_published', true)->first();
    }

    public function findById(int $id): mixed
    {
        return Page::findOrFail($id);
    }

    public function all(): mixed
    {
        return Page::where('is_published', true)->get();
    }

    public function create(array $data): mixed
    {
        return Page::create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $p = Page::findOrFail($id);
        $p->update($data);

        return $p;
    }

    public function delete(int $id): bool
    {
        return Page::destroy($id) > 0;
    }
}
