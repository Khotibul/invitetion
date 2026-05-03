<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class WeddingVariantsSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil preset dari template the-wedding asli sebagai base
        $base = Template::where('slug', 'the-wedding')->first();
        $preset = $base ? $base->preset : json_encode([
            'cover'   => ['name' => ['male' => 'Mempelai Pria', 'female' => 'Mempelai Wanita'], 'content' => 'Undangan Pernikahan', 'button' => 'Buka Undangan', 'description' => ['top' => '', 'bottom' => '', 'image' => ['method' => 'none', 'image' => '']]],
            'profile' => ['name' => ['male' => 'Mempelai Pria', 'female' => 'Mempelai Wanita'], 'photo' => ['male' => ['method' => 'none', 'image' => '', 'frame' => ''], 'female' => ['method' => 'none', 'image' => '', 'frame' => '']], 'instagram' => ['male' => '', 'female' => '', 'show' => false], 'parent' => ['show' => true, 'male' => ['father' => '', 'mother' => '', 'childhood' => '1'], 'female' => ['father' => '', 'mother' => '', 'childhood' => '1']]],
            'detail'  => ['calendar' => ['date' => now()->addMonths(3)->format('Y-m-d'), 'time' => '09:00', 'timezone' => 'wib', 'save' => ['show' => false, 'content' => 'Simpan Tanggal']], 'countdown' => ['show' => true], 'location' => ['address' => '', 'map' => ''], 'additional' => ['show' => false, 'closing' => '']],
            'quote'   => ['content' => ''],
            'music'   => ['show' => false, 'url' => ''],
            'rsvp'    => ['title' => 'Konfirmasi Kehadiran', 'content' => '', 'yes' => ['option' => 'Hadir', 'content' => 'Terima kasih'], 'no' => ['option' => 'Tidak Hadir', 'content' => 'Terima kasih']],
            'gift'    => ['show' => false, 'title' => 'Amplop Digital', 'content' => '', 'bank' => ['name' => '', 'code' => '', 'option' => 'bca']],
            'wishes'  => ['title' => 'Ucapan & Doa', 'content' => '', 'public' => true],
        ]);

        $templates = [
            [
                'title'   => 'The Wedding — Navy',
                'slug'    => 'the-wedding-navy',
                'url'     => 'the-wedding-navy',
                'grade'   => 'premium',
                'publish' => 'publish',
                'file'    => $base?->file ?? 'template/img_bg_1.jpg',
                'preset'  => $preset,
            ],
            [
                'title'   => 'The Wedding — Sage',
                'slug'    => 'the-wedding-sage',
                'url'     => 'the-wedding-sage',
                'grade'   => 'premium',
                'publish' => 'publish',
                'file'    => $base?->file ?? 'template/img_bg_1.jpg',
                'preset'  => $preset,
            ],
        ];

        foreach ($templates as $t) {
            Template::updateOrCreate(['slug' => $t['slug']], $t);
            $this->command->info("✅ Template '{$t['title']}' ({$t['slug']}) selesai.");
        }
    }
}
