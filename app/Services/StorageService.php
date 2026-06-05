<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    private const DISK = 'public';

    public static function put(string $path, $contents, array $options = []): bool
    {
        return Storage::disk(self::DISK)->put($path, $contents, $options);
    }

    public static function delete(string $path): bool
    {
        if (Storage::disk(self::DISK)->exists($path)) {
            return Storage::disk(self::DISK)->delete($path);
        }

        return false;
    }

    public static function exists(string $path): bool
    {
        return Storage::disk(self::DISK)->exists($path);
    }

    public static function url(string $path): string
    {
        return Storage::disk(self::DISK)->url(ltrim($path, '/'));
    }

    public static function publicLinkReady(): bool
    {
        $link = realpath(public_path('storage'));
        $target = realpath(storage_path('app/public'));

        return $link !== false && $target !== false && $link === $target;
    }

    public static function disk(): string
    {
        return self::DISK;
    }
}
