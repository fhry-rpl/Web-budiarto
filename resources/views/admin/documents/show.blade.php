@extends('layouts.admin')

@section('title', $document->title)

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Judul</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $document->title }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Slug</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $document->slug }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $document->category?->name ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                    <dd class="mt-1 text-sm text-gray-700">{{ $document->description ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tipe File</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $document->file_type ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Ukuran File</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $document->file_size ? round($document->file_size / 1024, 2) . ' KB' : '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
                        @if ($document->is_published)
                            <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700">Terbit</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-yellow-50 px-2 py-0.5 text-xs font-medium text-yellow-700">Draf</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tanggal Terbit</dt>
                    <dd class="mt-1 text-sm text-gray-600">{{ $document->published_at?->format('d F Y H:i') ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Diunduh</dt>
                    <dd class="mt-1 text-sm text-gray-600">{{ $document->download_count }} kali</dd>
                </div>
            </dl>
        </div>
        <div class="mt-6 flex items-center gap-4">
            <a href="{{ route('admin.documents.edit', $document->id) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">Edit</a>
            <form method="POST" action="{{ route('admin.documents.destroy', $document->id) }}" onsubmit="return confirm('Hapus dokumen ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-500">Hapus</button>
            </form>
            <a href="{{ route('admin.documents.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">&larr; Kembali</a>
        </div>
    </div>
@endsection
