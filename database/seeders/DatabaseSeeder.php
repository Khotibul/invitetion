<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * DatabaseSeeder — urutan penting!
 *
 * Jalankan fresh:  php artisan migrate:fresh --seed
 * Jalankan ulang:  php artisan db:seed
 * Seeder tertentu: php artisan db:seed --class=AllTemplatesSeeder
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

            // ── 3. Semua template dengan preset lengkap
            AllTemplatesSeeder::class,

            // ── 4. Aset template (font, quote)
            TemplateAssetSeeder::class,
            FontSeeder::class,

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
