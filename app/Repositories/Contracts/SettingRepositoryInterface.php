<?php

namespace App\Repositories\Contracts;

interface SettingRepositoryInterface
{
    public function getAll(): mixed;

    public function set(string $key, mixed $value): void;
}
