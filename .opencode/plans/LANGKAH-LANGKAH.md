# Langkah-Langkah Memperbaiki Build Error Vercel

## Masalah
Build gagal dengan error: `php: command not found`

Penyebab: `buildCommand` di `vercel.json` menjalankan perintah PHP, tapi PHP tidak tersedia di environment build Vercel.

---

## Langkah 1 — Ubah `vercel.json`

Hapus perintah PHP/Composer dari `buildCommand`, ganti dengan hanya `npm run build`.

**File:** `vercel.json`

```json
{
    "functions": {
        "api/index.php": {
            "runtime": "vercel-php@0.7.1"
        }
    },
    "routes": [
        { "src": "/build/(.*)", "dest": "/public/build/$1" },
        { "src": "/(.*)", "dest": "/api/index.php" }
    ],
    "outputDirectory": "public",
    "buildCommand": "npm run build"
}
```

> **Catatan:** `installCommand` tidak perlu ditentukan karena default-nya sudah `npm install`.

---

## Langkah 2 — Tambah `post-install-cmd` di `composer.json`

Tambah script artisan caching di bagian `"scripts"` agar berjalan otomatis saat `vercel-php` menjalankan `composer install` (fase di mana PHP tersedia).

**File:** `composer.json`

Cari bagian `"scripts"`, lalu tambahkan setelah `"post-autoload-dump"`:

```json
"post-install-cmd": [
    "@php artisan config:cache --ansi",
    "@php artisan route:cache --ansi",
    "@php artisan view:cache --ansi"
]
```

Hasil akhir bagian `"scripts"` akan terlihat seperti ini:

```json
"scripts": {
    "post-autoload-dump": [
        "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
        "@php artisan package:discover --ansi"
    ],
    "post-install-cmd": [
        "@php artisan config:cache --ansi",
        "@php artisan route:cache --ansi",
        "@php artisan view:cache --ansi"
    ],
    ...
}
```

---

## Langkah 3 — Set Environment Variables di Vercel

Buka **Vercel Dashboard → Project → Settings → Environment Variables**, tambahkan variabel berikut:

| Key        | Value                                       |
|------------|---------------------------------------------|
| `APP_KEY`  | `base64:...` (generate dari `php artisan key:generate --show`) |
| `APP_ENV`  | `production`                                |
| `APP_DEBUG`| `false`                                     |

> **Catatan:** Jika ada variabel env lain (database, queue, dll), tambahkan juga.

---

## Langkah 4 — Deploy Ulang

```bash
git add .
git commit -m "fix: perbaiki Vercel build dengan menyerahkan PHP ke vercel-php builder"
git push
```

Vercel akan otomatis menjalankan build ulang.

---

## Cara Kerja

| Sebelum (Error)                                  | Sesudah (Fix)                                         |
|--------------------------------------------------|-------------------------------------------------------|
| `buildCommand` manual pakai `php`                | `buildCommand` hanya untuk frontend (`npm run build`) |
| PHP belum tersedia → error                       | `vercel-php` builder sediakan PHP saat proses fungsi  |
| Composer & artisan di `buildCommand`             | Composer otomatis oleh builder, artisan via `post-install-cmd` |

Setelah perubahan ini:
1. `npm run build` → build frontend (Vite)
2. `vercel-php` proses `api/index.php` → download PHP + jalankan `composer install`
3. `composer install` picu `post-install-cmd` → `php artisan config:cache`, `route:cache`, `view:cache`
4. Fungsi siap di-deploy ✅
