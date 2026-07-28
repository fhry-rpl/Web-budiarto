# Vercel Deployment Checklist

## Status: Siap Deploy ✅

---

## 1. Fix yang Sudah Dilakukan

| # | Perbaikan | File |
|---|-----------|------|
| 1 | Runtime `vercel-php@0.7.5` → `0.9.0` (tidak pernah dipublikasikan) | `vercel.json:4` |
| 2 | Load `vendor/autoload.php` **sebelum** `class_exists()` agar Dotenv terbaca | `api/index.php:4` |
| 3 | `APP_KEY` dihapus dari `.env.vercel` — hanya via Dashboard agar tidak overwrite | `.env.vercel` |
| 4 | `SESSION_SECURE_COOKIE` ditambah default `true` | `config/session.php:172` |
| 5 | `bootstrap/cache/*.php` dibersihkan (akan di-generate ulang via `post-install-cmd`) | `bootstrap/cache/` |
| 6 | `.env.vercel` ditambah `APP_NAME`, `APP_URL`, `APP_LOCALE`, `APP_TIMEZONE`, dll | `.env.vercel` |
| 7 | `.env.production` — `ASSET_URL` pakai `${APP_URL}` (dinamis), cleanup komentar | `.env.production` |

---

## 2. Critical Issues (Harus Diperhatikan)

### a. Dotenv loading di `api/index.php`
**Sebelum:**
```php
if (class_exists(\Dotenv\Dotenv::class) && ...) {  // autoloader belum di-load!
```

**Sesudah (fixed):**
```php
require __DIR__ . '/../vendor/autoload.php';
if (class_exists(\Dotenv\Dotenv::class) && ...) {  // autoloader sudah ready
```

### b. `APP_KEY` harus di Vercel Dashboard
`config:cache` jalan saat build — `.env.vercel` belum diload. Jika `APP_KEY` tidak di Dashboard:
- Cached config punya `'key' => null`
- Runtime error: *"No application encryption key has been specified"*

### c. `config:cache` bake env saat build
Semua `env()` di-resolve **sekali** saat build. Ganti env di Dashboard setelah deploy **tidak akan生效 tanpa rebuild**.

---

## 3. Checklist Environment Variables (Vercel Dashboard)

### Wajib di Dashboard

| Variable | Contoh Value | Alasan |
|----------|-------------|--------|
| `APP_KEY` | `base64:xxx...` | Encryption, session signing |
| `APP_URL` | `https://laravel-web.vercel.app` | Route & URL generation |
| `DB_URL` | `postgresql://user:pass@ep-xxx.region.aws.neon.tech/neondb?sslmode=require` | Koneksi PostgreSQL |
| `MIGRATE_SECRET` | `a1b2c3d4e5f6...` | Auth endpoint `/__migrate/` |

### Opsional (sudah ada default)

| Variable | Default di `.env.vercel` | Keterangan |
|----------|--------------------------|------------|
| `DB_CONNECTION` | `pgsql` | |
| `SESSION_DRIVER` | `cookie` | |
| `SESSION_SECURE_COOKIE` | `true` | Default di config now |
| `CACHE_STORE` | `array` | |
| `QUEUE_CONNECTION` | `sync` | |
| `LOG_CHANNEL` | `stderr` | |
| `LOG_LEVEL` | `warning` | |

---

## 4. Langkah Deploy

### Via Git (Rekomendasi)

```bash
# 1. Commit semua perubahan
git add .
git commit -m "fix: perbaiki vercel.json runtime & env config untuk deploy"

# 2. Push ke GitHub
git push origin main

# 3. Deploy otomatis via Vercel (terhubung ke GitHub repo)
```

### Atau via Vercel CLI

```bash
vercel login
vercel --prod
```

---

## 5. Verifikasi Post-Deploy

| Cek | URL | Response |
|-----|-----|----------|
| Ping | `https://<project>.vercel.app/__ping` | `pong` |
| Env | `https://<project>.vercel.app/__env` | Daftar env vars |
| Home | `https://<project>.vercel.app/` | Halaman utama |
| Migrasi | `https://<project>.vercel.app/__migrate/<MIGRATE_SECRET>` | Migration + seeding log |

---

## 6. Troubleshooting

### Error 500 — No application encryption key has been specified
**Penyebab:** `APP_KEY` tidak diset di Dashboard.
**Solusi:** Generate key & set di Vercel Environment Variables.

### Halaman Kosong / 404
**Penyebab:** Route cache bermasalah.
**Solusi:**
```bash
git rm -r bootstrap/cache/*.php
git commit -m "fix: hapus cache"
git push
```

### Database Error — Table not found
**Penyebab:** Migration belum dijalankan.
**Solusi:** Akses `https://<project>.vercel.app/__migrate/<MIGRATE_SECRET>`

### Session / Login Tidak Berfungsi
**Penyebab:** `SESSION_DRIVER` tidak sesuai.
**Solusi:** Pastikan `SESSION_DRIVER=cookie` di Vercel Dashboard.

---

## 7. Deployment Diagram

```
Git Push → Vercel Build
  ├── npm install (installCommand)
  ├── npm run build (buildCommand) → Vite build frontend
  └── composer install --no-dev (vercel-php)
       └── post-install-cmd:
           ├── package:discover
           ├── config:cache ✓  (bake env dari Dashboard)
           ├── route:cache ✓
           └── view:cache ✓
            │
            ▼
Serverless Function (api/index.php)
  ├── require vendor/autoload.php ✓
  ├── load .env.vercel  ✓  (safe defaults)
  └── Laravel bootstrap → serve request
```
