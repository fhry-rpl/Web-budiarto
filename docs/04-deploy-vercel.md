# Deploy ke Vercel

## 1. Push ke GitHub

```bash
git add .
git commit -m "ready deploy vercel"
git remote add origin https://github.com/username/nama-repo.git
git push -u origin main
```

> Ganti `username/nama-repo` dengan repo GitHub kamu.

## 2. Import Project ke Vercel

1. Buka https://vercel.com
2. Klik **Add New** → **Project**
3. Pilih repo GitHub yang tadi di-push
4. **Framework Preset:** pilih **Other**
5. **Root Directory:** biarkan `./`

## 3. Set Environment Variables

Di halaman konfigurasi, buka tab **Environment Variables**, isi semua ini:

| Variable | Isi |
|----------|-----|
| `APP_KEY` | (generate dulu, lihat bawah) |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://namaproject.vercel.app` |
| `DB_CONNECTION` | `pgsql` |
| `DB_URL` | paste connection string dari Neon |
| `SESSION_DRIVER` | `cookie` |
| `QUEUE_CONNECTION` | `sync` |
| `CACHE_STORE` | `array` |
| `FILESYSTEM_DISK` | `s3` |
| `AWS_ACCESS_KEY_ID` | paste `BLOB_READ_WRITE_TOKEN` |
| `AWS_SECRET_ACCESS_KEY` | (kosong) |
| `AWS_DEFAULT_REGION` | `auto` |
| `AWS_BUCKET` | (kosong) |
| `AWS_ENDPOINT` | paste `BLOB_API_URL` |
| `AWS_URL` | paste `BLOB_API_URL` |

### Generate APP_KEY

Jalankan perintah ini di terminal komputer kamu:

```bash
php artisan key:generate --show
```

Copy hasilnya, paste ke `APP_KEY` di Vercel.

> Atau kalau mau generate langsung dari Vercel: nanti setelah deploy pertama gagal, jalankan command `php artisan key:generate` via **Run Command**.

## 4. Deploy

Klik **Deploy**. Tunggu ~2-3 menit.

## 5. Jalankan Migration

Setelah deploy sukses:

1. Buka Vercel Dashboard → tab **Deployments**
2. Klik ⋮ (titik tiga) → **Run Command**
3. Ketik: `php artisan migrate --force`
4. Tunggu selesai

## 6. Selesai!

Buka URL: `https://namaproject.vercel.app`

## Troubleshooting

| Masalah | Solusi |
|---------|--------|
| Error `APP_KEY` tidak ada | Run `php artisan key:generate` via Run Command |
| Error database connection | Cek `DB_URL` di Environment Variables, pastikan benar |
| Error file upload | Cek `BLOB_READ_WRITE_TOKEN` dan `BLOB_API_URL` |
| Halaman putih (500) | Run `php artisan config:cache` via Run Command |
| 404 selain halaman depan | Pastikan `vercel.json` sudah benar, re-deploy |
