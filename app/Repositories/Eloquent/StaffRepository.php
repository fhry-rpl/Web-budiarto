<?php

namespace App\Repositories\Eloquent;

use App\Models\Staff;
use App\Repositories\Contracts\StaffRepositoryInterface;

class StaffRepository implements StaffRepositoryInterface
{
    public function allActive(): mixed
    {
        return Staff::where('is_active', true)->orderBy('order')->get();
    }

    public function findById(int $id): mixed
    {
        return Staff::findOrFail($id);
    }

    public function all(): mixed
    {
        return Staff::orderBy('order')->get();
    }

    public function create(array $data): mixed
    {
        return Staff::create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $s = Staff::findOrFail($id);
        $s->update($data);

        return $s;
    }

    public function delete(int $id): bool
    {
        return Staff::destroy($id) > 0;
    }
}
