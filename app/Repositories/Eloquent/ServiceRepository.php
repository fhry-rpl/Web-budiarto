<?php

namespace App\Repositories\Eloquent;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function allActive(): mixed
    {
        return Service::where('is_active', true)->orderBy('order')->get();
    }

    public function findBySlug(string $slug): mixed
    {
        return Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
    }

    public function findById(int $id): mixed
    {
        return Service::findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return Service::create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $svc = Service::findOrFail($id);
        $svc->update($data);

        return $svc;
    }

    public function delete(int $id): bool
    {
        return Service::destroy($id) > 0;
    }
}
