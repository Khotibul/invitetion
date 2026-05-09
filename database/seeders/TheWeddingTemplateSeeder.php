<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

/**
 * TheWeddingTemplateSeeder
 * Update preset detail untuk semua varian template The Wedding.
 * Dijalankan setelah TemplateSeeder.
 */
class TheWeddingTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $variants = [
            'the-wedding'        => ['color' => '#bf9b73', 'bg' => '#fdf8f3', 'font' => 'Satisfy'],
            'the-wedding-navy'   => ['color' => '#1e3a5f', 'bg' => '#f0f4f8', 'font' => 'Merriweather'],
            'the-wedding-sage'   => ['color' => '#4a7c59', 'bg' => '#f0f7f2', 'font' => 'Satisfy'],
            'the-wedding-pink'   => ['color' => '#c48080', 'bg' => '#fdf0f0', 'font' => 'Satisfy'],
            'the-wedding-purple' => ['color' => '#6b3fa0', 'bg' => '#f5f0fa', 'font' => 'Satisfy'],
        ];

        foreach ($variants as $slug => $theme) {
            $preset = [
                'design' => [
                    'title'      => ['color' => $theme['color'], 'font' => $theme['font'], 'size' => 28],
                    'content'    => ['color' => '#828282', 'font' => 'Didact Gothic', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => $theme['color']],
                    'background' => $theme['bg'],
                    'template'   => null,
                ],
                'cover' => [
                    'name'        => ['female' => 'Mempelai Wanita', 'male' => 'Mempelai Pria', 'size' => '60', 'style' => 'default'],
                    'content'     => 'Kami berharap Anda menjadi bagian dari hari istimewa kami!',
                    'button'      => 'Buka Undangan',
                    'description' => [
                        'top'    => 'The Wedding Of',
                        'bottom' => 'Kami Mengundang Anda Untuk Hadir Di Acara Pernikahan Kami.',
                        'image'  => ['method' => 'none', 'image' => ''],
                    ],
                ],
                'profile' => [
                    'name'      => ['female' => 'Nama Mempelai Wanita', 'male' => 'Nama Mempelai Pria'],
                    'photo'     => [
                        'female' => ['method' => 'none', 'frame' => '', 'image' => ''],
                        'male'   => ['method' => 'none', 'frame' => '', 'image' => ''],
                    ],
                    'instagram' => ['show' => false, 'female' => '', 'male' => ''],
                    'parent'    => [
                        'show'   => false,
                        'female' => ['childhood' => '1', 'father' => '', 'mother' => ''],
                        'male'   => ['childhood' => '1', 'father' => '', 'mother' => ''],
                    ],
                ],
                'detail' => [
                    'calendar' => [
                        'save'     => ['content' => 'Simpan Tanggal', 'show' => false],
                        'date'     => '',
                        'time'     => '09:00',
                        'timezone' => 'wib',
                    ],
                    'countdown'  => ['show' => true, 'style' => 'default'],
                    'location'   => ['address' => '', 'map' => ''],
                    'additional' => [
                        'show'    => false,
                        'closing' => 'Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.',
                        'special' => [],
                    ],
                ],
                'additional' => [
                    'live'     => ['show' => false, 'app' => 'youtube', 'link' => '', 'content' => ''],
                    'protocol' => ['show' => false, 'code' => [], 'title' => 'Protokol Kesehatan', 'content' => ''],
                ],
                'quote' => [
                    'content'    => 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu istri-istri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya. — Q.S Ar-Rum: 21',
                    'decoration' => '',
                ],
                'music' => ['title' => '', 'url' => '', 'show' => false],
                'rsvp'  => [
                    'title'   => 'Konfirmasi Kehadiran',
                    'content' => 'Mohon konfirmasi kehadiran Anda',
                    'date'    => '',
                    'yes'     => ['option' => 'Hadir',       'content' => 'Terima kasih, sampai jumpa di acara!'],
                    'no'      => ['option' => 'Tidak Hadir', 'content' => 'Terima kasih, semoga kita bertemu di lain kesempatan.'],
                ],
                'wishes' => ['public' => true, 'title' => 'Ucapan & Doa', 'content' => 'Doa restu Anda merupakan karunia yang sangat berarti bagi kami.'],
                'gift'   => [
                    'show'    => false,
                    'title'   => 'Amplop Digital',
                    'content' => '',
                    'bank'    => ['option' => 'bca', 'code' => '', 'name' => ''],
                ],
            ];

            $tpl = Template::updateOrCreate(
                ['slug' => $slug],
                [
                    'preset'    => json_encode($preset),
                    'user_id'   => 1,
                    'ip_addr'   => '127.0.0.1',
                ]
            );

            // Update template_id di dalam preset
            $preset['design']['template'] = (string) $tpl->id;
            Template::whereId($tpl->id)->update(['preset' => json_encode($preset)]);
        }
    }
}
