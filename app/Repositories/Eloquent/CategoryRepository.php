<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all(): mixed
    {
        return Category::orderBy('order')->get();
    }

    public function findByType(string $type): mixed
    {
        return Category::where('type', $type)->orderBy('order')->get();
    }

    public function findById(int $id): mixed
    {
        return Category::findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $cat = Category::findOrFail($id);
        $cat->update($data);

        return $cat;
    }

    public function delete(int $id): bool
    {
        return Category::destroy($id) > 0;
    }
}
