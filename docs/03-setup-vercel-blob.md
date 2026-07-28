# Setup Vercel Blob (File Storage Gratis)

## Kenapa perlu?

File upload (gambar galeri, foto staff, thumbnail, dokumen) di Vercel gak bisa disimpan di folder `storage/` karena sifatnya sementara. Makanya pakai **Vercel Blob** — penyimpanan cloud gratis.

## Langkah

### 1. Buka Vercel Dashboard

1. Buka https://vercel.com
2. Pilih project kamu (nanti setelah import repo)

### 2. Buat Blob Storage

1. Di dashboard project, klik tab **Storage**
2. Klik **Create Database** atau **Connect Store**
3. Pilih **Vercel Blob**
4. Klik **Create**
5. Tunggu beberapa detik

### 3. Copy Token

Setelah Blob terbuat, akan muncul 2 nilai:

| Variable | Contoh |
|----------|--------|
| `BLOB_READ_WRITE_TOKEN` | `vercel_blob_rw_xxxxx...` |
| `BLOB_API_URL` | `https://xxxxx.blob.vercel-storage.com` |

**Copy keduanya.**

### 4. Isi Environment Variables

Buka **Settings → Environment Variables**, isi:

| Variable | Isi |
|----------|-----|
| `FILESYSTEM_DISK` | `s3` |
| `AWS_ACCESS_KEY_ID` | paste `BLOB_READ_WRITE_TOKEN` |
| `AWS_SECRET_ACCESS_KEY` | (biarkan kosong) |
| `AWS_DEFAULT_REGION` | `auto` |
| `AWS_BUCKET` | (biarkan kosong) |
| `AWS_ENDPOINT` | paste `BLOB_API_URL` |
| `AWS_URL` | paste `BLOB_API_URL` |

> Semua file upload nanti otomatis tersimpan di Vercel Blob, bukan di server lokal.
