<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Document;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_dashboard_loads(): void
    {
        $user = User::where('is_admin', true)->first();
        $this->assertNotNull($user);

        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_admin_crud_index_pages_load(): void
    {
        $user = User::where('is_admin', true)->first();

        $pages = [
            '/admin/posts' => 'Postingan',
            '/admin/documents' => 'Dokumen',
            '/admin/categories' => 'Kategori',
            '/admin/services' => 'Layanan',
            '/admin/galleries' => 'Galeri',
            '/admin/pages' => 'Halaman',
            '/admin/staff' => 'Staf',
            '/admin/contacts' => 'Pesan Masuk',
        ];

        foreach ($pages as $url => $expected) {
            $response = $this->actingAs($user)->get($url);
            $response->assertStatus(200);
            $response->assertSee($expected);
        }
    }

    public function test_admin_settings_page_loads(): void
    {
        $user = User::where('is_admin', true)->first();

        $response = $this->actingAs($user)->get('/admin/settings');
        $response->assertStatus(200);
        $response->assertSee('Pengaturan');
    }

    public function test_admin_show_pages_load(): void
    {
        $user = User::where('is_admin', true)->first();

        $post = Post::first();
        if ($post) {
            $response = $this->actingAs($user)->get("/admin/posts/{$post->id}");
            $response->assertStatus(200);
            $response->assertSee($post->title);
        }

        $document = Document::first();
        if ($document) {
            $response = $this->actingAs($user)->get("/admin/documents/{$document->id}");
            $response->assertStatus(200);
            $response->assertSee($document->title);
        }

        $category = Category::first();
        if ($category) {
            $response = $this->actingAs($user)->get("/admin/categories/{$category->id}");
            $response->assertStatus(200);
            $response->assertSee($category->name);
        }

        $service = Service::first();
        if ($service) {
            $response = $this->actingAs($user)->get("/admin/services/{$service->id}");
            $response->assertStatus(200);
            $response->assertSee($service->title);
        }

        $gallery = Gallery::first();
        if ($gallery) {
            $response = $this->actingAs($user)->get("/admin/galleries/{$gallery->id}");
            $response->assertStatus(200);
            $response->assertSee($gallery->title);
        }

        $page = Page::first();
        if ($page) {
            $response = $this->actingAs($user)->get("/admin/pages/{$page->id}");
            $response->assertStatus(200);
            $response->assertSee($page->title);
        }
    }
}
