<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

/**
 * AllTemplatesSeeder
 * Seed semua 15 template dengan preset lengkap dan akurat
 * sesuai font & warna yang digunakan di masing-masing blade template.
 */
class AllTemplatesSeeder extends Seeder
{
    /**
     * Buat preset lengkap untuk satu template.
     */
    private function makePreset(array $design): array
    {
        return [
            'design' => $design,
            'cover'  => [
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
        // ── Data setiap template: slug, title, url, grade, price, design preset ──
        $templates = [

            // ════════════════════════════════════════════════════════════════
            // THE WEDDING SERIES — Basic
            // Font: Satisfy (judul), Didact Gothic (konten)
            // ════════════════════════════════════════════════════════════════
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
                    'template'   => null,
                ],
            ],
            [
                'title' => 'The Wedding Navy',
                'slug'  => 'the-wedding-navy',
                'url'   => 'the-wedding-navy',
                'grade' => 'basic',
                'price' => 0,
                'design' => [
                    // Navy Blue & Silver — warna dari CSS override di blade
                    'title'      => ['color' => '#1e3a5f', 'font' => 'Merriweather', 'size' => 28],
                    'content'    => ['color' => '#4a5568', 'font' => 'Didact Gothic', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#1e3a5f'],
                    'background' => '#f0f4f8',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'The Wedding Sage',
                'slug'  => 'the-wedding-sage',
                'url'   => 'the-wedding-sage',
                'grade' => 'basic',
                'price' => 0,
                'design' => [
                    // Sage Green & Terracotta — #6b8f71 sage, #c4714a terracotta
                    'title'      => ['color' => '#6b8f71', 'font' => 'Satisfy',      'size' => 32],
                    'content'    => ['color' => '#5a7a6a', 'font' => 'Didact Gothic', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#6b8f71'],
                    'background' => '#f7f3ee',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'The Wedding Pink',
                'slug'  => 'the-wedding-pink',
                'url'   => 'the-wedding-pink',
                'grade' => 'basic',
                'price' => 0,
                'design' => [
                    // Dusty Rose & Blush Pink — #d4a5a5 dusty rose
                    'title'      => ['color' => '#d4a5a5', 'font' => 'Satisfy',      'size' => 32],
                    'content'    => ['color' => '#8a6a6a', 'font' => 'Didact Gothic', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#d4a5a5'],
                    'background' => '#fdf5f5',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'The Wedding Purple',
                'slug'  => 'the-wedding-purple',
                'url'   => 'the-wedding-purple',
                'grade' => 'basic',
                'price' => 0,
                'design' => [
                    // Royal Purple & Lavender — #6b3fa0 purple, #c9a8e0 lavender
                    'title'      => ['color' => '#6b3fa0', 'font' => 'Satisfy',      'size' => 32],
                    'content'    => ['color' => '#7a6a8a', 'font' => 'Didact Gothic', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#6b3fa0'],
                    'background' => '#f5f0fa',
                    'template'   => null,
                ],
            ],

            // ════════════════════════════════════════════════════════════════
            // PREMIUM TEMPLATES
            // ════════════════════════════════════════════════════════════════
            [
                'title' => 'Modern Elegant',
                'slug'  => 'modern-elegant',
                'url'   => 'modern-elegant',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    // Font: Playfair Display (heading), Poppins (body)
                    // Colors: --color-primary:#2d7a4f, --color-gold:#d4af37
                    'title'      => ['color' => '#2d7a4f', 'font' => 'Playfair Display', 'size' => 28],
                    'content'    => ['color' => '#6b7280', 'font' => 'Poppins',          'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#2d7a4f'],
                    'background' => '#e8f5ee',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Minimalist Green',
                'slug'  => 'minimalist-green',
                'url'   => 'minimalist-green',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    // Font: Cormorant Garamond (heading), Montserrat (body)
                    // Colors: --forest-green:#2d5016, --sage-green:#9caf88, --cream:#f5f1e8
                    'title'      => ['color' => '#2d5016', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#4a6741', 'font' => 'Montserrat',         'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#2d5016'],
                    'background' => '#f5f1e8',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Luxury Botanical',
                'slug'  => 'luxury-botanical',
                'url'   => 'luxury-botanical',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    // Font: Cinzel (heading), Lato (body)
                    // Colors: --emerald:#2d7a4f, --gold:#d4af37, --ivory:#fffff0
                    'title'      => ['color' => '#2d7a4f', 'font' => 'Cinzel', 'size' => 26],
                    'content'    => ['color' => '#2c3e50', 'font' => 'Lato',   'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#2d7a4f'],
                    'background' => '#fffff0',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Romantic Garden',
                'slug'  => 'romantic-garden',
                'url'   => 'romantic-garden',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    // Font: Alex Brush (heading), Raleway (body)
                    // Colors: --rose-pink:#2d7a4f (overridden green), --sage-green:#8ba888
                    'title'      => ['color' => '#2d7a4f', 'font' => 'Alex Brush', 'size' => 36],
                    'content'    => ['color' => '#4a6741', 'font' => 'Raleway',    'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#2d7a4f'],
                    'background' => '#faf8f3',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Tropical Paradise',
                'slug'  => 'tropical-paradise',
                'url'   => 'tropical-paradise',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    // Font: Pacifico (heading), Open Sans (body)
                    // Colors: --tropical-green:#00a86b, --ocean-blue:#0077be, --sand:#f4e4c1
                    'title'      => ['color' => '#00a86b', 'font' => 'Pacifico',  'size' => 28],
                    'content'    => ['color' => '#1a6b50', 'font' => 'Open Sans', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#00a86b'],
                    'background' => '#eaf7f0',
                    'template'   => null,
                ],
            ],

            // ════════════════════════════════════════════════════════════════
            // EXCLUSIVE TEMPLATES
            // ════════════════════════════════════════════════════════════════
            [
                'title' => 'Vintage Rustic',
                'slug'  => 'vintage-rustic',
                'url'   => 'vintage-rustic',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    // Font: Crimson Text (heading), Lora (body)
                    // Colors: --vintage-brown:#8b7355, --cream:#f5f1e8, --dark-brown:#5d4e37
                    'title'      => ['color' => '#8b7355', 'font' => 'Crimson Text', 'size' => 28],
                    'content'    => ['color' => '#5d4e37', 'font' => 'Lora',         'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#8b7355'],
                    'background' => '#f5f1e8',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Elegant Gold',
                'slug'  => 'elegant-gold',
                'url'   => 'elegant-gold',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    // Font: Great Vibes (script), Playfair Display (heading), Montserrat (body)
                    // Colors: --gold:#d4af37, --dark:#1a1a1a, --cream:#faf8f3
                    'title'      => ['color' => '#d4af37', 'font' => 'Great Vibes',      'size' => 36],
                    'content'    => ['color' => '#888888', 'font' => 'Montserrat',        'size' => 14],
                    'button'     => ['color' => '#1a1a1a', 'background' => '#d4af37'],
                    'background' => '#1a1a1a',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Islami Gold',
                'slug'  => 'islami-gold',
                'url'   => 'islami-gold',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    // Font: Amiri (Arabic serif), Lato (body), Great Vibes (accent)
                    // Colors: --green-dark:#1a4731, --gold:#c9a84c, --cream:#fdf8f0
                    'title'      => ['color' => '#c9a84c', 'font' => 'Amiri', 'size' => 28],
                    'content'    => ['color' => '#2c2c2c', 'font' => 'Lato',  'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#1a4731'],
                    'background' => '#fdf8f0',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Batik Cream',
                'slug'  => 'batik-cream',
                'url'   => 'batik-cream',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    // Font: Fraunces (heading), Plus Jakarta Sans (body), Great Vibes (accent)
                    // Colors: --cocoa:#2f2622, --latte:#7c665c, --gold:#b88746, --cream:#fbf6ee
                    'title'      => ['color' => '#2f2622', 'font' => 'Fraunces',        'size' => 28],
                    'content'    => ['color' => '#7c665c', 'font' => 'Plus Jakarta Sans','size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#b88746'],
                    'background' => '#fbf6ee',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'White Elegance',
                'slug'  => 'white-elegance',
                'url'   => 'white-elegance',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    // Font: Great Vibes (script), Playfair Display (heading), Lato (body)
                    // Colors: --gold:#c9a84c, --dark:#2c2c2c, --cream:#f5f0e8
                    'title'      => ['color' => '#2c2c2c', 'font' => 'Playfair Display', 'size' => 28],
                    'content'    => ['color' => '#6b6b6b', 'font' => 'Lato',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#c9a84c'],
                    'background' => '#faf9f7',
                    'template'   => null,
                ],
            ],
        ];

        foreach ($templates as $tplData) {
            $preset = $this->makePreset($tplData['design']);

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

            // Update template_id di dalam preset setelah dapat ID dari DB
            $preset['design']['template'] = (string) $tpl->id;
            Template::whereId($tpl->id)->update(['preset' => json_encode($preset)]);
        }
    }
}
