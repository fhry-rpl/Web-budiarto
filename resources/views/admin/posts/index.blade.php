@extends('layouts.admin')

@section('title', 'Postingan')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-600 dark:text-dark-muted">Total: {{ $posts->total() }} postingan</p>
        <a href="{{ route('admin.posts.create') }}" class="btn-primary btn-md">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Postingan
        </a>
    </div>
    @if ($posts->isEmpty())
        <div class="text-center py-16">
            <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-dark-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            <p class="mt-4 text-gray-500 dark:text-dark-muted">Belum ada postingan.</p>
        </div>
    @else
        <div class="card-dashboard overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th class="table-header">Judul</th>
                        <th class="table-header hidden sm:table-cell">Thumbnail</th>
                        <th class="table-header hidden sm:table-cell">Kategori</th>
                        <th class="table-header">Status</th>
                        <th class="table-header hidden md:table-cell">Tanggal</th>
                        <th class="table-header text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-dark-border">
                    @foreach ($posts as $post)
                        <tr class="hover:bg-gray-50 dark:hover:bg-dark-surface/50 transition">
                            <td class="table-cell font-medium text-gray-900 dark:text-dark-text">{{ $post->title }}</td>
                            <td class="table-cell hidden sm:table-cell">
                                @if ($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" class="h-10 w-16 rounded object-cover">
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="table-cell hidden sm:table-cell">{{ $post->category?->name ?? '-' }}</td>
                            <td class="table-cell">
                                @if ($post->is_published)
                                    <span class="inline-flex items-center rounded-full bg-accent-50 dark:bg-accent-900/20 px-2 py-0.5 text-xs font-medium text-accent-700 dark:text-accent-300">Terbit</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-warning-50 dark:bg-warning-900/20 px-2 py-0.5 text-xs font-medium text-warning-700 dark:text-warning-300">Draf</span>
                                @endif
                            </td>
                            <td class="table-cell hidden md:table-cell text-gray-500">{{ $post->published_at?->format('d F Y') ?? '-' }}</td>
                            <td class="table-cell text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn-ghost btn-sm">Edit</a>
                                    <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}" onsubmit="return confirm('Hapus postingan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-ghost btn-sm text-error-600 hover:bg-error-50 hover:text-error-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $posts->links() }}</div>
    @endif
@endsection
