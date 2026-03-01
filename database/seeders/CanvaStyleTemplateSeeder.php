<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class CanvaStyleTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'title'     => 'Elegant Gold',
                'slug'      => 'elegant-gold',
                'preset'    => json_encode([
                    'design' => [
                        'title' => ['color' => '#d4af37', 'font' => 'Great Vibes'],
                        'content' => ['color' => '#1a1a1a', 'font' => 'Montserrat'],
                        'button' => ['color' => '#ffffff', 'background' => '#d4af37'],
                        'background' => '#f8f6f0',
                        'template' => 'elegant-gold'
                    ],
                    'cover' => [
                        'opening_text' => 'The Wedding of',
                        'bride_name' => 'Bride Name',
                        'groom_name' => 'Groom Name',
                        'bride_nickname' => 'Bride',
                        'groom_nickname' => 'Groom',
                        'wedding_date' => '2026-12-31',
                        'cover_image' => 'couple-elegant.jpg',
                        'opening_quote' => 'Two souls, one heart',
                        'button_text' => 'Open Invitation'
                    ],
                    'couple' => [
                        'bride' => [
                            'full_name' => 'Full Name of Bride',
                            'nickname' => 'Bride',
                            'father_name' => 'Father Name',
                            'mother_name' => 'Mother Name',
                            'child_order' => 'First daughter',
                            'photo' => 'bride.jpg',
                            'instagram' => '@bride',
                            'bio' => 'Short bio about the bride'
                        ],
                        'groom' => [
                            'full_name' => 'Full Name of Groom',
                            'nickname' => 'Groom',
                            'father_name' => 'Father Name',
                            'mother_name' => 'Mother Name',
                            'child_order' => 'First son',
                            'photo' => 'groom.jpg',
                            'instagram' => '@groom',
                            'bio' => 'Short bio about the groom'
                        ]
                    ],
                    'events' => [
                        [
                            'name' => 'Akad Nikah',
                            'date' => '2026-12-31',
                            'time_start' => '08:00',
                            'time_end' => '10:00',
                            'timezone' => 'WIB',
                            'venue_name' => 'Masjid Al-Ikhlas',
                            'venue_address' => 'Jl. Contoh No. 123, Jakarta',
                            'venue_map_url' => 'https://maps.google.com/',
                            'dress_code' => 'Formal, Muslimah',
                            'notes' => 'Khusus keluarga'
                        ],
                        [
                            'name' => 'Resepsi',
                            'date' => '2026-12-31',
                            'time_start' => '11:00',
                            'time_end' => '14:00',
                            'timezone' => 'WIB',
                            'venue_name' => 'Gedung Serbaguna',
                            'venue_address' => 'Jl. Resepsi No. 456, Jakarta',
                            'venue_map_url' => 'https://maps.google.com/',
                            'dress_code' => 'Formal',
                            'notes' => 'Terbuka untuk umum'
                        ]
                    ],
                    'love_story' => [
                        [
                            'year' => '2020',
                            'title' => 'First Meet',
                            'description' => 'We met at a coffee shop on a rainy day',
                            'image' => 'story1.jpg'
                        ],
                        [
                            'year' => '2022',
                            'title' => 'First Date',
                            'description' => 'Our first official date at the beach',
                            'image' => 'story2.jpg'
                        ],
                        [
                            'year' => '2024',
                            'title' => 'Engagement',
                            'description' => 'He proposed under the stars',
                            'image' => 'story3.jpg'
                        ],
                        [
                            'year' => '2026',
                            'title' => 'Wedding Day',
                            'description' => 'Finally tying the knot',
                            'image' => 'story4.jpg'
                        ]
                    ],
                    'gallery' => [
                        'images' => [
                            'gallery1.jpg',
                            'gallery2.jpg',
                            'gallery3.jpg',
                            'gallery4.jpg',
                            'gallery5.jpg',
                            'gallery6.jpg'
                        ],
                        'layout' => 'masonry'
                    ],
                    'quotes' => [
                        'main_quote' => 'And of His signs is that He created for you from yourselves mates that you may find tranquility in them',
                        'quran_reference' => 'QS. Ar-Rum: 21',
                        'additional_quote' => 'Love is patient, love is kind'
                    ],
                    'rsvp' => [
                        'enabled' => true,
                        'deadline' => '2026-12-25',
                        'message' => 'Please confirm your attendance',
                        'attendance_options' => ['Hadir', 'Tidak Hadir', 'Masih Ragu'],
                        'guest_count_enabled' => true,
                        'meal_preference_enabled' => false,
                        'message_enabled' => true
                    ],
                    'gift' => [
                        'enabled' => true,
                        'title' => 'Wedding Gift',
                        'message' => 'Your presence is the greatest gift, but if you wish to honor us with a gift',
                        'banks' => [
                            [
                                'bank_name' => 'BCA',
                                'account_number' => '1234567890',
                                'account_name' => 'Bride & Groom',
                                'qr_code' => 'qr-bca.jpg'
                            ],
                            [
                                'bank_name' => 'Mandiri',
                                'account_number' => '0987654321',
                                'account_name' => 'Bride & Groom',
                                'qr_code' => 'qr-mandiri.jpg'
                            ]
                        ],
                        'shipping_address' => [
                            'enabled' => true,
                            'address' => 'Jl. Hadiah No. 789, Jakarta 12345',
                            'recipient' => 'Bride & Groom',
                            'phone' => '08123456789'
                        ]
                    ],
                    'wishes' => [
                        'enabled' => true,
                        'title' => 'Wedding Wishes',
                        'message' => 'Leave your wishes and prayers for us',
                        'moderation' => false,
                        'display_public' => true
                    ],
                    'music' => [
                        'enabled' => true,
                        'title' => 'Perfect - Ed Sheeran',
                        'url' => 'music/perfect.mp3',
                        'autoplay' => false
                    ],
                    'countdown' => [
                        'enabled' => true,
                        'target_date' => '2026-12-31 08:00:00',
                        'style' => 'elegant'
                    ],
                    'health_protocol' => [
                        'enabled' => false,
                        'message' => 'Please follow health protocols',
                        'items' => ['Wear mask', 'Maintain distance', 'Wash hands']
                    ],
                    'live_streaming' => [
                        'enabled' => false,
                        'platform' => 'YouTube',
                        'url' => 'https://youtube.com/live',
                        'message' => 'Watch our wedding live'
                    ],
                    'footer' => [
                        'thank_you_message' => 'Thank you for being part of our special day',
                        'hashtag' => '#BrideAndGroom2026',
                        'social_media' => [
                            'instagram' => '@weddingaccount',
                            'tiktok' => '@weddingaccount'
                        ]
                    ]
                ]),
                'file'      => 'elegant-gold-preview.jpg',
                'url'       => 'elegant-gold',
                'grade'     => 'exclusive',
                'publish'   => 'publish'
            ]
        ];

        foreach ($templates as $template) {
            Template::updateOrCreate(
                ['slug' => $template['slug']],
                $template
            );
        }
    }
}
