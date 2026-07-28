<?php

namespace App\Repositories\Eloquent;

use App\Models\ContactSubmission;
use App\Repositories\Contracts\ContactSubmissionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactSubmissionRepository implements ContactSubmissionRepositoryInterface
{
    public function all(int $perPage = 15): LengthAwarePaginator
    {
        return ContactSubmission::latest()->paginate($perPage);
    }

    public function allPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return ContactSubmission::latest()->paginate($perPage);
    }

    public function findById(int $id): mixed
    {
        return ContactSubmission::findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return ContactSubmission::create($data);
    }

    public function latest(int $limit = 5): mixed
    {
        return ContactSubmission::latest()->take($limit)->get();
    }

    public function markAsRead(int $id): void
    {
        ContactSubmission::where('id', $id)->update(['is_read' => true]);
    }

    public function delete(int $id): bool
    {
        return ContactSubmission::destroy($id) > 0;
    }

    public function unreadCount(): int
    {
        return ContactSubmission::where('is_read', false)->count();
    }
}
