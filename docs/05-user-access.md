# Hak Akses Pengguna — Website Resmi RENPRO UPBU Budiarto

## 5.1 Role Matrix

| Role | Level Akses | Halaman yang Bisa Diakses |
|---|---|---|
| **Guest** (tidak login) | ❌ Tidak bisa akses admin | Semua halaman publik |
| **Admin** (login) | ✅ Full akses admin panel | Semua halaman publik + semua halaman admin |

## 5.2 Admin Permissions

| Modul | Create | Read | Update | Delete |
|---|---|---|---|---|
| Posts | ✅ | ✅ | ✅ | ✅ |
| Documents | ✅ | ✅ | ✅ | ✅ |
| Categories | ✅ | ✅ | ✅ | ✅ |
| Services | ✅ | ✅ | ✅ | ✅ |
| Galleries | ✅ | ✅ | ✅ | ✅ |
| Pages | ✅ | ✅ | ✅ | ✅ |
| Staff | ✅ | ✅ | ✅ | ✅ |
| Contacts | ❌ | ✅ | ✅ | ✅ |
| Settings | ❌ | ✅ | ✅ | ❌ |

## 5.3 Middleware Protection

```php
// bootstrap/app.php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => EnsureUserIsAdmin::class,
    ]);
})

// routes/admin.php — semua route admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(...)
```

## 5.4 Policy Mapping

| Policy | Model | Actions |
|---|---|---|
| `PostPolicy` | Post | viewAny, create, update, delete |
| `DocumentPolicy` | Document | viewAny, create, update, delete |
| `CategoryPolicy` | Category | create, update, delete |
| `ServicePolicy` | Service | create, update, delete |
| `GalleryPolicy` | Gallery | create, update, delete |
| `PagePolicy` | Page | create, update, delete |
| `StaffPolicy` | Staff | create, update, delete |
| `ContactSubmissionPolicy` | ContactSubmission | viewAny, view, delete |
