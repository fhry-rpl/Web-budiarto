<footer class="bg-primary-950 dark:bg-[#0a0f1a] text-gray-300">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-600 text-sm font-bold text-white shadow-sm">RB</div>
                    <div>
                        <p class="text-sm font-semibold text-white font-heading">RENPRO UPBU Budiarto</p>
                        <p class="text-xs text-gray-400">Bandar Udara Budiarto</p>
                    </div>
                </div>
                <p class="mt-4 text-sm leading-relaxed text-gray-400">Rencana Program dan Pengembangan Bandar Udara Budiarto — mewujudkan bandara yang modern, aman, dan berkelanjutan.</p>
                <div class="mt-4 flex gap-3">
                    <a href="#" class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-800 text-gray-400 hover:bg-primary-700 hover:text-white transition" aria-label="Facebook">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-800 text-gray-400 hover:bg-primary-700 hover:text-white transition" aria-label="Instagram">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="#" class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-800 text-gray-400 hover:bg-primary-700 hover:text-white transition" aria-label="YouTube">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white font-heading">Navigasi</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-white transition">Berita</a></li>
                    <li><a href="{{ route('pengumuman.index') }}" class="text-gray-400 hover:text-white transition">Pengumuman</a></li>
                    <li><a href="{{ route('documents.index') }}" class="text-gray-400 hover:text-white transition">Dokumen</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-gray-400 hover:text-white transition">Layanan</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white font-heading">Profil</h3>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('profile.page', 'sejarah') }}" class="text-gray-400 hover:text-white transition">Sejarah</a></li>
                    <li><a href="{{ route('profile.page', 'visi-misi') }}" class="text-gray-400 hover:text-white transition">Visi & Misi</a></li>
                    <li><a href="{{ route('profile.page', 'tugas-fungsi') }}" class="text-gray-400 hover:text-white transition">Tugas & Fungsi</a></li>
                    <li><a href="{{ route('profile.page', 'struktur-organisasi') }}" class="text-gray-400 hover:text-white transition">Struktur Organisasi</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white font-heading">Kontak</h3>
                <ul class="mt-4 space-y-3 text-sm">
                    <li class="flex items-start gap-3">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-gray-400">Jl. Budiarto No.1, Curug, Tangerang</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="h-4 w-4 shrink-0 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:info@budiartoairport.com" class="text-gray-400 hover:text-white transition">info@budiartoairport.com</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="h-4 w-4 shrink-0 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span class="text-gray-400">(021) 1234-5678</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-10 border-t border-primary-800 pt-8 text-center text-sm">
            <p class="text-gray-400">&copy; {{ date('Y') }} RENPRO UPBU Budiarto. All rights reserved.</p>
        </div>
    </div>
</footer>
