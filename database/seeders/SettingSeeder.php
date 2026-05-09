<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['type' => 'title',            'title' => 'Judul Tab',         'content' => 'Risa Digital Invitation'],
            ['type' => 'icon',             'title' => 'Ikon Tab',          'content' => null],
            ['type' => 'logo',             'title' => 'Logo',              'content' => null],
            ['type' => 'color',            'title' => 'Warna Latar Tab',   'content' => '#2d7a4f'],
            ['type' => 'meta description', 'title' => 'Meta Description',  'content' => 'Risa Digital Invitation — Buat undangan pernikahan digital yang elegan dan modern.'],
            ['type' => 'meta keywords',    'title' => 'Meta Keywords',     'content' => 'undangan digital, undangan pernikahan, wedding invitation, digital invitation'],
            ['type' => 'maintenance',      'title' => 'Pemeliharaan',      'content' => 'off'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(
                ['type' => $s['type']],
                array_merge($s, ['user_id' => 1, 'ip_addr' => '127.0.0.1'])
            );
        }
    }
}
