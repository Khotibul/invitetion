<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    public function run(): void
    {
        Info::updateOrCreate(
            ['type' => 'package', 'file' => 'package'],
            [
                'title'   => 'Menu paket',
                'content' => json_encode([
                    'gift'               => 'Amplop Digital',
                    'e-invitation'       => 'E-Invitation',
                    'filter-ig'          => 'Filter Instagram',
                    'story'              => 'Kisah Cinta',
                    'live-stream'        => 'Live Streaming',
                    'private-invitation' => 'Personalized Invitation',
                    'event'              => 'Sesi Acara',
                    'free-text'          => 'Teks Gratis',
                    'event-count'        => 'Jumlah Acara',
                    'story-count'        => 'Jumlah Kisah Cinta',
                    'gallery-photo'      => 'Galeri Foto',
                    'smart-wa'           => 'Smart WhatsApp',
                    'manual-wa'          => 'WhatsApp Manual',
                    'guest'              => 'Tamu',
                    'gallery-video'      => 'Video',
                    'music'              => 'Lagu',
                    'template'           => 'Kategori Desain',
                    'active'             => 'Masa Aktif',
                ]),
                'file_type' => 'image',
                'user_id'   => 1,
                'ip_addr'   => '127.0.0.1',
            ]
        );
    }
}
