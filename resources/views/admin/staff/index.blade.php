@extends('layouts.admin')

@section('title', 'Staf')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-600">Total: {{ $staff->count() }} staf</p>
        <a href="{{ route('admin.staff.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">Tambah Staf</a>
    </div>
    @if ($staff->isEmpty())
        <p class="text-gray-500">Belum ada staf.</p>
    @else
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Urutan</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($staff as $member)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $member->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 hidden sm:table-cell">{{ $member->position }}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell">{{ $member->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 hidden sm:table-cell">{{ $member->order ?? '-' }}</td>
                            <td class="px-6 py-4 text-right text-sm">
                                <a href="{{ route('admin.staff.edit', $member->id) }}" class="font-medium text-indigo-600 hover:text-indigo-500">Edit</a>
                                <form method="POST" action="{{ route('admin.staff.destroy', $member->id) }}" class="inline ml-2" onsubmit="return confirm('Hapus staf ini?')">
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
