<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class IslamiGoldTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $preset = [
            'design' => [
                'title'      => ['color' => '#1a4731', 'font' => 'Amiri'],
                'content'    => ['color' => '#6b6b6b', 'font' => 'Lato'],
                'button'     => ['color' => '#1a4731', 'background' => '#c9a84c'],
                'background' => '#fdf8f0',
                'template'   => 'islami-gold',
            ],
            'cover' => [
                'name'        => ['female' => 'Mempelai Wanita', 'male' => 'Mempelai Pria', 'size' => '48', 'style' => 'islami'],
                'content'     => 'Dengan memohon rahmat dan ridha Allah SWT',
                'button'      => 'Buka Undangan',
                'description' => [
                    'top'    => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh',
                    'bottom' => 'Kami mengundang kehadiran Bapak/Ibu/Saudara/i',
                    'image'  => ['method' => 'none', 'image' => ''],
                ],
            ],
            'profile' => [
                'instagram' => ['male' => '', 'female' => '', 'show' => false],
                'parent'    => [
                    'male'   => ['father' => 'Nama Ayah', 'mother' => 'Nama Ibu', 'childhood' => '1'],
                    'female' => ['father' => 'Nama Ayah', 'mother' => 'Nama Ibu', 'childhood' => '1'],
                    'show'   => true,
                ],
                'name'  => ['male' => 'Nama Pria', 'female' => 'Nama Wanita'],
                'photo' => [
                    'male'   => ['method' => 'none', 'frame' => '', 'image' => ''],
                    'female' => ['method' => 'none', 'frame' => '', 'image' => ''],
                ],
            ],
            'detail' => [
                'calendar' => [
                    'save'     => ['content' => 'Simpan Tanggal', 'show' => true],
                    'date'     => '2026-12-31',
                    'time'     => '09:00',
                    'timezone' => 'wib',
                ],
                'countdown' => ['show' => true, 'style' => 'default'],
                'location'  => ['address' => 'Nama Gedung / Masjid, Kota', 'map' => 'https://maps.google.com/'],
                'additional' => [
                    'closing' => 'Jazakumullahu Khairan atas doa dan kehadiran Anda',
                    'special' => [],
                    'show'    => true,
                ],
            ],
            'quote'  => [
                'content'    => 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu pasangan hidup dari jenismu sendiri supaya kamu cenderung dan merasa tenteram kepadanya. (QS. Ar-Rum: 21)',
                'decoration' => '',
            ],
            'music'  => ['title' => '', 'url' => '', 'show' => false],
            'rsvp'   => [
                'title'   => 'Konfirmasi Kehadiran',
                'content' => 'Mohon konfirmasi kehadiran Anda',
                'date'    => '2026-12-20',
                'yes'     => ['option' => 'Insya Allah Hadir', 'content' => 'Jazakallahu Khairan, kami menantikan kehadiran Anda'],
                'no'      => ['option' => 'Belum Bisa Hadir', 'content' => 'Terima kasih, doa Anda sangat berarti bagi kami'],
            ],
            'gift'   => [
                'show'    => false,
                'title'   => 'Amplop Digital',
                'content' => 'Kehadiran dan doa Anda adalah hadiah terbaik bagi kami',
                'bank'    => ['name' => '', 'code' => '', 'option' => 'bca'],
            ],
            'wishes' => [
                'title'   => 'Kirim Ucapan & Doa',
                'content' => 'Sampaikan ucapan dan doa terbaik Anda untuk kami',
                'public'  => true,
            ],
            'additional' => [
                'live'     => ['show' => false, 'app' => '', 'link' => '', 'content' => ''],
                'protocol' => ['show' => false, 'code' => [], 'title' => '', 'content' => ''],
            ],
        ];

        Template::updateOrCreate(
            ['slug' => 'islami-gold'],
            [
                'title'   => 'Islami Gold',
                'slug'    => 'islami-gold',
                'preset'  => json_encode($preset),
                'file'    => 'template/the-wedding/images/img_bg_2.jpg',
                'url'     => 'islami-gold',
                'grade'   => 'premium',
                'publish' => 'publish',
            ]
        );
    }
}
