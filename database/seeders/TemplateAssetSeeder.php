<?php

namespace Database\Seeders;

use App\Models\TemplateAssets;
use Illuminate\Database\Seeder;

/**
 * TemplateAssetSeeder
 * Seed semua aset template: quote, font bawaan template, dan dekorasi.
 * Dijalankan setelah UserSeeder.
 */
class TemplateAssetSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. QUOTE ISLAMI ──────────────────────────────────────────────────
        $quotes = [
            [
                'title'   => 'QS. An-Nur: 32',
                'content' => 'Dan nikahkanlah orang-orang yang masih membujang di antara kamu, dan juga orang-orang yang layak (menikah) dari hamba-hamba sahayamu yang laki-laki dan perempuan. Jika mereka miskin, Allah akan memberi kemampuan kepada mereka dengan karunia-Nya.',
            ],
            [
                'title'   => 'QS. Ar-Rum: 21',
                'content' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
            ],
            [
                'title'   => 'QS. Al-Baqarah: 187',
                'content' => 'Mereka adalah pakaian bagimu, dan kamu adalah pakaian bagi mereka.',
            ],
            [
                'title'   => 'QS. Al-Hujurat: 13',
                'content' => 'Hai manusia, sesungguhnya Kami menciptakan kamu dari seorang laki-laki dan seorang perempuan dan menjadikan kamu berbangsa-bangsa dan bersuku-suku supaya kamu saling kenal-mengenal.',
            ],
            [
                'title'   => 'QS. An-Nisa: 1',
                'content' => 'Hai sekalian manusia, bertakwalah kepada Tuhan-mu yang telah menciptakan kamu dari seorang diri, dan dari padanya Allah menciptakan isterinya; dan dari pada keduanya Allah memperkembang biakkan laki-laki dan perempuan yang banyak.',
            ],
            [
                'title'   => 'Hadits Riwayat Ibnu Majah',
                'content' => 'Tidak ada yang lebih bermanfaat bagi dua orang yang saling mencintai selain pernikahan.',
            ],
        ];

        foreach ($quotes as $q) {
            TemplateAssets::updateOrCreate(
                ['type' => 'quote', 'title' => $q['title']],
                array_merge($q, ['type' => 'quote', 'publish' => 'publish', 'user_id' => 1, 'ip_addr' => '127.0.0.1'])
            );
        }

        // ── 2. FONT BAWAAN TEMPLATE (yang sudah di-load oleh template) ───────
        // Font ini tersedia tanpa perlu load ulang dari Google Fonts
        $templateFonts = [
            // The Wedding series
            ['title' => 'Didact Gothic',    'content' => 'Didact Gothic'],
            ['title' => 'Sacramento',       'content' => 'Sacramento'],
            ['title' => 'Estonia',          'content' => 'Estonia'],
            ['title' => 'Oswald',           'content' => 'Oswald'],
            ['title' => 'Yanone Kaffeesatz','content' => 'Yanone Kaffeesatz'],
            ['title' => 'Dancing Script',   'content' => 'Dancing Script'],
            ['title' => 'Satisfy',          'content' => 'Satisfy'],
            ['title' => 'Merriweather',     'content' => 'Merriweather'],
            ['title' => 'Courgette',        'content' => 'Courgette'],
            // Modern Elegant
            ['title' => 'Playfair Display', 'content' => 'Playfair Display'],
            ['title' => 'Poppins',          'content' => 'Poppins'],
            // Minimalist Green
            ['title' => 'Cormorant Garamond','content' => 'Cormorant Garamond'],
            ['title' => 'Montserrat',       'content' => 'Montserrat'],
            // Luxury Botanical
            ['title' => 'Cinzel',           'content' => 'Cinzel'],
            ['title' => 'Lato',             'content' => 'Lato'],
            // Romantic Garden
            ['title' => 'Alex Brush',       'content' => 'Alex Brush'],
            ['title' => 'Raleway',          'content' => 'Raleway'],
            // Tropical Paradise
            ['title' => 'Pacifico',         'content' => 'Pacifico'],
            ['title' => 'Open Sans',        'content' => 'Open Sans'],
            // Vintage Rustic
            ['title' => 'Crimson Text',     'content' => 'Crimson Text'],
            ['title' => 'Lora',             'content' => 'Lora'],
            // Elegant Gold / White Elegance
            ['title' => 'Great Vibes',      'content' => 'Great Vibes'],
            // Islami Gold
            ['title' => 'Amiri',            'content' => 'Amiri'],
            // Batik Cream
            ['title' => 'Fraunces',         'content' => 'Fraunces'],
            ['title' => 'Plus Jakarta Sans','content' => 'Plus Jakarta Sans'],
            // template-1 (Gold Luxe)
            ['title' => 'Jost',                'content' => 'Jost'],
            // template-2 (Green Minimal)
            ['title' => 'DM Serif Display',    'content' => 'DM Serif Display'],
            ['title' => 'DM Sans',             'content' => 'DM Sans'],
            // template-3 (Rose Blush)
            ['title' => 'Libre Baskerville',   'content' => 'Libre Baskerville'],
            ['title' => 'Nunito',              'content' => 'Nunito'],
            // template-4 (Forest Green)
            ['title' => 'Inter',               'content' => 'Inter'],
            // Tambahan populer
            ['title' => 'Caveat',           'content' => 'Caveat'],
            ['title' => 'Kaushan Script',   'content' => 'Kaushan Script'],
            ['title' => 'Nova Cut',         'content' => 'Nova Cut'],
            ['title' => 'Righteous',        'content' => 'Righteous'],
        ];

        foreach ($templateFonts as $font) {
            TemplateAssets::updateOrCreate(
                ['type' => 'font', 'title' => $font['title']],
                array_merge($font, ['type' => 'font', 'publish' => 'publish', 'user_id' => 1, 'ip_addr' => '127.0.0.1'])
            );
        }
    }
}
