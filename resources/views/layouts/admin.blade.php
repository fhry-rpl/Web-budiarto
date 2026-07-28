<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=lexend:400,500,600,700|source-sans-3:400,500,600" media="print" onload="this.media='all'">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-dark-bg">
    <div class="flex h-screen overflow-hidden">

        <aside class="hidden lg:flex lg:flex-col w-64 bg-primary-950 dark:bg-[#0a0f1a] text-white shrink-0">
            <x-admin.sidebar />
        </aside>

        <div id="sidebarOverlay" class="fixed inset-0 z-40 bg-black/50 lg:hidden hidden" onclick="toggleSidebar()"></div>

        <aside id="adminSidebar"
            class="hidden fixed inset-y-0 left-0 z-50 w-64 bg-primary-950 dark:bg-[#0a0f1a] text-white overflow-y-auto lg:!flex lg:relative"
        >
            <x-admin.sidebar />
        </aside>

        <div class="flex flex-col flex-1 overflow-y-auto">
            <x-admin.topbar />
            <main class="p-6 lg:p-8">
                @if (session('success'))
                    <div class="mb-4 flex items-center gap-2 rounded-lg bg-accent-50 dark:bg-accent-900/20 p-4 text-sm text-accent-700 dark:text-accent-300 border border-accent-200 dark:border-accent-800" role="alert">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 flex items-center gap-2 rounded-lg bg-error-50 dark:bg-error-900/20 p-4 text-sm text-error-700 dark:text-error-300 border border-error-200 dark:border-error-800" role="alert">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
