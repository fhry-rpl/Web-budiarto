@props(['menuItems' => [
    ['label' => 'Dashboard', 'icon' => 'layout-dashboard', 'route' => 'admin.dashboard'],
    [
        'group' => 'Konten',
        'items' => [
            ['label' => 'Postingan', 'icon' => 'file-text', 'route' => 'admin.posts.index'],
            ['label' => 'Dokumen', 'icon' => 'file', 'route' => 'admin.documents.index'],
            ['label' => 'Kategori', 'icon' => 'tags', 'route' => 'admin.categories.index'],
            ['label' => 'Halaman', 'icon' => 'file-text', 'route' => 'admin.pages.index'],
        ],
    ],
    [
        'group' => 'Fitur',
        'items' => [
            ['label' => 'Layanan', 'icon' => 'briefcase', 'route' => 'admin.services.index'],
            ['label' => 'Galeri', 'icon' => 'image', 'route' => 'admin.galleries.index'],
            ['label' => 'Staf', 'icon' => 'users', 'route' => 'admin.staff.index'],
        ],
    ],
    [
        'group' => 'Pengaturan',
        'items' => [
            ['label' => 'Menu Navigasi', 'icon' => 'menu', 'route' => 'admin.menus.index'],
            ['label' => 'Pesan Masuk', 'icon' => 'mail', 'route' => 'admin.contacts.index'],
            ['label' => 'Pengaturan', 'icon' => 'settings', 'route' => 'admin.settings.index'],
        ],
    ],
]])

<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-5 border-b border-primary-800 hover:bg-primary-900/50 transition-colors">
    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary-600 text-sm font-bold text-white shadow-sm">RB</div>
    <div class="text-sm">
        <p class="font-semibold leading-tight font-heading">Admin Panel</p>
        <p class="text-xs text-primary-300 leading-tight">{{ auth()->user()?->name }}</p>
    </div>
</a>
<nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
    @foreach ($menuItems as $item)
        @if (isset($item['group']))
            <div class="text-[11px] font-semibold text-primary-300/60 uppercase tracking-wider px-3 pt-4 pb-1">{{ $item['group'] }}</div>
            @foreach ($item['items'] as $child)
                @php $active = request()->routeIs($child['route'] . '*'); @endphp
                <a href="{{ route($child['route']) }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition {{ $active ? 'bg-primary-600 text-white shadow-sm' : 'text-primary-200 hover:bg-primary-800 hover:text-white' }}"
                >
                    <x-admin.icon :name="$child['icon']" class="h-5 w-5 shrink-0" />
                    {{ $child['label'] }}
                </a>
            @endforeach
        @else
            @php $active = request()->routeIs($item['route'] . '*'); @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition {{ $active ? 'bg-primary-600 text-white shadow-sm' : 'text-primary-200 hover:bg-primary-800 hover:text-white' }}"
            >
                <x-admin.icon :name="$item['icon']" class="h-5 w-5 shrink-0" />
                {{ $item['label'] }}
            </a>
        @endif
    @endforeach
</nav>
<div class="border-t border-primary-800 px-3 py-3 space-y-1">
    <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-primary-200 transition hover:bg-primary-800 hover:text-white">
        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Website
    </a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-primary-200 transition hover:bg-primary-800 hover:text-white">
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Keluar
        </button>
    </form>
</div>
