<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class EmberInvitesTemplatesSeeder extends Seeder
{
    /**
     * Buat preset lengkap untuk template Blade.
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

    private function templateList(): array
    {
        return [
            [
                'title' => 'Ember Rose',
                'slug'  => 'ember-invites-rose',
                'url'   => 'ember-invites-rose',
                'grade' => 'premium',
                'price' => 0,
                'file'  => 'template/thumbnails/ember-rose.svg',
                'design' => [
                    'title'      => ['color' => '#c86b85', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#6f6a66', 'font' => 'Inter',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#c86b85'],
                    'background' => '#fbf7f2',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Ember Sage',
                'slug'  => 'ember-invites-sage',
                'url'   => 'ember-invites-sage',
                'grade' => 'premium',
                'price' => 0,
                'file'  => 'template/thumbnails/ember-sage.svg',
                'design' => [
                    'title'      => ['color' => '#4f7c73', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#6f6a66', 'font' => 'Inter',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#4f7c73'],
                    'background' => '#fbf7f2',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Ember Navy',
                'slug'  => 'ember-invites-navy',
                'url'   => 'ember-invites-navy',
                'grade' => 'premium',
                'price' => 0,
                'file'  => 'template/thumbnails/ember-navy.svg',
                'design' => [
                    'title'      => ['color' => '#2f4b7c', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#6a717a', 'font' => 'Inter',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#2f4b7c'],
                    'background' => '#f3f5fa',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Ember Lilac',
                'slug'  => 'ember-invites-lilac',
                'url'   => 'ember-invites-lilac',
                'grade' => 'premium',
                'price' => 0,
                'file'  => 'template/thumbnails/ember-lilac.svg',
                'design' => [
                    'title'      => ['color' => '#7a5fa6', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#6f6a66', 'font' => 'Inter',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#7a5fa6'],
                    'background' => '#f7f3fb',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Ember Terracotta',
                'slug'  => 'ember-invites-terracotta',
                'url'   => 'ember-invites-terracotta',
                'grade' => 'premium',
                'price' => 0,
                'file'  => 'template/thumbnails/ember-terracotta.svg',
                'design' => [
                    'title'      => ['color' => '#c97044', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#6f6a66', 'font' => 'Inter',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#c97044'],
                    'background' => '#fbf7f2',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Ember Emerald',
                'slug'  => 'ember-invites-emerald',
                'url'   => 'ember-invites-emerald',
                'grade' => 'premium',
                'price' => 0,
                'file'  => 'template/thumbnails/ember-emerald.svg',
                'design' => [
                    'title'      => ['color' => '#1f7a5e', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#6f6a66', 'font' => 'Inter',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#1f7a5e'],
                    'background' => '#f2fbf7',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Ember Sky',
                'slug'  => 'ember-invites-sky',
                'url'   => 'ember-invites-sky',
                'grade' => 'premium',
                'price' => 0,
                'file'  => 'template/thumbnails/ember-sky.svg',
                'design' => [
                    'title'      => ['color' => '#2f8ccf', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#6f6a66', 'font' => 'Inter',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#2f8ccf'],
                    'background' => '#f1f8fd',
                    'template'   => null,
                ],
            ],
            [
                'title' => 'Ember Charcoal',
                'slug'  => 'ember-invites-charcoal',
                'url'   => 'ember-invites-charcoal',
                'grade' => 'premium',
                'price' => 0,
                'file'  => 'template/thumbnails/ember-charcoal.svg',
                'design' => [
                    'title'      => ['color' => '#1f1f1f', 'font' => 'Cormorant Garamond', 'size' => 28],
                    'content'    => ['color' => '#6c6c6c', 'font' => 'Inter',             'size' => 14],
                    'button'     => ['color' => '#ffffff', 'background' => '#1f1f1f'],
                    'background' => '#fbfbfa',
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

            $data = [
                'title'     => $tplData['title'],
                'url'       => $tplData['url'],
                'grade'     => $tplData['grade'],
                'price'     => $tplData['price'],
                'publish'   => 'publish',
                'file_type' => 'image',
                'file'      => $tplData['file'],
                'preset'    => json_encode($preset),
                'user_id'   => 1,
                'ip_addr'   => '127.0.0.1',
            ];

            $existing = Template::where('slug', $tplData['slug'])->first();

            if ($existing) {
                $existing->update($data);
                $tplId = $existing->id;
                $updated++;
            } else {
                $tpl = Template::create($data + ['slug' => $tplData['slug']]);
                $tplId = $tpl->id;
                $inserted++;
            }

            // Simpan template_id di preset untuk konsistensi (opsional).
            $preset['design']['template'] = (string) $tplId;
            Template::whereId($tplId)->update(['preset' => json_encode($preset)]);
        }

        $this->command?->info("EmberInvitesTemplatesSeeder: {$inserted} inserted, {$updated} updated.");
    }
}

