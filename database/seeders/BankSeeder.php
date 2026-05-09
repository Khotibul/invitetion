<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

/**
 * BankSeeder — seed daftar bank untuk amplop digital.
 */
class BankSeeder extends Seeder
{
    public function run(): void
    {
        $banks = [
            ['name' => 'BCA',       'content' => 'bca',       'file' => 'bca.png'],
            ['name' => 'BNI',       'content' => 'bni',       'file' => 'bni.png'],
            ['name' => 'BRI',       'content' => 'bri',       'file' => 'bri.png'],
            ['name' => 'Mandiri',   'content' => 'mandiri',   'file' => 'mandiri.png'],
            ['name' => 'BSI',       'content' => 'bsi',       'file' => 'bsi.png'],
            ['name' => 'CIMB',      'content' => 'cimb',      'file' => 'cimb.png'],
            ['name' => 'Danamon',   'content' => 'danamon',   'file' => 'danamon.png'],
            ['name' => 'Permata',   'content' => 'permata',   'file' => 'permata.png'],
            ['name' => 'BTN',       'content' => 'btn',       'file' => 'btn.png'],
            ['name' => 'GoPay',     'content' => 'gopay',     'file' => 'gopay.png'],
            ['name' => 'OVO',       'content' => 'ovo',       'file' => 'ovo.png'],
            ['name' => 'Dana',      'content' => 'dana',      'file' => 'dana.png'],
            ['name' => 'ShopeePay', 'content' => 'shopeepay', 'file' => 'shopeepay.png'],
        ];

        foreach ($banks as $bank) {
            Bank::updateOrCreate(
                ['content' => $bank['content']],
                array_merge($bank, [
                    'type'    => 'member',
                    'publish' => 'publish',
                    'user_id' => 1,
                    'ip_addr' => '127.0.0.1',
                ])
            );
        }
    }
}
