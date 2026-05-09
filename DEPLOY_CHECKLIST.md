# Deploy Checklist — Hosting cPanel

## Masalah: CSS tidak ter-load (tampilan polos)

### Root Cause
`@vite()` di Laravel membutuhkan Vite dev server atau file `public/build/manifest.json`.
Di shared hosting, Vite dev server tidak berjalan, sehingga CSS tidak ter-load.

### Solusi yang sudah diterapkan
Semua layout sudah diubah dari `@vite()` ke `asset()` langsung:
- `resources/views/member/layouts/app.blade.php`
- `resources/views/member/layouts/auth.blade.php`
- `resources/views/panel/layouts/app.blade.php`
- `resources/views/panel/layouts/auth.blade.php`
- `resources/views/layouts/app.blade.php`
- `resources/views/guestbook/layouts/app.blade.php`
- `resources/views/template/default.blade.php`

---

## Langkah Deploy

### Step 1: Upload file ke server

Upload via FTP/cPanel File Manager ke folder `public_html/` (atau sesuai root hosting):

**Wajib upload:**
```
public/build/                    ← SELURUH folder (manifest.json + assets/)
resources/views/                 ← SELURUH folder views
.env                             ← pastikan APP_ENV=production
```

**Struktur yang harus ada di server:**
```
public_html/
├── public/
│   ├── build/
│   │   ├── manifest.json
│   │   └── assets/
│   │       ├── member-style-KtJH4um1.css   ← CSS utama member
│   │       ├── member-style-s-rZ5YENN6.css ← CSS member (sass)
│   │       ├── sneat-D9iDqN5M.css          ← CSS panel admin
│   │       ├── member-script-DHdsZRvy.js   ← JS member
│   │       ├── sneat-iDp9ln3u.js           ← JS panel
│   │       ├── vendor-*.js                 ← vendor chunks
│   │       └── ...
│   └── index.php
├── resources/views/
├── app/
└── ...
```

### Step 2: Diagnosa di browser

Buka URL ini untuk cek apakah asset ada di server:
```
https://undanganwedding.risa-achla-invitation.xyz/check-assets.php
```

Jika ada file yang ❌ MISSING, upload ulang folder `public/build/`.

### Step 3: Clear cache di server

Buka URL ini untuk clear semua cache:
```
https://undanganwedding.risa-achla-invitation.xyz/clear-cache.php
```

### Step 4: Hapus file diagnosa

Setelah selesai, hapus kedua file ini dari server:
- `public/check-assets.php`
- `public/clear-cache.php`

### Step 5: Verifikasi .env di server

Pastikan `.env` di server berisi:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://undanganwedding.risa-achla-invitation.xyz
```

---

## Jika masih bermasalah

Cek di browser DevTools (F12 → Network):
1. Apakah ada request ke `/build/assets/member-style-*.css`?
2. Apakah response-nya 404 atau 200?
3. Jika 404 → file tidak ada di server, upload ulang `public/build/`
4. Jika 200 tapi CSS tidak apply → clear browser cache (Ctrl+Shift+R)
