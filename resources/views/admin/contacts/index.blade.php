@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
    @if ($submissions->isEmpty())
        <p class="text-gray-500">Belum ada pesan.</p>
    @else
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subjek</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Pengirim</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Tanggal</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($submissions as $submission)
                        <tr class="{{ $submission->is_read ? '' : 'bg-indigo-50' }}">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $submission->subject }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 hidden sm:table-cell">{{ $submission->name }}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell">{{ $submission->is_read ? 'Dibaca' : 'Baru' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 hidden sm:table-cell">{{ $submission->created_at->format('d F Y H:i') }}</td>
                            <td class="px-6 py-4 text-right text-sm">
                                <a href="{{ route('admin.contacts.show', $submission->id) }}" class="font-medium text-indigo-600 hover:text-indigo-500">Lihat</a>
                                <form method="POST" action="{{ route('admin.contacts.destroy', $submission->id) }}" class="inline ml-2" onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:text-red-500">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $submissions->links() }}</div>
    @endif
@endsection
