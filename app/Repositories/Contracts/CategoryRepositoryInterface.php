<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function all(): mixed;

    public function findByType(string $type): mixed;

    public function findById(int $id): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int $id): bool;
}
