# Informasi Halaman — Website Resmi RENPRO UPBU Budiarto

## 4.1 Halaman Publik

| Halaman | URL | Elemen Utama | Tipe Konten |
|---|---|---|---|
| **Beranda** | `/` | Hero, 3 layanan, 6 berita terbaru, 3 pengumuman, statistik chart, galeri preview | Dynamic (query DB) |
| **Profil** | `/profil` | Navigasi sub-profil, konten intro | Dynamic (page) |
| **Sejarah** | `/profil/sejarah` | Timeline/konten sejarah | Dynamic (page) |
| **Visi Misi** | `/profil/visi-misi` | Visi, misi, motto | Dynamic (page) |
| **Tugas Fungsi** | `/profil/tugas-fungsi` | Daftar tugas & fungsi | Dynamic (page) |
| **Struktur Organisasi** | `/profil/struktur-organisasi` | Grid/bagan staff (foto, nama, jabatan) | Dynamic (staff) |
| **Berita** | `/berita` | Grid berita, filter kategori, pagination, search | Dynamic (posts) |
| **Detail Berita** | `/berita/{slug}` | Judul, tanggal, konten, thumbnail, share | Dynamic (post) |
| **Pengumuman** | `/pengumuman` | Sama seperti berita (kategori terpisah) | Dynamic (posts) |
| **Dokumen** | `/dokumen` | Tabel/list dokumen, filter kategori, search | Dynamic (documents) |
| **Detail Dokumen** | `/dokumen/{id}` | Nama, deskripsi, file size, download button | Dynamic (document) |
| **RENPRO** | `/renpro` | Dokumen terfilter kategori RENPRO | Dynamic (documents) |
| **Program Kerja** | `/program-kerja` | Dokumen/laporan program kerja | Dynamic (documents) |
| **Target Kinerja** | `/target-kinerja` | Indikator + chart capaian | Dynamic (documents + manual) |
| **Layanan** | `/layanan` | Grid kartu layanan | Dynamic (services) |
| **Detail Layanan** | `/layanan/{slug}` | Prosedur, syarat, kontak terkait | Dynamic (service) |
| **Galeri** | `/galeri` | Grid galeri (thumbnail + judul) | Dynamic (galleries) |
| **Detail Galeri** | `/galeri/{id}` | Grid foto (lightbox), deskripsi | Dynamic (gallery) |
| **Kontak** | `/kontak` | Form (nama, email, tel, subjek, pesan), alamat, maps embed | Static + form |
| **Pencarian** | `/cari` | List hasil pencarian | Dynamic (search) |

## 4.2 Halaman Admin

| Halaman | URL | Fungsi |
|---|---|---|
| Dashboard | `/admin` | Overview statistik (charts + counts) |
| Posts Index | `/admin/posts` | Tabel dengan search, filter, bulk actions |
| Posts Create | `/admin/posts/create` | Form dengan rich text editor, upload thumbnail, pilih kategori, status |
| Posts Edit | `/admin/posts/{id}/edit` | Sama seperti create, pre-filled |
| Documents CRUD | `/admin/documents` | Form + upload file, kategori, download count |
| Categories CRUD | `/admin/categories` | Nama, slug, tipe (berita/pengumuman/dokumen) |
| Services CRUD | `/admin/services` | Nama, ikon, deskripsi, prosedur, syarat |
| Galleries CRUD | `/admin/galleries` | Multiple image upload, drag-drop sort |
| Pages CRUD | `/admin/pages` | Rich text editor untuk halaman statis |
| Staff CRUD | `/admin/staff` | Nama, jabatan, foto, urutan |
| Contacts | `/admin/contacts` | Tabel pesan, read/unread, detail, delete |
| Settings | `/admin/settings` | Form pengaturan website |
