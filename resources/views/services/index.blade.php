@extends('layouts.front')

@section('title', 'Layanan — ' . config('app.name'))

@section('content')
    <section class="bg-surface-alt dark:bg-dark-surface-alt py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <span class="inline-flex items-center rounded-full bg-primary-50 dark:bg-primary-900/30 px-3 py-1 text-sm font-medium text-primary-700 dark:text-primary-300">Layanan</span>
                <h1 class="mt-4 text-3xl font-bold text-gray-900 dark:text-dark-text font-heading sm:text-4xl">Layanan</h1>
                <p class="mt-3 text-lg text-gray-600 dark:text-dark-muted">Berbagai layanan yang tersedia di Bandar Udara Budiarto</p>
            </div>
            @if ($services->isEmpty())
                <div class="mt-12 text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <p class="mt-4 text-gray-500">Belum ada layanan.</p>
                </div>
            @else
                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($services as $service)
                        <a href="{{ route('services.show', $service->slug) }}" class="group card card-hover p-6">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300 group-hover:bg-primary-600 group-hover:text-white transition-all duration-200">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <h2 class="mt-4 text-lg font-semibold text-gray-900 dark:text-dark-text font-heading group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">{{ $service->title }}</h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-dark-muted line-clamp-3">{{ $service->description }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
