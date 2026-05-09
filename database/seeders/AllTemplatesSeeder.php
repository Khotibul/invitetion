<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * AllTemplatesSeeder
 * Seed semua 19 template dengan preset lengkap dan akurat
 * sesuai font & warna yang digunakan di masing-masing blade template.
 *
 * Jalankan: php artisan db:seed --class=AllTemplatesSeeder
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

    /**
     * Definisi semua 19 template.
     */
    private function templateList(): array
    {
        return [
            // ════════════════════════════════════════════════════════════════
            // THE WEDDING SERIES — Basic (5 template)
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
                    'title'      => ['color' => '#6b3fa0', 'font' => 'Satisfy',      'size' => 32],
                    'content'    => ['color' => '#7a6a8a', 'font' => 'Didact Gothic', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#6b3fa0'],
                    'background' => '#f5f0fa',
                    'template'   => null,
                ],
            ],

            // ════════════════════════════════════════════════════════════════
            // PREMIUM TEMPLATES (7 template)
            // ════════════════════════════════════════════════════════════════
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
                    'title'      => ['color' => '#00a86b', 'font' => 'Pacifico',  'size' => 28],
                    'content'    => ['color' => '#1a6b50', 'font' => 'Open Sans', 'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#00a86b'],
                    'background' => '#eaf7f0',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Gold Luxe',
                'slug'  => 'template-1',
                'url'   => 'template-1',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#c9a84c', 'font' => 'Cormorant Garamond', 'size' => 30],
                    'content'    => ['color' => '#7a7a7a', 'font' => 'Jost',               'size' => 14],
                    'button'     => ['color' => '#0f0f0f', 'background' => '#c9a84c'],
                    'background' => '#faf7f0',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Green Minimal',
                'slug'  => 'template-2',
                'url'   => 'template-2',
                'grade' => 'premium',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#2d7a4f', 'font' => 'DM Serif Display', 'size' => 28],
                    'content'    => ['color' => '#6b7c6d', 'font' => 'DM Sans',          'size' => 14],
                    'button'     => ['color' => '#1c2b1e', 'background' => '#8fad91'],
                    'background' => '#f7f9f7',
                    'template'   => null,
                ],
            ],

            // ════════════════════════════════════════════════════════════════
            // EXCLUSIVE TEMPLATES (7 template)
            // ════════════════════════════════════════════════════════════════
            [
                'title' => 'Vintage Rustic',
                'slug'  => 'vintage-rustic',
                'url'   => 'vintage-rustic',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
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
                    'title'      => ['color' => '#d4af37', 'font' => 'Great Vibes', 'size' => 36],
                    'content'    => ['color' => '#888888', 'font' => 'Montserrat',  'size' => 14],
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
                    'title'      => ['color' => '#2f2622', 'font' => 'Fraunces',         'size' => 28],
                    'content'    => ['color' => '#7c665c', 'font' => 'Plus Jakarta Sans', 'size' => 14],
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
                    'title'      => ['color' => '#2c2c2c', 'font' => 'Playfair Display', 'size' => 28],
                    'content'    => ['color' => '#6b6b6b', 'font' => 'Lato',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#c9a84c'],
                    'background' => '#faf9f7',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Rose Blush',
                'slug'  => 'template-3',
                'url'   => 'template-3',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#b5838d', 'font' => 'Libre Baskerville', 'size' => 28],
                    'content'    => ['color' => '#8a7a7d', 'font' => 'Nunito',            'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#b5838d'],
                    'background' => '#fdf0f2',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Forest Green',
                'slug'  => 'template-4',
                'url'   => 'template-4',
                'grade' => 'exclusive',
                'price' => 0,
                'design' => [
                    'title'      => ['color' => '#4a7c59', 'font' => 'Fraunces', 'size' => 28],
                    'content'    => ['color' => '#6b7c6d', 'font' => 'Inter',    'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#4a7c59'],
                    'background' => '#f5f0e8',
                    'template'   => null,
                ],
            ],
        ];
    }

    public function run(): void
    {
        $templates = $this->templateList();
        $inserted  = 0;
        $updated   = 0;

        foreach ($templates as $tplData) {
            $preset = $this->makePreset($tplData['design']);

            // Cek apakah sudah ada (berdasarkan slug)
            $existing = Template::where('slug', $tplData['slug'])->first();

            $data = [
                'title'     => $tplData['title'],
                'url'       => $tplData['url'],
                'grade'     => $tplData['grade'],
                'price'     => $tplData['price'],
                'publish'   => 'publish',
                'file_type' => 'image',
                'user_id'   => 1,
                'ip_addr'   => '127.0.0.1',
            ];

            // Hanya set file jika ada
            if (!empty($tplData['file'])) {
                $data['file'] = $tplData['file'];
            }

            if ($existing) {
                // Update — pertahankan file yang sudah ada jika tidak ada file baru
                $existing->update(array_merge($data, ['preset' => json_encode($preset)]));
                $tplId = $existing->id;
                $updated++;
            } else {
                // Insert baru
                $data['slug']   = $tplData['slug'];
                $data['preset'] = json_encode($preset);
                $tpl = Template::create($data);
                $tplId = $tpl->id;
                $inserted++;
            }

            // Update template_id di dalam preset
            $preset['design']['template'] = (string) $tplId;
            Template::whereId($tplId)->update(['preset' => json_encode($preset)]);
        }

        $this->command->info("AllTemplatesSeeder: {$inserted} inserted, {$updated} updated. Total: " . ($inserted + $updated));
    }
}
