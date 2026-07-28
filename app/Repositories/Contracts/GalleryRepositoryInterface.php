<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface GalleryRepositoryInterface
{
    public function allPublished(int $perPage = 12): LengthAwarePaginator;

    public function findById(int $id): mixed;

    public function allPaginated(int $perPage = 12): LengthAwarePaginator;

    public function latest(int $limit = 6): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int $id): bool;
}
