<?php

namespace App\Repositories\Contracts;

interface StaffRepositoryInterface
{
    public function allActive(): mixed;

    public function findById(int $id): mixed;

    public function all(): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int $id): bool;
}
