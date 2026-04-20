<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    /**
     * Simpan file ke disk aktif (R2 atau public).
     */
    public static function put(string $path, $contents, array $options = []): bool
    {
        return Storage::disk(self::disk())->put($path, $contents, $options);
    }

    /**
     * Hapus file dari disk aktif.
     */
    public static function delete(string $path): bool
    {
        return Storage::disk(self::disk())->delete($path);
    }

    /**
     * Cek apakah file ada.
     */
    public static function exists(string $path): bool
    {
        return Storage::disk(self::disk())->exists($path);
    }

    /**
     * Ambil public URL file.
     * - R2: pakai R2_URL (custom domain / r2.dev)
     * - local: pakai /storage/...
     */
    public static function url(string $path): string
    {
        $disk = self::disk();

        if ($disk === 'r2') {
            $base = rtrim(config('filesystems.disks.r2.url', ''), '/');
            return $base . '/' . ltrim($path, '/');
        }

        return Storage::disk('public')->url($path);
    }

    /**
     * Disk yang aktif.
     */
    public static function disk(): string
    {
        return config('filesystems.default', 'public');
    }

    /**
     * Apakah menggunakan R2.
     */
    public static function isR2(): bool
    {
        return self::disk() === 'r2';
    }
}
