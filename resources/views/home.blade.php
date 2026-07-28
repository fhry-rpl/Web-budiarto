@extends('layouts.front')

@section('title', config('app.name'))
@section('meta_description', 'Website resmi RENPRO UPBU Budiarto - Rencana Program dan Pengembangan Bandar Udara Budiarto')
@section('og_title', config('app.name'))
@section('og_description', 'Website resmi RENPRO UPBU Budiarto - Rencana Program dan Pengembangan Bandar Udara Budiarto')
@section('og_url', url('/'))
@section('twitter_title', config('app.name'))
@section('twitter_description', 'Website resmi RENPRO UPBU Budiarto - Rencana Program dan Pengembangan Bandar Udara Budiarto')

@section('content')
    {{-- =============== SECTION 1: HERO =============== --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMiIvPjwvZz48L2c+PC9zdmc+')] opacity-30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-white/5 via-transparent to-transparent"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-32 sm:px-6 lg:px-8 lg:py-44" data-scroll-reveal>
            <div class="max-w-3xl reveal">
                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 backdrop-blur-sm px-4 py-1.5 text-sm font-medium text-white/90 border border-white/20 mb-8">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent-400 animate-pulse"></span>
                    UPBU Budiarto — Bandar Udara
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white font-heading leading-[1.1]">
                    Rencana Program &<br>
                    <span class="text-primary-200">Pengembangan</span>
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-white/80 max-w-2xl leading-relaxed">
                    Mewujudkan Bandar Udara Budiarto sebagai bandara yang modern, aman, nyaman, dan berkelanjutan melalui perencanaan program yang terintegrasi dan inovatif.
                </p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('profile.page', 'visi-misi') }}" class="btn-primary btn-lg shadow-lg shadow-primary-600/25">
                        Visi & Misi
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('services.index') }}" class="inline-flex items-center rounded-xl border border-white/30 bg-white/10 px-6 py-3 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/20">
                        Lihat Layanan
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-surface dark:from-dark-bg"></div>
    </section>

    {{-- =============== SECTION 2: LAYANAN =============== --}}
    @if ($services->isNotEmpty())
        <section class="py-20 sm:py-28" data-scroll-reveal>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl mx-auto text-center reveal">
                    <span class="inline-flex items-center rounded-full bg-primary-50 dark:bg-primary-900/30 px-3 py-1 text-sm font-medium text-primary-700 dark:text-primary-300">Layanan</span>
                    <h2 class="mt-4 text-3xl sm:text-4xl font-bold text-gray-900 dark:text-dark-text font-heading">Layanan Kami</h2>
                    <p class="mt-3 text-lg text-gray-600 dark:text-dark-muted">Berbagai layanan tersedia untuk memenuhi kebutuhan pengguna jasa Bandar Udara Budiarto.</p>
                </div>
                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 reveal">
                    @foreach ($services as $service)
                        <a href="{{ route('services.show', $service->slug) }}" class="group card card-hover p-6">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-300 group-hover:bg-primary-600 group-hover:text-white transition-all duration-200">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-dark-text font-heading group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">{{ $service->title }}</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-dark-muted line-clamp-2 leading-relaxed">{{ $service->description }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- =============== SECTION 3: BERITA =============== --}}
    @if ($latestPosts->isNotEmpty())
        <section class="bg-surface-alt dark:bg-dark-surface-alt py-20 sm:py-28" data-scroll-reveal>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 reveal">
                    <div class="max-w-xl">
                        <span class="inline-flex items-center rounded-full bg-primary-50 dark:bg-primary-900/30 px-3 py-1 text-sm font-medium text-primary-700 dark:text-primary-300">Berita</span>
                        <h2 class="mt-4 text-3xl sm:text-4xl font-bold text-gray-900 dark:text-dark-text font-heading">Berita Terbaru</h2>
                        <p class="mt-3 text-lg text-gray-600 dark:text-dark-muted">Informasi terkini seputar Bandar Udara Budiarto.</p>
                    </div>
                    <a href="{{ route('posts.index') }}" class="btn-outline btn-md shrink-0">
                        Lihat Semua
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 reveal">
                    @foreach ($latestPosts as $post)
                        <article class="group card overflow-hidden">
                            <a href="{{ route('posts.show', $post->slug )}}">
                                @if ($post->thumbnail)
                                    <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="h-48 w-full object-cover" loading="lazy">
                                @else
                                    <div class="h-48 w-full bg-gradient-to-br from-primary-100 dark:from-primary-900/50 to-primary-50 dark:to-primary-950/30 flex items-center justify-center">
                                        <svg class="h-12 w-12 text-primary-300 dark:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                    </div>
                                @endif
                            </a>
                            <div class="p-5">
                                <div class="flex items-center gap-2">
                                    @if ($post->category)
                                        <span class="text-xs font-medium text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/30 px-2 py-0.5 rounded-full">{{ $post->category->name }}</span>
                                    @endif
                                    <span class="text-xs text-gray-400 dark:text-dark-muted">{{ $post->published_at?->format('d F Y') ?? '' }}</span>
                                </div>
                                <h3 class="mt-2 text-lg font-semibold text-gray-900 dark:text-dark-text font-heading group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">
                                    <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                </h3>
                                @if ($post->excerpt)
                                    <p class="mt-2 text-sm text-gray-600 dark:text-dark-muted line-clamp-2 leading-relaxed">{{ $post->excerpt }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- =============== SECTION 4: PENGUMUMAN =============== --}}
    @if (!empty($pengumuman))
        <section class="py-20 sm:py-28" data-scroll-reveal>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 reveal">
                    <div class="max-w-xl">
                        <span class="inline-flex items-center rounded-full bg-accent-50 dark:bg-accent-900/30 px-3 py-1 text-sm font-medium text-accent-700 dark:text-accent-300">Pengumuman</span>
                        <h2 class="mt-4 text-3xl sm:text-4xl font-bold text-gray-900 dark:text-dark-text font-heading">Pengumuman</h2>
                        <p class="mt-3 text-lg text-gray-600 dark:text-dark-muted">Informasi resmi dan pengumuman penting dari UPBU Budiarto.</p>
                    </div>
                    <a href="{{ route('pengumuman.index') }}" class="btn-outline btn-md shrink-0">
                        Lihat Semua
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="mt-10 space-y-3 reveal">
                    @foreach ($pengumuman as $item)
                        <a href="{{ route('posts.show', $item->slug) }}" class="group flex items-start gap-4 p-5 rounded-xl border border-border dark:border-dark-border bg-white dark:bg-dark-surface hover:border-accent-300 dark:hover:border-accent-600/50 hover:shadow-card-hover transition-all">
                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-accent-50 dark:bg-accent-900/30 text-accent-600 dark:text-accent-400 shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38a.5.5 0 01-.555-.029 7.523 7.523 0 01-2.09-3.02m0 0c-.256-.532-.5-1.076-.727-1.63m0 0c-.204.013-.408.02-.612.02h-.75a4.5 4.5 0 01-2.652-.848m10.899 0c.487.024.98.037 1.474.037 1.223 0 2.412-.136 3.548-.39 2.2-.492 3.69-2.294 3.69-4.29 0-2.09-1.483-3.926-3.69-4.424l-.492-.122m-5.53-4.133v.007m0 0c-.076.005-.15.013-.226.02m.226-.027c.512-.074 1.034-.116 1.565-.116h.029m0 0V4.545c0-.514.236-1 .64-1.31l.18-.137c.733-.56 1.656-.51 2.329.124l.27.254c.415.39.676.9.676 1.444v.006"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs text-accent-600 dark:text-accent-400 font-medium">{{ $item->published_at?->format('d F Y') ?? '' }}</span>
                                    @if ($item->category)
                                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-accent-50 dark:bg-accent-900/30 text-accent-600 dark:text-accent-400 font-medium">{{ $item->category->name }}</span>
                                    @endif
                                </div>
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-dark-text group-hover:text-accent-600 dark:group-hover:text-accent-400 transition">{{ $item->title }}</h3>
                                @if ($item->excerpt)
                                    <p class="mt-1 text-xs text-gray-500 dark:text-dark-muted line-clamp-1">{{ $item->excerpt }}</p>
                                @endif
                            </div>
                            <svg class="w-5 h-5 text-gray-300 dark:text-dark-muted group-hover:text-accent-500 transition-colors shrink-0 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- =============== SECTION 5: GALERI =============== --}}
    @if ($latestGalleries->isNotEmpty())
        <section class="bg-surface-alt dark:bg-dark-surface-alt py-20 sm:py-28" data-scroll-reveal>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 reveal">
                    <div class="max-w-xl">
                        <span class="inline-flex items-center rounded-full bg-primary-50 dark:bg-primary-900/30 px-3 py-1 text-sm font-medium text-primary-700 dark:text-primary-300">Galeri</span>
                        <h2 class="mt-4 text-3xl sm:text-4xl font-bold text-gray-900 dark:text-dark-text font-heading">Dokumentasi Kegiatan</h2>
                        <p class="mt-3 text-lg text-gray-600 dark:text-dark-muted">Foto dan dokumentasi kegiatan di lingkungan Bandar Udara Budiarto.</p>
                    </div>
                    <a href="{{ route('galleries.index') }}" class="btn-outline btn-md shrink-0">
                        Lihat Semua
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 reveal">
                    @foreach ($latestGalleries as $gallery)
                        <a href="{{ route('galleries.show', $gallery->id) }}" class="group relative aspect-[4/3] rounded-xl overflow-hidden bg-primary-50 dark:bg-primary-900/30">
                            @if ($gallery->images->isNotEmpty())
                                <img src="{{ Storage::url($gallery->images->first()->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105" loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-primary-300 dark:text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                                <h3 class="text-sm font-semibold text-white">{{ $gallery->title }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- =============== SECTION 6: KONTAK =============== --}}
    <section class="bg-primary-800 py-20" data-scroll-reveal>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center reveal">
                <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-sm font-medium text-white/80 border border-white/10">Kontak</span>
                <h2 class="mt-4 text-3xl sm:text-4xl font-bold text-white font-heading">Hubungi Kami</h2>
                <p class="mt-3 text-lg text-white/60">Silakan hubungi kami melalui kontak di bawah ini untuk informasi lebih lanjut.</p>
            </div>
            <div class="mt-12 grid gap-8 sm:grid-cols-3 reveal">
                <div class="text-center">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-xl bg-white/10 text-accent-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-white/50 uppercase tracking-wider mb-2">Alamat</h3>
                    <p class="text-base text-white/80">{{ $settings['address'] ?? 'Jl. Budiarto No.1, Curug, Tangerang' }}</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-xl bg-white/10 text-accent-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-white/50 uppercase tracking-wider mb-2">Telepon</h3>
                    <p class="text-base text-white/80">{{ $settings['phone'] ?? '(021) 1234-5678' }}</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-xl bg-white/10 text-accent-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-white/50 uppercase tracking-wider mb-2">Email</h3>
                    <p class="text-base text-white/80">{{ $settings['email'] ?? 'info@budiartoairport.com' }}</p>
                </div>
            </div>
            <div class="mt-12 text-center reveal">
                <a href="{{ route('contact.index') }}" class="btn-accent btn-lg">
                    Hubungi Kami
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
