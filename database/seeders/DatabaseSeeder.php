<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@budiartoairport.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
            DocumentSeeder::class,
            ServiceSeeder::class,
            GallerySeeder::class,
            PageSeeder::class,
            StaffSeeder::class,
            SettingSeeder::class,
            MenuItemSeeder::class,
        ]);
    }
}
