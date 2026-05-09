<?php

namespace Database\Seeders;

use App\Models\TemplateAssets;
use Illuminate\Database\Seeder;

/**
 * FontSeeder — tambah font pilihan member (di luar font bawaan template).
 * Font bawaan template sudah di-seed oleh TemplateAssetSeeder.
 * Aman dijalankan berulang kali (updateOrCreate).
 */
class FontSeeder extends Seeder
{
    public function run(): void
    {
        $fonts = [
            // ── Script / Kaligrafi
            ['title' => 'Allura',            'content' => 'Allura'],
            ['title' => 'Pinyon Script',     'content' => 'Pinyon Script'],
            ['title' => 'Tangerine',         'content' => 'Tangerine'],
            ['title' => 'Petit Formal Script','content' => 'Petit Formal Script'],
            ['title' => 'Herr Von Muellerhoff','content' => 'Herr Von Muellerhoff'],

            // ── Serif Elegan
            ['title' => 'EB Garamond',       'content' => 'EB Garamond'],
            ['title' => 'Libre Baskerville', 'content' => 'Libre Baskerville'],
            ['title' => 'Cardo',             'content' => 'Cardo'],
            ['title' => 'Spectral',          'content' => 'Spectral'],
            ['title' => 'Gilda Display',     'content' => 'Gilda Display'],

            // ── Sans-serif Modern
            ['title' => 'Nunito',            'content' => 'Nunito'],
            ['title' => 'Roboto',            'content' => 'Roboto'],
            ['title' => 'Josefin Sans',      'content' => 'Josefin Sans'],
            ['title' => 'Quicksand',         'content' => 'Quicksand'],
            ['title' => 'DM Sans',           'content' => 'DM Sans'],
            ['title' => 'Inter',             'content' => 'Inter'],

            // ── Display / Dekoratif
            ['title' => 'Poiret One',        'content' => 'Poiret One'],
            ['title' => 'Josefin Slab',      'content' => 'Josefin Slab'],
            ['title' => 'Italiana',          'content' => 'Italiana'],
            ['title' => 'Philosopher',       'content' => 'Philosopher'],

            // ── Islami / Arab
            ['title' => 'Scheherazade New',  'content' => 'Scheherazade New'],
            ['title' => 'Noto Naskh Arabic', 'content' => 'Noto Naskh Arabic'],
        ];

        foreach ($fonts as $font) {
            TemplateAssets::updateOrCreate(
                ['type' => 'font', 'title' => $font['title']],
                [
                    'type'    => 'font',
                    'content' => $font['content'],
                    'publish' => 'publish',
                    'user_id' => 1,
                    'ip_addr' => '127.0.0.1',
                ]
            );
        }
    }
}
