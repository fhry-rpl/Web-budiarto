@extends('layouts.front')

@section('title', $gallery->title . ' — ' . config('app.name'))

@section('content')
    <section class="py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-sm text-primary-600 dark:text-primary-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-primary-700 transition">Beranda</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('galleries.index') }}" class="hover:text-primary-700 transition">Galeri</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-gray-500 dark:text-dark-muted">{{ $gallery->title }}</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading sm:text-4xl">{{ $gallery->title }}</h1>
            @if ($gallery->description)
                <p class="mt-3 text-lg text-gray-600 dark:text-dark-muted">{{ $gallery->description }}</p>
            @endif
            @if ($gallery->images->isNotEmpty())
                <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($gallery->images as $index => $image)
                        <button onclick="openLightbox({{ $index }}, {{ json_encode($gallery->images->pluck('image_path')->map(fn($p) => Storage::url($p))->values()->toArray()) }})" class="group overflow-hidden rounded-xl card-hover">
                            <img src="{{ Storage::url($image->image_path) }}" alt="" class="h-48 w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                        </button>
                    @endforeach
                </div>
            @endif
            <div class="mt-10 pt-8 border-t border-border dark:border-dark-border flex flex-wrap gap-4">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/></svg>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('galleries.index') }}" class="inline-flex items-center text-sm text-gray-500 dark:text-dark-muted hover:text-primary-600 dark:hover:text-primary-400 transition">
                    Semua Galeri
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <div id="lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 p-4" role="dialog" aria-modal="true">
        <button id="lightboxClose" class="absolute top-4 right-4 rounded-full bg-white/10 p-2 text-white hover:bg-white/20 transition">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <button id="lightboxPrev" class="absolute left-4 rounded-full bg-white/10 p-2 text-white hover:bg-white/20 transition">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <img id="lightboxImg" src="" alt="" class="max-h-[85vh] max-w-full rounded-2xl object-contain shadow-2xl">
        <button id="lightboxNext" class="absolute right-4 rounded-full bg-white/10 p-2 text-white hover:bg-white/20 transition">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
@endsection
