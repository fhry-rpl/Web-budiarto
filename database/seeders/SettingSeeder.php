<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'RENPRO UPBU Budiarto',
            'site_description' => 'Website resmi Rencana Program dan Pengembangan Unit Penyelenggara Bandar Udara Budiarto',
            'address' => 'Jl. Budiarto No.1, Curug, Tangerang, Banten 15810',
            'email' => 'info@budiartoairport.com',
            'phone' => '(021) 1234-5678',
        ];

        foreach ($settings as $key => $value) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
