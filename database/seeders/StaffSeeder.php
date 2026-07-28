<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $staff = [
            ['name' => 'Dr. Andi Wijaya, S.T., M.T.', 'position' => 'Kepala UPBU Budiarto', 'order' => 1, 'is_active' => true, 'instagram' => 'andi_wijaya', 'whatsapp' => '081234567890', 'facebook' => '#'],
            ['name' => 'Ir. Siti Rahmawati, M.M.', 'position' => 'Kepala Seksi Renpro', 'order' => 2, 'is_active' => true, 'instagram' => 'siti_rahmawati', 'whatsapp' => '081345678902', 'facebook' => '#'],
            ['name' => 'Bambang Susilo, S.E.', 'position' => 'Kepala Seksi Keuangan', 'order' => 3, 'is_active' => true, 'instagram' => 'bambang_susilo', 'whatsapp' => '082345678901', 'facebook' => '#'],
            ['name' => 'Dewi Sartika, S.H.', 'position' => 'Kepala Seksi Umum', 'order' => 4, 'is_active' => true, 'instagram' => 'dewi_sartika', 'whatsapp' => '083456789012', 'facebook' => '#'],
            ['name' => 'Ahmad Fauzi, S.Si.T.', 'position' => 'Analis Program', 'order' => 5, 'is_active' => true, 'instagram' => 'ahmad_fauzi', 'whatsapp' => '084567890123', 'facebook' => '#'],
            ['name' => 'Rina Marlina, A.Md.', 'position' => 'Staf Administrasi', 'order' => 6, 'is_active' => true, 'instagram' => 'rina_marlina', 'whatsapp' => '085678901234', 'facebook' => '#'],
        ];

        foreach ($staff as $member) {
            Staff::firstOrCreate(['name' => $member['name'], 'position' => $member['position']], $member);
        }
    }
}
