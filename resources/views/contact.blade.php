@extends('layouts.front')

@section('title', 'Kontak — ' . config('app.name'))

@section('content')
    <section class="bg-surface-alt dark:bg-dark-surface-alt py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-2">
                <div>
                    <span class="inline-flex items-center rounded-full bg-primary-50 dark:bg-primary-900/30 px-3 py-1 text-sm font-medium text-primary-700 dark:text-primary-300">Kontak</span>
                    <h1 class="mt-4 text-3xl font-bold text-gray-900 dark:text-dark-text font-heading sm:text-4xl">Hubungi Kami</h1>
                    <p class="mt-3 text-lg text-gray-600 dark:text-dark-muted">Silakan hubungi kami melalui formulir di samping atau informasi kontak di bawah ini.</p>
                    <div class="mt-8 space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-dark-text">Alamat</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-dark-muted">Jl. Budiarto No.1, Curug, Tangerang, Banten</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-dark-text">Email</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-dark-muted">info@budiartoairport.com</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-dark-text">Telepon</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-dark-muted">(021) 1234-5678</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card p-8">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-dark-text font-heading">Kirim Pesan</h2>
                        <form method="POST" action="{{ route('contact.store') }}" class="mt-6 space-y-5" onsubmit="event.preventDefault(); handleFormSubmit(this)">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-dark-muted">Nama <span class="text-error-500">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="255" class="mt-1 block w-full rounded-lg border border-border dark:border-dark-border bg-white dark:bg-dark-surface px-4 py-2.5 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20 @error('name') border-error-500 @enderror">
                                @error('name') <p class="mt-1 text-xs text-error-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-dark-muted">Email <span class="text-error-500">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required maxlength="255" class="mt-1 block w-full rounded-lg border border-border dark:border-dark-border bg-white dark:bg-dark-surface px-4 py-2.5 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20 @error('email') border-error-500 @enderror">
                                @error('email') <p class="mt-1 text-xs text-error-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-dark-muted">Telepon</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" maxlength="20" class="mt-1 block w-full rounded-lg border border-border dark:border-dark-border bg-white dark:bg-dark-surface px-4 py-2.5 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20 @error('phone') border-error-500 @enderror">
                                @error('phone') <p class="mt-1 text-xs text-error-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-dark-muted">Subjek <span class="text-error-500">*</span></label>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required maxlength="255" class="mt-1 block w-full rounded-lg border border-border dark:border-dark-border bg-white dark:bg-dark-surface px-4 py-2.5 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20 @error('subject') border-error-500 @enderror">
                                @error('subject') <p class="mt-1 text-xs text-error-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-dark-muted">Pesan <span class="text-error-500">*</span></label>
                                <textarea id="message" name="message" rows="5" required maxlength="5000" class="mt-1 block w-full rounded-lg border border-border dark:border-dark-border bg-white dark:bg-dark-surface px-4 py-2.5 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20 @error('message') border-error-500 @enderror">{{ old('message') }}</textarea>
                                @error('message') <p class="mt-1 text-xs text-error-600">{{ $message }}</p> @enderror
                            </div>
                            <button type="submit" data-submit-btn class="btn-primary w-full btn-lg">
                                <span data-submit-text>Kirim Pesan</span>
                                <span data-submit-loading class="hidden items-center gap-2">
                                    <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                    Mengirim...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endSection
