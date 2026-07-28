<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $profile = MenuItem::create([
            'label' => 'Profil',
            'route' => null,
            'params' => [],
            'parent_id' => null,
            'order' => 1,
            'icon' => 'building2',
            'is_active' => true,
        ]);

        $profile->children()->createMany([
            [
                'label' => 'Sejarah',
                'route' => 'profile.page',
                'params' => ['page' => 'sejarah'],
                'order' => 0,
                'icon' => null,
                'is_active' => true,
            ],
            [
                'label' => 'Visi & Misi',
                'route' => 'profile.page',
                'params' => ['page' => 'visi-misi'],
                'order' => 1,
                'icon' => null,
                'is_active' => true,
            ],
            [
                'label' => 'Tugas & Fungsi',
                'route' => 'profile.page',
                'params' => ['page' => 'tugas-fungsi'],
                'order' => 2,
                'icon' => null,
                'is_active' => true,
            ],
            [
                'label' => 'Struktur Organisasi',
                'route' => 'profile.page',
                'params' => ['page' => 'struktur-organisasi'],
                'order' => 3,
                'icon' => null,
                'is_active' => true,
            ],
        ]);

        $items = [
            ['label' => 'Beranda', 'route' => 'home', 'order' => 0, 'icon' => 'home'],
            ['label' => 'Berita', 'route' => 'posts.index', 'order' => 2, 'icon' => 'newspaper'],
            ['label' => 'Pengumuman', 'route' => 'pengumuman.index', 'order' => 3, 'icon' => 'megaphone'],
            ['label' => 'Dokumen', 'route' => 'documents.index', 'order' => 4, 'icon' => 'file-text'],
            ['label' => 'Layanan', 'route' => 'services.index', 'order' => 5, 'icon' => 'briefcase'],
            ['label' => 'Galeri', 'route' => 'galleries.index', 'order' => 6, 'icon' => 'image'],
            ['label' => 'Kontak', 'route' => 'contact.index', 'order' => 7, 'icon' => 'phone'],
        ];

        foreach ($items as $item) {
            MenuItem::create($item + ['params' => [], 'parent_id' => null, 'is_active' => true]);
        }
    }
}
