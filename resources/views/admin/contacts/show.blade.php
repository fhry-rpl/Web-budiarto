@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
    <div class="max-w-3xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <dl class="space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $submission->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $submission->email }}</dd>
                </div>
                @if ($submission->phone)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Telepon</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $submission->phone }}</dd>
                    </div>
                @endif
                <div>
                    <dt class="text-sm font-medium text-gray-500">Subjek</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $submission->subject }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Pesan</dt>
                    <dd class="mt-1 text-sm text-gray-700 whitespace-pre-wrap">{{ $submission->message }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Dikirim</dt>
                    <dd class="mt-1 text-sm text-gray-600">{{ $submission->created_at->format('d F Y H:i') }}</dd>
                </div>
            </dl>
        </div>
        <div class="mt-6">
            <a href="{{ route('admin.contacts.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-500">&larr; Kembali</a>
        </div>
    </div>
@endsection
