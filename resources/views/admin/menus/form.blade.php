@extends('layouts.admin')

@section('title', isset($menu) ? 'Edit Menu' : 'Tambah Menu')

@section('content')
    <form method="POST" action="{{ isset($menu) ? route('admin.menus.update', $menu->id) : route('admin.menus.store') }}" class="max-w-xl">
        @csrf
        @if (isset($menu)) @method('PUT') @endif
        <div class="space-y-6">
            <div>
                <label for="label" class="block text-sm font-medium text-gray-700">Label <span class="text-red-500">*</span></label>
                <input type="text" id="label" name="label" value="{{ old('label', $menu->label ?? '') }}" required maxlength="255" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('label') border-red-500 @enderror">
                @error('label') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="parent_id" class="block text-sm font-medium text-gray-700">Menu Induk</label>
                <select id="parent_id" name="parent_id" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">— Root (Menu Utama) —</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id ?? '') == $parent->id ? 'selected' : '' }}>{{ $parent->label }}</option>
                    @endforeach
                </select>
                @error('parent_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="route" class="block text-sm font-medium text-gray-700">Route</label>
                <select id="route" name="route" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">— Tidak Ada (Parent Menu) —</option>
                    @foreach ($routes as $routeName => $routeLabel)
                        <option value="{{ $routeName }}" {{ old('route', $menu->route ?? '') == $routeName ? 'selected' : '' }}>{{ $routeLabel }} ({{ $routeName }})</option>
                    @endforeach
                </select>
                <p class="mt-1 text-xs text-gray-500">Atau ketik manual jika route tidak ada di daftar.</p>
                <input type="text" name="route_custom" value="{{ old('route_custom', (!isset($routes[old('route', $menu->route ?? '')]) && old('route', $menu->route ?? '')) ? old('route', $menu->route ?? '') : '') }}" placeholder="route.name.custom" class="mt-2 block w-full rounded-lg border border-gray-300 px-4 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('route') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="params" class="block text-sm font-medium text-gray-700">Parameters (JSON)</label>
                <input type="text" id="params" name="params" value="{{ old('params', isset($menu) && $menu->params ? json_encode($menu->params, JSON_UNESCAPED_UNICODE) : '') }}" placeholder='{"page":"sejarah"}' class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('params') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700">Ikon (Lucide)</label>
                <input type="text" id="icon" name="icon" value="{{ old('icon', $menu->icon ?? '') }}" placeholder="home, file-text, image, dll." maxlength="100" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <p class="mt-1 text-xs text-gray-500">Digunakan untuk navigasi mobile (bottom nav). Lihat <a href="https://lucide.dev/icons" target="_blank" class="text-indigo-600 hover:underline">lucide.dev/icons</a></p>
            </div>
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700">Urutan</label>
                <input type="number" id="order" name="order" value="{{ old('order', $menu->order ?? '') }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div class="flex items-center gap-3">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $menu->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                <label for="is_active" class="text-sm font-medium text-gray-700">Aktif</label>
            </div>
            <div class="flex items-center gap-4">
                <button type="submit" class="rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-500">{{ isset($menu) ? 'Perbarui' : 'Simpan' }}</button>
                <a href="{{ route('admin.menus.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">Batal</a>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const routeSelect = document.getElementById('route');
        const routeCustom = document.querySelector('input[name="route_custom"]');

        routeSelect.addEventListener('change', function() {
            if (this.value) {
                routeCustom.value = '';
                routeCustom.disabled = true;
            } else {
                routeCustom.disabled = false;
            }
        });

        routeCustom.addEventListener('input', function() {
            if (this.value) {
                routeSelect.value = '';
            }
        });

        if (routeSelect.value) {
            routeCustom.disabled = true;
        }
    });
    </script>
    @endpush
@endsection
