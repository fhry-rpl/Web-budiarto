@extends('layouts.admin')

@section('title', 'Menu Navigasi')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-600">Total: {{ $menus->count() }} menu utama</p>
        <a href="{{ route('admin.menus.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">Tambah Menu</a>
    </div>
    @if ($menus->isEmpty())
        <p class="text-gray-500">Belum ada menu. <a href="{{ route('admin.menus.create') }}" class="text-indigo-600 hover:underline">Buat menu baru</a></p>
    @else
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white">
            <table class="min-w-full divide-y divide-gray-200" id="menu-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Label</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Route</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Ikon</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Aktif</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 sortable" data-reorder-url="{{ route('admin.menus.reorder') }}">
                    @foreach ($menus as $menu)
                        <tr data-id="{{ $menu->id }}" class="hover:bg-gray-50 cursor-grab active:cursor-grabbing">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                <div class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-gray-400 shrink-0 handle" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                                    <span>{{ $menu->label }}</span>
                                </div>
                                @if ($menu->children->isNotEmpty())
                                    <div class="ml-6 mt-2 space-y-1">
                                        @foreach ($menu->children as $child)
                                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                                <svg class="h-3 w-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                <span>{{ $child->label }}</span>
                                                <span class="text-xs text-gray-400">({{ $child->route ?? '-' }})</span>
                                                @if (!$child->is_active)
                                                    <span class="text-xs text-red-400">nonaktif</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 hidden sm:table-cell">{{ $menu->route ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 hidden sm:table-cell">{{ $menu->icon ?? '-' }}</td>
                            <td class="px-6 py-4 text-center hidden sm:table-cell">
                                @if ($menu->is_active)
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Ya</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-700">Tidak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right text-sm">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}" class="font-medium text-indigo-600 hover:text-indigo-500">Edit</a>
                                <form method="POST" action="{{ route('admin.menus.destroy', $menu->id) }}" class="inline ml-2" onsubmit="return confirm('Hapus menu ini beserta semua sub-menu-nya?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:text-red-500">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('menu-table');
    if (!table) return;

    let dragRow = null;

    table.querySelectorAll('.handle').forEach(handle => {
        handle.addEventListener('mousedown', function(e) {
            dragRow = this.closest('tr');
            document.addEventListener('mousemove', onDrag);
            document.addEventListener('mouseup', onDrop);
        });
    });

    function onDrag(e) {
        if (!dragRow) return;
        const rows = [...dragRow.parentElement.querySelectorAll('tr')];
        const target = document.elementFromPoint(e.clientX, e.clientY)?.closest('tr');
        if (target && target !== dragRow) {
            const rect = target.getBoundingClientRect();
            const mid = rect.top + rect.height / 2;
            if (e.clientY < mid) {
                target.parentElement.insertBefore(dragRow, target);
            } else {
                target.parentElement.insertBefore(dragRow, target.nextElementSibling);
            }
        }
    }

    async function onDrop() {
        document.removeEventListener('mousemove', onDrag);
        document.removeEventListener('mouseup', onDrop);
        if (!dragRow) return;
        dragRow = null;

        const rows = [...document.querySelectorAll('#menu-table tbody tr')];
        const items = rows.map((row, index) => ({
            id: parseInt(row.dataset.id),
            order: index,
            parent_id: null,
        }));

        const url = document.querySelector('.sortable')?.dataset.reorderUrl;
        if (!url) return;

        try {
            await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ items }),
            });
        } catch {}
    }
});
</script>
@endpush
