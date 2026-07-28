@extends('layouts.front')

@section('title', 'Dokumen — ' . config('app.name'))

@section('content')
    <section class="bg-surface-alt dark:bg-dark-surface-alt py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <span class="inline-flex items-center rounded-full bg-primary-50 dark:bg-primary-900/30 px-3 py-1 text-sm font-medium text-primary-700 dark:text-primary-300">Dokumen</span>
                <h1 class="mt-4 text-3xl font-bold text-gray-900 dark:text-dark-text font-heading sm:text-4xl">Dokumen</h1>
                <p class="mt-3 text-lg text-gray-600 dark:text-dark-muted">Kumpulan dokumen resmi Bandar Udara Budiarto</p>
            </div>
            @if ($categories->isNotEmpty())
                <div class="mt-6 flex flex-wrap gap-2">
                    <a href="{{ route('documents.index') }}" class="rounded-full px-4 py-1.5 text-sm font-medium transition {{ !$query ? 'bg-primary-600 text-white shadow-sm' : 'bg-white dark:bg-dark-surface text-gray-700 dark:text-dark-muted border border-border dark:border-dark-border hover:bg-primary-50 dark:hover:bg-primary-900/30' }}">Semua</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('documents.index', ['kategori' => $category->slug]) }}" class="rounded-full px-4 py-1.5 text-sm font-medium transition {{ $query === $category->slug ? 'bg-primary-600 text-white shadow-sm' : 'bg-white dark:bg-dark-surface text-gray-700 dark:text-dark-muted border border-border dark:border-dark-border hover:bg-primary-50 dark:hover:bg-primary-900/30' }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            @endif
            @if ($documents->isEmpty())
                <div class="mt-12 text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-dark-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    <p class="mt-4 text-gray-500 dark:text-dark-muted">Belum ada dokumen.</p>
                </div>
            @else
                <div class="mt-8 space-y-3">
                    @foreach ($documents as $document)
                        <div class="flex items-center justify-between card p-4">
                            <div class="flex items-start gap-3 min-w-0">
                                <svg class="mt-0.5 h-6 w-6 shrink-0 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                <div class="min-w-0">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-dark-text truncate">{{ $document->title }}</h3>
                                    @if ($document->description)
                                        <p class="mt-1 text-xs text-gray-500 dark:text-dark-muted line-clamp-1">{{ $document->description }}</p>
                                    @endif
                                    <p class="mt-1 text-xs text-gray-400">{{ $document->published_at?->format('d F Y') ?? '' }}</p>
                                </div>
                            </div>
                            <a href="{{ route('documents.download', $document->id) }}" class="shrink-0 rounded-lg bg-primary-50 dark:bg-primary-900/30 p-2.5 text-primary-600 dark:text-primary-400 transition hover:bg-primary-100 dark:hover:bg-primary-900/50" aria-label="Unduh dokumen">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $documents->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
