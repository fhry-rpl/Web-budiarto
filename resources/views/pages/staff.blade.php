@extends('layouts.front')

@section('title', 'Struktur Organisasi — ' . config('app.name'))

@section('content')
    <section class="bg-surface-alt dark:bg-dark-surface-alt py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <span class="inline-flex items-center rounded-full bg-primary-50 dark:bg-primary-900/30 px-3 py-1 text-sm font-medium text-primary-700 dark:text-primary-300">Profil</span>
                <h1 class="mt-4 text-3xl font-bold text-gray-900 dark:text-dark-text font-heading sm:text-4xl">Struktur Organisasi</h1>
                <p class="mt-3 text-lg text-gray-600 dark:text-dark-muted">Susunan organisasi RENPRO UPBU Budiarto</p>
            </div>
            @if ($staff->isEmpty())
                <div class="mt-12 text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-300 dark:text-dark-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <p class="mt-4 text-gray-500 dark:text-dark-muted">Belum ada data staf.</p>
                </div>
            @else
                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($staff as $member)
                        <div class="card p-6 text-center hover:shadow-card-hover transition">
                            @if ($member->photo)
                                <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" class="mx-auto h-24 w-24 rounded-full object-cover ring-4 ring-primary-50 dark:ring-primary-900/30" loading="lazy">
                            @else
                                <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-primary-50 dark:bg-primary-900/30 text-2xl font-bold text-primary-600 dark:text-primary-300 ring-4 ring-primary-50 dark:ring-primary-900/30">
                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                </div>
                            @endif
                            <h2 class="mt-4 text-lg font-semibold text-gray-900 dark:text-dark-text font-heading">{{ $member->name }}</h2>
                            <p class="text-sm font-medium text-primary-600 dark:text-primary-400">{{ $member->position }}</p>
                            @if ($member->bio)
                                <p class="mt-2 text-xs text-gray-500 dark:text-dark-muted">{{ $member->bio }}</p>
                            @endif
                            @if ($member->instagram || $member->whatsapp || $member->facebook)
                                <div class="mt-3 flex items-center justify-center gap-3">
                                    @if ($member->instagram)
                                        <a href="https://instagram.com/{{ str_replace('@', '', $member->instagram) }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-pink-500 transition-colors" title="Instagram">
                                            <i data-lucide="instagram" class="h-4 w-4"></i>
                                        </a>
                                    @endif
                                    @if ($member->whatsapp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->whatsapp) }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-green-500 transition-colors" title="WhatsApp">
                                            <i data-lucide="message-circle" class="h-4 w-4"></i>
                                        </a>
                                    @endif
                                    @if ($member->facebook)
                                        <a href="{{ $member->facebook }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-blue-600 transition-colors" title="Facebook">
                                            <i data-lucide="facebook" class="h-4 w-4"></i>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
