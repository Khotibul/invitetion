# Panduan Deploy ke Vercel + PostgreSQL

> ⚠️ **Penting**: Vercel dirancang untuk frontend/serverless. Laravel bisa jalan di Vercel
> menggunakan runtime PHP (`vercel-php`), tapi dengan keterbatasan:
> - Tidak ada filesystem persistent (upload file harus pakai cloud storage seperti Cloudflare R2 / AWS S3)
> - Tidak ada background jobs
> - Cold start lebih lambat
>
> **Alternatif yang lebih direkomendasikan**: Railway.app atau Render.com

---

## Opsi A: Vercel + Supabase PostgreSQL (Gratis)

### Langkah 1 — Buat Database di Supabase

1. Daftar di [supabase.com](https://supabase.com)
2. Buat project baru
3. Masuk ke **Settings → Database**
4. Copy **Connection String** format URI:
   ```
   postgresql://postgres:[PASSWORD]@db.[PROJECT-REF].supabase.co:5432/postgres
   ```

### Langkah 2 — Setup Vercel

1. Push kode ke GitHub
2. Daftar di [vercel.com](https://vercel.com) dan import repository
3. Di **Environment Variables**, tambahkan:

```
APP_NAME=Risa Digital Invitation
APP_ENV=production
APP_KEY=base64:egol25DwAIDHhYJI4rxKDFjVta+OBT1VeW+NtNG24ms=
APP_DEBUG=false
APP_URL=https://your-app.vercel.app

DATABASE_URL=postgresql://postgres:[PASSWORD]@db.[REF].supabase.co:5432/postgres

DB_CONNECTION=pgsql
DB_HOST=db.[PROJECT-REF].supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your_supabase_password
DB_SSLMODE=require

SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=public
LOG_CHANNEL=stderr

GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=https://your-app.vercel.app/auth/google/callback
```

### Langkah 3 — Jalankan Migrasi

Setelah deploy pertama, jalankan migrasi via Supabase SQL Editor atau koneksi langsung:

```bash
# Dari lokal dengan DATABASE_URL Supabase
php artisan migrate --force
php artisan db:seed --force
```

---

## Opsi B: Railway.app (Lebih Direkomendasikan untuk Laravel)

Railway mendukung PHP + PostgreSQL secara native, lebih mudah dan reliable.

### Langkah 1 — Buat Project di Railway

1. Daftar di [railway.app](https://railway.app)
2. Klik **New Project → Deploy from GitHub**
3. Pilih repository ini

### Langkah 2 — Tambah PostgreSQL

1. Di dashboard Railway, klik **+ New Service → Database → PostgreSQL**
2. Railway otomatis inject `DATABASE_URL` ke environment

### Langkah 3 — Set Environment Variables

Di Railway dashboard → Variables:

```
APP_NAME=Risa Digital Invitation
APP_ENV=production
APP_KEY=base64:egol25DwAIDHhYJI4rxKDFjVta+OBT1VeW+NtNG24ms=
APP_DEBUG=false
APP_URL=https://your-app.up.railway.app

DB_CONNECTION=pgsql
# Railway otomatis set DATABASE_URL, atau isi manual dari PostgreSQL service

SESSION_DRIVER=database
CACHE_DRIVER=database
FILESYSTEM_DISK=public
LOG_CHANNEL=stderr
```

### Langkah 4 — Tambah `nixpacks.toml` untuk build

```toml
[phases.setup]
nixPkgs = ["php82", "php82Extensions.pdo_pgsql", "php82Extensions.pgsql", "composer"]

[phases.build]
cmds = ["composer install --no-dev --optimize-autoloader", "npm ci", "npm run build"]

[start]
cmd = "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT"
```

---

## Opsi C: Neon PostgreSQL (Serverless, Gratis)

[neon.tech](https://neon.tech) — PostgreSQL serverless yang cocok untuk Vercel.

1. Daftar dan buat database
2. Copy connection string dari dashboard
3. Gunakan sebagai `DATABASE_URL` di Vercel

---

## Menjalankan Migrasi Lokal dengan PostgreSQL

Pastikan PostgreSQL terinstall, lalu:

```bash
# Buat database
createdb undangan_digital

# Jalankan migrasi
php artisan migrate

# Seed data awal
php artisan db:seed
```

## Catatan Penting untuk Upload File

Karena Vercel tidak punya persistent storage, upload file harus dikonfigurasi ke cloud:

- **Cloudflare R2** (gratis 10GB) — recommended
- **AWS S3**
- **Supabase Storage**

Update `FILESYSTEM_DISK=s3` dan konfigurasi S3 credentials di `.env`.
