@extends('layouts.admin')

@section('title', isset($staff) ? 'Edit Staf' : 'Tambah Staf')

@section('content')
    <form method="POST" action="{{ isset($staff) ? route('admin.staff.update', $staff->id) : route('admin.staff.store') }}" enctype="multipart/form-data" class="max-w-xl">
        @csrf
        @if (isset($staff)) @method('PUT') @endif
        <div class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $staff->name ?? '') }}" required maxlength="255" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="position" class="block text-sm font-medium text-gray-700">Jabatan <span class="text-red-500">*</span></label>
                <input type="text" id="position" name="position" value="{{ old('position', $staff->position ?? '') }}" required maxlength="255" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('position') border-red-500 @enderror">
                @error('position') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div data-file-size="photoSize">
                <label for="photo" class="block text-sm font-medium text-gray-700">Foto</label>
                <input type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/webp" >
                <p id="photoSize" class="hidden" class="mt-1 text-xs text-red-600">Ukuran foto tidak boleh lebih dari 2 MB.</p>
            </div>
            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea id="bio" name="bio" rows="3" maxlength="1000" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('bio', $staff->bio ?? '') }}</textarea>
            </div>
            <div>
                <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                <input type="text" id="instagram" name="instagram" value="{{ old('instagram', $staff->instagram ?? '') }}" maxlength="255" placeholder="@username" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('instagram') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="whatsapp" class="block text-sm font-medium text-gray-700">WhatsApp</label>
                <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $staff->whatsapp ?? '') }}" maxlength="255" placeholder="08xxxxxxxxxx" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('whatsapp') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
                <input type="text" id="facebook" name="facebook" value="{{ old('facebook', $staff->facebook ?? '') }}" maxlength="255" placeholder="URL profil Facebook" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('facebook') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700">Urutan</label>
                <input type="number" id="order" name="order" value="{{ old('order', $staff->order ?? '') }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $staff->is_active ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="text-sm text-gray-700">Aktif</span>
                </label>
            </div>
            <div class="flex items-center gap-4">
                <button type="submit" class="rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-500">{{ isset($staff) ? 'Perbarui' : 'Simpan' }}</button>
                <a href="{{ route('admin.staff.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">Batal</a>
            </div>
        </div>
    </form>
@endsection
