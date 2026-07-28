# Vercel 500 Error - Fix

## Tanggal: 23 Juli 2026

### Masalah
Semua route di production mengembalikan HTTP 500 error.

### Root Cause
1. **APP_KEY tidak tersedia saat runtime** - `.env.vercel` di-gitignore, tidak terdeploy ke Vercel
2. **Environment variables tidak diset** - `vercel.json` hanya punya 4 build vars, tidak termasuk `APP_KEY`, `DB_CONNECTION`, dll
3. **Tidak ada fallback loading** - `api/index.php` tidak load `.env` apapun

### Fix yang Dilakukan

#### 1. `api/index.php`
- Menambahkan fallback loading `.env.vercel` jika `.env` tidak ada
- Menggunakan `safeLoad()` agar tidak overwrite env vars dari Dashboard

#### 2. `vercel.json`
- Runtime: `vercel-php@0.7.4` → `vercel-php@0.9.0`
- Menambahkan env vars: `APP_KEY`, `APP_DEBUG`, `APP_URL`, `DB_CONNECTION`, `SESSION_DRIVER`, `SESSION_SECURE_COOKIE`, `CACHE_STORE`, `LOG_CHANNEL`, `LOG_LEVEL`

### Masih Perlu Diset di Vercel Dashboard
- `DB_URL` - connection string PostgreSQL dari Neon
- `MIGRATE_SECRET` - token untuk migrasi
- `UPLOADS_DISK` - `s3` jika pakai Vercel Blob
