@extends('layouts.admin')

@section('title', isset($service) ? 'Edit Layanan' : 'Tambah Layanan')

@section('content')
    <form method="POST" action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}" class="max-w-3xl">
        @csrf
        @if (isset($service)) @method('PUT') @endif
        <div class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $service->title ?? '') }}" required maxlength="255" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror">
                @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug <span class="text-red-500">*</span></label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $service->slug ?? '') }}" required maxlength="255" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('slug') border-red-500 @enderror">
                @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700">Ikon</label>
                <input type="text" id="icon" name="icon" value="{{ old('icon', $service->icon ?? '') }}" maxlength="100" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="5" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $service->description ?? '') }}</textarea>
                @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="procedure" class="block text-sm font-medium text-gray-700">Prosedur</label>
                <textarea id="procedure" name="procedure" rows="5" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('procedure', $service->procedure ?? '') }}</textarea>
            </div>
            <div>
                <label for="requirements" class="block text-sm font-medium text-gray-700">Persyaratan</label>
                <textarea id="requirements" name="requirements" rows="5" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('requirements', $service->requirements ?? '') }}</textarea>
            </div>
            <div>
                <label for="contact_info" class="block text-sm font-medium text-gray-700">Info Kontak</label>
                <input type="text" id="contact_info" name="contact_info" value="{{ old('contact_info', $service->contact_info ?? '') }}" maxlength="500" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700">Urutan</label>
                <input type="number" id="order" name="order" value="{{ old('order', $service->order ?? '') }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="text-sm text-gray-700">Aktif</span>
                </label>
            </div>
            <div class="flex items-center gap-4">
                <button type="submit" class="rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-500">{{ isset($service) ? 'Perbarui' : 'Simpan' }}</button>
                <a href="{{ route('admin.services.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">Batal</a>
            </div>
        </div>
    </form>
@endsection
