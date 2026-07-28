<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('pengumuman', [PostController::class, 'pengumuman'])->name('pengumuman.index');

Route::get('services', [ServiceController::class, 'index'])->name('services.index');
Route::get('services/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('galleries', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('galleries/{id}', [GalleryController::class, 'show'])->name('galleries.show');

Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('documents/{id}', [DocumentController::class, 'show'])->name('documents.show');
Route::get('documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');

Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('search', [SearchController::class, 'index'])->name('search');

Route::get('profil/{page}', [ProfilePageController::class, 'show'])->name('profile.page');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
