@extends('layouts.front')

@section('title', ($page?->title ?? 'Halaman') . ' — ' . config('app.name'))

@section('content')
    <section class="py-20 sm:py-28">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            @if (!$page)
                <div class="text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-dark-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                    <p class="mt-4 text-gray-500 dark:text-dark-muted">Konten belum tersedia.</p>
                    <a href="{{ route('home') }}" class="mt-4 inline-flex btn-outline btn-md">Kembali ke Beranda</a>
                </div>
            @else
                <div class="flex items-center gap-2 text-sm text-primary-600 dark:text-primary-400 mb-4">
                    <a href="{{ route('home') }}" class="hover:text-primary-700 transition">Beranda</a>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-gray-500 dark:text-dark-muted">{{ $page->title }}</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading sm:text-4xl">{{ $page->title }}</h1>
                <div class="mt-8 prose prose-primary dark:prose-invert max-w-none">
                    {!! $page->body ?? '' !!}
                </div>
            @endif
        </div>
    </section>
@endsection
