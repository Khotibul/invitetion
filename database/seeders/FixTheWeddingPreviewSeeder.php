<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class FixTheWeddingPreviewSeeder extends Seeder
{
    public function run(): void
    {
        Template::where('slug', 'the-wedding')->update([
            'file' => 'template/the-wedding/images/img_bg_1.jpg',
        ]);
    }
}
