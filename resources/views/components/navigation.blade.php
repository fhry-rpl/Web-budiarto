@php
if (!function_exists('isActive')) {
    function isActive($route, $params = []) {
        if (!request()->route() || !$route) return false;
        $currentName = request()->route()->getName();
        if ($currentName === $route) return true;
        if (str_ends_with($route, '.index')) {
            $prefix = substr($route, 0, strrpos($route, '.'));
            return str_starts_with($currentName, $prefix . '.');
        }
        return false;
    }
    function hasActiveChild($children) {
        foreach ($children as $child) {
            if (isActive($child->route ?? '', $child->params ?? [])) return true;
        }
        return false;
    }
}
@endphp

<nav id="mainNav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0" aria-label="Beranda">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-600 text-sm font-bold text-white shadow-sm transition group-hover:shadow-md group-hover:bg-primary-700">RB</div>
            <div class="hidden sm:block">
                <p class="text-sm font-semibold text-gray-900 dark:text-dark-text font-heading">RENPRO UPBU Budiarto</p>
                <p class="text-xs text-gray-500 dark:text-dark-muted">Bandar Udara Budiarto</p>
            </div>
        </a>

        <nav class="hidden lg:flex lg:items-center lg:gap-0.5" aria-label="Navigasi utama">
            @foreach ($menuItems as $item)
                <div class="relative" data-dropdown="{{ $item->id }}">
                    @if (!$item->children->isEmpty())
                        <div class="relative">
                            <button
                                data-dropdown-toggle
                                class="flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium font-heading transition-colors {{ hasActiveChild($item->children) ? 'text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-dark-muted hover:text-primary-700 dark:hover:text-primary-300 hover:bg-primary-50 dark:hover:bg-primary-900/30' }}"
                            >
                                {{ $item->label }}
                                <svg class="chevron h-3.5 w-3.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            @if (hasActiveChild($item->children))
                                <span class="absolute -bottom-0.5 left-3 right-3 h-0.5 bg-primary-600 rounded-full"></span>
                            @endif
                            <div
                                data-dropdown-menu="{{ $item->id }}"
                                class="hidden absolute left-0 top-full mt-1 z-50 w-56 rounded-xl border border-border dark:border-dark-border bg-white dark:bg-dark-surface py-1.5 shadow-dropdown"
                                role="menu"
                            >
                                @foreach ($item->children as $child)
                                    <a
                                        href="{{ $child->route ? route($child->route, $child->params ?? []) : '#' }}"
                                        class="block px-4 py-2.5 text-sm transition-colors {{ isActive($child->route ?? '', $child->params ?? []) ? 'text-primary-700 dark:text-primary-300 bg-primary-50 dark:bg-primary-900/30 font-medium' : 'text-gray-700 dark:text-dark-muted hover:bg-primary-50 dark:hover:bg-primary-900/30 hover:text-primary-700 dark:hover:text-primary-300' }}"
                                        role="menuitem"
                                    >{{ $child->label }}</a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a
                            href="{{ $item->route ? route($item->route, $item->params ?? []) : '#' }}"
                            class="relative rounded-lg px-3 py-2 text-sm font-medium font-heading transition-colors {{ isActive($item->route ?? '', $item->params ?? []) ? 'text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-dark-muted hover:text-primary-700 dark:hover:text-primary-300 hover:bg-primary-50 dark:hover:bg-primary-900/30' }}"
                        >
                            {{ $item->label }}
                            @if (isActive($item->route ?? '', $item->params ?? []))
                                <span class="absolute -bottom-0.5 left-3 right-3 h-0.5 bg-primary-600 rounded-full"></span>
                            @endif
                        </a>
                    @endif
                </div>
            @endforeach
        </nav>

        <div class="flex items-center gap-2">
            <button onclick="openSearch()" class="rounded-lg p-2 text-gray-400 dark:text-dark-muted transition hover:bg-primary-50 dark:hover:bg-primary-900/30 hover:text-primary-600 dark:hover:text-primary-300" aria-label="Pencarian">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
            <button id="drawerToggle" onclick="toggleDrawer()" class="rounded-lg p-2 text-gray-400 dark:text-dark-muted transition lg:hidden hover:bg-primary-50 dark:hover:bg-primary-900/30" aria-label="Toggle menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path class="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path class="close-icon hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <div id="mobileOverlay" class="fixed inset-0 z-40 bg-black/50 lg:hidden hidden" onclick="closeDrawer()"></div>

    <div id="mobileDrawer"
        class="fixed inset-y-0 right-0 z-50 w-72 max-w-[85vw] bg-white dark:bg-dark-surface shadow-2xl lg:hidden overflow-y-auto hidden"
        role="dialog"
        aria-modal="true"
    >
        <div class="flex items-center justify-between px-4 py-4 border-b border-border dark:border-dark-border">
            <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-600 text-xs font-bold text-white">RB</div>
                <p class="text-sm font-semibold text-gray-900 dark:text-dark-text font-heading">Menu</p>
            </div>
            <button data-drawer-close class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 dark:hover:bg-dark-surface-alt" aria-label="Tutup menu">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="px-3 py-4 space-y-1">
            @foreach ($menuItems as $item)
                <div>
                    @if ($item->children->isEmpty())
                        <a
                            href="{{ $item->route ? route($item->route, $item->params ?? []) : '#' }}"
                            class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition {{ isActive($item->route ?? '', $item->params ?? []) ? 'text-primary-700 dark:text-primary-300 bg-primary-50 dark:bg-primary-900/30' : 'text-gray-600 dark:text-dark-muted hover:bg-primary-50 dark:hover:bg-primary-900/30 hover:text-primary-700 dark:hover:text-primary-300' }}"
                        >{{ $item->label }}</a>
                    @else
                        <div>
                            <button
                                data-mobile-toggle="{{ $item->id }}"
                                class="flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-sm font-medium text-gray-600 dark:text-dark-muted hover:bg-primary-50 dark:hover:bg-primary-900/30 hover:text-primary-700 dark:hover:text-primary-300"
                            >
                                <span>{{ $item->label }}</span>
                                <svg class="chevron h-4 w-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div data-mobile-menu="{{ $item->id }}" class="hidden ml-4 space-y-1 pb-1">
                                @foreach ($item->children as $child)
                                    <a
                                        href="{{ $child->route ? route($child->route, $child->params ?? []) : '#' }}"
                                        class="flex items-center rounded-lg px-3 py-2 text-sm transition {{ isActive($child->route ?? '', $child->params ?? []) ? 'text-primary-700 dark:text-primary-300 bg-primary-50 dark:bg-primary-900/30' : 'text-gray-600 dark:text-dark-muted hover:bg-primary-50 dark:hover:bg-primary-900/30 hover:text-primary-700 dark:hover:text-primary-300' }}"
                                    >{{ $child->label }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="border-t border-border dark:border-dark-border px-3 py-4">
            <a href="{{ route('search') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-600 dark:text-dark-muted hover:bg-primary-50 dark:hover:bg-primary-900/30 hover:text-primary-700 dark:hover:text-primary-300 transition">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Pencarian
            </a>
        </div>
    </div>
</nav>
