<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class CanvaProTemplateSeeder extends Seeder
{
    private function getBasePreset($customizations = [])
    {
        $base = [
            'couple' => [
                'bride' => [
                    'full_name' => '',
                    'nickname' => '',
                    'father_name' => '',
                    'mother_name' => '',
                    'child_order' => '',
                    'photo' => '',
                    'instagram' => '',
                    'bio' => ''
                ],
                'groom' => [
                    'full_name' => '',
                    'nickname' => '',
                    'father_name' => '',
                    'mother_name' => '',
                    'child_order' => '',
                    'photo' => '',
                    'instagram' => '',
                    'bio' => ''
                ]
            ],
            'events' => [],
            'love_story' => [],
            'gallery' => ['images' => [], 'layout' => 'masonry'],
            'quotes' => [
                'main_quote' => '',
                'quran_reference' => '',
                'additional_quote' => ''
            ],
            'rsvp' => [
                'enabled' => true,
                'deadline' => '',
                'message' => 'Mohon konfirmasi kehadiran Anda',
                'attendance_options' => ['Hadir', 'Tidak Hadir', 'Masih Ragu'],
                'guest_count_enabled' => true,
                'meal_preference_enabled' => false,
                'message_enabled' => true
            ],
            'gift' => [
                'enabled' => true,
                'title' => 'Amplop Digital',
                'message' => 'Kehadiran Anda adalah hadiah terindah',
                'banks' => [],
                'shipping_address' => ['enabled' => false, 'address' => '', 'recipient' => '', 'phone' => '']
            ],
            'wishes' => [
                'enabled' => true,
                'title' => 'Ucapan & Doa',
                'message' => 'Berikan ucapan dan doa untuk kami',
                'moderation' => false,
                'display_public' => true
            ],
            'music' => ['enabled' => true, 'title' => '', 'url' => '', 'autoplay' => false],
            'countdown' => ['enabled' => true, 'target_date' => '', 'style' => 'modern'],
            'health_protocol' => ['enabled' => false, 'message' => '', 'items' => []],
            'live_streaming' => ['enabled' => false, 'platform' => '', 'url' => '', 'message' => ''],
            'footer' => [
                'thank_you_message' => 'Terima kasih atas kehadiran dan doa restu Anda',
                'hashtag' => '',
                'social_media' => ['instagram' => '', 'tiktok' => '']
            ]
        ];

        return array_merge($base, $customizations);
    }

    public function run(): void
    {
        $templates = [
            // 1. Floral Blush
            [
                'title' => 'Floral Blush',
                'slug' => 'floral-blush',
                'preset' => json_encode($this->getBasePreset([
                    'design' => [
                        'title' => ['color' => '#ff6b9d', 'font' => 'Dancing Script'],
                        'content' => ['color' => '#2c2c2c', 'font' => 'Lato'],
                        'button' => ['color' => '#ffffff', 'background' => '#ff6b9d'],
                        'background' => '#fff5f8',
                        'template' => 'floral-blush'
                    ],
                    'cover' => [
                        'opening_text' => 'Undangan Pernikahan',
                        'bride_name' => '',
                        'groom_name' => '',
                        'wedding_date' => '',
                        'cover_image' => '',
                        'opening_quote' => 'Cinta adalah bunga kehidupan',
                        'button_text' => 'Buka Undangan'
                    ]
                ])),
                'file' => 'floral-blush-preview.jpg',
                'url' => 'floral-blush',
                'grade' => 'premium',
                'publish' => 'publish'
            ],

            // 2. Navy Elegance
            [
                'title' => 'Navy Elegance',
                'slug' => 'navy-elegance',
                'preset' => json_encode($this->getBasePreset([
                    'design' => [
                        'title' => ['color' => '#1e3a5f', 'font' => 'Playfair Display'],
                        'content' => ['color' => '#4a4a4a', 'font' => 'Roboto'],
                        'button' => ['color' => '#ffffff', 'background' => '#1e3a5f'],
                        'background' => '#f0f4f8',
                        'template' => 'navy-elegance'
                    ],
                    'cover' => [
                        'opening_text' => 'Wedding Invitation',
                        'bride_name' => '',
                        'groom_name' => '',
                        'wedding_date' => '',
                        'cover_image' => '',
                        'opening_quote' => 'Timeless elegance, eternal love',
                        'button_text' => 'View Invitation'
                    ]
                ])),
                'file' => 'navy-elegance-preview.jpg',
                'url' => 'navy-elegance',
                'grade' => 'premium',
                'publish' => 'publish'
            ],

            // 3. Boho Chic
            [
                'title' => 'Boho Chic',
                'slug' => 'boho-chic',
                'preset' => json_encode($this->getBasePreset([
                    'design' => [
                        'title' => ['color' => '#c17c4a', 'font' => 'Satisfy'],
                        'content' => ['color' => '#5d4e37', 'font' => 'Open Sans'],
                        'button' => ['color' => '#ffffff', 'background' => '#c17c4a'],
                        'background' => '#faf8f3',
                        'template' => 'boho-chic'
                    ],
                    'cover' => [
                        'opening_text' => 'Join Us',
                        'bride_name' => '',
                        'groom_name' => '',
                        'wedding_date' => '',
                        'cover_image' => '',
                        'opening_quote' => 'Wild hearts, free spirits',
                        'button_text' => 'Open'
                    ]
                ])),
                'file' => 'boho-chic-preview.jpg',
                'url' => 'boho-chic',
                'grade' => 'premium',
                'publish' => 'publish'
            ],

            // 4. Classic White
            [
                'title' => 'Classic White',
                'slug' => 'classic-white',
                'preset' => json_encode($this->getBasePreset([
                    'design' => [
                        'title' => ['color' => '#2c2c2c', 'font' => 'Cormorant'],
                        'content' => ['color' => '#666666', 'font' => 'Lato'],
                        'button' => ['color' => '#ffffff', 'background' => '#2c2c2c'],
                        'background' => '#ffffff',
                        'template' => 'classic-white'
                    ],
                    'cover' => [
                        'opening_text' => 'The Wedding',
                        'bride_name' => '',
                        'groom_name' => '',
                        'wedding_date' => '',
                        'cover_image' => '',
                        'opening_quote' => 'Pure love, pure joy',
                        'button_text' => 'Enter'
                    ]
                ])),
                'file' => 'classic-white-preview.jpg',
                'url' => 'classic-white',
                'grade' => 'basic',
                'publish' => 'publish'
            ],

            // 5. Sunset Romance
            [
                'title' => 'Sunset Romance',
                'slug' => 'sunset-romance',
                'preset' => json_encode($this->getBasePreset([
                    'design' => [
                        'title' => ['color' => '#ff6b35', 'font' => 'Pacifico'],
                        'content' => ['color' => '#4a4a4a', 'font' => 'Nunito'],
                        'button' => ['color' => '#ffffff', 'background' => '#ff6b35'],
                        'background' => '#fff8f0',
                        'template' => 'sunset-romance'
                    ],
                    'cover' => [
                        'opening_text' => 'Celebrate With Us',
                        'bride_name' => '',
                        'groom_name' => '',
                        'wedding_date' => '',
                        'cover_image' => '',
                        'opening_quote' => 'Love like a sunset, beautiful and endless',
                        'button_text' => 'See Invitation'
                    ]
                ])),
                'file' => 'sunset-romance-preview.jpg',
                'url' => 'sunset-romance',
                'grade' => 'premium',
                'publish' => 'publish'
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
