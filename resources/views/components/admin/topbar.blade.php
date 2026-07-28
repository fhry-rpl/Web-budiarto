<header class="sticky top-0 z-40 flex h-16 items-center gap-4 border-b border-border dark:border-dark-border bg-white dark:bg-dark-surface px-6">
    <button type="button" onclick="toggleSidebar()" class="lg:hidden rounded-lg p-2 text-gray-500 dark:text-dark-muted hover:bg-gray-100 dark:hover:bg-dark-surface-alt" aria-label="Toggle sidebar">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
    <div class="flex-1">
        <h1 class="heading-h3 text-gray-900 dark:text-dark-text">@yield('title', 'Dashboard')</h1>
    </div>
    <div class="flex items-center gap-4">
        <span class="text-sm text-gray-600 dark:text-dark-muted">{{ auth()->user()?->name }}</span>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="btn-ghost btn-sm">Keluar</button>
        </form>
    </div>
</header>
