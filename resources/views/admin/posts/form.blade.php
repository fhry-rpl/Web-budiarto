@extends('layouts.admin')

@section('title', isset($post) ? 'Edit Postingan' : 'Tambah Postingan')

@section('content')
    <form method="POST" action="{{ isset($post) ? route('admin.posts.update', $post->id) : route('admin.posts.store') }}" enctype="multipart/form-data" class="max-w-3xl">
        @csrf
        @if (isset($post)) @method('PUT') @endif
        <div class="card p-8 space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-dark-muted">Judul <span class="text-error-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? '') }}" required maxlength="255" class="mt-1 block w-full rounded-lg border border-border dark:border-dark-border bg-white dark:bg-dark-surface px-4 py-2.5 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20 @error('title') border-error-500 @enderror">
                @error('title') <p class="mt-1 text-xs text-error-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-dark-muted">Slug <span class="text-error-500">*</span></label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $post->slug ?? '') }}" required maxlength="255" class="mt-1 block w-full rounded-lg border border-border dark:border-dark-border bg-white dark:bg-dark-surface px-4 py-2.5 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20 @error('slug') border-error-500 @enderror">
                @error('slug') <p class="mt-1 text-xs text-error-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-dark-muted">Kategori</label>
                <select id="category_id" name="category_id" class="mt-1 block w-full rounded-lg border border-border dark:border-dark-border bg-white dark:bg-dark-surface px-4 py-2.5 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20">
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-dark-muted">Ringkasan</label>
                <textarea id="excerpt" name="excerpt" rows="3" maxlength="500" class="mt-1 block w-full rounded-lg border border-border dark:border-dark-border bg-white dark:bg-dark-surface px-4 py-2.5 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
            </div>
            <div>
                <label for="body" class="block text-sm font-medium text-gray-700 dark:text-dark-muted">Konten <span class="text-error-500">*</span></label>
                <textarea id="body" name="body" rows="15" class="mt-1 block w-full rounded-lg border border-border dark:border-dark-border bg-white dark:bg-dark-surface px-4 py-2.5 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20 @error('body') border-error-500 @enderror">{{ old('body', $post->body ?? '') }}</textarea>
                @error('body') <p class="mt-1 text-xs text-error-600">{{ $message }}</p> @enderror
            </div>
            <div data-file-size="thumbnailSize">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 dark:text-dark-muted">Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/webp" >
                <p id="thumbnailSize" class="hidden" class="mt-1 text-xs text-error-600">Ukuran thumbnail tidak boleh lebih dari 2 MB.</p>
                @if (isset($post) && $post->thumbnail)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="h-32 w-auto rounded-lg border object-cover">
                        <p class="mt-1 text-xs text-gray-500 dark:text-dark-muted">Kosongkan jika tidak ingin mengubah.</p>
                    </div>
                @endif
            </div>
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }} class="checkbox">
                    <span class="text-sm text-gray-700 dark:text-dark-muted">Terbitkan</span>
                </label>
            </div>
            <div class="flex items-center gap-4 pt-4 border-t border-border dark:border-dark-border">
                <button type="submit" class="btn-primary btn-md">{{ isset($post) ? 'Perbarui' : 'Simpan' }}</button>
                <a href="{{ route('admin.posts.index') }}" class="btn-ghost btn-md">Batal</a>
            </div>
        </div>
    </form>
@endsection
