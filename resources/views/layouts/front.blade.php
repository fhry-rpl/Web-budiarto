<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Website resmi RENPRO UPBU Budiarto')">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=lexend:300,400,500,600,700|source-sans-3:300,400,500,600,700" media="print" onload="this.media='all'">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans text-gray-900 antialiased bg-surface">
    <x-navigation />

    <div id="searchModal" class="fixed inset-0 z-[60] bg-black/60 backdrop-blur-sm flex items-start justify-center pt-[15vh] hidden" onclick="closeSearch()">
        <div onclick="event.stopPropagation()" class="w-full max-w-lg mx-4">
            <form action="{{ route('search') }}" method="GET" class="bg-white dark:bg-dark-surface rounded-2xl shadow-modal border border-border dark:border-dark-border overflow-hidden">
                <div class="flex items-center gap-3 px-5 py-4">
                    <svg class="h-5 w-5 shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input
                        type="text"
                        name="q"
                        placeholder="Cari berita, dokumen, layanan..."
                        class="flex-1 border-0 bg-transparent text-sm text-gray-900 dark:text-dark-text placeholder-gray-400 focus:outline-none focus:ring-0"
                        autocomplete="off"
                    >
                    <button type="button" onclick="closeSearch()" class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 dark:hover:bg-dark-surface-alt transition" aria-label="Tutup pencarian">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openSearch() { document.getElementById('searchModal').classList.remove('hidden'); }
        function closeSearch() { document.getElementById('searchModal').classList.add('hidden'); }
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeSearch(); });
    </script>

    <main>
        @yield('content')
    </main>
    <x-footer />
    @stack('scripts')
</body>
</html>
