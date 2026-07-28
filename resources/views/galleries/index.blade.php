@extends('layouts.front')

@section('title', 'Galeri — ' . config('app.name'))

@section('content')
    <section class="bg-surface-alt dark:bg-dark-surface-alt py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <span class="inline-flex items-center rounded-full bg-primary-50 dark:bg-primary-900/30 px-3 py-1 text-sm font-medium text-primary-700 dark:text-primary-300">Galeri</span>
                <h1 class="mt-4 text-3xl font-bold text-gray-900 dark:text-dark-text font-heading sm:text-4xl">Galeri</h1>
                <p class="mt-3 text-lg text-gray-600 dark:text-dark-muted">Kumpulan foto dan dokumentasi Bandar Udara Budiarto</p>
            </div>
            @if ($galleries->isEmpty())
                <div class="mt-12 text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-dark-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="mt-4 text-gray-500 dark:text-dark-muted">Belum ada galeri.</p>
                </div>
            @else
                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($galleries as $gallery)
                        <a href="{{ route('galleries.show', $gallery->id) }}" class="group card overflow-hidden">
                            @if ($gallery->cover_image)
                                <img src="{{ Storage::url($gallery->cover_image) }}" alt="{{ $gallery->title }}" class="h-48 w-full object-cover transition group-hover:scale-105 duration-500" loading="lazy">
                            @else
                                <div class="h-48 w-full bg-gradient-to-br from-primary-100 dark:from-primary-900/50 to-primary-50 dark:to-primary-950/30 flex items-center justify-center">
                                    <svg class="h-12 w-12 text-primary-300 dark:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <div class="p-5">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-dark-text font-heading group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">{{ $gallery->title }}</h2>
                                @if ($gallery->description)
                                    <p class="mt-1 text-sm text-gray-600 dark:text-dark-muted line-clamp-2">{{ $gallery->description }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $galleries->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
