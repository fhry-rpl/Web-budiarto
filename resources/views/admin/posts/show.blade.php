@extends('layouts.admin')

@section('title', $post->title)

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Judul</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $post->title }}</dd>
                </div>
                @if ($post->thumbnail)
                <div>
                    <dt class="text-sm font-medium text-gray-500">Thumbnail</dt>
                    <dd class="mt-1">
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="h-40 w-auto rounded-lg border object-cover">
                    </dd>
                </div>
                @endif
                <div>
                    <dt class="text-sm font-medium text-gray-500">Slug</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $post->slug }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $post->category?->name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Penulis</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $post->user?->name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Ringkasan</dt>
                    <dd class="mt-1 text-sm text-gray-700">{{ $post->excerpt ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Konten</dt>
                    <dd class="mt-1 text-sm text-gray-700 whitespace-pre-wrap">{{ $post->body }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
                        @if ($post->is_published)
                            <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700">Terbit</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-yellow-50 px-2 py-0.5 text-xs font-medium text-yellow-700">Draf</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tanggal Terbit</dt>
                    <dd class="mt-1 text-sm text-gray-600">{{ $post->published_at?->format('d F Y H:i') ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Dibuat</dt>
                    <dd class="mt-1 text-sm text-gray-600">{{ $post->created_at->format('d F Y H:i') }}</dd>
                </div>
            </dl>
        </div>
        <div class="mt-6 flex items-center gap-4">
            <a href="{{ route('admin.posts.edit', $post->id) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">Edit</a>
            <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}" onsubmit="return confirm('Hapus postingan ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-500">Hapus</button>
            </form>
            <a href="{{ route('admin.posts.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">&larr; Kembali</a>
        </div>
    </div>
@endsection
