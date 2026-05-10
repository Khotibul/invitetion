<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

/**
 * StorageService — wrapper untuk Storage::disk('public').
 * Semua file disimpan di disk public (storage/app/public).
 *
 * URL storage di hosting cPanel:
 * - Symlink: public/storage → storage/app/public
 * - URL: https://domain.com/storage/filename.jpg
 *
 * Pastikan sudah jalankan: php artisan storage:link
 */
class StorageService
{
    public static function put(string $path, $contents, array $options = []): bool
    {
        return Storage::disk('public')->put($path, $contents, $options);
    }

    public static function delete(string $path): bool
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }

    public static function exists(string $path): bool
    {
        return Storage::disk('public')->exists($path);
    }

    /**
     * Generate URL untuk file di storage/app/public.
     * Menggunakan APP_URL dari config agar benar di semua environment.
     */
    public static function url(string $path): string
    {
        // Gunakan Storage::disk('public')->url() yang membaca APP_URL dari config
        // Ini lebih reliable daripada url() helper
        return Storage::disk('public')->url(ltrim($path, '/'));
    }

    public static function disk(): string
    {
        return 'public';
    }
}
