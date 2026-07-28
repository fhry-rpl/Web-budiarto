<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=lexend:400,500,600,700|source-sans-3:400,500,600" media="print" onload="this.media='all'">
        @stack('scripts')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-primary-50 to-surface dark:from-dark-bg dark:to-dark-surface">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-6">
                <a href="/" class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary-600 text-lg font-bold text-white shadow-md">RB</div>
                    <div class="hidden sm:block">
                        <p class="text-sm font-semibold text-gray-900 dark:text-dark-text font-heading">RENPRO UPBU Budiarto</p>
                        <p class="text-xs text-gray-500 dark:text-dark-muted">Bandar Udara Budiarto</p>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-6 bg-white dark:bg-dark-surface rounded-2xl shadow-card border border-border dark:border-dark-border">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
