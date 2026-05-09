<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        $defaultPreset = json_encode([
            'design' => [
                'title'      => ['color' => '#000000', 'font' => 'Dancing Script', 'size' => 24],
                'content'    => ['color' => '#333333', 'font' => 'Raleway', 'size' => 14],
                'button'     => ['color' => '#ffffff', 'background' => '#2d7a4f'],
                'background' => '#ffffff',
                'template'   => null,
            ],
            'cover' => [
                'name'        => ['female' => 'Mempelai Wanita', 'male' => 'Mempelai Pria', 'size' => '48', 'style' => 'default'],
                'content'     => 'Undangan Pernikahan',
                'button'      => 'Buka Undangan',
                'description' => [
                    'top'    => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh',
                    'bottom' => 'Wa\'alaikumussalaam Warahmatullahi Wabarakatuh',
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
                    'show'   => false,
                    'male'   => ['father' => '', 'mother' => '', 'childhood' => '1'],
                    'female' => ['father' => '', 'mother' => '', 'childhood' => '1'],
                ],
            ],
            'detail' => [
                'calendar'   => ['date' => '', 'time' => '09:00', 'timezone' => 'wib', 'save' => ['show' => false, 'content' => 'Simpan Tanggal']],
                'countdown'  => ['show' => true, 'style' => 'default'],
                'location'   => ['address' => '', 'map' => ''],
                'additional' => ['show' => false, 'closing' => '', 'special' => []],
            ],
            'quote'  => ['content' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya.', 'decoration' => ''],
            'music'  => ['show' => false, 'title' => '', 'url' => ''],
            'rsvp'   => ['title' => 'Konfirmasi Kehadiran', 'content' => '', 'date' => '', 'yes' => ['option' => 'Hadir', 'content' => 'Terima kasih'], 'no' => ['option' => 'Tidak Hadir', 'content' => 'Terima kasih']],
            'gift'   => ['show' => false, 'title' => 'Amplop Digital', 'content' => '', 'bank' => ['name' => '', 'code' => '', 'option' => 'bca']],
            'wishes' => ['title' => 'Ucapan & Doa', 'content' => '', 'public' => true],
            'additional' => [
                'live'     => ['show' => false, 'app' => '', 'link' => '', 'content' => ''],
                'protocol' => ['show' => false, 'code' => [], 'title' => '', 'content' => ''],
            ],
        ]);

        $templates = [
            [
                'title'   => 'The Wedding',
                'slug'    => 'the-wedding',
                'url'     => 'the-wedding',
                'grade'   => 'basic',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'The Wedding Navy',
                'slug'    => 'the-wedding-navy',
                'url'     => 'the-wedding-navy',
                'grade'   => 'basic',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'The Wedding Sage',
                'slug'    => 'the-wedding-sage',
                'url'     => 'the-wedding-sage',
                'grade'   => 'basic',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'The Wedding Pink',
                'slug'    => 'the-wedding-pink',
                'url'     => 'the-wedding-pink',
                'grade'   => 'basic',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'The Wedding Purple',
                'slug'    => 'the-wedding-purple',
                'url'     => 'the-wedding-purple',
                'grade'   => 'basic',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'Modern Elegant',
                'slug'    => 'modern-elegant',
                'url'     => 'modern-elegant',
                'grade'   => 'premium',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'Minimalist Green',
                'slug'    => 'minimalist-green',
                'url'     => 'minimalist-green',
                'grade'   => 'premium',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'Luxury Botanical',
                'slug'    => 'luxury-botanical',
                'url'     => 'luxury-botanical',
                'grade'   => 'premium',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'Romantic Garden',
                'slug'    => 'romantic-garden',
                'url'     => 'romantic-garden',
                'grade'   => 'premium',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'Tropical Paradise',
                'slug'    => 'tropical-paradise',
                'url'     => 'tropical-paradise',
                'grade'   => 'premium',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'Vintage Rustic',
                'slug'    => 'vintage-rustic',
                'url'     => 'vintage-rustic',
                'grade'   => 'exclusive',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'Elegant Gold',
                'slug'    => 'elegant-gold',
                'url'     => 'elegant-gold',
                'grade'   => 'exclusive',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'Islami Gold',
                'slug'    => 'islami-gold',
                'url'     => 'islami-gold',
                'grade'   => 'exclusive',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'Batik Cream',
                'slug'    => 'batik-cream',
                'url'     => 'batik-cream',
                'grade'   => 'exclusive',
                'publish' => 'publish',
                'price'   => 0,
            ],
            [
                'title'   => 'White Elegance',
                'slug'    => 'white-elegance',
                'url'     => 'white-elegance',
                'grade'   => 'exclusive',
                'publish' => 'publish',
                'price'   => 0,
            ],
        ];

        foreach ($templates as $tpl) {
            Template::updateOrCreate(
                ['slug' => $tpl['slug']],
                array_merge($tpl, [
                    'preset'    => $defaultPreset,
                    'file_type' => 'image',
                    'user_id'   => 1,
                    'ip_addr'   => '127.0.0.1',
                ])
            );
        }
    }
}
