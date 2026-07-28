@extends('layouts.front')

@section('title', 'Pencarian — ' . config('app.name'))

@section('content')
    <section class="bg-surface-alt dark:bg-dark-surface-alt py-20 sm:py-28">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading sm:text-4xl">Pencarian</h1>
            <form action="{{ route('search') }}" method="GET" class="mt-6">
                <div class="flex gap-2">
                    <div class="relative flex-1">
                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" name="q" value="{{ $query }}" placeholder="Cari berita, dokumen..." class="block w-full rounded-xl border border-border dark:border-dark-border bg-white dark:bg-dark-surface pl-10 pr-4 py-3 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20" autofocus>
                    </div>
                    <button type="submit" class="btn-primary btn-lg">Cari</button>
                </div>
            </form>
            @if ($query)
                <div class="mt-10 space-y-8">
                    @if ($posts->isNotEmpty())
                        <div>
                            <h2 class="heading-h2 text-gray-900 dark:text-dark-text flex items-center gap-2">
                                <svg class="h-5 w-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                Berita
                            </h2>
                            <div class="mt-4 space-y-3">
                                @foreach ($posts as $post)
                                    <a href="{{ route('posts.show', $post->slug) }}" class="card p-4 block hover:shadow-card-hover transition">
                                        <h3 class="font-semibold text-gray-900 dark:text-dark-text">{{ $post->title }}</h3>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-dark-muted line-clamp-2">{{ $post->excerpt }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if ($documents->isNotEmpty())
                        <div>
                            <h2 class="heading-h2 text-gray-900 dark:text-dark-text flex items-center gap-2">
                                <svg class="h-5 w-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                Dokumen
                            </h2>
                            <div class="mt-4 space-y-3">
                                @foreach ($documents as $document)
                                    <a href="{{ route('documents.show', $document->id) }}" class="card p-4 block hover:shadow-card-hover transition">
                                        <h3 class="font-semibold text-gray-900 dark:text-dark-text">{{ $document->title }}</h3>
                                        @if ($document->description)
                                            <p class="mt-1 text-sm text-gray-600 dark:text-dark-muted line-clamp-1">{{ $document->description }}</p>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if ($posts->isEmpty() && $documents->isEmpty())
                        <div class="text-center py-16">
                            <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-dark-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <p class="mt-4 text-gray-500 dark:text-dark-muted">Tidak ditemukan hasil untuk "<strong>{{ $query }}</strong>".</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
@endsection
