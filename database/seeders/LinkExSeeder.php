<?php

namespace Database\Seeders;

use App\Models\LinkExternal;
use Illuminate\Database\Seeder;

class LinkExSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            // Social media
            ['type' => 'social', 'brand' => 'instagram', 'title' => 'Instagram', 'url' => 'https://instagram.com/', 'icon' => 'bx bxl-instagram'],
            ['type' => 'social', 'brand' => 'facebook',  'title' => 'Facebook',  'url' => 'https://facebook.com/', 'icon' => 'bx bxl-facebook'],
            ['type' => 'social', 'brand' => 'twitter',   'title' => 'Twitter',   'url' => 'https://twitter.com/',  'icon' => 'bx bxl-twitter'],
            ['type' => 'social', 'brand' => 'tiktok',    'title' => 'TikTok',    'url' => 'https://tiktok.com/',   'icon' => 'bx bxl-tiktok'],
            ['type' => 'social', 'brand' => 'youtube',   'title' => 'YouTube',   'url' => 'https://youtube.com/',  'icon' => 'bx bxl-youtube'],
            ['type' => 'social', 'brand' => 'whatsapp',  'title' => 'WhatsApp',  'url' => 'https://whatsapp.com/', 'icon' => 'bx bxl-whatsapp'],
            ['type' => 'social', 'brand' => 'telegram',  'title' => 'Telegram',  'url' => 'https://telegram.com/', 'icon' => 'bx bxl-telegram'],
            ['type' => 'social', 'brand' => 'discord',   'title' => 'Discord',   'url' => 'https://discord.com/',  'icon' => 'bx bxl-discord'],
            ['type' => 'social', 'brand' => 'linkedin',  'title' => 'LinkedIn',  'url' => 'https://linkedin.com/', 'icon' => 'bx bxl-linkedin'],
            ['type' => 'social', 'brand' => 'pinterest', 'title' => 'Pinterest', 'url' => 'https://pinterest.com/','icon' => 'bx bxl-pinterest'],
            ['type' => 'social', 'brand' => 'snapchat',  'title' => 'Snapchat',  'url' => 'https://snapchat.com/', 'icon' => 'bx bxl-snapchat'],
            ['type' => 'social', 'brand' => 'twitch',    'title' => 'Twitch',    'url' => 'https://twitch.tv/',    'icon' => 'bx bxl-twitch'],
            // E-commerce
            ['type' => 'ecommerce', 'brand' => 'tokopedia',  'title' => 'Tokopedia',  'url' => 'https://tokopedia.com/',  'icon' => 'tokopedia.png'],
            ['type' => 'ecommerce', 'brand' => 'shopee',     'title' => 'Shopee',     'url' => 'https://shopee.co.id/',   'icon' => 'shopee.png'],
            ['type' => 'ecommerce', 'brand' => 'lazada',     'title' => 'Lazada',     'url' => 'https://lazada.co.id/',   'icon' => 'lazada.png'],
            ['type' => 'ecommerce', 'brand' => 'bukalapak',  'title' => 'Bukalapak',  'url' => 'https://bukalapak.com/',  'icon' => 'bukalapak.png'],
            ['type' => 'ecommerce', 'brand' => 'blibli',     'title' => 'Blibli',     'url' => 'https://blibli.com/',     'icon' => 'blibli.png'],
            ['type' => 'ecommerce', 'brand' => 'tiktokshop', 'title' => 'TikTok Shop','url' => 'https://shop.tiktok.com/','icon' => 'tiktokshop.png'],
        ];

        foreach ($links as $link) {
            LinkExternal::updateOrCreate(
                ['type' => $link['type'], 'brand' => $link['brand']],
                array_merge($link, ['actived' => '0', 'user_id' => 1, 'ip_addr' => '127.0.0.1'])
            );
        }
    }
}
