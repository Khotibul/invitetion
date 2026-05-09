<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            // Paket 1: Uji Coba (Gratis)
            [
                'title'   => 'Uji Coba',
                'slug'    => 'try',
                'content' => json_encode([
                    'gift'               => false,
                    'e-invitation'       => false,
                    'filter-ig'          => false,
                    'story'              => false,
                    'live-stream'        => false,
                    'private-invitation' => false,
                    'event'              => true,
                    'free-text'          => false,
                    'event-count'        => '2',
                    'story-count'        => '0',
                    'gallery-photo'      => '3',
                    'smart-wa'           => false,
                    'manual-wa'          => true,
                    'guest'              => '10',
                    'gallery-video'      => '0',
                    'music'              => 'template',
                    'template'           => ['basic'],
                    'active'             => '3',
                ]),
                'price'   => '0',
                'grade'   => 0,
                'publish' => 'publish',
                'user_id' => 1,
                'ip_addr' => '127.0.0.1',
            ],

            // Paket 2: Starter
            [
                'title'   => 'Starter',
                'slug'    => 'starter',
                'content' => json_encode([
                    'gift'               => true,
                    'e-invitation'       => false,
                    'filter-ig'          => false,
                    'story'              => true,
                    'live-stream'        => false,
                    'private-invitation' => false,
                    'event'              => true,
                    'free-text'          => false,
                    'event-count'        => '3',
                    'story-count'        => '3',
                    'gallery-photo'      => '10',
                    'smart-wa'           => false,
                    'manual-wa'          => true,
                    'guest'              => '50',
                    'gallery-video'      => '1',
                    'music'              => 'template',
                    'template'           => ['basic'],
                    'active'             => '90',
                ]),
                'price'   => '99000',
                'grade'   => 1,
                'publish' => 'publish',
                'user_id' => 1,
                'ip_addr' => '127.0.0.1',
            ],

            // Paket 3: Basic
            [
                'title'   => 'Basic',
                'slug'    => 'basic',
                'content' => json_encode([
                    'gift'               => true,
                    'e-invitation'       => false,
                    'filter-ig'          => false,
                    'story'              => true,
                    'live-stream'        => false,
                    'private-invitation' => false,
                    'event'              => true,
                    'free-text'          => false,
                    'event-count'        => '5',
                    'story-count'        => '5',
                    'gallery-photo'      => '20',
                    'smart-wa'           => false,
                    'manual-wa'          => true,
                    'guest'              => '100',
                    'gallery-video'      => '1',
                    'music'              => 'template',
                    'template'           => ['basic', 'premium'],
                    'active'             => '180',
                ]),
                'price'   => '149000',
                'grade'   => 2,
                'publish' => 'publish',
                'user_id' => 1,
                'ip_addr' => '127.0.0.1',
            ],

            // Paket 4: Premium
            [
                'title'   => 'Premium',
                'slug'    => 'premium',
                'content' => json_encode([
                    'gift'               => true,
                    'e-invitation'       => true,
                    'filter-ig'          => true,
                    'story'              => true,
                    'live-stream'        => true,
                    'private-invitation' => true,
                    'event'              => true,
                    'free-text'          => true,
                    'event-count'        => 'unlimited',
                    'story-count'        => 'unlimited',
                    'gallery-photo'      => 'unlimited',
                    'smart-wa'           => true,
                    'manual-wa'          => true,
                    'guest'              => 'unlimited',
                    'gallery-video'      => '3',
                    'music'              => 'custom',
                    'template'           => ['basic', 'premium', 'exclusive'],
                    'active'             => '365',
                ]),
                'price'   => '249000',
                'grade'   => 3,
                'publish' => 'publish',
                'user_id' => 1,
                'ip_addr' => '127.0.0.1',
            ],
        ];

        foreach ($packages as $pkg) {
            Package::updateOrCreate(
                ['slug' => $pkg['slug']],
                $pkg
            );
        }
    }
}
