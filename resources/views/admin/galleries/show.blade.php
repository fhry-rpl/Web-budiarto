@extends('layouts.admin')

@section('title', $gallery->title)

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Judul</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $gallery->title }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                    <dd class="mt-1 text-sm text-gray-700">{{ $gallery->description ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Jumlah Foto</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $gallery->images->count() }} foto</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
                        @if ($gallery->is_published)
                            <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700">Terbit</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-yellow-50 px-2 py-0.5 text-xs font-medium text-yellow-700">Draf</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tanggal Terbit</dt>
                    <dd class="mt-1 text-sm text-gray-600">{{ $gallery->published_at?->format('d F Y H:i') ?? '-' }}</dd>
                </div>
            </dl>
            @if ($gallery->images->isNotEmpty())
                <div class="mt-6 border-t border-gray-200 pt-6">
                    <dt class="text-sm font-medium text-gray-500 mb-3">Foto</dt>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach ($gallery->images as $image)
                            <div class="aspect-square rounded-lg overflow-hidden bg-gray-100">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <div class="mt-6 flex items-center gap-4">
            <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">Edit</a>
            <form method="POST" action="{{ route('admin.galleries.destroy', $gallery->id) }}" onsubmit="return confirm('Hapus galeri ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-500">Hapus</button>
            </form>
            <a href="{{ route('admin.galleries.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">&larr; Kembali</a>
        </div>
    </div>
@endsection
