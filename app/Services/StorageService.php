<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

/**
 * StorageService — wrapper untuk Storage::disk('public').
 * Semua file disimpan di disk public (storage/app/public).
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

    public static function url(string $path): string
    {
        return url('storage/' . ltrim($path, '/'));
    }

    public static function disk(): string
    {
        return 'public';
    }
}
