@extends('layouts.admin')

@section('title', 'Dokumen')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-600">Total: {{ $documents->total() }} dokumen</p>
        <a href="{{ route('admin.documents.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500">Unggah Dokumen</a>
    </div>
    @if ($documents->isEmpty())
        <p class="text-gray-500">Belum ada dokumen.</p>
    @else
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Tanggal</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($documents as $document)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $document->title }}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell">{{ $document->is_published ? 'Terbit' : 'Draf' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 hidden sm:table-cell">{{ $document->published_at?->format('d F Y') ?? '-' }}</td>
                            <td class="px-6 py-4 text-right text-sm">
                                <a href="{{ route('admin.documents.edit', $document->id) }}" class="font-medium text-indigo-600 hover:text-indigo-500">Edit</a>
                                <form method="POST" action="{{ route('admin.documents.destroy', $document->id) }}" class="inline ml-2" onsubmit="return confirm('Hapus dokumen ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:text-red-500">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $documents->links() }}</div>
    @endif
@endsection
