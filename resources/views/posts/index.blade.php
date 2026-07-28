@extends('layouts.front')

@php
    $isPengumuman = request()->route()->named('pengumuman.index');
    $label = $isPengumuman ? 'Pengumuman' : 'Berita';
    $titleLabel = $isPengumuman ? 'Pengumuman' : 'Berita';
    $description = $isPengumuman ? 'Pengumuman resmi Bandar Udara Budiarto' : 'Informasi terkini seputar Bandar Udara Budiarto';
    $emptyMessage = $isPengumuman ? 'Belum ada pengumuman.' : 'Belum ada berita.';
@endphp

@section('title', $titleLabel . ' — ' . config('app.name'))

@section('content')
    <section class="bg-surface-alt dark:bg-dark-surface-alt py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <span class="inline-flex items-center rounded-full bg-primary-50 dark:bg-primary-900/30 px-3 py-1 text-sm font-medium text-primary-700 dark:text-primary-300">{{ $label }}</span>
                <h1 class="mt-4 text-3xl font-bold text-gray-900 dark:text-dark-text font-heading sm:text-4xl">{{ $titleLabel }}</h1>
                <p class="mt-3 text-lg text-gray-600 dark:text-dark-muted">{{ $description }}</p>
            </div>
            @if ($posts->isEmpty())
                <div class="mt-12 text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-dark-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <p class="mt-4 text-gray-500 dark:text-dark-muted">{{ $emptyMessage }}</p>
                </div>
            @else
                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)
                        <article class="group card overflow-hidden">
                            @if ($post->thumbnail)
                                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="h-48 w-full object-cover" loading="lazy">
                            @else
                                <div class="h-48 w-full bg-gradient-to-br from-primary-100 dark:from-primary-900/50 to-primary-50 dark:to-primary-950/30 flex items-center justify-center">
                                    <svg class="h-12 w-12 text-primary-300 dark:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                            @endif
                            <div class="p-5">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-medium text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/30 px-2 py-0.5 rounded-full">{{ $post->category?->name }}</span>
                                    <span class="text-xs text-gray-400">{{ $post->published_at?->format('d F Y') ?? '' }}</span>
                                </div>
                                <h2 class="mt-2 text-lg font-semibold text-gray-900 dark:text-dark-text font-heading group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">
                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </h2>
                                <p class="mt-2 text-sm text-gray-600 dark:text-dark-muted line-clamp-2">{{ $post->excerpt }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-10">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
