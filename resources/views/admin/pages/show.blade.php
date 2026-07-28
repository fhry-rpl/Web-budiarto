@extends('layouts.admin')

@section('title', $page->title)

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Judul</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $page->title }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Slug</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $page->slug }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Konten</dt>
                    <dd class="mt-1 text-sm text-gray-700 whitespace-pre-wrap">{{ $page->body ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
                        @if ($page->is_published)
                            <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700">Terbit</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-yellow-50 px-2 py-0.5 text-xs font-medium text-yellow-700">Draf</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Dibuat</dt>
                    <dd class="mt-1 text-sm text-gray-600">{{ $page->created_at->format('d F Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Diperbarui</dt>
                    <dd class="mt-1 text-sm text-gray-600">{{ $page->updated_at->format('d F Y H:i') }}</dd>
                </div>
            </dl>
        </div>
        <div class="mt-6 flex items-center gap-4">
            <a href="{{ route('admin.pages.edit', $page->id) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">Edit</a>
            <form method="POST" action="{{ route('admin.pages.destroy', $page->id) }}" onsubmit="return confirm('Hapus halaman ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-500">Hapus</button>
            </form>
            <a href="{{ route('admin.pages.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">&larr; Kembali</a>
        </div>
    </div>
@endsection
