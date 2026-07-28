<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Berita', 'slug' => 'berita', 'type' => 'post', 'order' => 1],
            ['name' => 'Pengumuman', 'slug' => 'pengumuman', 'type' => 'pengumuman', 'order' => 1],
            ['name' => 'Dokumen Umum', 'slug' => 'dokumen-umum', 'type' => 'dokumen', 'order' => 1],
            ['name' => 'Laporan', 'slug' => 'laporan', 'type' => 'dokumen', 'order' => 2],
            ['name' => 'Regulasi', 'slug' => 'regulasi', 'type' => 'dokumen', 'order' => 3],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
