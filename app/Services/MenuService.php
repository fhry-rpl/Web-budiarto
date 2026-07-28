<?php

namespace App\Services;

use App\Models\MenuItem;
use Illuminate\Support\Collection;

class MenuService
{
    protected ?Collection $tree = null;

    public function getTree(): Collection
    {
        if ($this->tree !== null) {
            return $this->tree;
        }

        $this->tree = MenuItem::active()
            ->root()
            ->ordered()
            ->with(['children' => fn ($q) => $q->active()->ordered()])
            ->get();

        return $this->tree;
    }

    public function flush(): void
    {
        $this->tree = null;
    }
}
