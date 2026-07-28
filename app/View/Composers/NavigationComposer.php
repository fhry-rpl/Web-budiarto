<?php

namespace App\View\Composers;

use App\Services\MenuService;
use Illuminate\View\View;

class NavigationComposer
{
    public function __construct(
        protected MenuService $menuService,
    ) {}

    public function compose(View $view): void
    {
        $view->with('menuItems', $this->menuService->getTree());
    }
}
