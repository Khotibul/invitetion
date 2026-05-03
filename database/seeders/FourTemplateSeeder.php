<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class FourTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $preset = json_encode([
            'cover' => [
                'name'        => ['male' => 'Mempelai Pria', 'female' => 'Mempelai Wanita', 'size' => '48', 'style' => 'default'],
                'content'     => 'Undangan Pernikahan',
                'button'      => 'Buka Undangan',
                'description' => [
                    'top'    => 'Dengan penuh kebahagiaan',
                    'bottom' => 'Kami mengundang kehadiran Anda',
                    'image'  => ['method' => 'none', 'image' => ''],
                ],
            ],
            'profile' => [
                'name'      => ['male' => 'Mempelai Pria', 'female' => 'Mempelai Wanita'],
                'photo'     => [
                    'male'   => ['method' => 'none', 'image' => '', 'frame' => ''],
                    'female' => ['method' => 'none', 'image' => '', 'frame' => ''],
                ],
                'instagram' => ['male' => '', 'female' => '', 'show' => false],
                'parent'    => [
                    'show'   => true,
                    'male'   => ['father' => 'Bapak', 'mother' => 'Ibu', 'childhood' => '1'],
                    'female' => ['father' => 'Bapak', 'mother' => 'Ibu', 'childhood' => '1'],
                ],
            ],
            'detail' => [
                'calendar'   => ['date' => now()->addMonths(3)->format('Y-m-d'), 'time' => '09:00', 'timezone' => 'wib', 'save' => ['show' => false, 'content' => 'Simpan Tanggal']],
                'countdown'  => ['show' => true, 'style' => 'default'],
                'location'   => ['address' => '', 'map' => ''],
                'additional' => ['show' => false, 'closing' => '', 'special' => []],
            ],
            'quote'   => ['content' => 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu istri-istri dari jenismu sendiri. (QS. Ar-Rum: 21)', 'decoration' => ''],
            'music'   => ['show' => false, 'title' => '', 'url' => ''],
            'rsvp'    => ['title' => 'Konfirmasi Kehadiran', 'content' => '', 'date' => '', 'yes' => ['option' => 'Hadir', 'content' => 'Terima kasih'], 'no' => ['option' => 'Tidak Hadir', 'content' => 'Terima kasih']],
            'gift'    => ['show' => false, 'title' => 'Amplop Digital', 'content' => '', 'bank' => ['name' => '', 'code' => '', 'option' => 'bca']],
            'wishes'  => ['title' => 'Ucapan & Doa', 'content' => '', 'public' => true],
        ]);

        $templates = [
            [
                'title'   => 'Gold Luxe',
                'slug'    => 'template-1',
                'url'     => 'template-1',
                'grade'   => 'premium',
                'publish' => 'publish',
                'file'    => 'template/img_bg_1.jpg',
                'preset'  => $preset,
            ],
            [
                'title'   => 'Forest Green',
                'slug'    => 'template-2',
                'url'     => 'template-2',
                'grade'   => 'premium',
                'publish' => 'publish',
                'file'    => 'template/img_bg_1.jpg',
                'preset'  => $preset,
            ],
            [
                'title'   => 'Blush Rose',
                'slug'    => 'template-3',
                'url'     => 'template-3',
                'grade'   => 'premium',
                'publish' => 'publish',
                'file'    => 'template/img_bg_1.jpg',
                'preset'  => $preset,
            ],
            [
                'title'   => 'Sage & Sand',
                'slug'    => 'template-4',
                'url'     => 'template-4',
                'grade'   => 'premium',
                'publish' => 'publish',
                'file'    => 'template/img_bg_1.jpg',
                'preset'  => $preset,
            ],
        ];

        foreach ($templates as $t) {
            Template::updateOrCreate(['slug' => $t['slug']], $t);
            $this->command->info("✅ Template '{$t['title']}' ({$t['slug']}) selesai.");
        }
    }
}
