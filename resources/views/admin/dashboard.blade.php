@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="heading-h2 text-gray-900 dark:text-dark-text">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-dark-muted">Selamat datang di panel administrasi.</p>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="card-dashboard p-6">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-dark-muted">Postingan</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading">{{ $postCount }}</p>
                    <p class="mt-0.5 text-xs text-gray-400 dark:text-dark-muted">
                        {{ $publishedPosts }} terbit · {{ $draftPosts }} draf
                    </p>
                </div>
            </div>
        </div>
        <div class="card-dashboard p-6">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-dark-muted">Dokumen</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading">{{ $documentCount }}</p>
                    <p class="mt-0.5 text-xs text-gray-400 dark:text-dark-muted">{{ $totalDownloads }} total unduhan</p>
                </div>
            </div>
        </div>
        <div class="card-dashboard p-6">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-dark-muted">Galeri</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading">{{ $galleryCount }}</p>
                    <p class="mt-0.5 text-xs text-gray-400 dark:text-dark-muted">{{ $totalImages }} total foto</p>
                </div>
            </div>
        </div>
        <div class="card-dashboard p-6">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-dark-muted">Pesan</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading">{{ $contactCount }}</p>
                    <p class="mt-0.5 text-xs text-gray-400 dark:text-dark-muted">{{ $contactTotal }} total · {{ $contactCount }} belum dibaca</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="card-dashboard p-6">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-accent-50 dark:bg-accent-900/30 text-accent-600 dark:text-accent-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-dark-muted">Layanan</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading">{{ $serviceCount }}</p>
                </div>
            </div>
        </div>
        <div class="card-dashboard p-6">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-accent-50 dark:bg-accent-900/30 text-accent-600 dark:text-accent-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-dark-muted">Staf</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading">{{ $staffCount }}</p>
                </div>
            </div>
        </div>
        <div class="card-dashboard p-6">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-accent-50 dark:bg-accent-900/30 text-accent-600 dark:text-accent-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-dark-muted">Kategori</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading">{{ $categoryCount }}</p>
                </div>
            </div>
        </div>
        <div class="card-dashboard p-6">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-accent-50 dark:bg-accent-900/30 text-accent-600 dark:text-accent-300">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-dark-muted">Pengguna</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-dark-text font-heading">{{ $userCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 grid gap-8 lg:grid-cols-2">
        <div class="card-dashboard p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="heading-h3 text-gray-900 dark:text-dark-text">Postingan Terbaru</h2>
                <a href="{{ route('admin.posts.index') }}" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:underline">Lihat semua</a>
            </div>
            @if ($recentPosts->isEmpty())
                <p class="text-sm text-gray-500 dark:text-dark-muted">Belum ada postingan.</p>
            @else
                <ul class="divide-y divide-border dark:divide-dark-border">
                    @foreach ($recentPosts as $post)
                        <li class="py-3 first:pt-0 last:pb-0">
                            <div class="flex items-start justify-between gap-2">
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-sm font-medium text-gray-900 dark:text-dark-text hover:text-primary-600 dark:hover:text-primary-400 transition">{{ $post->title }}</a>
                                @if ($post->is_published)
                                    <span class="shrink-0 rounded-full bg-accent-50 dark:bg-accent-900/20 px-2.5 py-0.5 text-xs font-medium text-accent-700 dark:text-accent-300">Terbit</span>
                                @else
                                    <span class="shrink-0 rounded-full bg-gray-100 dark:bg-gray-800 px-2.5 py-0.5 text-xs font-medium text-gray-600 dark:text-gray-400">Draf</span>
                                @endif
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-dark-muted">
                                {{ $post->published_at?->format('d F Y') ?? '—' }}
                                @if ($post->category)
                                    · {{ $post->category->name }}
                                @endif
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="card-dashboard p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="heading-h3 text-gray-900 dark:text-dark-text">Dokumen Terbaru</h2>
                <a href="{{ route('admin.documents.index') }}" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:underline">Lihat semua</a>
            </div>
            @if ($recentDocuments->isEmpty())
                <p class="text-sm text-gray-500 dark:text-dark-muted">Belum ada dokumen.</p>
            @else
                <ul class="divide-y divide-border dark:divide-dark-border">
                    @foreach ($recentDocuments as $doc)
                        <li class="py-3 first:pt-0 last:pb-0">
                            <div class="flex items-start justify-between gap-2">
                                <a href="{{ route('admin.documents.edit', $doc->id) }}" class="text-sm font-medium text-gray-900 dark:text-dark-text hover:text-primary-600 dark:hover:text-primary-400 transition">{{ $doc->title }}</a>
                                <span class="shrink-0 text-xs text-gray-400 dark:text-dark-muted">{{ $doc->download_count }}x unduh</span>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-dark-muted">
                                {{ $doc->created_at->format('d F Y') }}
                                @if ($doc->category)
                                    · {{ $doc->category->name }}
                                @endif
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="mt-8 grid gap-8 lg:grid-cols-2">
        <div class="card-dashboard p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="heading-h3 text-gray-900 dark:text-dark-text">Galeri Terbaru</h2>
                <a href="{{ route('admin.galleries.index') }}" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:underline">Lihat semua</a>
            </div>
            @if ($recentGalleries->isEmpty())
                <p class="text-sm text-gray-500 dark:text-dark-muted">Belum ada galeri.</p>
            @else
                <ul class="divide-y divide-border dark:divide-dark-border">
                    @foreach ($recentGalleries as $gallery)
                        <li class="py-3 first:pt-0 last:pb-0">
                            <div class="flex items-start justify-between gap-2">
                                <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="text-sm font-medium text-gray-900 dark:text-dark-text hover:text-primary-600 dark:hover:text-primary-400 transition">{{ $gallery->title }}</a>
                                <span class="shrink-0 text-xs text-gray-400 dark:text-dark-muted">{{ $gallery->images_count }} foto</span>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-dark-muted">{{ $gallery->created_at->format('d F Y') }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="card-dashboard p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="heading-h3 text-gray-900 dark:text-dark-text">Pesan Masuk Terbaru</h2>
                <a href="{{ route('admin.contacts.index') }}" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:underline">Lihat semua</a>
            </div>
            @if ($recentContacts->isEmpty())
                <p class="text-sm text-gray-500 dark:text-dark-muted">Belum ada pesan.</p>
            @else
                <ul class="divide-y divide-border dark:divide-dark-border">
                    @foreach ($recentContacts as $contact)
                        <li class="py-3 first:pt-0 last:pb-0">
                            <div class="flex items-start justify-between gap-2">
                                <a href="{{ route('admin.contacts.show', $contact->id) }}" class="text-sm font-medium text-gray-900 dark:text-dark-text hover:text-primary-600 dark:hover:text-primary-400 transition">{{ $contact->subject }}</a>
                                @if (!$contact->is_read)
                                    <span class="shrink-0 rounded-full bg-error-50 dark:bg-error-900/20 px-2.5 py-0.5 text-xs font-medium text-error-700 dark:text-error-300">Baru</span>
                                @endif
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-dark-muted">{{ $contact->name }} — {{ $contact->created_at->format('d F Y') }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
