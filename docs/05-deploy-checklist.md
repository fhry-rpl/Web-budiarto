# Deploy Checklist — RENPRO UPBU Budiarto

## Bug Fixes (sudah diterapkan)

| # | File | Perbaikan |
|---|------|-----------|
| 1 | `.env.vercel` | Hapus `VERCEL_OIDC_TOKEN` (security — jangan commit credential) |
| 2 | `.env.vercel` | `SESSION_DRIVER=array` → `cookie` (biar login persist) |
| 3 | `.env.vercel` | Tambah `# DB_URL` placeholder (nilai real diset via Vercel Dashboard) |
| 4 | `.env.vercel` | `APP_KEY` digenerate ulang |
| 5 | `api/index.php:36-41` | Tambah guard `if (!$dbUrl)` biar migration route tidak error |

---

## 1. Setup Database (Neon PostgreSQL)

1. Buka https://console.neon.tech → Login/Create account
2. Klik **Create Project**
   - Name: `renpro-upbu-budiarto`
   - Region: `Singapore` (`ap-southeast-1`)
   - PostgreSQL version: 16 atau 17
3. Klik **Create**
4. Copy **connection string** (format: `postgresql://user:pass@ep-xxx.region.aws.neon.tech/neondb?sslmode=require`)

---

## 2. Set Environment Variables di Vercel

Buka **Vercel Dashboard → Project → Settings → Environment Variables**, tambahkan:

| Variable | Value | Keterangan |
|----------|-------|------------|
| `APP_KEY` | `base64:Py1QmZqV7gabUrvnfmSMlnHdFQozvsrIhbw1r5rqTno=` | Encryption key (jangan diubah) |
| `APP_ENV` | `production` | |
| `APP_DEBUG` | `false` | |
| `APP_URL` | `https://laravel-web-peach.vercel.app` | Ganti dgn URL project-mu |
| `APP_NAME` | `RENPRO UPBU Budiarto` | |
| `APP_LOCALE` | `id` | |
| `APP_FALLBACK_LOCALE` | `id` | |
| `APP_TIMEZONE` | `Asia/Jakarta` | |
| `DB_CONNECTION` | `pgsql` | |
| `DB_URL` | *(paste connection string Neon)* | **WAJIB** |
| `SESSION_DRIVER` | `cookie` | |
| `SESSION_SECURE_COOKIE` | `true` | |
| `QUEUE_CONNECTION` | `sync` | |
| `CACHE_STORE` | `array` | |
| `LOG_CHANNEL` | `stderr` | |
| `LOG_LEVEL` | `warning` | |
| `FILESYSTEM_DISK` | `local` | (S3 menyusul) |
| `MIGRATE_SECRET` | `db1a2641187764e7d39f55b970817eeb3092b448aad6279ed512ef24e15ba8bd` | Secret untuk migrasi |

> **PENTING:** Jangan commit DB_URL atau MIGRATE_SECRET ke Git. Set hanya via Vercel Dashboard.

---

## 3. Deploy

```bash
# Login Vercel (sekali saja)
vercel login

# Link project
vercel link

# Deploy production
vercel --prod
```

Atau deploy via Git:
```bash
git add .
git commit -m "fix: bugs untuk deploy vercel"
git push
```
Lalu import repo di https://vercel.com → Add New → Project.

---

## 4. Post-Deploy Verification

### 4.1. Cek health endpoint
```
https://<url>.vercel.app/__ping
```
→ harus return `pong`

### 4.2. Cek environment variables
```
https://<url>.vercel.app/__env
```
→ Pastikan semua vars terisi (bukan `NOT SET`)

### 4.3. Jalankan migrasi + seeder
Buka di browser:
```
https://<url>.vercel.app/__migrate/db1a2641187764e7d39f55b970817eeb3092b448aad6279ed512ef24e15ba8bd
```
→ Akan menjalankan `migrate:fresh --force` + `db:seed --force`

### 4.4. Verifikasi halaman
- `https://<url>.vercel.app/` → Home
- `https://<url>.vercel.app/login` → Halaman login
- `https://<url>.vercel.app/admin` → Dashboard admin (login dulu)

---

## 5. Troubleshooting

| Gejala | Penyebab | Solusi |
|--------|----------|--------|
| `__env` show `NOT SET` | Env vars belum diset di Vercel Dashboard | Set semua vars, redeploy |
| `__migrate` error `DB_URL not set` | `DB_URL` tidak di Vercel env vars | Set `DB_URL` di Dashboard |
| Error `No application encryption key` | `APP_KEY` kosong/salah | Set `APP_KEY` yang benar |
| Login tidak persist | `SESSION_DRIVER=array` | Ganti ke `cookie` |
| 500 error / white screen | Cache corrupt | Coba akses `__ping` dulu |
| File upload gagal | Storage lokal (sementara) | Setup S3/Cloudflare R2 nanti |
