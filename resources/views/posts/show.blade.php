@extends('layouts.front')

@section('title', $post->title . ' — ' . config('app.name'))
@section('meta_description', $post->excerpt)

@section('content')
    <article class="py-20 sm:py-28">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-sm text-primary-600 dark:text-primary-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-primary-700 transition">Beranda</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('posts.index') }}" class="hover:text-primary-700 transition">Berita</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-gray-500 dark:text-dark-muted">{{ $post->title }}</span>
            </div>
            <div class="flex items-center gap-3 mb-4">
                <span class="text-sm font-medium text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/30 px-3 py-1 rounded-full">{{ $post->category?->name }}</span>
                <span class="text-sm text-gray-500 dark:text-dark-muted">{{ $post->published_at?->format('d F Y') ?? '' }}</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading sm:text-4xl">{{ $post->title }}</h1>
            @if ($post->thumbnail)
                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="mt-8 w-full rounded-2xl object-cover shadow-card" loading="lazy">
            @endif
            <div class="mt-8 prose prose-primary dark:prose-invert max-w-none">
                {!! $post->body !!}
            </div>
            <div class="mt-10 pt-8 border-t border-border dark:border-dark-border flex flex-wrap gap-4">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/></svg>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('posts.index') }}" class="inline-flex items-center text-sm text-gray-500 dark:text-dark-muted hover:text-primary-600 dark:hover:text-primary-400 transition">
                    Semua Berita
                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </article>
@endsection
