#!/bin/bash
# ─────────────────────────────────────────────────────────────────────────────
# setup-storage.sh — Setup storage di server hosting
# Jalankan SEKALI setelah upload file ke server
# Usage: bash scripts/setup-storage.sh
# ─────────────────────────────────────────────────────────────────────────────

echo "=== Setup Storage ==="

# 1. Buat symlink storage
if [ ! -e "public/storage" ]; then
    php artisan storage:link --force
    echo "✅ Storage symlink dibuat"
else
    echo "ℹ️  Storage symlink sudah ada"
fi

# 2. Set permission
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
echo "✅ Permission diset"

# 3. Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
echo "✅ Cache dibersihkan"

echo ""
echo "✅ Setup selesai!"
echo ""
echo "PENTING: Upload file gambar via FTP ke:"
echo "  server: storage/app/public/avatar/"
echo "  server: storage/app/public/sm/"
echo "  server: storage/app/public/xs/"
echo "  server: storage/app/public/md/"
