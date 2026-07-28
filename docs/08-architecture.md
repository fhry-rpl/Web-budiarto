# Arsitektur Aplikasi — Website Resmi RENPRO UPBU Budiarto

## Filosofi Arsitektur

```
Request → Middleware → Controller → FormRequest → Service → Repository → Model → DB
                                                      ↓
                                                 Event → Listener → Queue → Mail/Log
```

Setiap lapisan punya tanggung jawab tunggal:

| Layer | Tanggung Jawab |
|---|---|
| **Controller** | Menerima request, return response. Hanya orchestrasi. |
| **FormRequest** | Validasi input + otorisasi (authorize()) |
| **Service** | Semua logika bisnis. Bisa dipanggil dari mana saja. |
| **Repository** | Akses data (Eloquent query). Abstraksi database. |
| **Model** | Representasi tabel + relasi + mutator/accessor |
| **Policy** | Otorisasi per model |
| **Resource** | Transformasi output |
| **Event/Listener** | Decoupling efek samping (notifikasi, log) |
| **Job/Queue** | Task berat/asinkron (kirim email, upload file) |

## Struktur Folder

```
app/
├── Console/Commands/
├── Enums/
│   ├── PostStatus.php
│   ├── PostType.php
│   └── CategoryType.php
├── Events/
│   ├── PostPublished.php
│   ├── DocumentDownloaded.php
│   └── ContactSubmitted.php
├── Exceptions/
├── Http/
│   ├── Controllers/
│   │   ├── Controller.php
│   │   ├── HomeController.php
│   │   ├── PageController.php
│   │   ├── PostController.php
│   │   ├── DocumentController.php
│   │   ├── ServiceController.php
│   │   ├── GalleryController.php
│   │   ├── ContactController.php
│   │   ├── SearchController.php
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       ├── PostController.php
│   │       ├── DocumentController.php
│   │       ├── CategoryController.php
│   │       └── ...
│   ├── Middleware/
│   │   └── EnsureUserIsAdmin.php
│   ├── Requests/
│   │   ├── StorePostRequest.php
│   │   ├── UpdatePostRequest.php
│   │   ├── StoreDocumentRequest.php
│   │   └── ...
│   └── Resources/
│       ├── PostResource.php
│       ├── DocumentResource.php
│       └── ...
├── Listeners/
├── Jobs/
├── Models/
│   ├── User.php
│   ├── Post.php
│   ├── Document.php
│   ├── Category.php
│   ├── Service.php
│   ├── Gallery.php
│   ├── GalleryItem.php
│   ├── Page.php
│   ├── Staff.php
│   ├── ContactSubmission.php
│   └── Setting.php
├── Observers/
├── Policies/
├── Repositories/
│   ├── Contracts/
│   └── Eloquent/
├── Services/
├── Traits/
│   ├── HasSlug.php
│   └── HasAuthor.php
└── Helpers/
    ├── helpers.php
    ├── FileHelper.php
    └── TextHelper.php

routes/
├── web.php        # Route publik
├── admin.php      # Route admin (require auth)
└── console.php

resources/
├── views/
│   ├── layouts/
│   ├── components/
│   ├── home.blade.php
│   ├── pages/
│   ├── posts/
│   ├── documents/
│   ├── services/
│   ├── galleries/
│   ├── contact.blade.php
│   ├── search.blade.php
│   └── admin/
├── css/app.css
└── js/
    ├── app.ts
    └── components/
```

## Dependency Injection Flow

```php
// Controller → depends on → Service
class PostController {
    public function __construct(
        private PostService $postService
    ) {}
}

// Service → depends on → Repository Interface
class PostService {
    public function __construct(
        private PostRepositoryInterface $repository
    ) {}
}

// RepositoryServiceProvider binds Interface → Implementation
$this->app->bind(PostRepositoryInterface::class, PostRepository::class);
```

## Request Lifecycle

```
Browser → Middleware (auth, admin) → Controller
    → FormRequest (validasi + authorize)
    → Service (logika bisnis)
    → Repository (query database via Eloquent)
    → Event/Listener (efek samping)
    → Resource (transform output)
    → View (Blade) → Browser
```
