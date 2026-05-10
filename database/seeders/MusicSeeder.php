<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TemplateAssets;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * MusicSeeder — Seed musik latar default untuk undangan.
 *
 * File MP3 harus sudah ada di storage/app/public/audio/
 * Seeder ini hanya mendaftarkan metadata ke tabel template_assets.
 *
 * Cara pakai:
 *   php artisan db:seed --class=MusicSeeder
 */
class MusicSeeder extends Seeder
{
    public function run(): void
    {
        // Cari admin user untuk dijadikan owner musik
        $admin = User::whereIn('role', ['admin', 'developer'])->first();
        if (!$admin) {
            $this->command->warn('Tidak ada admin user. Buat admin dulu.');
            return;
        }

        // Daftar musik default
        // Format: ['title' => '...', 'file' => 'nama-file.mp3']
        // File harus ada di storage/app/public/audio/
        $musicList = [
            [
                'title' => 'Nissa Sabyan - Ya Adnani',
                'file'  => '1cuKYo6hzZiRuLvUXn7AyoO24ZGBrWKzqEPKXC9b.mp3',
            ],
            // Tambahkan musik lain di sini:
            // ['title' => 'Judul Lagu', 'file' => 'nama-file.mp3'],
        ];

        $ip = '127.0.0.1';

        foreach ($musicList as $music) {
            // Skip jika file tidak ada di storage
            if (!Storage::disk('public')->exists('audio/' . $music['file'])) {
                $this->command->warn("File tidak ditemukan: audio/{$music['file']} — dilewati.");
                continue;
            }

            // Skip jika sudah ada (berdasarkan content/filename)
            $exists = TemplateAssets::where('type', 'music')
                ->where('content', $music['file'])
                ->exists();

            if ($exists) {
                // Pastikan user_id adalah admin
                TemplateAssets::where('type', 'music')
                    ->where('content', $music['file'])
                    ->update(['user_id' => $admin->id]);
                $this->command->info("Musik sudah ada, update user_id: {$music['title']}");
                continue;
            }

            TemplateAssets::create([
                'type'    => 'music',
                'title'   => $music['title'],
                'content' => $music['file'],
                'publish' => 'publish',
                'user_id' => $admin->id,
                'ip_addr' => $ip,
            ]);

            $this->command->info("Musik ditambahkan: {$music['title']}");
        }
    }
}
