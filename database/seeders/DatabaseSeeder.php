<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * DatabaseSeeder — urutan penting!
 * Seeder yang bergantung pada data lain harus dijalankan setelah dependensinya.
 *
 * Jalankan: php artisan db:seed
 * Reset:    php artisan migrate:fresh --seed
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // ── 1. User (harus pertama — semua seeder lain butuh user_id = 1)
            UserSeeder::class,

            // ── 2. Paket langganan
            PackageSeeder::class,

            // ── 3. Template undangan (semua template yang tersedia)
            TemplateSeeder::class,          // seed semua template sekaligus
            TheWeddingTemplateSeeder::class, // update preset detail The Wedding

            // ── 4. Aset template
            TemplateAssetSeeder::class,     // quote default
            FontSeeder::class,              // 35 font Google

            // ── 5. Pengaturan sistem
            SettingSeeder::class,

            // ── 6. Konten & kontak
            InfoSeeder::class,
            ContactSeeder::class,
            LinkExSeeder::class,

            // ── 7. Bank untuk amplop digital
            BankSeeder::class,
        ]);
    }
}
