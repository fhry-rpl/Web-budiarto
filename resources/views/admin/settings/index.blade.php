@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" class="max-w-3xl">
        @csrf @method('PUT')
        <div class="space-y-6">
            @php $defaults = [
                'site_name' => 'RENPRO UPBU Budiarto',
                'site_description' => 'Website resmi RENPRO UPBU Budiarto',
                'address' => 'Jl. Budiarto No.1, Curug, Tangerang',
                'email' => 'info@budiartoairport.com',
                'phone' => '(021) 1234-5678',
                'facebook' => '',
                'instagram' => '',
                'youtube' => '',
            ]; @endphp
            @foreach ($defaults as $key => $default)
                @php $value = old("settings.$key", $settings[$key] ?? $default); @endphp
                <div>
                    <label for="{{ $key }}" class="block text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $key) }}</label>
                    @if (in_array($key, ['site_description', 'address']))
                        <textarea id="{{ $key }}" name="settings[{{ $key }}]" rows="3" maxlength="5000" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $value }}</textarea>
                    @else
                        <input type="text" id="{{ $key }}" name="settings[{{ $key }}]" value="{{ $value }}" maxlength="5000" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @endif
                </div>
            @endforeach
            <button type="submit" class="rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-500">Simpan Pengaturan</button>
        </div>
    </form>
@endsection
