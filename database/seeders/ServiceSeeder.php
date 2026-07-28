<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Pelayanan Bandara',
                'slug' => 'pelayanan-bandara',
                'description' => 'Informasi lengkap mengenai fasilitas dan pelayanan yang tersedia di Bandar Udara Budiarto, termasuk ruang tunggu, toilet, mushola, dan area parkir.',
                'icon' => 'building',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Kargo & Logistik',
                'slug' => 'kargo-logistik',
                'description' => 'Layanan pengiriman kargo dan logistik melalui Bandar Udara Budiarto dengan prosedur yang cepat dan aman.',
                'icon' => 'truck',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Perizinan & Regulasi',
                'slug' => 'perizinan-regulasi',
                'description' => 'Informasi mengenai perizinan penerbangan, penggunaan bandara, dan regulasi terkait operasional bandara.',
                'icon' => 'file-text',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Pengaduan Masyarakat',
                'slug' => 'pengaduan-masyarakat',
                'description' => 'Layanan pengaduan dan aspirasi masyarakat terkait pelayanan di Bandar Udara Budiarto.',
                'icon' => 'message-circle',
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
