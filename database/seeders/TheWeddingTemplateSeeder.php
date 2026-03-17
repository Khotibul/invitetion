<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TheWeddingTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preset = [
            'design' => [
                'title' => ['color' => '#bf9b73', 'font' => 'Sacramento'],
                'content' => ['color' => '#828282', 'font' => 'Didact Gothic'],
                'button' => ['color' => '#ffffff', 'background' => '#bf9b73'],
                'background' => '#ffffff',
                'template' => null,
            ],
            'cover' => [
                'name' => ['female' => 'Juliet', 'male' => 'Romeo', 'size' => '60', 'style' => 'normal'],
                'content' => 'Kami berharap Anda menjadi bagian dari hari istimewa kami!',
                'button' => 'Buka Undangan',
                'description' => [
                    'top' => 'The Wedding Of',
                    'bottom' => 'Kami Mengundang Anda Untuk Hadir Di Acara Pernikahan Kami.',
                    'image' => ['method' => null, 'image' => null],
                ],
            ],
            'profile' => [
                'name' => ['female' => 'Nama Mempelai Wanita', 'male' => 'Nama Mempelai Pria'],
                'parent' => [
                    'show' => true,
                    'female' => ['childhood' => 'Kedua', 'father' => 'Bapak Mempelai Wanita', 'mother' => 'Ibu Mempelai Wanita'],
                    'male' => ['childhood' => 'Keempat', 'father' => 'Bapak Mempelai Pria', 'mother' => 'Ibu Mempelai Pria'],
                ],
                'photo' => [
                    'female' => ['method' => null, 'frame' => null, 'image' => null],
                    'male' => ['method' => null, 'frame' => null, 'image' => null],
                ],
                'instagram' => ['show' => true, 'female' => 'instagram_wanita', 'male' => 'instagram_pria'],
            ],
            'detail' => [
                'calendar' => [
                    'save' => ['content' => 'Save the date', 'show' => true],
                    'date' => '2026-12-31',
                    'time' => '09:00',
                    'timezone' => 'wib',
                ],
                'countdown' => ['show' => true, 'style' => 'default'],
                'location' => ['address' => 'Lokasi Pernikahan, Kota, Provinsi', 'map' => 'https://goo.gl/maps/placeholder'],
                'additional' => [
                    'show' => true,
                    'closing' => 'Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu. Atas kehadiran dan doa restunya, kami mengucapkan terima kasih.',
                    'special' => [],
                ],
            ],
            'additional' => [
                'live' => ['show' => false, 'app' => 'youtube', 'link' => '', 'content' => ''],
                'protocol' => ['show' => false, 'code' => null, 'title' => 'Protokol Kesehatan', 'content' => ''],
            ],
            'quote' => [
                'show' => true,
                'content' => 'Dan di antara tanda-tanda kekuasaan-Nya lah Dia menciptakan untukmu istri-istri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berfikir. - Q.S Ar Rum : 21 -',
            ],
            'music' => ['title' => 'Beautiful In White', 'url' => 'https://ngodingsolusi.github.io/the-wedding-of-rehan-maulidan/music/Beautiful%20In%20White.mp3', 'show' => true],
            'rsvp' => [
                'title' => 'Konfirmasi Kehadiran',
                'content' => 'Mohon konfirmasi kehadiran Anda',
                'date' => '2026-12-25',
                'yes' => ['option' => 'Hadir', 'content' => 'Terima kasih, sampai jumpa di acara!'],
                'no' => ['option' => 'Tidak Hadir', 'content' => 'Terima kasih, semoga kita bertemu di lain kesempatan.'],
            ],
            'wishes' => ['public' => true, 'title' => 'Buku Tamu & Ucapan', 'content' => 'Doa Restu Anda merupakan karunia yang sangat berarti bagi kami.'],
            'gift' => [
                'show' => false,
                'title' => 'Kirim Hadiah',
                'content' => 'Tanpa mengurangi rasa hormat, bagi anda yang ingin memberikan tanda kasih untuk kami, dapat melalui:',
                'bank' => ['option' => 'Bank', 'code' => '1234567890', 'name' => 'Nama Pemilik Rekening'],
            ],
        ];

        $template = Template::updateOrCreate(
            ['slug' => 'the-wedding'],
            [
                'title' => 'The Wedding',
                'preset' => json_encode($preset),
                'file' => 'template/the-wedding/images/readme/half%20circle-200.png',
                'file_type' => 'image',
                'url' => 'the-wedding',
                'grade' => 'basic',
                'publish' => 'publish',
            ]
        );

        $preset['design']['template'] = (string) $template->id;
        Template::whereId($template->id)->update(['preset' => json_encode($preset)]);
    }
}
