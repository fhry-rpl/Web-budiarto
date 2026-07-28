@extends('layouts.admin')

@section('title', $service->title)

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Judul</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $service->title }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Slug</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $service->slug }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Ikon</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $service->icon ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                    <dd class="mt-1 text-sm text-gray-700 whitespace-pre-wrap">{{ $service->description }}</dd>
                </div>
                @if ($service->procedure)
                <div>
                    <dt class="text-sm font-medium text-gray-500">Prosedur</dt>
                    <dd class="mt-1 text-sm text-gray-700 whitespace-pre-wrap">{{ $service->procedure }}</dd>
                </div>
                @endif
                @if ($service->requirements)
                <div>
                    <dt class="text-sm font-medium text-gray-500">Persyaratan</dt>
                    <dd class="mt-1 text-sm text-gray-700 whitespace-pre-wrap">{{ $service->requirements }}</dd>
                </div>
                @endif
                @if ($service->contact_info)
                <div>
                    <dt class="text-sm font-medium text-gray-500">Kontak</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $service->contact_info }}</dd>
                </div>
                @endif
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1">
                        @if ($service->is_active)
                            <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700">Aktif</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-red-50 px-2 py-0.5 text-xs font-medium text-red-700">Nonaktif</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Urutan</dt>
                    <dd class="mt-1 text-sm text-gray-600">{{ $service->order ?? '-' }}</dd>
                </div>
            </dl>
        </div>
        <div class="mt-6 flex items-center gap-4">
            <a href="{{ route('admin.services.edit', $service->id) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">Edit</a>
            <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}" onsubmit="return confirm('Hapus layanan ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-500">Hapus</button>
            </form>
            <a href="{{ route('admin.services.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">&larr; Kembali</a>
        </div>
    </div>
@endsection
