<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::factory(12)->create();

        $pengumumanCat = Category::where('type', 'pengumuman')->first();

        if ($pengumumanCat) {
            $pengumuman = [
                [
                    'title' => 'Pengumuman Libur Hari Raya Idul Adha',
                    'slug' => 'libur-idul-adha-2026',
                    'excerpt' => 'Sehubungan dengan perayaan Hari Raya Idul Adha, operasional Bandar Udara Budiarto akan disesuaikan.',
                    'body' => '<h2>Pengumuman Libur Hari Raya Idul Adha 1447 H</h2><p>Sehubungan dengan perayaan Hari Raya Idul Adha 1447 Hijriah, dengan ini kami sampaikan bahwa operasional Bandar Udara Budiarto akan berjalan seperti biasa namun dengan penyesuaian jadwal pada beberapa layanan.</p><p>Kami mengucapkan Selamat Hari Raya Idul Adha kepada seluruh pengguna jasa bandara. Mohon maaf atas ketidaknyamanan apabila ada perubahan jadwal penerbangan.</p>',
                ],
                [
                    'title' => 'Pengumuman Pembukaan Rute Penerbangan Baru',
                    'slug' => 'rute-penerbangan-baru',
                    'excerpt' => 'Bandar Udara Budiarto akan membuka rute penerbangan baru tujuan Yogyakarta dan Surabaya.',
                    'body' => '<h2>Pembukaan Rute Penerbangan Baru</h2><p>Dengan bangga kami mengumumkan bahwa Bandar Udara Budiarto akan membuka rute penerbangan baru menuju Yogyakarta (YIA) dan Surabaya (SUB) mulai bulan depan.</p><p>Rute ini diharapkan dapat meningkatkan konektivitas wilayah dan mendukung pertumbuhan ekonomi di sekitar Bandar Udara Budiarto.</p><p>Tiket sudah dapat dipesan melalui maskapai mitra dan platform pemesanan tiket online.</p>',
                ],
                [
                    'title' => 'Pengumuman Pemeliharaan Runway Berkala',
                    'slug' => 'pemeliharaan-runway',
                    'excerpt' => 'Akan dilakukan pemeliharaan runway secara berkala pada tanggal 15-17 Juli 2026.',
                    'body' => '<h2>Pemeliharaan Runway Berkala</h2><p>Diberitahukan kepada seluruh pengguna jasa bandara bahwa akan dilaksanakan pemeliharaan runway secara berkala pada:</p><p><strong>Tanggal:</strong> 15-17 Juli 2026<br><strong>Waktu:</strong> 22.00 - 05.00 WIB</p><p>Selama pemeliharaan berlangsung, operasional penerbangan tetap berjalan dengan pengaturan jadwal yang disesuaikan. Mohon maaf atas ketidaknyamanan yang ditimbulkan.</p>',
                ],
            ];

            foreach ($pengumuman as $data) {
                Post::firstOrCreate(
                    ['slug' => $data['slug']],
                    array_merge($data, [
                        'user_id' => 1,
                        'category_id' => $pengumumanCat->id,
                        'is_published' => true,
                        'published_at' => now()->subDays(rand(1, 30)),
                    ])
                );
            }
        }
    }
}
