<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface ContactSubmissionRepositoryInterface
{
    public function all(int $perPage = 15): LengthAwarePaginator;

    public function allPaginated(int $perPage = 20): LengthAwarePaginator;

    public function findById(int $id): mixed;

    public function latest(int $limit = 5): mixed;

    public function create(array $data): mixed;

    public function markAsRead(int $id): void;

    public function delete(int $id): bool;

    public function unreadCount(): int;
}
