# User Flow — Website Resmi RENPRO UPBU Budiarto

## 3.1 Pengunjung Umum (Masyarakat)

```
[Landing di Beranda]
       │
       ├──> [Scroll melihat hero, layanan, berita, pengumuman]
       │
       ├──> [Klik "Selengkapnya" di Berita] ──> Halaman Daftar Berita
       │                                          │
       │                                          └──> [Klik judul] ──> Detail Berita
       │
       ├──> [Klik menu "Dokumen"] ──> Halaman Dokumen
       │                                │
       │                                ├──> [Filter kategori] ──> Dokumen terfilter
       │                                │
       │                                └──> [Klik "Download"] ──> File terdownload (+ counter)
       │
       ├──> [Klik menu "Profil"] ──> Halaman Profil
       │                              │
       │                              └──> [Klik submenu] ──> Sejarah / Visi Misi / Struktur
       │
       ├──> [Klik menu "Kontak"] ──> Halaman Kontak
       │                              │
       │                              └──> [Isi form + submit] ──> Success notification
       │
       └──> [Klik menu "Galeri"] ──> Halaman Galeri
                                      │
                                      └──> [Klik galeri] ──> Grid foto (lightbox)
```

## 3.2 Admin

```
[Login via /login]
       │
       └──> [Redirect ke /admin/dashboard]
                │
                ├──> [Lihat grafik & statistik]
                │
                ├──> [Buat Berita Baru]
                │     ├──> Klik "Tambah Post"
                │     ├──> Isi form (judul, konten, kategori, thumbnail)
                │     ├──> [Publish / Draft / Archived]
                │     └──> Success redirect ke index
                │
                ├──> [Upload Dokumen]
                │     ├──> Klik "Tambah Dokumen"
                │     ├──> Pilih file PDF, isi deskripsi
                │     └──> Sukses
                │
                ├──> [Kelola Pesan Masuk]
                │     ├──> Lihat daftar pesan
                │     ├──> Klik detail
                │     └──> Tandai sudah dibaca
                │
                ├──> [Edit Halaman Profil]
                │     └──> Edit content (rich text)
                │
                └──> [Pengaturan Website]
                      ├──> Ganti logo
                      ├──> Update sosial media
                      └──> Simpan
```

## 3.3 Pencarian Informasi

```
[User mengetik di search bar (navbar)]
       │
       └──> [Submit] ──> /cari?q=keyword
                │
                ├──> [Hasil ditemukan] ──> List hasil (posts + documents + pages)
                │                           │
                │                           └──> [Klik hasil] ──> Halaman terkait
                │
                └──> [Tidak ditemukan] ──> "Tidak ada hasil" + saran
```

## 3.4 Download Dokumen

```
[User melihat daftar dokumen]
       │
       ├──> [Klik "Download"]
       │     ├──> Hit counter +1 (via Event/Listener)
       │     ├──> Stream file ke browser
       │     └──> File terdownload
       │
       └──> [Klik judul dokumen]
             └──> Halaman detail → [Klik Download]
```
