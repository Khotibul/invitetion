<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

/**
 * AllTemplatesSeeder
 * Seed semua template dengan preset lengkap dan akurat sesuai desain masing-masing.
 * Aman dijalankan berulang kali (updateOrCreate).
 */
class AllTemplatesSeeder extends Seeder
{
    /**
     * Preset default yang dipakai semua template sebagai base.
     */
    private function basePreset(array $design, string $titleFont, string $contentFont): array
    {
        return [
            'design' => array_merge([
                'title'      => ['color' => '#000000', 'font' => $titleFont,   'size' => 28],
                'content'    => ['color' => '#555555', 'font' => $contentFont, 'size' => 14],
                'button'     => ['color' => '#ffffff', 'background' => '#2d7a4f'],
                'background' => '#ffffff',
                'template'   => null,
            ], $design),
            'cover' => [
                'name'        => ['female' => 'Mempelai Wanita', 'male' => 'Mempelai Pria', 'size' => '60', 'style' => 'default'],
                'content'     => 'Kami mengundang kehadiran Bapak/Ibu/Saudara/i di hari istimewa kami.',
                'button'      => 'Buka Undangan',
                'description' => [
                    'top'    => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh',
                    'bottom' => 'Wa\'alaikumussalaam Warahmatullahi Wabarakatuh',
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
                    'closing' => 'Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.',
                    'special' => [],
                ],
            ],
            'additional' => [
                'live'     => ['show' => false, 'app' => 'youtube', 'link' => '', 'content' => ''],
                'protocol' => ['show' => false, 'code' => [], 'title' => 'Protokol Kesehatan', 'content' => ''],
            ],
            'quote' => [
                'content'    => 'Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu istri-istri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya di antaramu rasa kasih dan sayang. — Q.S Ar-Rum: 21',
                'decoration' => '',
            ],
            'music' => ['title' => '', 'url' => '', 'show' => false],
            'rsvp'  => [
                'title'   => 'Konfirmasi Kehadiran',
                'content' => 'Mohon konfirmasi kehadiran Anda sebelum acara.',
                'date'    => '',
                'yes'     => ['option' => 'Hadir',       'content' => 'Terima kasih, sampai jumpa di acara!'],
                'no'      => ['option' => 'Tidak Hadir', 'content' => 'Terima kasih, semoga kita bertemu di lain kesempatan.'],
            ],
            'wishes' => ['public' => true, 'title' => 'Ucapan & Doa', 'content' => 'Doa restu Anda merupakan karunia yang sangat berarti bagi kami.'],
            'gift'   => [
                'show'    => false,
                'title'   => 'Amplop Digital',
                'content' => 'Tanpa mengurangi rasa hormat, bagi yang ingin memberikan tanda kasih dapat melalui:',
                'bank'    => ['option' => 'bca', 'code' => '', 'name' => ''],
            ],
        ];
    }

    public function run(): void
    {
        $templates = [
            // ── THE WEDDING SERIES (Basic) ────────────────────────────────────
            [
                'title' => 'The Wedding',
                'slug'  => 'the-wedding',
                'url'   => 'the-wedding',
                'grade' => 'basic',
                'price' => 0,
                'file'  => 'template/the-wedding/images/readme/half%20circle-200.png',
                'design' => [
                    'title'      => ['color' => '#bf9b73', 'font' => 'Satisfy',      'size' => 32],
                    'content'    => ['color' => '#828282', 'font' => 'Didact Gothic', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#bf9b73'],
                    'background' => '#fdf8f3',
                ],
                'title_font' => 'Satisfy', 'content_font' => 'Didact Gothic',
            ],
            [
                'title' => 'The Wedding Navy',
                'slug'  => 'the-wedding-navy',
                'url'   => 'the-wedding-navy',
                'grade' => 'basic',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#1e3a5f', 'font' => 'Merriweather', 'size' => 28],
                    'content'    => ['color' => '#4a5568', 'font' => 'Didact Gothic', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#1e3a5f'],
                    'background' => '#f0f4f8',
                ],
                'title_font' => 'Merriweather', 'content_font' => 'Didact Gothic',
            ],
            [
                'title' => 'The Wedding Sage',
                'slug'  => 'the-wedding-sage',
                'url'   => 'the-wedding-sage',
                'grade' => 'basic',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#4a7c59', 'font' => 'Satisfy',      'size' => 32],
                    'content'    => ['color' => '#5a7a6a', 'font' => 'Didact Gothic', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#4a7c59'],
                    'background' => '#f0f7f2',
                ],
                'title_font' => 'Satisfy', 'content_font' => 'Didact Gothic',
            ],
            [
                'title' => 'The Wedding Pink',
                'slug'  => 'the-wedding-pink',
                'url'   => 'the-wedding-pink',
                'grade' => 'basic',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#c48080', 'font' => 'Satisfy',      'size' => 32],
                    'content'    => ['color' => '#8a6a6a', 'font' => 'Didact Gothic', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#c48080'],
                    'background' => '#fdf0f0',
                ],
                'title_font' => 'Satisfy', 'content_font' => 'Didact Gothic',
            ],
            [
                'title' => 'The Wedding Purple',
                'slug'  => 'the-wedding-purple',
                'url'   => 'the-wedding-purple',
                'grade' => 'basic',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#6b3fa0', 'font' => 'Satisfy',      'size' => 32],
                    'content'    => ['color' => '#7a6a8a', 'font' => 'Didact Gothic', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#6b3fa0'],
                    'background' => '#f5f0fa',
                ],
                'title_font' => 'Satisfy', 'content_font' => 'Didact Gothic',
            ],

            // ── PREMIUM TEMPLATES ─────────────────────────────────────────────
            [
                'title' => 'Modern Elegant',
                'slug'  => 'modern-elegant',
                'url'   => 'modern-elegant',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#2d7a4f', 'font' => 'Playfair Display', 'size' => 28],
                    'content'    => ['color' => '#6b7280', 'font' => 'Poppins',          'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#2d7a4f'],
                    'background' => '#e8f5ee',
                ],
                'title_font' => 'Playfair Display', 'content_font' => 'Poppins',
            ],
            [
                'title' => 'Minimalist Green',
                'slug'  => 'minimalist-green',
                'url'   => 'minimalist-green',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#2d5016', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#4a6741', 'font' => 'Montserrat',         'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#2d5016'],
                    'background' => '#f5f1e8',
                ],
                'title_font' => 'Cormorant Garamond', 'content_font' => 'Montserrat',
            ],
            [
                'title' => 'Luxury Botanical',
                'slug'  => 'luxury-botanical',
                'url'   => 'luxury-botanical',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#1c2b1a', 'font' => 'Cinzel', 'size' => 26],
                    'content'    => ['color' => '#3a5c35', 'font' => 'Lato',   'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#1c2b1a'],
                    'background' => '#f0ebe0',
                ],
                'title_font' => 'Cinzel', 'content_font' => 'Lato',
            ],
            [
                'title' => 'Romantic Garden',
                'slug'  => 'romantic-garden',
                'url'   => 'romantic-garden',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#8c3050', 'font' => 'Dancing Script', 'size' => 32],
                    'content'    => ['color' => '#6b4a55', 'font' => 'Lato',           'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#8c3050'],
                    'background' => '#fdf0f4',
                ],
                'title_font' => 'Dancing Script', 'content_font' => 'Lato',
            ],
            [
                'title' => 'Tropical Paradise',
                'slug'  => 'tropical-paradise',
                'url'   => 'tropical-paradise',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#0d4f3c', 'font' => 'Pacifico', 'size' => 28],
                    'content'    => ['color' => '#1a6b50', 'font' => 'Lato',     'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#0d4f3c'],
                    'background' => '#e8f7f2',
                ],
                'title_font' => 'Pacifico', 'content_font' => 'Lato',
            ],

            // ── EXCLUSIVE TEMPLATES ───────────────────────────────────────────
            [
                'title' => 'Vintage Rustic',
                'slug'  => 'vintage-rustic',
                'url'   => 'vintage-rustic',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#5c3d2e', 'font' => 'Playfair Display', 'size' => 28],
                    'content'    => ['color' => '#7a5c4a', 'font' => 'Lato',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#5c3d2e'],
                    'background' => '#fdf6ec',
                ],
                'title_font' => 'Playfair Display', 'content_font' => 'Lato',
            ],
            [
                'title' => 'Elegant Gold',
                'slug'  => 'elegant-gold',
                'url'   => 'elegant-gold',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#d4af37', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#b8960c', 'font' => 'Lato',               'size' => 14],
                    'button'     => ['color' => '#000000', 'background' => '#d4af37'],
                    'background' => '#0a0800',
                ],
                'title_font' => 'Cormorant Garamond', 'content_font' => 'Lato',
            ],
            [
                'title' => 'Islami Gold',
                'slug'  => 'islami-gold',
                'url'   => 'islami-gold',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#d4af37', 'font' => 'Amiri', 'size' => 28],
                    'content'    => ['color' => '#8a7a50', 'font' => 'Lato',  'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#1a2a1a'],
                    'background' => '#f5f0e8',
                ],
                'title_font' => 'Amiri', 'content_font' => 'Lato',
            ],
            [
                'title' => 'Batik Cream',
                'slug'  => 'batik-cream',
                'url'   => 'batik-cream',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#2f2622', 'font' => 'Playfair Display', 'size' => 28],
                    'content'    => ['color' => '#5c4a3a', 'font' => 'Lato',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#b88746'],
                    'background' => '#fbf6ee',
                ],
                'title_font' => 'Playfair Display', 'content_font' => 'Lato',
            ],
            [
                'title' => 'White Elegance',
                'slug'  => 'white-elegance',
                'url'   => 'white-elegance',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#1a1a1a', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#555555', 'font' => 'Lato',               'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#1a1a1a'],
                    'background' => '#f5f5f5',
                ],
                'title_font' => 'Cormorant Garamond', 'content_font' => 'Lato',
            ],
        ];

        foreach ($templates as $tplData) {
            $titleFont   = $tplData['title_font'];
            $contentFont = $tplData['content_font'];
            $design      = $tplData['design'];

            $preset = $this->basePreset(['title' => $design['title'], 'content' => $design['content'], 'button' => $design['button'], 'background' => $design['background']], $titleFont, $contentFont);

            $tpl = Template::updateOrCreate(
                ['slug' => $tplData['slug']],
                [
                    'title'     => $tplData['title'],
                    'url'       => $tplData['url'],
                    'grade'     => $tplData['grade'],
                    'price'     => $tplData['price'],
                    'publish'   => 'publish',
                    'file'      => $tplData['file'] ?? null,
                    'file_type' => 'image',
                    'preset'    => json_encode($preset),
                    'user_id'   => 1,
                    'ip_addr'   => '127.0.0.1',
                ]
            );

            // Update template_id di dalam preset setelah dapat ID
            $preset['design']['template'] = (string) $tpl->id;
            Template::whereId($tpl->id)->update(['preset' => json_encode($preset)]);
        }
    }
}
