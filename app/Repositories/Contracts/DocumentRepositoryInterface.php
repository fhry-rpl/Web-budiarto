<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface DocumentRepositoryInterface
{
    public function all(int $perPage = 15): LengthAwarePaginator;

    public function allPublished(int $perPage = 15): LengthAwarePaginator;

    public function findById(int $id): mixed;

    public function publishedByCategory(int $categoryId, int $perPage = 15): LengthAwarePaginator;

    public function search(string $query, int $perPage = 15): LengthAwarePaginator;

    public function incrementDownload(int $id): void;

    public function count(): int;

    public function allPaginated(int $perPage = 15): LengthAwarePaginator;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int $id): bool;
}
