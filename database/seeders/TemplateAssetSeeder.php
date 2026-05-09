<?php

namespace Database\Seeders;

use App\Models\TemplateAssets;
use Illuminate\Database\Seeder;

/**
 * TemplateAssetSeeder — seed aset dasar template.
 * Font lengkap ada di FontSeeder.
 * Seeder ini fokus pada avatar default dan quote default.
 */
class TemplateAssetSeeder extends Seeder
{
    public function run(): void
    {
        // ── Quote default
        $quotes = [
            [
                'type'    => 'quote',
                'title'   => 'QS. An-Nur: 32',
                'content' => 'Dan nikahkanlah orang-orang yang masih membujang di antara kamu, dan juga orang-orang yang layak (menikah) dari hamba-hamba sahayamu yang laki-laki dan perempuan. Jika mereka miskin, Allah akan memberi kemampuan kepada mereka dengan karunia-Nya.',
            ],
            [
                'type'    => 'quote',
                'title'   => 'QS. Ar-Rum: 21',
                'content' => 'Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang.',
            ],
            [
                'type'    => 'quote',
                'title'   => 'QS. Al-Baqarah: 187',
                'content' => 'Mereka adalah pakaian bagimu, dan kamu adalah pakaian bagi mereka.',
            ],
        ];

        foreach ($quotes as $q) {
            TemplateAssets::updateOrCreate(
                ['type' => $q['type'], 'title' => $q['title']],
                array_merge($q, ['publish' => 'publish', 'user_id' => 1, 'ip_addr' => '127.0.0.1'])
            );
        }
    }
}
