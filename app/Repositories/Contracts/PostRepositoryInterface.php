<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    public function all(int $perPage = 15): LengthAwarePaginator;

    public function allPublished(int $perPage = 10): LengthAwarePaginator;

    public function findPublished(string $slug): mixed;

    public function findById(int $id): mixed;

    public function publishedByCategory(string $categoryType, int $perPage = 10): LengthAwarePaginator;

    public function latest(int $limit = 6): mixed;

    public function count(): int;

    public function search(string $query, int $perPage = 10): LengthAwarePaginator;

    public function allPaginated(int $perPage = 10): LengthAwarePaginator;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int $id): bool;
}
