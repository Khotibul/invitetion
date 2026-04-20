<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class WhiteEleganceTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $preset = [
            'design' => [
                'title'      => ['color' => '#2c2c2c', 'font' => 'Playfair Display'],
                'content'    => ['color' => '#6b6b6b', 'font' => 'Lato'],
                'button'     => ['color' => '#ffffff', 'background' => '#2c2c2c'],
                'background' => '#faf9f7',
                'template'   => 'white-elegance',
            ],
            'cover' => [
                'name'        => ['female' => 'Bride', 'male' => 'Groom', 'size' => '48', 'style' => 'elegant'],
                'content'     => 'Kami mengundang Anda untuk berbagi kebahagiaan di hari istimewa kami',
                'button'      => 'Buka Undangan',
                'description' => [
                    'top'    => 'Dengan penuh syukur dan kebahagiaan',
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
                'location'  => ['address' => 'Nama Gedung, Kota', 'map' => 'https://maps.google.com/'],
                'additional' => ['closing' => 'Terima kasih atas kehadiran dan doa restu Anda', 'special' => [], 'show' => true],
            ],
            'quote'  => ['content' => 'Cinta adalah perpaduan dua jiwa yang menjadi satu', 'decoration' => ''],
            'music'  => ['title' => '', 'url' => '', 'show' => false],
            'rsvp'   => [
                'title'   => 'Konfirmasi Kehadiran',
                'content' => 'Mohon konfirmasi kehadiran Anda sebelum tanggal yang ditentukan',
                'date'    => '2026-12-20',
                'yes'     => ['option' => 'Hadir', 'content' => 'Terima kasih, kami menantikan kehadiran Anda'],
                'no'      => ['option' => 'Tidak Hadir', 'content' => 'Terima kasih atas perhatian Anda'],
            ],
            'gift'   => [
                'show'    => false,
                'title'   => 'Amplop Digital',
                'content' => 'Kehadiran Anda adalah hadiah terbaik bagi kami',
                'bank'    => ['name' => '', 'code' => '', 'option' => 'bca'],
            ],
            'wishes' => ['title' => 'Ucapan & Doa', 'content' => 'Sampaikan ucapan dan doa terbaik Anda', 'public' => true],
            'additional' => [
                'live'     => ['show' => false, 'app' => '', 'link' => '', 'content' => ''],
                'protocol' => ['show' => false, 'code' => [], 'title' => '', 'content' => ''],
            ],
        ];

        Template::updateOrCreate(
            ['slug' => 'white-elegance'],
            [
                'title'   => 'White Elegance',
                'slug'    => 'white-elegance',
                'preset'  => json_encode($preset),
                'file'    => 'template/the-wedding/images/img_bg_1.jpg', // preview sementara
                'url'     => 'white-elegance',
                'grade'   => 'premium',
                'publish' => 'publish',
            ]
        );
    }
}
