<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class FixTemplateCompatibilitySeeder extends Seeder
{
    public function run(): void
    {
        $templates = Template::all();

        foreach ($templates as $template) {
            $preset = json_decode($template->preset, true);
            
            // Ensure profile structure exists
            if (!isset($preset['profile'])) {
                if (isset($preset['couple'])) {
                    // Create profile from couple
                    $preset['profile'] = [
                        'name' => [
                            'male' => $preset['couple']['groom']['full_name'] ?? $preset['couple']['groom']['nickname'] ?? '',
                            'female' => $preset['couple']['bride']['full_name'] ?? $preset['couple']['bride']['nickname'] ?? ''
                        ],
                        'instagram' => [
                            'male' => $preset['couple']['groom']['instagram'] ?? '',
                            'female' => $preset['couple']['bride']['instagram'] ?? '',
                            'show' => true
                        ],
                        'parent' => [
                            'male' => [
                                'father' => $preset['couple']['groom']['father_name'] ?? '',
                                'mother' => $preset['couple']['groom']['mother_name'] ?? '',
                                'childhood' => '1'
                            ],
                            'female' => [
                                'father' => $preset['couple']['bride']['father_name'] ?? '',
                                'mother' => $preset['couple']['bride']['mother_name'] ?? '',
                                'childhood' => '1'
                            ],
                            'show' => true
                        ],
                        'photo' => [
                            'male' => [
                                'method' => 'avatar',
                                'frame' => null,
                                'image' => $preset['couple']['groom']['photo'] ?? '9d348c30-9331-11ec-b089-ad70ef6b2563.png'
                            ],
                            'female' => [
                                'method' => 'avatar',
                                'frame' => null,
                                'image' => $preset['couple']['bride']['photo'] ?? '4a1f7960-9331-11ec-8fa8-a3a23f6da840.png'
                            ]
                        ]
                    ];
                } else {
                    // Create default profile
                    $preset['profile'] = [
                        'name' => ['male' => '', 'female' => ''],
                        'instagram' => ['male' => '', 'female' => '', 'show' => true],
                        'parent' => [
                            'male' => ['father' => '', 'mother' => '', 'childhood' => '1'],
                            'female' => ['father' => '', 'mother' => '', 'childhood' => '1'],
                            'show' => true
                        ],
                        'photo' => [
                            'male' => ['method' => 'avatar', 'frame' => null, 'image' => '9d348c30-9331-11ec-b089-ad70ef6b2563.png'],
                            'female' => ['method' => 'avatar', 'frame' => null, 'image' => '4a1f7960-9331-11ec-8fa8-a3a23f6da840.png']
                        ]
                    ];
                }
            }
            
            // Ensure couple structure exists
            if (!isset($preset['couple']) && isset($preset['profile'])) {
                $preset['couple'] = [
                    'bride' => [
                        'full_name' => $preset['profile']['name']['female'] ?? '',
                        'nickname' => $preset['cover']['name']['female'] ?? '',
                        'father_name' => $preset['profile']['parent']['female']['father'] ?? '',
                        'mother_name' => $preset['profile']['parent']['female']['mother'] ?? '',
                        'child_order' => 'Putri pertama',
                        'photo' => $preset['profile']['photo']['female']['image'] ?? '',
                        'instagram' => $preset['profile']['instagram']['female'] ?? '',
                        'bio' => ''
                    ],
                    'groom' => [
                        'full_name' => $preset['profile']['name']['male'] ?? '',
                        'nickname' => $preset['cover']['name']['male'] ?? '',
                        'father_name' => $preset['profile']['parent']['male']['father'] ?? '',
                        'mother_name' => $preset['profile']['parent']['male']['mother'] ?? '',
                        'child_order' => 'Putra pertama',
                        'photo' => $preset['profile']['photo']['male']['image'] ?? '',
                        'instagram' => $preset['profile']['instagram']['male'] ?? '',
                        'bio' => ''
                    ]
                ];
            }
            
            $template->preset = json_encode($preset);
            $template->save();
            
            echo "✅ Fixed: {$template->title}\n";
        }
        
        echo "\n✅ All templates fixed!\n";
    }
}
