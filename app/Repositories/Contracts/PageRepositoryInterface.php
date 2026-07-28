<?php

namespace App\Repositories\Contracts;

interface PageRepositoryInterface
{
    public function findBySlug(string $slug): mixed;

    public function findPublishedBySlug(string $slug): mixed;

    public function findById(int $id): mixed;

    public function all(): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int $id): bool;
}
