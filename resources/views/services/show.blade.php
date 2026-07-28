@extends('layouts.front')

@section('title', $service->title . ' — ' . config('app.name'))

@section('content')
    <section class="py-20 sm:py-28">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-sm text-primary-600 dark:text-primary-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-primary-700 transition">Beranda</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('services.index') }}" class="hover:text-primary-700 transition">Layanan</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-gray-500 dark:text-dark-muted">{{ $service->title }}</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading sm:text-4xl">{{ $service->title }}</h1>
            
            <div class="mt-8 prose prose-primary dark:prose-invert max-w-none">
                {!! $service->description !!}
            </div>
            
            @if ($service->procedure)
                <div class="mt-10 card p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-dark-text font-heading flex items-center gap-2">
                        <svg class="h-5 w-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        Prosedur
                    </h2>
                    <div class="mt-4 prose prose-primary dark:prose-invert max-w-none">{!! $service->procedure !!}</div>
                </div>
            @endif
            
            @if ($service->requirements)
                <div class="mt-6 card p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-dark-text font-heading flex items-center gap-2">
                        <svg class="h-5 w-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Persyaratan
                    </h2>
                    <div class="mt-4 prose prose-primary dark:prose-invert max-w-none">{!! $service->requirements !!}</div>
                </div>
            @endif
            
            @if ($service->contact_info)
                <div class="mt-6 rounded-xl bg-primary-50 dark:bg-primary-900/30 border border-primary-100 dark:border-primary-800 p-6">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-dark-text font-heading flex items-center gap-2">
                        <svg class="h-5 w-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Informasi Kontak
                    </h2>
                    <p class="mt-2 text-sm text-gray-700 dark:text-dark-muted">{{ $service->contact_info }}</p>
                </div>
            @endif
            
            <div class="mt-10 pt-8 border-t border-border dark:border-dark-border flex flex-wrap gap-4">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/></svg>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('services.index') }}" class="inline-flex items-center text-sm text-gray-500 dark:text-dark-muted hover:text-primary-600 dark:hover:text-primary-400 transition">
                    Semua Layanan
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
