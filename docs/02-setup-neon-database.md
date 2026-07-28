# Setup Neon Database (PostgreSQL Gratis)

## 1. Buka & Login

1. Buka https://console.neon.tech
2. Klik **Sign In** → pilih **Continue with GitHub**
3. Izinkan akses (Authorize Neon)

## 2. Buat Project

1. Klik **Create a project** (tombol biru)
2. Isi:
   - **Name:** `renpro-budiarto` (atau bebas)
   - **Postgres version:** 17
   - **Region:** pilih yang paling dekat (Singapore / Tokyo)
3. Klik **Create project**
   - Tunggu ~5 detik, project jadi.

## 3. Copy Connection String

Setelah project dibuat, langsung muncul **Connection Details**:

```
postgresql://namauser:password@ep-bla-bla-xxx.ap-southeast-1.aws.neon.tech/neondb?sslmode=require
```

**Copy seluruh string itu.**

Nanti di Vercel dashboard → Settings → Environment Variables, isi:

| Variable | Isi |
|----------|-----|
| `DB_CONNECTION` | `pgsql` |
| `DB_URL` | **paste connection string tadi** |

> Gak perlu dipecah-pecah. Cukup 2 baris aja.

## 4. Jalankan Migration (setelah deploy)

Vercel Dashboard → Deployment → ⋮ → Run Command:

```bash
php artisan migrate --force
```

---

### Catatan

- **Free tier:** 0.5 GB storage, cukup untuk web profil
- Database akan **sleep** setelah 5 menit idle. Request pertama agak lambat (~1-3 detik). Ini normal.
