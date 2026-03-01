<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class UpdateExistingTemplatesSeeder extends Seeder
{
    private function getEnhancedPreset($oldPreset, $templateSlug)
    {
        $old = json_decode($oldPreset, true);
        
        // Enhanced structure
        $enhanced = [
            'design' => $old['design'] ?? [],
            'cover' => array_merge([
                'opening_text' => 'Undangan Pernikahan',
                'bride_name' => $old['profile']['name']['female'] ?? '',
                'groom_name' => $old['profile']['name']['male'] ?? '',
                'bride_nickname' => $old['cover']['name']['female'] ?? '',
                'groom_nickname' => $old['cover']['name']['male'] ?? '',
                'wedding_date' => $old['detail']['calendar']['date'] ?? '',
                'cover_image' => $old['cover']['description']['image']['image'] ?? '',
                'opening_quote' => $old['cover']['description']['top'] ?? '',
                'button_text' => $old['cover']['button'] ?? 'Buka Undangan'
            ], $old['cover'] ?? []),
            
            'couple' => [
                'bride' => [
                    'full_name' => $old['profile']['name']['female'] ?? '',
                    'nickname' => $old['cover']['name']['female'] ?? '',
                    'father_name' => $old['profile']['parent']['female']['father'] ?? '',
                    'mother_name' => $old['profile']['parent']['female']['mother'] ?? '',
                    'child_order' => 'Putri pertama',
                    'photo' => $old['profile']['photo']['female']['image'] ?? '',
                    'instagram' => $old['profile']['instagram']['female'] ?? '',
                    'bio' => 'Mempelai wanita'
                ],
                'groom' => [
                    'full_name' => $old['profile']['name']['male'] ?? '',
                    'nickname' => $old['cover']['name']['male'] ?? '',
                    'father_name' => $old['profile']['parent']['male']['father'] ?? '',
                    'mother_name' => $old['profile']['parent']['male']['mother'] ?? '',
                    'child_order' => 'Putra pertama',
                    'photo' => $old['profile']['photo']['male']['image'] ?? '',
                    'instagram' => $old['profile']['instagram']['male'] ?? '',
                    'bio' => 'Mempelai pria'
                ]
            ],
            
            'events' => [
                [
                    'name' => 'Akad Nikah',
                    'date' => $old['detail']['calendar']['date'] ?? '',
                    'time_start' => $old['detail']['calendar']['time'] ?? '08:00',
                    'time_end' => '10:00',
                    'timezone' => strtoupper($old['detail']['calendar']['timezone'] ?? 'WIB'),
                    'venue_name' => 'Tempat Acara',
                    'venue_address' => $old['detail']['location']['address'] ?? '',
                    'venue_map_url' => $old['detail']['location']['map'] ?? '',
                    'dress_code' => 'Formal',
                    'notes' => 'Khusus keluarga'
                ],
                [
                    'name' => 'Resepsi',
                    'date' => $old['detail']['calendar']['date'] ?? '',
                    'time_start' => '11:00',
                    'time_end' => '14:00',
                    'timezone' => strtoupper($old['detail']['calendar']['timezone'] ?? 'WIB'),
                    'venue_name' => 'Tempat Acara',
                    'venue_address' => $old['detail']['location']['address'] ?? '',
                    'venue_map_url' => $old['detail']['location']['map'] ?? '',
                    'dress_code' => 'Formal',
                    'notes' => 'Terbuka untuk umum'
                ]
            ],
            
            'love_story' => [
                ['year' => '2020', 'title' => 'Pertemuan Pertama', 'description' => 'Kami bertemu di...', 'image' => ''],
                ['year' => '2022', 'title' => 'Kencan Pertama', 'description' => 'Kencan pertama kami di...', 'image' => ''],
                ['year' => '2024', 'title' => 'Lamaran', 'description' => 'Dia melamar di...', 'image' => ''],
                ['year' => '2026', 'title' => 'Pernikahan', 'description' => 'Akhirnya kami menikah', 'image' => '']
            ],
            
            'gallery' => [
                'images' => [],
                'layout' => 'masonry'
            ],
            
            'quotes' => [
                'main_quote' => $old['quote']['content'] ?? '',
                'quran_reference' => 'QS. Ar-Rum: 21',
                'additional_quote' => ''
            ],
            
            'rsvp' => [
                'enabled' => true,
                'deadline' => $old['rsvp']['date'] ?? '',
                'message' => $old['rsvp']['content'] ?? 'Mohon konfirmasi kehadiran Anda',
                'attendance_options' => [
                    $old['rsvp']['yes']['option'] ?? 'Hadir',
                    $old['rsvp']['no']['option'] ?? 'Tidak Hadir',
                    'Masih Ragu'
                ],
                'guest_count_enabled' => true,
                'meal_preference_enabled' => false,
                'message_enabled' => true
            ],
            
            'gift' => [
                'enabled' => $old['gift']['show'] ?? true,
                'title' => $old['gift']['title'] ?? 'Amplop Digital',
                'message' => $old['gift']['content'] ?? 'Kehadiran Anda adalah hadiah terindah',
                'banks' => [
                    [
                        'bank_name' => strtoupper($old['gift']['bank']['option'] ?? 'BCA'),
                        'account_number' => $old['gift']['bank']['code'] ?? '',
                        'account_name' => $old['gift']['bank']['name'] ?? '',
                        'qr_code' => ''
                    ]
                ],
                'shipping_address' => [
                    'enabled' => false,
                    'address' => '',
                    'recipient' => '',
                    'phone' => ''
                ]
            ],
            
            'wishes' => [
                'enabled' => true,
                'title' => $old['wishes']['title'] ?? 'Ucapan & Doa',
                'message' => $old['wishes']['content'] ?? 'Berikan ucapan dan doa untuk kami',
                'moderation' => false,
                'display_public' => $old['wishes']['public'] ?? true
            ],
            
            'music' => [
                'enabled' => $old['music']['show'] ?? true,
                'title' => $old['music']['title'] ?? '',
                'url' => $old['music']['url'] ?? '',
                'autoplay' => false
            ],
            
            'countdown' => [
                'enabled' => $old['detail']['countdown']['show'] ?? true,
                'target_date' => ($old['detail']['calendar']['date'] ?? '') . ' ' . ($old['detail']['calendar']['time'] ?? '08:00') . ':00',
                'style' => $old['detail']['countdown']['style'] ?? 'modern'
            ],
            
            'health_protocol' => [
                'enabled' => $old['additional']['protocol']['show'] ?? false,
                'message' => $old['additional']['protocol']['content'] ?? '',
                'items' => []
            ],
            
            'live_streaming' => [
                'enabled' => $old['additional']['live']['show'] ?? false,
                'platform' => $old['additional']['live']['app'] ?? '',
                'url' => $old['additional']['live']['link'] ?? '',
                'message' => $old['additional']['live']['content'] ?? ''
            ],
            
            'footer' => [
                'thank_you_message' => $old['detail']['additional']['closing'] ?? 'Terima kasih atas kehadiran dan doa restu Anda',
                'hashtag' => '',
                'social_media' => [
                    'instagram' => '',
                    'tiktok' => ''
                ]
            ]
        ];
        
        return json_encode($enhanced);
    }

    public function run(): void
    {
        $templates = Template::whereIn('slug', [
            'modern-elegant',
            'minimalist-green',
            'luxury-botanical',
            'romantic-garden',
            'tropical-paradise',
            'vintage-rustic'
        ])->get();

        foreach ($templates as $template) {
            $template->preset = $this->getEnhancedPreset($template->preset, $template->slug);
            $template->save();
            echo "✅ Updated: {$template->title}\n";
        }
    }
}
