<?php

namespace Database\Seeders;

use App\Models\TemplateAssets;
use Illuminate\Database\Seeder;

/**
 * FontSeeder — tambah/perbarui daftar font untuk pilihan member.
 * Aman dijalankan berulang kali (upsert berdasarkan title+type).
 */
class FontSeeder extends Seeder
{
    public function run(): void
    {
        $fonts = [
            // ── Script / Kaligrafi (cocok untuk nama pasangan)
            ['title' => 'Caveat',           'content' => 'Caveat'],
            ['title' => 'Dancing Script',   'content' => 'Dancing Script'],
            ['title' => 'Great Vibes',      'content' => 'Great Vibes'],
            ['title' => 'Kaushan Script',   'content' => 'Kaushan Script'],
            ['title' => 'Pacifico',         'content' => 'Pacifico'],
            ['title' => 'Satisfy',          'content' => 'Satisfy'],
            ['title' => 'Sacramento',       'content' => 'Sacramento'],
            ['title' => 'Courgette',        'content' => 'Courgette'],
            ['title' => 'Allura',           'content' => 'Allura'],
            ['title' => 'Alex Brush',       'content' => 'Alex Brush'],
            ['title' => 'Pinyon Script',    'content' => 'Pinyon Script'],
            ['title' => 'Tangerine',        'content' => 'Tangerine'],

            // ── Serif Elegan (cocok untuk judul formal)
            ['title' => 'Playfair Display', 'content' => 'Playfair Display'],
            ['title' => 'Cormorant Garamond','content' => 'Cormorant Garamond'],
            ['title' => 'Merriweather',     'content' => 'Merriweather'],
            ['title' => 'Lora',             'content' => 'Lora'],
            ['title' => 'EB Garamond',      'content' => 'EB Garamond'],
            ['title' => 'Libre Baskerville','content' => 'Libre Baskerville'],
            ['title' => 'Crimson Text',     'content' => 'Crimson Text'],

            // ── Sans-serif Modern (cocok untuk konten/deskripsi)
            ['title' => 'Raleway',          'content' => 'Raleway'],
            ['title' => 'Lato',             'content' => 'Lato'],
            ['title' => 'Poppins',          'content' => 'Poppins'],
            ['title' => 'Montserrat',       'content' => 'Montserrat'],
            ['title' => 'Nunito',           'content' => 'Nunito'],
            ['title' => 'Open Sans',        'content' => 'Open Sans'],
            ['title' => 'Roboto',           'content' => 'Roboto'],
            ['title' => 'Josefin Sans',     'content' => 'Josefin Sans'],
            ['title' => 'Quicksand',        'content' => 'Quicksand'],

            // ── Display / Dekoratif
            ['title' => 'Nova Cut',         'content' => 'Nova Cut'],
            ['title' => 'Righteous',        'content' => 'Righteous'],
            ['title' => 'Cinzel',           'content' => 'Cinzel'],
            ['title' => 'Poiret One',       'content' => 'Poiret One'],
            ['title' => 'Josefin Slab',     'content' => 'Josefin Slab'],

            // ── Islami / Arab
            ['title' => 'Amiri',            'content' => 'Amiri'],
            ['title' => 'Scheherazade New', 'content' => 'Scheherazade New'],
        ];

        foreach ($fonts as $font) {
            TemplateAssets::updateOrCreate(
                ['type' => 'font', 'title' => $font['title']],
                [
                    'content' => $font['content'],
                    'publish' => 'publish',
                    'user_id' => 1,
                    'ip_addr' => '127.0.0.1',
                ]
            );
        }
    }
}
