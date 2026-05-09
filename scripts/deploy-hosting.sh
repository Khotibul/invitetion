#!/bin/bash
# ─────────────────────────────────────────────────────────────────────────────
# deploy-hosting.sh — Jalankan di server hosting setelah upload file
# Usage: bash scripts/deploy-hosting.sh
# ─────────────────────────────────────────────────────────────────────────────

set -e

echo "=== [1/6] Clear semua cache ==="
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

echo "=== [2/6] Jalankan migration ==="
php artisan migrate --force

echo "=== [3/6] Rebuild cache production ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "=== [4/6] Storage link ==="
php artisan storage:link --force 2>/dev/null || true

echo "=== [5/6] Set permission ==="
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

echo "=== [6/6] Selesai ==="
echo "✅ Deploy berhasil!"
echo "   URL: $(grep APP_URL .env | cut -d= -f2)"
