#!/bin/bash
# ─────────────────────────────────────────────────────────────────────────────
# Setup awal aplikasi di server Proxmox / cPanel
# Jalankan sekali setelah clone repo ke server
#
# Usage:
#   chmod +x scripts/setup-server.sh
#   ./scripts/setup-server.sh
# ─────────────────────────────────────────────────────────────────────────────

set -e

echo "╔══════════════════════════════════════════════════════╗"
echo "║   Risa Digital Invitation — Setup Awal Server        ║"
echo "╚══════════════════════════════════════════════════════╝"
echo ""

# ── 1. Cek .env
if [ ! -f ".env" ]; then
    echo "[1/7] Membuat .env dari .env.example..."
    cp .env.example .env
    echo "      ⚠️  Edit .env dan isi DB_DATABASE, DB_USERNAME, DB_PASSWORD sebelum lanjut!"
    echo "      Tekan Enter setelah selesai edit .env..."
    read -r
else
    echo "[1/7] .env sudah ada — skip."
fi

# ── 2. Generate app key
echo "[2/7] Generate APP_KEY..."
php artisan key:generate --force

# ── 3. Install Composer (no-dev untuk production)
echo "[3/7] Install Composer dependencies..."
composer install --no-dev --prefer-dist --no-interaction --classmap-authoritative --optimize-autoloader

# ── 4. Buat direktori storage
echo "[4/7] Setup storage directories..."
mkdir -p storage/app/public
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
chmod -R 775 storage bootstrap/cache

# ── 5. Storage link
echo "[5/7] Membuat storage symlink..."
php artisan storage:link --force

# ── 6. Migrasi database
echo "[6/7] Menjalankan migrasi database..."
php artisan migrate --force

# ── 7. Seed database
echo "[7/7] Menjalankan database seeder..."
php artisan db:seed --force

# ── 8. Optimasi
echo "[8/8] Optimasi Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo ""
echo "✅ Setup selesai!"
echo "   URL: $(grep APP_URL .env | cut -d= -f2)"
echo ""
echo "   Login admin:"
echo "   Email   : admin@risadigital.com"
echo "   Password: Admin@2025!"
echo ""
echo "   ⚠️  Segera ganti password setelah login pertama!"
