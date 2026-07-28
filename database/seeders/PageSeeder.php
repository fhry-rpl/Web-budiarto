<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Sejarah',
                'slug' => 'sejarah',
                'body' => '<h2>Sejarah Bandar Udara Budiarto</h2><p>Bandar Udara Budiarto (Budiarto Airport) adalah bandar udara yang terletak di Curug, Tangerang, Banten. Bandara ini dikelola oleh Unit Penyelenggara Bandar Udara (UPBU) Budiarto di bawah Kementerian Perhubungan Republik Indonesia.</p><p>Bandara ini memiliki peran strategis dalam mendukung konektivitas wilayah dan pertumbuhan ekonomi di sekitarnya. Berbagai program pengembangan terus dilakukan untuk meningkatkan kualitas pelayanan dan infrastruktur bandara.</p>',
                'is_published' => true,
            ],
            [
                'title' => 'Visi & Misi',
                'slug' => 'visi-misi',
                'body' => '<h2>Visi</h2><p>Menjadi bandar udara yang modern, aman, nyaman, dan berkelanjutan yang mendukung konektivitas nasional.</p><h2>Misi</h2><ol><li>Menyediakan layanan kebandarudaraan yang prima dan profesional.</li><li>Mengembangkan infrastruktur bandara yang modern dan ramah lingkungan.</li><li>Meningkatkan keselamatan dan keamanan penerbangan.</li><li>Mendukung pertumbuhan ekonomi daerah melalui konektivitas udara.</li><li>Menerapkan tata kelola organisasi yang transparan dan akuntabel.</li></ol>',
                'is_published' => true,
            ],
            [
                'title' => 'Tugas & Fungsi',
                'slug' => 'tugas-fungsi',
                'body' => '<h2>Tugas</h2><p>UPBU Budiarto bertugas melaksanakan penyelenggaraan dan pelayanan jasa kebandarudaraan di Bandar Udara Budiarto.</p><h2>Fungsi</h2><ul><li>Penyusunan rencana dan program kerja bandara.</li><li>Pelaksanaan pelayanan jasa kebandarudaraan.</li><li>Pengoperasian fasilitas keselamatan dan keamanan penerbangan.</li><li>Pemeliharaan dan pengembangan infrastruktur bandara.</li><li>Pelaksanaan administrasi dan tata usaha.</li></ul>',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(['slug' => $page['slug']], $page);
        }
    }
}
