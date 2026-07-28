# Deployment ke Vercel

## Prasyarat
- GitHub repository
- Vercel account (terhubung ke GitHub)
- Neon PostgreSQL database (atau PostgreSQL provider lain)

## Setup Environment Variables

Buka **Vercel Dashboard → Project → Settings → Environment Variables**, tambahkan:

| Variable | Contoh Value | Keterangan |
|----------|-------------|------------|
| `APP_KEY` | `base64:...` | Generate dengan `php artisan key:generate --show` |
| `APP_ENV` | `production` | |
| `APP_DEBUG` | `false` | |
| `APP_URL` | `https://app.vercel.app` | |
| `DB_CONNECTION` | `pgsql` | |
| `DB_URL` | `postgresql://user:pass@host/db?sslmode=require` | Connection string Neon |
| `SESSION_DRIVER` | `cookie` | Cookie-based (no DB hit) |
| `CACHE_STORE` | `array` | In-memory (no DB hit) |
| `LOG_CHANNEL` | `stderr` | Log ke Vercel dashboard |
| `MIGRATE_SECRET` | `random-secret` | Untuk endpoint migrasi |
| `UPLOADS_DISK` | `local` | Ganti ke `s3` jika pakai S3/R2 |

## Arsitektur

```
Git Push → Vercel Build
  ├── vercel-php installs Composer dependencies
  ├── Vercel installs Node dependencies
  └── npm run build (Vite assets → public/build/)

Vercel Runtime (vercel-php@0.7.4 / PHP 8.3)
  └── api/index.php → Laravel bootstrap
       ├── /__ping → health check
       ├── /__migrate/{token} → run migration + seeder
       └── /* → Laravel app
```

> Jangan menambahkan `composer install` ke `installCommand`. Perintah itu
> dijalankan pada image Node Vercel yang tidak menyediakan Composer, sehingga
> deployment akan gagal. Runtime `vercel-php` memasang dependency PHP sendiri.

## Deploy

```bash
git add .
git commit -m "deploy"
git push
```

Atau deploy via Vercel CLI:
```bash
npx vercel --prod
```

## Migrasi Database

Setelah deploy, akses endpoint berikut di browser:
```
https://app.vercel.app/__migrate/{MIGRATE_SECRET}
```

Ini akan menjalankan `php artisan migrate --force` dan `db:seed --force`.

## Storage

Default: `local` (tidak persisten di Vercel — file hilang setelah cold start).

Untuk production, set `UPLOADS_DISK=s3` dan tambahkan env:
- `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`
- `AWS_BUCKET`, `AWS_ENDPOINT` (untuk R2: `https://{id}.r2.cloudflarestorage.com`)
