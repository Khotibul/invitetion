<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [
            ['type' => 'address',   'title' => 'Alamat',     'content' => 'Ketikan alamat lengkap kamu disini, lebih akurat lebih baik.'],
            ['type' => 'phone',     'title' => 'Telepon',    'content' => '08100000000'],
            ['type' => 'whatsapp',  'title' => 'Admin',      'content' => '08100000000'],
            ['type' => 'whatsapp',  'title' => 'Finance',    'content' => '08100000000'],
            ['type' => 'whatsapp',  'title' => 'Consultant', 'content' => '08100000000'],
            ['type' => 'email',     'title' => 'E-Mail',     'content' => 'admin@risadigital.com'],
        ];

        foreach ($contacts as $c) {
            Contact::updateOrCreate(
                ['type' => $c['type'], 'title' => $c['title']],
                array_merge($c, ['pinned' => '0', 'actived' => '1', 'user_id' => 1, 'ip_addr' => '127.0.0.1'])
            );
        }
    }
}
