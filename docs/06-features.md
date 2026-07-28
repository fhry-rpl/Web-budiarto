# Fitur Utama — Website Resmi RENPRO UPBU Budiarto

## 6.1 Manajemen Posting (Berita & Pengumuman)

- Tipe post: `berita` dan `pengumuman` (dibedakan via kategori)
- Status: `draft`, `published`, `archived`
- Featured image upload (thumbnail)
- Kategori
- Slug otomatis dari judul
- Excerpt / ringkasan
- Penulis (authored by admin yang login)
- Published date
- View counter

## 6.2 Manajemen Dokumen

- Upload file (PDF, DOC, XLS — dibatasi maks 10MB)
- Kategori dokumen: RENPRO, Laporan, Peraturan, Publikasi, Program Kerja, Target Kinerja
- Download counter
- Informasi file: ukuran, tipe, tanggal upload
- Filter berdasarkan kategori

## 6.3 Galeri Media

- Tipe: Foto dan Video
- Foto: upload multiple, thumbnails, lightbox preview
- Video: embed YouTube/link
- Sort order
- Deskripsi per item galeri

## 6.4 Form Kontak

- Validasi client + server side
- Field: Nama, Email, Telepon, Subjek, Pesan
- Flash message setelah sukses
- Admin melihat pesan di panel
- Status read/unread

## 6.5 Pencarian Global

- Mencari di: posts (berita & pengumuman), documents, pages
- Search by title & content
- Result pagination

## 6.6 Dashboard Admin

- Total counts: posts, documents, services, galleries
- Grafik posts per bulan (ApexCharts Area)
- Pesan belum dibaca
- 5 post terbaru
- 5 dokumen terbaru

## 6.7 Pengaturan Website

- Nama website
- Deskripsi singkat
- Logo (upload)
- Hero banner gambar
- Alamat, telepon, email
- Sosial media (YouTube, Instagram, Facebook, Twitter, TikTok)
- Jam operasional
- Footer credit text

## 6.8 Animasi (Motion One)

- Hero: fade-in + slide-up pada headline & CTA
- Cards: stagger muncul saat scroll (intersection observer)
- Counter statistik: animate count-up
- Page transition: subtle fade

## 6.9 Grafik (ApexCharts)

- **Beranda Publik**: Bar chart atau donut chart distribusi konten
- **Dashboard Admin**: Area chart (posting trend 12 bulan), distribusi kategori
