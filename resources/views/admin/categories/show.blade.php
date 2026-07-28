@extends('layouts.admin')

@section('title', $category->name)

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $category->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Slug</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $category->slug }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tipe</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $category->type }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Urutan</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $category->order ?? '-' }}</dd>
                </div>
            </dl>
        </div>
        <div class="mt-6 flex items-center gap-4">
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">Edit</a>
            <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Hapus kategori ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-500">Hapus</button>
            </form>
            <a href="{{ route('admin.categories.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">&larr; Kembali</a>
        </div>
    </div>
@endsection
