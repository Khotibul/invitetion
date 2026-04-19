<?php

/**
 * Vercel PHP Runtime Entry Point
 * Laravel + Neon PostgreSQL
 */

define('LARAVEL_START', microtime(true));

$projectRoot = dirname(__DIR__);
chdir($projectRoot);

// Pastikan storage/logs bisa ditulis (Vercel pakai /tmp)
$tmpStorage = '/tmp/storage';
foreach (['logs', 'framework/cache/data', 'framework/sessions', 'framework/views'] as $dir) {
    $path = $tmpStorage . '/' . $dir;
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
}

// Override storage path ke /tmp agar writable di Vercel
$_ENV['APP_STORAGE_PATH'] = $tmpStorage;

require $projectRoot . '/vendor/autoload.php';

$app = require_once $projectRoot . '/bootstrap/app.php';

// Arahkan storage ke /tmp
$app->useStoragePath($tmpStorage);

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
